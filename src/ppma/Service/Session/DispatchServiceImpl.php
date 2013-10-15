<?php


namespace ppma\Service\Session;


use ppma\Service\SessionService;

class DispatchServiceImpl implements SessionService
{
    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = []) { }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        session($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function set($name, $value)
    {
        session($name, $value);
    }

}