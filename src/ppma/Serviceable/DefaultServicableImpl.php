<?php


namespace ppma\Serviceable;


use ppma\Service;
use ppma\Serviceable;

abstract class DefaultServicableImpl implements Serviceable
{

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