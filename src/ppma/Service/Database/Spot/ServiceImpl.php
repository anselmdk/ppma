<?php


namespace ppma\Service\Database\Spot;


use ppma\Service;
use ppma\Serviceable\DefaultServicableImpl;
use Spot\Config;
use Spot\Mapper;

abstract class ServiceImpl extends DefaultServicableImpl implements Service
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

    public function services()
    {
        return [
            [
                'name' => 'configService',
                'id'   => '\ppma\Service\Configuration\DotorServiceImpl'
            ]
        ];
    }

}