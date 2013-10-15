<?php

namespace ppma\Service\Database\Spot\Entity;

use Spot\Entity;
use Spot\Query;

/**
 * Class Entry
 *
 * @property int    $id
 * @property string $name
 * @property string $url
 * @property string $comment
 * @property string $encryptedPassword
 * @property int    $userId
 * @property int    $categoryId
 * @property string $username
 * @property int    $viewCount
 */
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
            'id'                => ['type' => 'int', 'primary' => true],
            'name'              => ['type' => 'string'],
            'url'               => ['type' => 'text'],
            'comment'           => ['type' => 'text'],
            'encryptedPassword' => ['type' => 'text'],
            'userId'            => ['type' => 'int'],
            'categoryId'        => ['type' => 'int'],
            'username'          => ['type' => 'string'],
            'viewCount'         => ['type' => 'int'],
        ];
    }

}