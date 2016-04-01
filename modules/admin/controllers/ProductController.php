<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\modules\admin\models\ProductForm;
use app\modules\admin\models\Product;
use app\modules\admin\controllers\ParserController;

class ProductController extends Controller
{

    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            $products = Product::getAll();
            return $this->render('index', ['products' => $products]);
        } else {
            return $this->redirect('/sign/login');
        }
    }

    public function actionAdd()
    {
        $model = new ProductForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($product = $model->add()) {
                return $this->redirect('/admin/parser/parsing/'.$product->id);
            } else {
                Yii::$app->session->setFlash('error', 'Error product add.');
                Yii::error('Error product add');
                return $this->refresh();
            }
        }

        return $this->render(
            'product',
            ['model' => $model]
        );

    }
    public function actionEdit($id)
    {
        $model = new ProductForm();
        $model->getProduct($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($product = $model->edit($id)) {
                return $this->redirect('/admin/parser/parsing/'.$product->id);
            } else {
                Yii::$app->session->setFlash('error', 'Error product edit.');
                Yii::error('Error product edit');
                return $this->refresh();
            }
        }

        return $this->render(
            'product',
            ['model' => $model]
        );

    }

    public function actionDelete($id)
    {
        $result = Product::deleteAll("id = $id");

        if (!$result) {
            Yii::$app->session->setFlash('delete_error', 'Error product delete.');
            Yii::error('Error product delete');
        }
        return $this->redirect('/admin/product/index');

    }


}