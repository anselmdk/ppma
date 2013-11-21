<?php


namespace ppma\Action;


use ppma\Action;
use ppma\Config;
use ppma\Service;

abstract class ActionImpl implements Action
{

    /**
     * @var Service\Response\JsonService
     */
    protected $response;

    /**
     * @return void
     */
    public function after()
    {
    }

    /**
     * @return void
     */
    public function before()
    {
    }

    /**
     * @param array $args
     * @return void
     */
    public function init($args = [])
    {
    }

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
        return [
            array_merge(Config::get('services.response'), ['target' => 'response']),
        ];
    }


    /**
     * @param string $target
     * @param Service $service
     * @return void
     */
    public function setService($target, Service $service)
    {
        $this->$target = $service;
    }

} 