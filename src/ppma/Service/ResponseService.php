<?php


namespace ppma\Service;


use ppma\Service;

interface ResponseService extends Service
{

    /**
     * @param mixed $data
     * @return void
     */
    public function send($data);

}