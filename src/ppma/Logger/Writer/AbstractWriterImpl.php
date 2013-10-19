<?php


namespace ppma\Logger\Writer;


use ppma\Logger\Exception\InvalidLevelException;
use ppma\Logger\Writer;

abstract class AbstractWriterImpl implements Writer
{

    /**
     * @param string $level
     * @param string $msg
     * @throws \ppma\Logger\Exception\InvalidLevelException
     * @return void
     */
    public function log($level, $msg)
    {
        switch($level)
        {
            case Logger::DEBUG:
                $this->debug($msg);
                break;
            case Logger::ERROR:
                $this->error($msg);
                break;
            case Logger::INFO:
                $this->info($msg);
                break;
            case Logger::WARN:
                $this->warn($msg);
                break;
            default:
                throw new InvalidLevelException();
        }
    }

}