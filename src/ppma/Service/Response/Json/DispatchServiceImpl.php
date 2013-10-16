<?php


namespace ppma\Service\Response\Json;


use ppma\Service\ResponseService;

class DispatchServiceImpl implements ResponseService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = []) { }

    /**
     * @param mixed $data
     * @return void
     */
    public function send($data)
    {
        json_out($data);
    }

}