<?php


namespace ppma\Service;


use ppma\Service;

interface ResponseService extends Service
{

    /**
     * @param mixed $data
     * @param int $status
     * @param array $header
     * @return void
     */
    public function send($data, $status = 200, $header =[]);

}