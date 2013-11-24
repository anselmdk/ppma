<?php


namespace ppma\Model;


use Phormium\Model;

class GroupModel extends Model
{

    /**
     * @var array
     */
    protected static $_meta = array(
        'database' => 'ppma',
        'table'    => 'group',
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

}