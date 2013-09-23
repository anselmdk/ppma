<?php


namespace ppma\Application;


trait StaticSilexTrait
{

    /**
     * @return \Silex\Application
     */
    public static function getSilex()
    {
        return \ppma::instance()->silex();
    }

    /**
     * @return \Silex\Application
     */
    public static function silex()
    {
        return self::getSilex();
    }

}