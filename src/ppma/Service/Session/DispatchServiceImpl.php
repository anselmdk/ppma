<?php


namespace ppma\Service\Session;


use ppma\Service\SessionService;

class DispatchServiceImpl implements SessionService
{
    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        if (isset($args['path']))
        {
            session_save_path($args['path']);
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return session($name);
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