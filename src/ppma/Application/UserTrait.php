<?php


namespace ppma\Application;


trait UserTrait
{
    use SilexTrait;

    /**
     * @return \ppma\Session\User
     */
    public function getUser()
    {
        return $this->silex()['user'];
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