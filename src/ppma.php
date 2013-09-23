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

        // register WebUserProvider
        $app->register(new \ppma\Provider\WebUser());

        // register Whoops
        $app->register(new Whoops\Provider\Silex\WhoopsServiceProvider());

        // register Spot
        $app->register(new Psamatt\Silex\SpotServiceProvider('mysql://root:bitnami@localhost/ppmasilex'));

        // register routes
        $app->get('/app',            '\ppma\Controller\App::home')->bind('home');
        $app->get('/login',          '\ppma\Controller\Login::get')->bind('login');
        $app->post('/login',         '\ppma\Controller\Login::post');
        $app->get('/entries',        '\ppma\Controller\Entries::all');
        $app->get('/entries/recent', '\ppma\Controller\Entries::recent');

        $this->app = $app;
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
     * @return \Silex\Application
     */
    public function getSilex()
    {
        return $this->app;
    }


    /**
     * @return \ppma\Session\User
     */
    public function getUser()
    {
        return $this->app['user'];
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


    /**
     * @return \Silex\Application
     */
    public static function silex()
    {
        return self::instance()->getSilex();
    }


    /**
     * Alias for getUser()
     *
     * @return \ppma\Session\User
     */
    public function user()
    {
        return $this->getUser();
    }

}