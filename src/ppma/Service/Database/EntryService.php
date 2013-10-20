<?php


namespace ppma\Service\Database;


use ppma\Entity\EntryEntity;
use ppma\Service;

interface EntryService extends Service
{

    /**
     * @return EntryEntity[]
     */
    public function getAll();

    /**
     * @param int $id
     * @return EntryEntity
     */
    public function getById($id);

}