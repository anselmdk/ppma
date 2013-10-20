<?php


namespace ppma\Service\Database\Spot;


use ppma\Entity\UserEntity;
use ppma\Service\Database\Exception\RecordNotFoundException;
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
     * @param UserEntity     $entity
     * @return UserEntity
     */
    protected function assignModelToEntity(SpotUser $model, UserEntity $entity)
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
     * @return UserEntity[]
     */
    public function getAll()
    {
        $models   = $this->mapper->all($this->_entityClass);
        $entities = [];

        foreach ($models as $model)
        {
            $entities[] = $this->assignModelToEntity($model, new UserEntity());
        }

        return $entities;
    }

    /**
     * @param int $id
     * @return UserEntity
     * @throws \ppma\Service\Database\Exception\RecordNotFoundException
     */
    public function getById($id)
    {
        $model = $this->mapper->get($this->_entityClass, $id);

        if ($model === false)
        {
            throw new RecordNotFoundException();
        }

        return $this->assignModelToEntity($model, new UserEntity());
    }

    /**
     * @param string $username
     * @return UserEntity
     * @throws \ppma\Service\Database\Exception\RecordNotFoundException
     */
    public function getByUsername($username)
    {
        /* @var \ppma\Service\Database\Spot\Entity\User $model */
        $model = $this->mapper->first($this->_entityClass, ['username' => $username]);

        if ($model === false)
        {
            throw new RecordNotFoundException();
        }

        return $this->assignModelToEntity($model, new UserEntity());
    }

}