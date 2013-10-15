<?php

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
        // create config service
        if (!isset($config['services']['config']))
        {
            throw new InvalidArgumentException('configuration needs services.config');
        }

        /* @var \ppma\Service\ConfigService $configService */
        $configService = ServiceFactory::get($config['services']['config'], ['config' => $config]);
        ServiceFactory::init($configService);

        // config dispatch
        config('dispatch.views', '../views');
        config('dispatch.router', pathinfo($configService->get('url'), PATHINFO_BASENAME));
        config('dispatch.url',    pathinfo($configService->get('url'), PATHINFO_DIRNAME));

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
        on('GET', '/login', function() {
            echo $this->createController('\ppma\Controller\LoginController')->get();
        });

        on('POST', '/login', function() {
            echo $this->createController('\ppma\Controller\LoginController')->post();
        });
    }

    /**
     * @return void
     */
    public function run()
    {
        dispatch();
    }

}