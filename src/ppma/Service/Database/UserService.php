<?php


namespace ppma\Service\Database;


use ppma\Entity\User;

interface UserService
{

    /**
     * @return User[]
     */
    public function getAll();

    /**
     * @param int $id
     * @return User
     */
    public function getById($id);

    /**
     * @param string $username
     * @return User
     */
    public function getByUsername($username);

}