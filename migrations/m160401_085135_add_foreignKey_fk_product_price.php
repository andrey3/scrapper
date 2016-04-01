<?php

use yii\db\Migration;

class m160401_085135_add_foreignKey_fk_product_price extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('fk_product_price', 'products_info');
        $this->addForeignKey('fk_product_price', 'products_info', 'product_id', 'products', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_product_price', 'products_info');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
