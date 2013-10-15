<?php


namespace ppma\Controller;


use ppma\Config;
use ppma\Controller;
use ppma\Service\ViewService;

class AppController extends ControllerImpl
{

    /**
     * @var ViewService
     */
    protected $viewService;

    /**
     * @return string
     */
    public function home()
    {
        return $this->viewService->render('app');
    }

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
        return [
            [
                'name' => 'viewService',
                'id'   => Config::get('services.view')
            ]
        ];
    }

}