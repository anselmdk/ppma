<?php


namespace ppma\Model;


use Phormium\Model;

class GroupModel extends Model
{

    /**
     * @var array
     */
    // @codingStandardsIgnoreStart
    protected static $_meta = array(
        'database' => 'ppma',
        'table'    => 'group',
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
}
