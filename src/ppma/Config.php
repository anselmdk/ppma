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
     * @param bool $forceOverwriting
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public static function get($key, $default = null, $forceOverwriting = false)
    {
        if (!(self::$dotor instanceof Dotor))
        {
            throw new \InvalidArgumentException(sprintf('%s is not initialized', __CLASS__));
        }

        // get value
        $value = self::$dotor->get($key, $default);

        if ($forceOverwriting && is_array($value) && is_array($default))
        {
            $value = array_merge($value, $default);
        }

        return $value;
    }

    /**
     * @param array $config
     */
    public static function init($config = [])
    {
        self::$dotor = new Dotor($config);
    }

}