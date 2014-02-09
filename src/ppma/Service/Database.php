<?php


namespace ppma\Service;


use Phormium\DB;
use ppma\Config;
use ppma\Logger;

class Database extends ServiceImpl
{

    /**
     * @var bool
     */
    protected $isConnected = false;

    /**
     * @return void
     */
    public function connect()
    {
        if (!$this->isConnected) {
            Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

            // config phormium
            DB::configure([
                'databases' => [
                    'ppma' => [
                        'dsn' => sprintf(
                            'mysql:host=%s;dbname=%s',
                            Config::get('database.host', 'localhost'),
                            Config::get('database.name', 'ppma')
                        ),
                        'username' => Config::get('database.username', 'root'),
                        'password' => Config::get('database.password', '')
                    ],
                ],
                'logging' => false
            ]);

            $this->isConnected = true;
        }
    }
}
