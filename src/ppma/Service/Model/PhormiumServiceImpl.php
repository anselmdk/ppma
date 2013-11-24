<?php


namespace ppma\Service\Model;


use ppma\Config;
use ppma\Logger;
use ppma\Service\ModelService;
use ppma\Service\Orm\PhormiumService;
use ppma\Service;

abstract class PhormiumServiceImpl implements ModelService
{

    /**
     * @var PhormiumService
     */
    protected $phormium;

    /**
     * @param array $args
     * @return mixed
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
            array_merge(Config::get('services.orm'), ['target' => 'phormium'])
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