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
        // initialize ppma\Config
        Config::init($config);

        // config dispatch

        config('dispatch.router', pathinfo(Config::get('url'), PATHINFO_BASENAME));
        config('dispatch.url',    pathinfo(Config::get('url'), PATHINFO_DIRNAME));

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
            ControllerFactory::get('\ppma\Controller\LoginController')->get();
        });

        on('POST', '/login', function() {
            ControllerFactory::get('\ppma\Controller\LoginController')->post();
        });

        on('GET', '/app', function() {
            ControllerFactory::get('\ppma\Controller\AppController')->home();
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