<?php

use yii\db\Migration;

class m160401_072834_rename_table_price extends Migration
{
    public function up()
    {
        $this->renameTable('prices', 'products_info');
    }

    public function down()
    {
        $this->renameTable('products_info', 'prices');
    }
}
