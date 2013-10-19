<?php


namespace ppma\Logger;


use ppma\Service;

interface Writer
{

    /**
     * @param string $msg
     * @return void
     */
    public function debug($msg);

    /**
     * @param string $msg
     * @return void
     */
    public function error($msg);

    /**
     * @param array $config
     * @return void
     */
    public function init($config = []);

    /**
     * @param string $msg
     * @return mixed
     */
    public function info($msg);

    /**
     * @param string $level
     * @param string $msg
     * @return void
     */
    public function log($level, $msg);

    /**
     * @param $msg
     * @return void
     */
    public function warn($msg);

}