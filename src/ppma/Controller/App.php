<?php


namespace ppma\Controller;


class App
{

    /**
     * @return string
     */
    public function home()
    {
        return \ppma::instance()->getTwig()->render('app.twig');
    }


    public function login()
    {
        return \ppma::instance()->getTwig()->render('login.twig');
    }

}