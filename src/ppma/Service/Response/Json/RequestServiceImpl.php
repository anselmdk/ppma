<?php


namespace ppma\Service\Response\Json;


use ppma\Service\ResponseService;

class RequestServiceImpl implements ResponseService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
    }

    public function send($data = [], $status = 200, $header =[])
    {
        // TODO: add name of status code
        header(sprintf('HTTP/1.1 %d', $status));
        header('Content-Type: application/json');

        foreach ($header as $name => $value)
        {
            header(sprintf('%s: %s', $name, $value));
        }

        echo json_encode($data);
    }

}