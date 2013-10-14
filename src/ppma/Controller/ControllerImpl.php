<?php


namespace ppma\Controller;


use ppma\Controller;
use ppma\Service;
use ppma\Service\ConfigService;
use ppma\Serviceable;

abstract class ControllerImpl implements Controller
{

    /**
     * @var ConfigService
     */
    protected $configService;

    /**
     * @param ConfigService $service
     * @return mixed
     */
    public function setConfigService(ConfigService $service)
    {
        $this->configService = $service;
    }

    /**
     * @param string $name
     * @param Service $service
     * @return void
     */
    public function setService($name, Service $service)
    {
        $this->$name = $service;
    }

}