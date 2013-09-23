<?php


namespace ppma\Application;


trait UserTrait
{

    /**
     * @return \ppma\Session\User
     */
    public function getUser()
    {
        return \ppma::app()->silex()['user'];
    }


    /**
     * Alias for getUser()
     *
     * @return \ppma\Session\User
     */
    public function user()
    {
        return $this->getUser();
    }

}