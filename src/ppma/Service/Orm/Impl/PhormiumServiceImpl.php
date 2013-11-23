<?php


namespace ppma\Service\Orm\Impl;


use ppma\Service\Orm\PhormiumService;
use ppma\Config;
use Phormium\DB;

class PhormiumServiceImpl implements PhormiumService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        // config phormium
        DB::configure([
            'databases' => [
                'ppma' => [
                    'dsn' => sprintf('mysql:host=%s;dbname=%s',
                        Config::get('database.host', 'localhost'),
                        Config::get('database.name', 'ppma')
                    ),
                    'username' => Config::get('database.username', 'root'),
                    'password' => Config::get('database.password', '')
                ],
            ],
            'logging' => false
        ]);
    }

}