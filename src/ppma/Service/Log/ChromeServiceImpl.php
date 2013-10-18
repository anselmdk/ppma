<?php


namespace ppma\Service\Log;


use ppma\Service\LogService;

class ChromeServiceImpl implements LogService
{
    /**
     * @param string $message
     * @return void
     */
    public function debug($message)
    {
        \ChromePhp::log($message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function error($message)
    {
        \ChromePhp::error($message);
    }

    /**
     * @param string $message
     * @return void
     */
    public function info($message)
    {
        \ChromePhp::info($message);
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = []) { }

    /**
     * @param string $message
     * @return void
     */
    public function warning($message)
    {
        \ChromePhp::warn($message);
    }

}