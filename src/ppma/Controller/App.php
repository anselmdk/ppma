<?php


namespace ppma\Controller;

use ppma\Application\ApplicationTrait;
use ppma\Application\SilexTrait;
use ppma\Application\UserTrait;
use ppma\Application\ViewTrait;
use ppma\Controller;


class App
{
    use ApplicationTrait, UserTrait, ViewTrait;

    /**
     * @return string
     */
    public function home()
    {
        if (!$this->user()->hasAccess())
        {
            $url = $this->silex()['url_generator']->generate('login');
            return $this->silex()->redirect($url);
        }

        return $this->render('app');
    }

}