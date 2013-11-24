<?php


namespace ppma\Service\Orm\Impl;


use Phormium\DB;
use ppma\Config;
use ppma\Logger;
use ppma\Service\Orm\PhormiumService;

class PhormiumServiceImpl implements PhormiumService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

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