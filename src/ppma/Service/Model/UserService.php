<?php


namespace ppma\Service\Model;


use ppma\Model\UserModel;
use ppma\Service;

interface UserService extends Service
{

    /**
     * @param UserModel $model;
     * @return void
     */
    public function create(UserModel $model);

    /**
     * @param UserModel $model
     * @return UserModel
     */
    public function createNewAuthKey(UserModel $model);

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
     * @param string $slug
     * @return mixed
     */
    public function getBySlug($slug);

    /**
     * @param string $username
     * @return UserModel
     */
    public function getByUsername($username);

    /**
     * @param UserModel $model
     * @param null|array
     * @return void
     */
    public function update(UserModel $model, $validate = null);

}