<?php


namespace ppma;


interface Controller
{

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services();

    /**
     * @param string $name
     * @param Service $service
     * @return void
     */
    public function setService($name, Service $service);

}