<?php


namespace ppma;


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
     * @return void
     */
    public static function debug($message)
    {
        self::log(Logger::DEBUG, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public static function error($message)
    {
        self::log(Logger::ERROR, $message);
    }

    /**
     * @param string $message
     * @return void
     */
    public static function info($message)
    {
        self::log(Logger::INFO, $message);
    }

    /**
     * @param array $config
     * @return void
     */
    public static function init($config = [])
    {
        foreach ($config['writer'] as $writerConfig)
        {
            if (isset($writerConfig['enabled']) && !$writerConfig['enabled'])
            {
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
     */
    public static function log($level, $message)
    {
        foreach (self::$writer as $writer)
        {
            $writer->write(sprintf('%s: %s', $level, $message));
        }
    }

    /**
     * @param string $message
     * @return void
     */
    public static function warn($message)
    {
        self::log(Logger::WARN, $message);
    }

}