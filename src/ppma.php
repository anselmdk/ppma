<?php


class ppma
{

    /**
     * @var \ppma\Service\ConfigService
     */
    protected $configService;

    /**
     * @var array ['id' => 'instance of controller']
     */
    protected $controller = [];

    /**
     * @var array ['id' => 'instance of service']
     */
    protected $services = [];

    /**
     * @param array $config
     * @throws \InvalidArgumentException
     */
    public function __construct($config = [])
    {
        config('dispatch.views', '../views');
        config('dispatch.router', 'index.php');
        config('dispatch.url', 'http://localhost:8080/ppmasilex');

        // create config service
        if (!isset($config['services']['config']))
        {
            throw new InvalidArgumentException('configuration needs services.config');
        }

        $serviceId           = $config['services']['config'];
        $this->configService = $this->createService($serviceId, ['config' => $config]);

        // register routes
        $this->registerRoutes();
    }

    /**
     * @param \ppma\Serviceable $object
     */
    public function attachServices(\ppma\Serviceable $object)
    {
        // create services
        foreach ($object->services() as $configuration)
        {
            $name = $configuration['name'];
            $id   = $configuration['id'];
            $args = [];

            if (isset($configuration['args']))
            {
                $args = $configuration['args'];
            }

            // create service
            $service = $this->createService($id, $args);

            // set service to object
            $object->setService($name, $service);
        }
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
            $controller->setConfigService($this->configService);

            // attach services to controller
            $this->attachServices($controller);

            // save controller
            $this->controller[$id] = $controller;
        }

        return $this->controller[$id];
    }

    /**
     * @param string $id
     * @param array $args
     * @return \ppma\Service
     * @throws ppma\Exception\ServiceDoesNotExist
     * @throws ppma\Exception\InstanceIsNotAService
     */
    public function createService($id, $args = [])
    {
        if (!isset($this->services[$id]))
        {
            // check if class $id exist
            if (!class_exists($id))
            {
                throw new \ppma\Exception\ServiceDoesNotExist($id);
            }

            /* @var \ppma\Service $service */
            $service = new $id();

            // check if $service really a service
            if (!($service instanceof \ppma\Service))
            {
                throw new \ppma\Exception\InstanceIsNotAService($id);
            }

            // attach services if object serviceable
            if ($service instanceof \ppma\Serviceable)
            {
                /* @var \ppma\Serviceable $service */
                $service->setConfigService($this->configService);
                $this->attachServices($service);
            }

            // init service
            $service->init($args);

            // save service
            $this->services[$id] = $service;
        }

        return $this->services[$id];
    }

    /**
     * @return void
     */
    protected function registerRoutes()
    {
        on('GET', '/login', function() {
            echo $this->createController('\ppma\Controller\Login')->get();
        });

        on('POST', '/login', function() {
            echo $this->createController('\ppma\Controller\Login')->post();
        });
    }

    /**
     * @return void
     */
    public function run()
    {
        dispatch();
    }

    /**
     * @param \ppma\Controller $controller
     * @return void
     */
    protected function setServices(\ppma\Controller $controller)
    {
        foreach ($controller->services() as $name => $id)
        {
            $controller->setService($name, $this->createService($id));
        }
    }

}