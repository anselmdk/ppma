<?php


namespace ppma\Logger\Writer;


class ChromeWriterImpl extends AbstractWriterImpl
{
    /**
     * @param string $msg
     * @return void
     */
    public function debug($msg)
    {
        $this->info('DEBUG: method ChromePhp::info() does not exist, i will use info() instead of this');
        $this->info('DEBUG: ' . $msg);
    }

    /**
     * @param string $msg
     * @return void
     */
    public function error($msg)
    {
        \ChromePhp::info('ERROR: ' . $msg);
    }

    /**
     * @param array $config
     * @return void
     */
    public function init($config = []) { }

    /**
     * @param string $msg
     * @return mixed
     */
    public function info($msg)
    {
        \ChromePhp::info('INFO: ' . $msg);
    }

    /**
     * @param $msg
     * @return void
     */
    public function warn($msg)
    {
        \ChromePhp::info('WARN: ' . $msg);
    }


}