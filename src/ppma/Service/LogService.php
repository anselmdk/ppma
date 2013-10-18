<?php


namespace ppma\Service;


use ppma\Service;

interface LogService extends Service
{

    /**
     * @param string $message
     * @return void
     */
    public function debug($message);

    /**
     * @param string $message
     * @return void
     */
    public function error($message);

    /**
     * @param string $message
     * @return void
     */
    public function info($message);

    /**
     * @param string $message
     * @return void
     */
    public function warning($message);

}