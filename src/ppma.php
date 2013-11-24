<?php

use ppma\Config;
use ppma\Factory\ActionFactory;
use ppma\Factory\ServiceFactory;
use ppma\Service\Response\Impl\AccessDeniedImpl;
use ppma\Service\ResponseService;

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

        // set error handler
        $catcher = new UniversalErrorCatcher_Catcher();
        $catcher->registerCallback(function(\Exception $e) {
            /* @var \ppma\Service\Response\Impl\JsonServiceImpl $response */
            $response = ServiceFactory::get(Config::get('services.response'));

            if (Config::get('dev-mode'))
            {
                $response
                    ->addData('type', get_class($e))
                    ->addData('message', $e->getMessage())
                    ->addData('file', $e->getFile())
                    ->addData('line', $e->getLine())
                    ->addData('trace', $e->getTrace())
                ;
            }
            else
            {
                $response->addData('message', 'see log for more information');
            }
            $response->setStatusCode(500);


            $this->sendResponse($response);
            exit;
        });
        $catcher->start();

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

            // trigger `before`-event
            $action->before();

            // init action
            $action->init($args);

            // run action
            $response = $action->run();

            if ($response instanceof AccessDeniedImpl)
            {
                error(403);
            }

            // output action
            $this->sendResponse($response);

            // triger `after`-event
            $action->after();
        };

        // server
        on('GET', '/', function() use ($caller) { $caller('\ppma\Action\Server\RedirectToPingAction'); });
        on('GET', '/ping', function() use ($caller) { $caller('\ppma\Action\Server\PingAction'); });

        // auth
        on('GET', '/users/:slug/auth/:password', function($slug, $password) use ($caller) {
            $caller('\ppma\Action\Auth\GetKeyAction', ['slug' => $slug, 'password' => $password]); }
        );

        on('POST', '/users/:slug/auth', function($slug) use ($caller) {
                $caller('\ppma\Action\Auth\CreateNewKeyAction', ['slug' => $slug]); }
        );

        // user
        on('POST', '/users', function() use ($caller) { $caller('\ppma\Action\User\CreateAction'); });

        on('PUT', '/users/:slug', function($slug) use ($caller) {
            $caller('\ppma\Action\User\UpdateAction', ['slug' => $slug]);
        });

        // 403-handler
        error(403, function() use ($caller) {
            $caller('\ppma\Action\Error\AccessDeniedAction');
        });

        // 404-handler
        error(404, function() use ($caller) {
            $caller('\ppma\Action\Error\NotFoundAction');
        });
    }

    /**
     * @return void
     */
    public function run()
    {
        dispatch();
    }

    protected function sendResponse(ResponseService $response)
    {
        header(sprintf('HTTP/1.1 %d', $response->getStatusCode()));

        foreach ($response->getHeader() as $name => $value)
        {
            header(sprintf('%s: %s', $name, $value));
        }

        echo $response->getBody();
    }

}