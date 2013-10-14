<?php


use Symfony\Component\HttpFoundation\Request;

class ppma
{

    /**
     * @var array ['id' => 'instance of controller']
     */
    protected $controller = [];


    /**
     * @var Silex\Application
     */
    protected $silex;


    /**
     * @var ppma
     */
    protected static $instance;

    /**
     * @var array ['id' => 'instance of service']
     */
    protected $services = [];


    /**
     * @return \ppma
     */
    protected function __construct()
    {
        // create application
        $app         = new Silex\Application();
        $this->silex = $app;

        // register UrlGenerator
        $app->register(new Silex\Provider\UrlGeneratorServiceProvider());

        // register SessionProvider
        $app->register(new Silex\Provider\SessionServiceProvider());
        $app['session.storage.save_path'] = realpath(__DIR__ . '/../tmp/sessions');

        // register WebUserProvider
        $app->register(new \ppma\Provider\User());

        // register Whoops
        $app->register(new Whoops\Provider\Silex\WhoopsServiceProvider());
        $app['whoops']->pushHandler(new \Whoops\Handler\JsonResponseHandler());

        // register Spot
        $app->register(new Psamatt\Silex\SpotServiceProvider('mysql://root:bitnami@localhost/ppmasilex'));

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

            // create services
            foreach ($controller->services() as $configuration)
            {
                $name = $configuration['name'];
                $id   = $configuration['id'];
                $args = [];

                if (isset($configuration['args']))
                {
                    $args = $configuration['args'];
                }

                $controller->setService($name, $this->createService($id, $args));
            }

            // save controller
            $this->controller[$id] = $controller;
        }

        return $this->controller[$id];
    }

    /**
     * @param string $id
     * @param array  $args
     * @return \ppma\Service
     */
    public function createService($id, $args = [])
    {
        if (!isset($this->services[$id]))
        {
            /* @var \ppma\Service $service */
            $service = new $id();
            $service->init($args);

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
     * @return \ppma
     */
    public static function app()
    {
        if (self::$instance == null)
        {
            self::$instance = new ppma();
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
        $app->get('/app',            '\ppma\Controller\App::home')->bind('app');
        $app->get('/entries',        '\ppma\Controller\Entries::all');
        $app->get('/entries/recent', '\ppma\Controller\Entries::recent');

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