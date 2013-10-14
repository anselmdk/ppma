<?php

namespace ppma\Entity;

use ppma\Application\DatabaseTrait;
use ppma\Application\StaticDatabaseTrait;
use Spot\Entity;
use Spot\Query;

class Entry extends Entity
{
    use StaticDatabaseTrait;


    /**
     * @var string
     */
    protected static $_datasource = 'entry';


    /**
     * @return array
     */
    public static function fields()
    {
        return [
            'id'          => ['type' => 'int', 'primary' => true],
            'name'        => ['type' => 'string'],
            'url'         => ['type' => 'text'],
            'comment'     => ['type' => 'text'],
            'password'    => ['type' => 'text'],
            'userId'      => ['type' => 'int'],
            'categoryId'  => ['type' => 'int'],
        ];
    }


    /**
     * @return Query
     */
    public static function findAll()
    {
        return self::database()->all('\ppma\Entity\Entry');
    }

}