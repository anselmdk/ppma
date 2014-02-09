<?php


namespace ppma\Model;

use Phormium\Model;

class User extends Model
{

    /**
     * @var array
     */
    // @codingStandardsIgnoreStart
    protected static $_meta = array(
        'database' => 'ppma',
        'table'    => 'user',
        'pk'       => 'id'
    );
    // @codingStandardsIgnoreEnd

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
    public $authkey;

    /**
     * @var string
     */
    public $slug;
}
