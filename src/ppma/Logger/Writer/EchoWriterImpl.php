<?php


namespace ppma\Logger\Writer;


use ppma\Logger\Writer;
use ppma\Logger;

class EchoWriterImpl extends WriterImpl
{

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function debug($msg, $context = null)
    {
        printf("%-8s %-40s %s\n", 'DEBUG:', $context, $msg);
    }

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function error($msg, $context = null)
    {
        printf("%-8s %-40s %s\n", 'ERROR:', $context, $msg);
    }

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function info($msg, $context = null)
    {
        printf("%-8s %-40s %s\n", 'INFO:', $context, $msg);
    }

    /**
     * @param array $config
     * @return void
     */
    public function init($config = [])
    {
    }

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function warn($msg, $context = null)
    {
        printf("%-8s %-40s %s\n", 'WARN:', $context, $msg);
    }
}
