<?php


namespace ppma\Service\Database\Spot;


use ppma\Config;
use ppma\Service;
use ppma\Serviceable;
use Spot\Config as SpotConfig;
use Spot\Mapper;

abstract class ServiceImpl implements Service, Serviceable
{

    /**
     * @var Mapper
     */
    protected $mapper;

    /**
     * @param array $args
     * @return void
     */
    public function init($args = [])
    {
        $cfg = new SpotConfig();
        $cfg->addConnection('db', sprintf('mysql://%s:%s@%s/%s',
            Config::get('database.username'),
            Config::get('database.password'),
            Config::get('database.host'),
            Config::get('database.database')
        ));

        $this->mapper = new Mapper($cfg);
    }

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
        return [];
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