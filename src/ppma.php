<?php

use ppma\Config;
use ppma\Factory\ActionFactory;
use ppma\Factory\ServiceFactory;

class ppma
{

    /**
     * @var array ['id' => 'instance of controller']
     */
    protected $controller = [];

    /**
     * @param array $config
     * @throws \InvalidArgumentException
     */
    public function __construct($config = [])
    {
        // set error handler in DEV_MODE
        if (DEV_MODE)
        {
            $catcher = new UniversalErrorCatcher_Catcher();
            $catcher->registerCallback(function(\Exception $e) {
                echo '<pre>';
                printf("Type:    %s\n",   get_class($e));
                printf("Message: %s\n",   $e->getMessage());
                printf("File:    %s\n",   $e->getFile());
                printf("Line:    %s\n\n", $e->getLine());
                printf("Message: \n%s",   $e->getTraceAsString());
                echo '</pre>';
                die();
            });
            $catcher->start();
        }

        // initialize ppma\Config
        Config::init($config);

        // config phormium
        Phormium\DB::configure([
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

        // config dispatch
        config('dispatch.router', 'index.php');

        // create and init logger
        \ppma\Logger::init(Config::get('log'));

        // register routes
        $this->registerRoutes();
    }

    /**
     * @return void
     */
    protected function registerRoutes()
    {
        $caller = function($id, $args = []) {
            /* @var \ppma\Action $action */
            $action = ActionFactory::get($id);
            $action->before();
            $action->init($args);
            $action->run();
            $action->after();
        };

        // server
        on('GET', '/', function() use ($caller) { $caller('\ppma\Action\Server\PingAction'); });

        // user
        on('POST', '/users', function() use ($caller) { $caller('\ppma\Action\User\CreateAction'); });
    }

    /**
     * @return void
     */
    public function run()
    {
        dispatch();
    }

}