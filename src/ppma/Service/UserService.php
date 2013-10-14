<?php


namespace ppma\Service;


use ppma\Entity\User;
use ppma\Service;

interface UserService extends Service
{

    /**
     * @param User $user
     * @return void
     */
    public function login(User $user);

}