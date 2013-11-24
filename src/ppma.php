<?php

use ppma\Config;
use ppma\Factory\ActionFactory;
use ppma\Factory\ServiceFactory;
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

        // set error handler in DEV_MODE
        if (DEV_MODE)
        {
            $catcher = new UniversalErrorCatcher_Catcher();
            $catcher->registerCallback(function(\Exception $e) {
                /* @var \ppma\Service\Response\Impl\JsonServiceImpl $response */
                $response = ServiceFactory::get(Config::get('services.response'));

                $response
                    ->addData('type', get_class($e))
                    ->addData('message', $e->getMessage())
                    ->addData('file', $e->getFile())
                    ->addData('line', $e->getLine())
                    ->addData('trace', $e->getTrace())
                    ->setStatusCode(500)
                ;

                $this->sendResponse($response);
                exit;
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

            // trigger `before`-event
            $action->before();

            // init action
            $action->init($args);

            // run action
            $response = $action->run();

            // output action
            $this->sendResponse($response);

            // triger `after`-event
            $action->after();
        };

        // server
        on('GET', '/', function() use ($caller) { $caller('\ppma\Action\Server\RedirectToPingAction'); });
        on('GET', '/ping', function() use ($caller) { $caller('\ppma\Action\Server\PingAction'); });

        // auth
        on('GET', '/users/:username/auth/:password', function($username, $password) use ($caller) {
            $caller('\ppma\Action\Auth\GetKeyAction', ['username' => $username, 'password' => $password]); }
        );

        on('POST', '/users/:username/auth', function($username) use ($caller) {
                $caller('\ppma\Action\Auth\CreateNewKeyAction', ['username' => $username]); }
        );

        // user
        on('POST', '/users', function() use ($caller) { $caller('\ppma\Action\User\CreateAction'); });

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