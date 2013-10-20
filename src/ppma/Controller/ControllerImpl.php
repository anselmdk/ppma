<?php


namespace ppma\Controller;


use ppma\Controller;
use ppma\Service;

abstract class ControllerImpl implements Controller
{
    /**
     * @return void
     */
    public function after()
    {
        // noop
    }

    /**
     * @return void
     */
    public function before()
    {
        // noop
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