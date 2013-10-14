<?php


namespace ppma\Controller;


use ppma\Controller;
use ppma\Service;

abstract class ControllerImpl implements Controller
{

    /**
     * @param string $name
     * @param Service $service
     * @return void
     */
    public function setService($name, Service $service)
    {
        // TODO: validation
        $this->$name = $service;
    }

}