<?php


namespace ppma;


use Dotor\Dotor;

class Config
{

    /**
     * @var Dotor
     */
    protected static $dotor;

    /**
     * @param string $key
     * @param mixed $default
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public static function get($key, $default = null)
    {
        if (!(self::$dotor instanceof Dotor))
        {
            throw new \InvalidArgumentException(sprintf('%s is not initialized', __CLASS__));
        }

        return self::$dotor->get($key, $default);
    }

    /**
     * @param array $config
     */
    public static function init($config = [])
    {
        self::$dotor = new Dotor($config);
    }

    /**
     * @param string $name
     * @return string
     */
    public static function url($name)
    {
        return self::get('url.base') . self::get('url.' . $name);
    }

}