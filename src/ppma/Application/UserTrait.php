<?php


namespace ppma\Application;


trait UserTrait
{

    /**
     * @return \ppma\Session\User
     */
    public function getUser()
    {
        return \ppma::instance()->silex()['user'];
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