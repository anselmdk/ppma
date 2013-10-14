<?php


namespace ppma\Service;


use ppma\Service;

interface ConfigurationService extends Service
{

    /**
     * @param string $name
     * @param mixed $defaultValue
     * @return mixed
     */
    public function get($name, $defaultValue = null);

}