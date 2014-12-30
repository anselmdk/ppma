<?php

use yii\db\Migration;

class m141230_204040_category extends Migration
{
    public function up()
    {
        $this->createTable('categories', [
            'id' => 'pk',
            'name' => \yii\db\Schema::TYPE_STRING . ' NOT NULL'
        ]);

        $this->createIndex('name', 'categories', 'name');
    }

    public function down()
    {
        $this->dropTable('categories');
    }
}
