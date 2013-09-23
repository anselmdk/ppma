<?php


namespace ppma\Application;


trait DatabaseTrait
{

    /**
     * Alias for getDatabase
     *
     * @return \Spot\Mapper
     */
    public function database()
    {
        return $this->getDatabase();
    }

    /**
     * @return \Spot\Mapper
     */
    public function getDatabase()
    {
        return $this->silex['spot'];
    }

}