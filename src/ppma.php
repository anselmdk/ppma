<?php


class ppma
{

    /**
     * @var Silex\Application
     */
    protected $app;

    /**
     * @var ppma
     */
    protected static $instance;


    /**
     * @return \ppma
     */
    protected function __construct()
    {
        // create application
        $app = new Silex\Application();

        // register UrlGenerator
        $app->register(new Silex\Provider\UrlGeneratorServiceProvider());

        // register SessionProvider
        $app->register(new Silex\Provider\SessionServiceProvider());
        $app['session.storage.save_path'] = realpath(__DIR__ . '/../tmp/sessions');

        // register Whoops
        $app->register(new Whoops\Provider\Silex\WhoopsServiceProvider());

        // register Spot
        $app->register(new Psamatt\Silex\SpotServiceProvider('mysql://root:bitnami@localhost/ppmasilex'));

        // register routes
        $app->get('/app',            '\ppma\Controller\App::home')->bind('home');
        $app->get('/app/login',      '\ppma\Controller\Login::get')->bind('login');
        $app->post('/app/login',     '\ppma\Controller\Login::post');
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
     * Alias for getDatabase
     *
     * @return \Spot\Mapper
     */
    public function database()
    {
        return $this->getDatabase();
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
        return $this->app['spot'];
    }


    /**
     * @return \Symfony\Component\HttpFoundation\Session\Session
     */
    public function getSession()
    {
        return $this->app['session'];
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


    /**
     * Alias for getSession()
     *
     * @return \Symfony\Component\HttpFoundation\Session\Session
     */
    public function session()
    {
        return $this->getSession();
    }

}