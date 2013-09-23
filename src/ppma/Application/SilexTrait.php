<?php


namespace ppma\Application;


trait SilexTrait
{

    /**
     * @return \Silex\Application
     */
    public function getSilex()
    {
        return \ppma::instance()->silex();
    }

    /**
     * @return \Silex\Application
     */
    public function silex()
    {
        return $this->getSilex();
    }

}