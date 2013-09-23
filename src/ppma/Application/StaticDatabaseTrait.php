<?php


namespace ppma\Application;


trait StaticDatabaseTrait
{

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
        return \ppma::app()->silex()['spot'];
    }

}