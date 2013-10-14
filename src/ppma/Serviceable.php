<?php


namespace ppma;


use ppma\Service\ConfigService;

interface Serviceable
{

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services();

    /**
     * @param ConfigService $service
     * @return mixed
     */
    public function setConfigService(ConfigService $service);

    /**
     * @param string $name
     * @param Service $service
     * @return void
     */
    public function setService($name, Service $service);

}