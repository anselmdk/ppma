<?php


namespace ppma\Service\Model;


use ppma\Model\UserModel;
use ppma\Service;

interface UserService extends Service
{

    /**
     * @return UserModel[]
     */
    public function getAll();

    /**
     * @param int $id
     * @return UserModel
     */
    public function getById($id);

    /**
     * @param string $username
     * @return UserModel
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