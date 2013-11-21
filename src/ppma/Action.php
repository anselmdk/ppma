<?php


namespace ppma;


interface Action extends Serviceable
{

    /**
     * @return void
     */
    public function after();

    /**
     * @return void
     */
    public function before();

    /**
     * @param array $args
     * @return void
     */
    public function init($args = []);

    /**
     * @return void
     */
    public function run();

} 