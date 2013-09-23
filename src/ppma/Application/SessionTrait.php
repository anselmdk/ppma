<?php


namespace ppma\Application;


trait SessionTrait
{

    /**
     * @return \Symfony\Component\HttpFoundation\Session\Session
     */
    public function getSession()
    {
        return \ppma::instance()->silex()['session'];
    }


    /**
     * Alias for getSession()
     *
     * @return \Symfony\Component\HttpFoundation\Session\Session
     */
    public function session()
    {
        return $this->getSession();
    }

}