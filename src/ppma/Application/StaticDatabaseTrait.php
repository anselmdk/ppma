<?php


namespace ppma\Application;


trait StaticDatabaseTrait
{
    use StaticSilexTrait;

    /**
     * Alias for getDatabase
     *
     * @return \Spot\Mapper
     */
    public static function database()
    {
        return self::getDatabase();
    }

    /**
     * @return \Spot\Mapper
     */
    public static function getDatabase()
    {
        return self::silex()['spot'];
    }

}