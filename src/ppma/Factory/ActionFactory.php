<?php


namespace ppma\Factory;


use ppma\Action;

class ActionFactory
{

    /**
     * @var Action[]
     */
    protected static $actions = [];

    /**
     * @param string $id
     * @return Action
     */
    protected static function create($id)
    {
        /* @var \ppma\Action $action */
        $action = new $id();

        // adorn action with services
        ServiceFactory::adorn($action);

        return $action;
    }

    /**
     * @param string $id
     * @return Action
     */
    public static function get($id)
    {
        if (!isset(self::$actions[$id]))
        {
            self::$actions[$id] = self::create($id);
        }

        return self::$actions[$id];
    }

}