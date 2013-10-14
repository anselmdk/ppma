<?php


namespace ppma\Service;


use ppma\Service;
use Spot\Config;
use Spot\Mapper;

abstract class ServiceImpl implements Service
{

    /**
     * @param array $args
     * @return void
     */
    public function init($args = [])
    {
    }

}