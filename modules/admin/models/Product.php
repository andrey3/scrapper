<?php

namespace app\modules\admin\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "products".
 *
 * @property integer $id
 * @property string $title
 * @property string $link
 */

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'products';
    }

    public function rules()
    {
        return [
            [['title', 'link'], 'filter', 'filter' => 'trim'],
            [['title', 'link'], 'required'],
            ['title', 'string', 'min' => 4, 'max' => 255],
            ['link', 'string', 'min' => 6, 'max' => 255],
            [['title', 'link'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'link' => 'Link',
        ];
    }

    public static function getAll()
    {
        $products = self::find()->all();
        return $products;
    }

    public static function getById($id)
    {
        return static::findOne([
            'id' => $id
        ]);
    }

    public function getInfo()
    {
        return $this->hasOne(ProductInfo::className(), ['product_id' => 'id']);
    }

}
