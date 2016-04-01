<?php

use yii\db\Migration;
use yii\db\Schema;

class m160331_075414_create_products_table extends Migration
{
    public function up()
    {
        $this->createTable('products',
            [
                'id'=>Schema::TYPE_PK,
                'title' => Schema::TYPE_STRING.' NOT NULL',
                'link' => Schema::TYPE_STRING.' NOT NULL',
            ]
        );
    }

    public function down()
    {
        $this->dropTable('products');
    }
}
