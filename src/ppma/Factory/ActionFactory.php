<?php


namespace ppma\Factory;


use ppma\Action;
use ppma\Logger;

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
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

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
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        if (!isset(self::$actions[$id]))
        {
            self::$actions[$id] = self::create($id);
        }

        return self::$actions[$id];
    }

}