<?php


namespace ppma\Service\Database;


use ppma\Entity\UserEntity;

interface UserService
{

    /**
     * @return UserEntity[]
     */
    public function getAll();

    /**
     * @param int $id
     * @return UserEntity
     */
    public function getById($id);

    /**
     * @param string $username
     * @return UserEntity
     */
    public function getByUsername($username);

}