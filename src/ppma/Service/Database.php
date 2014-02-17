<?php


namespace ppma\Service;


use Phormium\DB;
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
                            $this->app->config('database.host'),
                            $this->app->config('database.name')
                        ),
                        'username' => $this->app->config('database.username'),
                        'password' => $this->app->config('database.password')
                    ],
                ],
                'logging' => false
            ]);

            $this->isConnected = true;
        }
    }
}
