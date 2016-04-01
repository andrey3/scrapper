<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use app\modules\admin\models\Product;

class ProductForm extends Model
{

    public $title;
    public $link;

    protected $_product;

    public function rules()
    {
        return [
            [['title', 'link'], 'filter', 'filter' => 'trim'],
            [['title', 'link'], 'required'],
            ['title', 'string', 'min' => 4, 'max' => 255],
            ['link', 'string', 'min' => 10, 'max' => 255],
            ['link', 'url'],
            [['title', 'link'], 'safe']
        ];
    }

    public function add()
    {
        $product = new Product();

        $product->title = $this->title;
        $product->link = $this->link;

        return $product->save(false) && empty($this->getErrors()) ? $product : null;
    }

    public function getProduct($id)
    {
        if(!$this->_product instanceof Product){
            $this->_product = Product::getById($id);
            $this->setAttributes($this->_product->getAttributes());
        }
        return $this->_product;
    }

    public function edit($id)
    {
        $product = $this->getProduct($id);

        $product->title = $this->title;
        $product->link = $this->link;

        return $product->save(false) && empty($this->getErrors()) ? $product : null;
    }
}