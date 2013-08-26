<?php


class ppma
{

    /**
     * @var Silex\Application
     */
    protected $app;

    /**
     * @var \Spot\Mapper
     */
    protected $db;

    /**
     * @var ppma
     */
    protected static $instance;

    /**
     * @var Twig_Environment
     */
    protected $twig;


    /**
     * @return \ppma
     */
    protected function __construct()
    {
        // create application
        $app = new Silex\Application();

        // register Whoops
        $app->register(new Whoops\Provider\Silex\WhoopsServiceProvider());

        // register Spot
        $app->register(new Psamatt\Silex\SpotServiceProvider('mysql://root:bitnami@localhost/ppma'));
        $this->db = $app['spot'];

        // register Twig
        $app->register(new Silex\Provider\TwigServiceProvider(), [
            'twig.path' => __DIR__ . '/../views',
        ]);
        $this->twig = $app['twig'];

        // register routes
        $app->get('/app',            '\ppma\Controller\App::home');
        $app->get('/app/login',      '\ppma\Controller\App::login');
        $app->get('/entries',        '\ppma\Controller\Entries::all');
        $app->get('/entries/recent', '\ppma\Controller\Entries::recent');

        $this->app = $app;
    }


    /**
     * @return \Silex\Application
     */
    public static function app()
    {
        return self::instance()->getApp();
    }


    /**
     * @return \Silex\Application
     */
    public function getApp()
    {
        return $this->app;
    }


    /**
     * @return \Spot\Mapper
     */
    public function getDatabase()
    {
        return $this->db;
    }


    /**
     * @return \Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
    }


    /**
     * @return \ppma
     */
    public static function instance()
    {
        if (self::$instance == null)
        {
            self::$instance = new ppma();
        }

        return self::$instance;
    }

}