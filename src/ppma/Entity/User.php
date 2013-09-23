<?php

namespace ppma\Entity;

use ppma\Application\StaticDatabaseTrait;
use Spot\Entity;


/**
 * Class User
 * @package ppma\Entity
 *
 * @property int     id
 * @property string  username
 * @property string  password
 * @property boolean isAdmin
 * @property string  encryptionKey
 */
class User extends Entity
{
    use StaticDatabaseTrait;

    /**
     * @var string
     */
    protected static $_datasource = 'user';


    /**
     * @return array
     */
    public static function fields()
    {
        return [
            'id'            => ['type' => 'int', 'primary' => true],
            'username'      => ['type' => 'string'],
            'password'      => ['type' => 'string'],
            'isAdmin'       => ['type' => 'boolean'],
            'encryptionKey' => ['type' => 'string'],
        ];
    }


    /**
     * @param string $username
     * @return bool|User
     */
    public static function findByUsername($username)
    {
        return self::getDatabase()->first('ppma\Entity\User', ['username' => $username]);
    }

}