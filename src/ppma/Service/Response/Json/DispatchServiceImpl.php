<?php


namespace ppma\Service\Response\Json;


use ppma\Service\Response\JsonService;

class DispatchServiceImpl implements JsonService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = []) { }

    public function send($data = [], $status = 200, $header =[])
    {
        // add name of status code
        header(sprintf('HTTP/1.1 %d', $status));

        json_out($data);
    }

}