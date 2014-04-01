<?php

namespace ppma;

use Hahns\Hahns;
use Hahns\Request;
use Hahns\Response\Json;
use Hahns\Response;
use ppma\Action\Auth\AuthAction;
use ppma\Action\Auth\CreateNewKeyAction;
use ppma\Action\Server\PingAction;
use ppma\Action\Server\RedirectToPingAction;
use ppma\Action\User\CreateAction;
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

        // create instance of Hahns
        $this->app = new Hahns($config);

        // create and init logger
        Logger::init($this->app->config('log'));

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

        $this->app->service('user', function () use ($prepare) {
            return $prepare('\ppma\Service\Model\User');
        });

        $this->app->service('password', function () use ($prepare) {
            return $prepare('\ppma\Service\Password');
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

            // set application to action
            $action->setApplication($this->app);

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
            return $caller(RedirectToPingAction::class, [$res]);
        });

        $this->app->get('/ping', function (Json $res) use ($caller) {
            return $caller(PingAction::class, [$res]);
        });

        // auth
        $this->app->post('/users/[.+:slug]/auth', function (Request $req, Json $res) use ($caller) {
            return $caller(CreateNewKeyAction::class, [$req, $res]);
        });

        $this->app->get('/users/[.+:slug]/auth/[.+:password]', function (Request $req, Json $res) use ($caller) {
            return $caller(AuthAction::class, [$req, $res]);
        });

        // user
        $this->app->post('/users', function (Request $req, Json $res) use ($caller) {
            return $caller(CreateAction::class, [$req, $res]);
        });


        //http://localhost:8000/api.php?entries
        // entries
        $this->app->get('/entries', function (Json $res) use ($caller) {
            return $res->send([
                'data' => [[
                    'name' => 'google.com'
                ], [
                    'name' => 'amazon.com'
                ], [
                    'name' => 'buch.de'
                ]]
            ]);
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
