<?php


namespace ppma\Service\Database\Spot;


use ppma\Entity\Entry;
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
     * @param Entry $entity
     * @return Entry
     */
    protected function assignModelToEntity(SpotEntry $model, Entry $entity)
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
     * @return Entry[]
     */
    public function getAll()
    {
        $models   = $this->mapper->all($this->_enitityClass);
        $entities = [];

        foreach ($models as $model)
        {
            $entities[] = $this->assignModelToEntity($model, new Entry());
        }

        return $entities;
    }

    /**
     * @param int $id
     * @return Entry
     */
    public function getById($id)
    {
        return $this->assignModelToEntity(
            $this->mapper->get($this->_enitityClass, $id),
            new Entry()
        );
    }

}