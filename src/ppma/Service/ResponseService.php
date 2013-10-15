<?php


namespace ppma\Service;


use ppma\Service;

interface ResponseService extends Service
{

    /**
     * @param array $data
     * @return string
     */
    public function send(array $data);

}