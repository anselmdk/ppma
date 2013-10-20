<?php


namespace ppma\Controller;


use ppma\Config;
use ppma\Controller;
use ppma\Service\Response\HtmlService;
use ppma\Service\UserService;

class AppController extends ControllerImpl
{

    /**
     * @var HtmlService
     */
    protected $html;

    /**
     * @var UserService
     */
    protected $user;

    /**
     * @return void
     */
    public function before()
    {
        parent::before();
        redirect(Config::url('login'), 302, !$this->user->isAuthenticated());
    }

    /**
     * @return void
     */
    public function home()
    {
        $this->html->render('app');
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->user->logout();
        redirect(Config::get('url.base') . Config::get('url.login'));
    }

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
        return [
            array_merge(Config::get('services.response.html'), ['target' => 'html']),
            array_merge(Config::get('services.user'), ['target' => 'user']),
        ];
    }

}