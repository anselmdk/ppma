<?php


namespace ppma\Logger;


use ppma\Service;

interface Writer
{

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function debug($msg, $context = null);

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function error($msg, $context = null);

    /**
     * @param array $config
     * @return void
     */
    public function init($config = []);

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function info($msg, $context = null);

    /**
     * @param string $level
     * @param string $msg
     * @param string $context
     * @return mixed
     */
    public function log($level, $msg, $context = null);

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function warn($msg, $context = null);

}