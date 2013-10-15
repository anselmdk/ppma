<?php


namespace ppma\Factory;


use ppma\Controller;

class ControllerFactory
{

    /**
     * @var Controller[]
     */
    protected static $controller = [];

    /**
     * @param string $id
     * @return Controller
     */
    protected static function create($id)
    {
        /* @var \ppma\Controller $controller */
        $controller = new $id();

        // adorn controller with services
        ServiceFactory::adorn($controller);

        return $controller;
    }

    /**
     * @param string $id
     * @return Controller
     */
    public static function get($id)
    {
        if (!isset(self::$controller[$id]))
        {
            self::$controller[$id] = self::create($id);
        }

        return self::$controller[$id];
    }

}