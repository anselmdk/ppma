<?php


namespace ppma;


interface Serviceable
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