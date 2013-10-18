<?php


namespace ppma\Controller;


use ppma\Config;
use ppma\Controller;
use ppma\Service\Response\HtmlService;
use ppma\Service\ViewService;

class AppController extends ControllerImpl
{

    /**
     * @var HtmlService
     */
    protected $html;

    /**
     * @return void
     */
    public function home()
    {
        $this->html->render('app');
    }

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
        return [
            Config::get('services.response.html'),
        ];
    }

}