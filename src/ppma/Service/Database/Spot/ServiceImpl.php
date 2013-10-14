<?php


namespace ppma\Service\Database\Spot;


use ppma\Service;
use Spot\Config;
use Spot\Mapper;

class ServiceImpl implements Service
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
        $cfg = new Config();
        $cfg->addConnection('db', sprintf('mysql://%s:%s@%s/%s',
            $args['username'], $args['password'], $args['host'], $args['table']
        ));

        $this->mapper = new Mapper($cfg);
    }

}