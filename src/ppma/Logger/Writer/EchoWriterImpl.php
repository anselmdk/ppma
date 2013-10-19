<?php


namespace ppma\Logger\Writer;


use ppma\Logger\Writer;

class EchoWriterImpl implements Writer
{

    /**
     * @param array $config
     * @return void
     */
    public function init($config = [])
    {

    }

    /**
     * @param string $message
     * @return void
     */
    public function write($message)
    {
        echo $message;
    }

}