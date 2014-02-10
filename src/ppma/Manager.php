<?php

namespace ppma;

use Hahns\Hahns;
use Hahns\Request;
use Hahns\Response\Json;
use Hahns\Response;
use ppma\Exception\Response\ForbiddenException;
use ppma\Factory\ActionFactory;
use ppma\Logger;

class Manager
{

    /**
     * @var Hahns
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
        $this->app = new Hahns(true);

        // create and init logger
        Logger::init(Config::get('log'));

        // register routes
        $this->registerServices();
        $this->registerRoutes();
    }

    /**
     * @return void
     */
    protected function registerServices()
    {
        $prepare = function ($id) {
            /* @var Service $service */
            $service = new $id();
            $service->setApplication($this->app);
            $service->init();
            return $service;
        };

        $this->app->service('db', function () use ($prepare) {
            return $prepare('\ppma\Service\Database');
        });

        $this->app->service('user-service', function () use ($prepare) {
            return $prepare('\ppma\Service\Model\User');
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
        $this->app->get('/', function (Json $res) use ($caller) {
            return $caller('\ppma\Action\Server\RedirectToPingAction', [$res]);
        });

        $this->app->get('/ping', function (Json $res) use ($caller) {
            return $caller('\ppma\Action\Server\PingAction', [$res]);
        });

        $this->app->post('/users/[.+:slug]/auth', function (Request $req, Json $res, Hahns $app) use ($caller) {
            return $caller('\ppma\Action\Auth\CreateNewKeyAction', [$req, $res, $app]);
        });
    }

    /**
     * @return void
     */
    public function run()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        try {
            $this->app->run();
        } catch (ForbiddenException $e) {
            /* @var Json $response */
            $response = $this->app->service('json-response');
            echo $response->send([
                'code'    => $e->getCode(),
                'message' => $e->getMessage()
            ], Response::CODE_FORBIDDEN);
        }

    }
}
