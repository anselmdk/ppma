<?php


namespace ppma\Service;


use ppma\Entity\User;
use ppma\Service;

interface UserService extends Service
{

    /**
     * @return User
     */
    public function getEntity();

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return boolean
     */
    public function isAuthenticated();

    /**
     * @param User $user
     * @return void
     */
    public function login(User $user);

    /**
     * @return void
     */
    public function logout();

}