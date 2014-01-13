<?php


namespace ppma;


use ppma\Service\ResponseService;

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
     * @return ResponseService
     */
    public function run();
}
