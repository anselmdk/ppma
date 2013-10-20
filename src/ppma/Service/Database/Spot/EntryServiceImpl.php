<?php


namespace ppma\Service\Database\Spot;


use ppma\Entity\EntryEntity;
use ppma\Service\Database\EntryService;
use ppma\Service\Database\Spot\Entity\Entry as SpotEntry;

class EntryServiceImpl extends ServiceImpl implements EntryService
{

    /**
     * @var string
     */
    private $_enitityClass = '\ppma\Service\Database\Spot\Entity\Entry';

    /**
     * @param SpotEntry $model
     * @param EntryEntity $entity
     * @return EntryEntity
     */
    protected function assignModelToEntity(SpotEntry $model, EntryEntity $entity)
    {
        $entity->assignToProperties([
            'id'        => $model->id,
            'userId'    => $model->userId,
            'name'      => $model->name,
            'url'       => $model->url,
            'comment'   => $model->comment,
            'username'  => $model->username,
            'password'  => $model->encryptedPassword,
            'viewCount' => $model->viewCount,
        ]);

        return $entity;
    }

    /**
     * @return EntryEntity[]
     */
    public function getAll()
    {
        $models   = $this->mapper->all($this->_enitityClass);
        $entities = [];

        foreach ($models as $model)
        {
            $entities[] = $this->assignModelToEntity($model, new EntryEntity());
        }

        return $entities;
    }

    /**
     * @param int $id
     * @return EntryEntity
     */
    public function getById($id)
    {
        return $this->assignModelToEntity(
            $this->mapper->get($this->_enitityClass, $id),
            new EntryEntity()
        );
    }

}