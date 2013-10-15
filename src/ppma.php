<?php


use Symfony\Component\HttpFoundation\Request;

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
     * @var ppma
     */
    protected static $instance;

    /**
     * @var array ['id' => 'instance of service']
     */
    protected $services = [];

    /**
     * @var Silex\Application
     */
    protected $silex;

    /**
     * @param array $config
     * @throws \InvalidArgumentException
     */
    public function __construct($config = [])
    {
        // create application
        $app         = new Silex\Application();
        $this->silex = $app;

        // create config service
        if (!isset($config['services']['config']))
        {
            debug_print_backtrace();die();
            throw new InvalidArgumentException('configuration needs services.config');
        }

        $serviceId           = $config['services']['config'];
        $this->configService = $this->createService($serviceId, ['config' => $config]);

        // register UrlGenerator
        $app->register(new Silex\Provider\UrlGeneratorServiceProvider());

        // register SessionProvider
        $app->register(new Silex\Provider\SessionServiceProvider());
        $app['session.storage.save_path'] = realpath(__DIR__ . '/../tmp/sessions');

        // register WebUserProvider
        $app->register(new \ppma\Provider\User());

        // register Whoops
        $app->register(new Whoops\Provider\Silex\WhoopsServiceProvider());
        $app['whoops']->pushHandler(new \Whoops\Handler\PrettyPageHandler());
        $app['whoops']->pushHandler(new \Whoops\Handler\JsonResponseHandler());

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
     * @return \Silex\Application
     */
    public function getSilex()
    {
        return $this->silex;
    }


    /**
     * @param array $config
     * @return ppma
     */
    public static function app($config = [])
    {
        if (self::$instance == null)
        {
            self::$instance = new ppma($config);
        }

        return self::$instance;
    }

    /**
     * @return void
     */
    protected function registerRoutes()
    {
        $app = $this->silex;

        // register routes
        $app->get('/entries',        '\ppma\Controller\Entries::all');
        $app->get('/entries/recent', '\ppma\Controller\Entries::recent');

        // GET: /app
        $app->get('/app', function() {
            return $this->createController('\ppma\Controller\App')->home();
        })->bind('app');

        // GET: /login
        $app->get('/login', function() {
            return $this->createController('\ppma\Controller\Login')->get();
        })->bind('login');

        // POST: /login
        $app->post('/login', function(Request $request) {
            return $this->createController('\ppma\Controller\Login')->post($request);
        });
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->silex->run();
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


    /**
     * Alias for getSilex()
     *
     * @return \Silex\Application
     */
    public function silex()
    {
        return $this->getSilex();
    }

}