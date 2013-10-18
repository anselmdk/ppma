<?php


namespace ppma;


interface Serviceable
{

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services();

    /**
     * @param string $target
     * @param Service $service
     * @return void
     */
    public function setService($target, Service $service);

}