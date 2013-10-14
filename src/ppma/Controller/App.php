<?php


namespace ppma\Controller;


use ppma\Application\ApplicationTrait;
use ppma\Application\SilexTrait;
use ppma\Application\UrlGeneratorTrait;
use ppma\Application\UserTrait;
use ppma\Application\ViewTrait;
use ppma\Controller;

class App
{
    use ApplicationTrait, UserTrait, UrlGeneratorTrait, ViewTrait;

    /**
     * @return string
     */
    public function home()
    {
        if (!$this->user()->hasAccess())
        {
            return $this->app()->silex()->redirect( $this->path('login') );
        }

        return $this->render('app');
    }

}