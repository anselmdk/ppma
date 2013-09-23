<?php


namespace ppma\Application;


trait SessionTrait
{
    use SilexTrait;


    /**
     * @return \Symfony\Component\HttpFoundation\Session\Session
     */
    public function getSession()
    {
        return $this->silex()['session'];
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