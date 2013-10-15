<?php


namespace ppma\Service\Database\Spot;


use ppma\Entity\User;
use ppma\Service\Database\Spot\Entity\User as SpotUser;
use ppma\Service\Database\Spot\ServiceImpl;
use ppma\Service\Database\UserService;
use Spot\Exception;

class UserServiceImpl extends ServiceImpl implements UserService
{

    /**
     * @var string
     */
    private $_entityClass = '\ppma\Service\Database\Spot\Entity\User';

    /**
     * @param SpotUser $model
     * @param User     $entity
     * @return User
     */
    protected function assignModelToEntity(SpotUser $model, User $entity)
    {
        $entity->assignToProperties([
            'id'            => $model->id,
            'username'      => $model->username,
            'password'      => $model->password,
            'encryptionKey' => $model->encryptionKey,
            'isAdmin'       => $model->isAdmin,
        ]);

        return $entity;
    }

    /**
     * @return User[]
     */
    public function getAll()
    {
        $models   = $this->mapper->all($this->_entityClass);
        $entities = [];

        foreach ($models as $model)
        {
            $entities[] = $this->assignModelToEntity($model, new User());
        }

        return $entities;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getById($id)
    {
        return $this->assignModelToEntity(
            $this->mapper->get($this->_entityClass, $id),
            new User()
        );
    }

    public function getByUsername($username)
    {
        /* @var \ppma\Service\Database\Spot\Entity\User $model */
        $model = $this->mapper->first($this->_entityClass, ['username' => $username]);

        if ($model === false)
        {
            throw new Exception();
        }

        return $this->assignModelToEntity($model, new User());
    }

}