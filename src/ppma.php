<?php

use ppma\Config;
use ppma\Factory\ActionFactory;
use ppma\Logger;

class ppma
{

    /**
     * @var array ['id' => 'instance of controller']
     */
    protected $controller = [];

    /**
     * @var \Hahns\Hahns
     */
    protected $app;

    /**
     * @param array $config
     * @throws \InvalidArgumentException
     */
    public function __construct($config = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        // initialize ppma\Config
        Config::init($config);

        // create instance of Hahns
        $this->app = new \Hahns\Hahns(true);

        // create and init logger
        \ppma\Logger::init(Config::get('log'));

        // register routes
        $this->registerServices();
        $this->registerRoutes();
    }

    /**
     * @return void
     */
    protected function registerServices()
    {
        $this->app->service('db', function () {
            $service = new \ppma\Service\Database();
            $service->setApplication($this->app);
            $service->init();
            return $service;
        });

        $this->app->service('user-service', function () {
            $service = new \ppma\Service\Model\User();
            $service->setApplication($this->app);
            $service->init();
            return $service;
        });
    }

    /**
     * @return void
     */
    protected function registerRoutes()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $caller = function ($id, $args = []) {
            /* @var \ppma\Action $action */
            $action = ActionFactory::create($id, $args);

            // trigger `before`-event
            $action->before();

            // run action
            $response = $action->run();

            // triger `after`-event
            $action->after();

            // return response
            return $response;
        };

        // server
        $this->app->get('/', function (\Hahns\Response\Json $response) use ($caller) {
            return $caller('\ppma\Action\Server\RedirectToPingAction', [$response]);
        });

        $this->app->get('/ping', function (\Hahns\Response\Json $response) use ($caller) {
            return $caller('\ppma\Action\Server\PingAction', [$response]);
        });

        $this->app->post('/users/[.+:slug]/auth', function (\Hahns\Request $request, \Hahns\Response\Json $response, \Hahns\Hahns $app) use ($caller) {
            return $caller('\ppma\Action\Auth\CreateNewKeyAction', [$request, $response, $app]);
        });
    }

    /**
     * @return void
     */
    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        $this->app->run();
    }
}
