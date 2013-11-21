<?php


namespace ppma\Service\Request;


use ppma\Service;

interface RequestService extends Service
{

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get($name, $default = null);

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function post($name, $default = null);

} 