<?php


namespace ppma\Service;


use ppma\Service;

interface SessionService extends Service
{

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name);

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function set($name, $value);

}