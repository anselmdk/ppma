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
        // initialize ppma\Config
        Config::init($config);

        // set error handler in DEV_MODE
        if (DEV_MODE)
        {
            $catcher = new UniversalErrorCatcher_Catcher();
            $catcher->registerCallback(function(\Exception $e) {
                /* @var \ppma\Service\Response\Json\ResponseServiceImpl $response */
                $response = ServiceFactory::get(Config::get('services.response'));

                $response->send([
                    'type'    => get_class($e),
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine(),
                    'trace'   => $e->getTrace()
                ], 500);
                die();
            });
            $catcher->start();
        }

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
        on('GET', '/', function() use ($caller) { $caller('\ppma\Action\Server\RedirectToPingAction'); });
        on('GET', '/ping', function() use ($caller) { $caller('\ppma\Action\Server\PingAction'); });

        // auth
        on('GET', '/users/:username/auth/:password', function($username, $password) use ($caller) {
            $caller('\ppma\Action\Auth\GetKeyAction', ['username' => $username, 'password' => $password]); }
        );

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