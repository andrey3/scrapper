<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\Product;
use app\modules\admin\models\ProductInfo;

class ParserController extends Controller
{
    public function actionGetPrice()
    {
        /* @var \app\components\parser\ShopParser $shopParser */

        $shopParser = Yii::$app->get('shopParser');
        $products = Product::getAll();
        foreach ($products as $product) {
            $price = 'Link is not correct';
            if (isset($product->info->price)) {
                $model = $product->info;
            } else {
                $model = new ProductInfo();
            }
            try {
                $price = $shopParser->parsePrice($product->link);
                $price = mb_convert_encoding($price, 'utf8', 'cp1251');
            } catch (\Exception $e) {
                echo $e->getMessage() . "\n";
            }
            if (!isset($model->price)) {
                $model->product_id = $product->id;
            }
            $model->price = $price;
            $result = $model->save();

        }
        if (isset($result)) {
            return $this->redirect('/admin/product/index');
        } else {
            return false;
        }
    }

    public function actionParsing($id)
    {
        /* @var \app\components\parser\ShopParser $shopParser */

        $shopParser = Yii::$app->get('shopParser');
        $product = Product::getById($id);
        if (isset($product->info->price)) {
            $model = $product->info;
        } else {
            $model = new ProductInfo();
        }
        try {
            $price = $shopParser->parsePrice($product->link);
            $price = mb_convert_encoding($price, 'utf8', 'cp1251');
            $model->price = $price;
            $model->product_id = $id;
        } catch (\Exception $e) {
            $product->addError('link', 'Link don\'t validate');
        }
        if($model->save()) {
            return $this->redirect('/admin/product/index');
        } else {
            return $this->render(
                '/product/product',
                ['model' => $product]
            );
        }
    }
}