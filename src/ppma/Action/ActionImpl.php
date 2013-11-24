<?php


namespace ppma\Action;


use ppma\Action;
use ppma\Config;
use ppma\Logger;
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
        Logger::debug('execute after()', __CLASS__);
    }

    /**
     * @return void
     */
    public function before()
    {
        Logger::debug('execute before()', __CLASS__);
    }

    /**
     * @param array $args
     * @return void
     */
    public function init($args = [])
    {
        Logger::debug('execute init()', __CLASS__);
    }

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
        Logger::debug('execute services()', __CLASS__);

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
        Logger::debug('execute setServices()', __CLASS__);
        $this->$target = $service;
    }

} 