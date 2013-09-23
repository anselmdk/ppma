<?php

namespace ppma\Entity;

use Spot\Entity;


/**
 * Class User
 * @package ppma\Entity
 *
 * @property int     id
 * @property string  username
 * @property string  password
 * @property string  salt
 * @property boolean isAdmin
 */
class User extends Entity
{

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
            'id'          => ['type' => 'int', 'primary' => true],
            'username'    => ['type' => 'string'],
            'password'    => ['type' => 'text'],
            'salt'        => ['type' => 'text'],
            'isAdmin'     => ['type' => 'boolean'],
        ];
    }


    /**
     * @param string $username
     * @return bool|User
     */
    public static function findByUsername($username)
    {
        return \ppma::instance()->getDatabase()->first('ppma\Entity\User', ['username' => $username]);
    }

}