<?php


namespace ppma;


interface Controller extends Serviceable
{

    /**
     * @return void
     */
    public function before();

    /**
     * @return void
     */
    public function after();

}