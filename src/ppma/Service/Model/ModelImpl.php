<?php


namespace ppma\Service\Model;


use ppma\Service\ServiceImpl;

class ModelImpl extends ServiceImpl
{

    /**
     * @return void
     */
    public function init()
    {
        parent::init();

        /* @var \ppma\Service\Database $db */
        $db = $this->app->service('db');
        $db->connect();
    }
}
