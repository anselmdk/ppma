<?php


namespace ppma\Service\Database;


use ppma\Entity\Entry;
use ppma\Service;

interface EntryService extends Service
{

    /**
     * @return Entry[]
     */
    public function getAll();

    /**
     * @param int $id
     * @return Entry
     */
    public function getById($id);

}