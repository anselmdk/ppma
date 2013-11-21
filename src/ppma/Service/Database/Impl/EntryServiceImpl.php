<?php


namespace ppma\Service\Database\Spot;


use ppma\Entity\EntryModel;
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
     * @param EntryModel $entity
     * @return EntryModel
     */
    protected function assignModelToEntity(SpotEntry $model, EntryModel $entity)
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
     * @return EntryModel[]
     */
    public function getAll()
    {
        $models   = $this->mapper->all($this->_enitityClass);
        $entities = [];

        foreach ($models as $model)
        {
            $entities[] = $this->assignModelToEntity($model, new EntryModel());
        }

        return $entities;
    }

    /**
     * @param int $id
     * @return EntryModel
     */
    public function getById($id)
    {
        return $this->assignModelToEntity(
            $this->mapper->get($this->_enitityClass, $id),
            new EntryModel()
        );
    }

}