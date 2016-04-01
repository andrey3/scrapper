<?php

use yii\db\Migration;
use yii\db\Schema;

class m160331_080627_create_prices_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('prices',
            [
                'id'=>Schema::TYPE_PK,
                'product_id'=>Schema::TYPE_INTEGER. ' NOT NULL',
                'price' => Schema::TYPE_STRING.' NOT NULL'
            ]
        );
        $this->addForeignKey('fk_product_price', 'prices', 'product_id', 'products', 'id');

    }

    public function safeDown()
    {
        $this->dropTable('prices');
        $this->dropForeignKey('fk_product_price', 'prices');
    }
}
