<?php


namespace ppma\Controller;


use ppma\Controller;
use ppma\Service;

abstract class ControllerImpl implements Controller
{

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