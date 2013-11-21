<?php

use ppma\Config;
use ppma\Factory\ControllerFactory;
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
     * @param string $id
     * @return \ppma\Controller
     */
    public function createController($id)
    {
        if (!isset($this->controller[$id]))
        {
            /* @var \ppma\Controller $controller */
            $controller = new $id();
            ServiceFactory::adorn($controller);

            // attach services to controller
            ServiceFactory::adorn($controller);

            // save controller
            $this->controller[$id] = $controller;
        }

        return $this->controller[$id];
    }

    /**
     * @return void
     */
    protected function registerRoutes()
    {
        $caller = function($id, $method, $args = []) {
            /* @var \ppma\Controller $controller */
            $controller = ControllerFactory::get($id);
            $controller->before();

            if (isset($args[0]))
            {
                $controller->$method($args[0]);
            }
            else
            {
                $controller->$method();
            }


            $controller->after();
        };

        // user
        on('POST', '/users', function() use ($caller) {
            $caller('\ppma\Controller\UserController', 'create');
        });

        on('GET',  '/',       function() use ($caller) { $caller('\ppma\Controller\ServerController', 'getVersion'); });
        on('GET',  '/login',  function() use ($caller) { $caller('\ppma\Controller\LoginController',  'get'); });
        on('POST', '/login',  function() use ($caller) { $caller('\ppma\Controller\LoginController',  'post'); });
    }

    /**
     * @return void
     */
    public function run()
    {
        dispatch();
    }

}