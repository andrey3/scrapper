<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $product_id
 * @property ProductInfo $price
 */

class ProductInfo extends ActiveRecord
{
    public static function tableName()
    {
        return 'products_info';
    }

    public function rules()
    {
        return [
            ['price', 'filter', 'filter' => 'trim'],
            ['price', 'required'],
            ['product_id', 'exist', 'targetClass' => Product::className(), 'targetAttribute' => 'id'],
            ['product_id', 'unique', 'targetClass' => ProductInfo::className()],
            ['price', 'string', 'min' => 4, 'max' => 255],
            [['price', 'product_id'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'price' => 'Price',
        ];
    }

    public static function getAll()
    {
        $prices = self::find()->all();
        return $prices;
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}