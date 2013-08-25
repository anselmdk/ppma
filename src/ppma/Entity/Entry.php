<?php

namespace ppma\Entity;

use Spot\Entity;

class Entry extends Entity
{

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

}