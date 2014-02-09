<?php


namespace ppma\Logger\Writer;


use ppma\Logger\Writer;
use ppma\Logger;

class FileWriterImpl extends WriterImpl
{

    /**
     * @var string
     */
    protected $path;

    protected $level = [];

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function debug($msg, $context = null)
    {
        if (!in_array('debug', $this->level)) {
            return;
        }

        $msg = sprintf("%-5s %s %s\n%s\n", 'DEBUG', date('c'), $context, $msg);
        $this->write($msg);
    }

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function error($msg, $context = null)
    {
        if (!in_array('error', $this->level)) {
            return;
        }

        $msg = sprintf("%-5s %s %s\n%s\n", 'ERROR', date('c'), $context, $msg);
        $this->write($msg);
    }

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function info($msg, $context = null)
    {
        if (!in_array('info', $this->level)) {
            return;
        }

        $msg = sprintf("%-5s %s %s\n%s\n", 'INFO', date('c'), $context, $msg);
        $this->write($msg);
    }

    /**
     * @param array $config
     * @throws \Exception
     */
    public function init($config = [])
    {
        if (!isset($config['path'])) {
            throw new \Exception('path to log file is not set');
        }

        $this->path  = $config['path'];
        $this->level = $config['level'];
    }

    /**
     * @param string $msg
     * @param string $context
     * @return void
     */
    public function warn($msg, $context = null)
    {
        if (!in_array('warn', $this->level)) {
            return;
        }

        $msg = sprintf("%-5s %s %s\n%s\n", 'WARN', date('c'), $context, $msg);
        $this->write($msg);
    }

    /**
     * @param string $message
     */
    protected function write($message)
    {
        // create file if is not exist
        if (!file_exists($this->path)) {
            touch($this->path);
            chmod($this->path, 0777);
        }

        file_put_contents($this->path, $message . "\n", FILE_APPEND);
    }
}
