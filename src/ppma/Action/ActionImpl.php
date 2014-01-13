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
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
    }

    /**
     * @return void
     */
    public function before()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
    }

    /**
     * @param array $args
     * @return void
     */
    public function init($args = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
    }

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

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
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        $this->$target = $service;
    }
}
