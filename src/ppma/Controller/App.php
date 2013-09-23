<?php


namespace ppma\Controller;

use ppma\Application\ApplicationTrait;
use ppma\Application\SilexTrait;
use ppma\Application\ViewTrait;
use ppma\Controller;


class App
{
    use ApplicationTrait, SilexTrait, ViewTrait;

    /**
     * @return string
     */
    public function home()
    {
        if (!$this->app()->user()->hasAccess())
        {
            $url = $this->silex()['url_generator']->generate('login');
            return $this->silex()->redirect($url);
        }

        return $this->render('app');
    }

}