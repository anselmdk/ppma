<?php

use yii\db\Migration;

class m141230_204929_fixture extends Migration
{
    public function up()
    {
        $this->insert('entries', [
            'name' => 'alternate.de',
            'username' => 'dev@klinks.info',
            'url' => 'http://www.alternate.de',
        ]);
        $this->insert('entries', [
            'name' => 'amazon.de',
            'username' => 'dev@klinks.info',
            'url' => 'http://www.amazon.de',
        ]);
        $this->insert('entries', [
            'name' => 'github.com',
            'username' => 'pklink',
            'url' => 'http://github.com',
        ]);

        $this->insert('categories', ['name' => 'Shop']);
        $this->insert('categories', ['name' => 'Coding']);
        $this->insert('categories', ['name' => 'Stuff']);
    }

    public function down()
    {
        $this->truncateTable('entries');
        $this->truncateTable('categories');
    }
}
