<?php


namespace ppma\Service\Database;


use ppma\Model\UserModel;
use ppma\Service;

interface UserService extends Service
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

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @return UserModel
     */
    public function create($username, $email, $password);

}