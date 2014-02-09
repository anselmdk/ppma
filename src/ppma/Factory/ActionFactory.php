<?php


namespace ppma\Factory;


use Hahns\Hahns;
use Hahns\Request;
use Hahns\Response\Json;
use ppma\Action;
use ppma\Logger;

class ActionFactory
{

    /**
     * @param string $id
     * @param array $args
     * @return Action
     */
    public static function create($id, $args = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        /* @var \ppma\Action $action */
        $action = new $id();

        // set arguments
        foreach ($args as $arg) {
            if ($arg instanceof Json) {
                $action->setResponse($arg);
            } elseif ($arg instanceof Request) {
                $action->setRequest($arg);
            } elseif ($arg instanceof Hahns) {
                $action->setApplication($arg);
            }
        }

        return $action;
    }
}
