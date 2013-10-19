<?php


namespace ppma\Logger\Writer;


class ChromeWriterImpl extends AbstractWriterImpl
{

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function debug($msg, $context = null)
    {
        $infoMessage = 'method ChromePhp::info() does not exist, i will use info() instead of this';
        \ChromePhp::info(sprintf('%-8s %-40s %s', 'DEBUG:', $context, $infoMessage));
        \ChromePhp::info(sprintf('%-8s %-40s %s', 'DEBUG:', $context, $msg));
    }

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function error($msg, $context = null)
    {
        \ChromePhp::error(sprintf('%-8s %-40s %s', 'ERROR:', $context, $msg));
    }

    /**
     * @param array $config
     * @return void
     */
    public function init($config = []) { }

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function info($msg, $context = null)
    {
        \ChromePhp::info(sprintf('%-8s %-40s %s', 'INFO:', $context, $msg));
    }

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function warn($msg, $context = null)
    {
        \ChromePhp::warn(sprintf('%-8s %-40s %s', 'WARN:', $context, $msg));
    }


}