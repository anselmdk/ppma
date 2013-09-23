<?php


namespace ppma\Provider;


use ppma\Session\User;
use Silex\Application;
use Silex\ServiceProviderInterface;

class WebUser implements ServiceProviderInterface
{

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Application $app An Application instance
     */
    public function register(Application $app)
    {
        $app['user'] = $app->share(function() {
            // try to get user from session
            $user = \ppma::instance()->session()->get(User::SESSION_NAME);

            if ($user instanceof User)
            {
                return $user;
            }
            else
            {
                return new User();
            }
        });
    }


    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     */
    public function boot(Application $app)
    {
    }

}