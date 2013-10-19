<?php


namespace ppma\Logger\Writer;


use ppma\Logger\Writer;
use ppma\Logger;

class EchoWriterImpl extends AbstractWriterImpl
{

    /**
     * @param string $msg
     * @return void
     */
    public function debug($msg)
    {
        echo 'DEBUG: ' . $msg;
    }

    /**
     * @param string $msg
     * @return void
     */
    public function error($msg)
    {
        echo 'ERROR: ' . $msg;
    }

    /**
     * @param string $msg
     * @return mixed
     */
    public function info($msg)
    {
        echo 'INFO: ' . $msg;
    }

    /**
     * @param array $config
     * @return void
     */
    public function init($config = []) { }

    /**
     * @param $msg
     * @return void
     */
    public function warn($msg)
    {
        echo 'WARN: ' . $msg;
    }

}