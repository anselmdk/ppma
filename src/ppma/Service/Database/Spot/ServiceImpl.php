<?php


namespace ppma\Service\Database\Spot;


use ppma\Service;
use ppma\Service\ConfigService;
use ppma\Serviceable;
use Spot\Config;
use Spot\Mapper;

abstract class ServiceImpl implements Service, Serviceable
{

    /**
     * @var Service\Configuration\DotorServiceImpl
     */
    protected $configService;

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
        $cfg = new Config();
        $cfg->addConnection('db', sprintf('mysql://%s:%s@%s/%s',
            $this->configService->get('database.username'),
            $this->configService->get('database.password'),
            $this->configService->get('database.host'),
            $this->configService->get('database.database')
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