<?php


namespace ppma;


interface Service
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = []);
}
