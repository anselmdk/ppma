<?php


class ppma
{

    /**
     * @var Silex\Application
     */
    protected $silex;


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
        $app->get('/app',            '\ppma\Controller\App::home')->bind('app');
        $app->get('/login',          '\ppma\Controller\Login::get')->bind('login');
        $app->post('/login',         '\ppma\Controller\Login::post');
        $app->get('/entries',        '\ppma\Controller\Entries::all');
        $app->get('/entries/recent', '\ppma\Controller\Entries::recent');

        $this->silex = $app;
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
    public static function instance()
    {
        if (self::$instance == null)
        {
            self::$instance = new ppma();
        }

        return self::$instance;
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