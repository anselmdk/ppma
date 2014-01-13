<?php


namespace ppma\Logger\Writer;


use ppma\Logger\Exception\InvalidLevelException;
use ppma\Logger\Writer;
use ppma\Logger;

abstract class AbstractWriterImpl implements Writer
{

    /**
     * @param string $level
     * @param string $msg
     * @param string $context
     * @return void
     * @throws \ppma\Logger\Exception\InvalidLevelException
     */
    public function log($level, $msg, $context = null)
    {
        switch($level)
        {
            case Logger::DEBUG:
                $this->debug($msg, $context);
                break;
            case Logger::ERROR:
                $this->error($msg, $context);
                break;
            case Logger::INFO:
                $this->info($msg, $context);
                break;
            case Logger::WARN:
                $this->warn($msg, $context);
                break;
            default:
                throw new InvalidLevelException();
        }
    }
}
