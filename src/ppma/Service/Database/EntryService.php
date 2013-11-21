<?php


namespace ppma\Service\Database;


use ppma\Entity\EntryModel;
use ppma\Service;

interface EntryService extends Service
{

    /**
     * @return EntryModel[]
     */
    public function getAll();

    /**
     * @param int $id
     * @return EntryModel
     */
    public function getById($id);

}