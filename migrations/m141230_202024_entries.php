<?php

use yii\db\Migration;
use yii\db\Schema;

class m141230_202024_entries extends Migration
{

    public function up()
    {
        $this->createTable('entries', [
            'id' => 'pk',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'username' => Schema::TYPE_STRING,
            'url' => Schema::TYPE_STRING
        ]);

        $this->createIndex('name', 'entries', 'name');
        $this->createIndex('username', 'entries', 'username');
    }

    public function down()
    {
        $this->dropTable('entries');
    }
}
