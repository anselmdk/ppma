<?php


namespace ppma\Logger;


use ppma\Service;

interface Writer
{

    /**
     * @param array $config
     * @return void
     */
    public function init($config = []);

    /**
     * @param string $message
     * @return void
     */
    public function write($message);

}