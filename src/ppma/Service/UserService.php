<?php


namespace ppma\Service;


use ppma\Entity\UserEntity;
use ppma\Service;

interface UserService extends Service
{

    /**
     * @return UserEntity
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
     * @param UserEntity $user
     * @return void
     */
    public function login(UserEntity $user);

    /**
     * @return void
     */
    public function logout();

}