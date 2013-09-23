<?php


namespace ppma\Controller;

use ppma\Application\ApplicationTrait;
use ppma\Application\ViewTrait;
use ppma\Controller;


class App
{
    use ApplicationTrait, ViewTrait;

    /**
     * @return string
     */
    public function home()
    {
        if (!$this->app()->user()->hasAccess())
        {
            $url = $this->app()->silex()['url_generator']->generate('login');
            return $this->app()->silex()->redirect($url);
        }

        return $this->render('app');
    }

}