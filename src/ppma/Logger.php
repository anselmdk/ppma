<?php


namespace ppma;


use ppma\Logger\Exception\InvalidLevelException;
use ppma\Logger\Writer;

class Logger
{

    const DEBUG = 'DEBUG';

    const ERROR = 'ERROR';

    const INFO = 'INFO';

    const WARN = 'WARN';

    /**
     * @var Writer[]
     */
    protected static $writer = [];

    /**
     * @param Writer $writer
     * @return void
     */
    public static function addWriter(Writer $writer)
    {
        self::$writer[] = $writer;
    }

    /**
     * @param string $message
     * @param string $context
     * @return void
     */
    public static function debug($message, $context = null)
    {
        self::log(Logger::DEBUG, $message, $context);
    }

    /**
     * @param string $message
     * @param string $context
     * @return void
     */
    public static function error($message, $context = null)
    {
        self::log(Logger::ERROR, $message, $context);
    }

    /**
     * @param string $message
     * @param string $context
     * @return void
     */
    public static function info($message, $context = null)
    {
        self::log(Logger::INFO, $message, $context);
    }

    /**
     * @param array $config
     * @return void
     */
    public static function init($config = [])
    {
        foreach ($config['writer'] as $writerConfig) {
            if (isset($writerConfig['enabled']) && !$writerConfig['enabled']) {
                continue;
            }

            /* @var Writer $writer */
            $writer = new $writerConfig['id']();
            $writer->init($writerConfig);

            self::addWriter($writer);
        }
    }

    /**
     * @param string $level
     * @param string $message
     * @param string $context
     * @throws Logger\Exception\InvalidLevelException
     */
    public static function log($level, $message, $context = null)
    {
        foreach (self::$writer as $writer) {
            switch($level)
            {
                case Logger::DEBUG:
                    $writer->debug($message, $context);
                    break;
                case Logger::ERROR:
                    $writer->error($message, $context);
                    break;
                case Logger::INFO:
                    $writer->info($message, $context);
                    break;
                case Logger::WARN:
                    $writer->warn($message, $context);
                    break;
                default:
                    throw new InvalidLevelException();
            }
        }
    }

    /**
     * @param string $message
     * @param string $context
     * @return void
     */
    public static function warn($message, $context = null)
    {
        self::log(Logger::WARN, $message, $context);
    }
}
