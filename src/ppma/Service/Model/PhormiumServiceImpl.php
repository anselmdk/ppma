<?php


namespace ppma\Service\Model;


use ppma\Service\ModelService;
use ppma\Config;
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
    }


    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
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
        $this->$target = $service;
    }

}