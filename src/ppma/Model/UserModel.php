<?php


namespace ppma\Model;

use Phormium\Model;

class UserModel extends Model
{

    /**
     * @var array
     */
    protected static $_meta = array(
        'database' => 'ppma',
        'table'    => 'user',
        'pk'       => 'id'
    );

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $apikey;

    /**
     * @var string
     */
    public $slug;

}