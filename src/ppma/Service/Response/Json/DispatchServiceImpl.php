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

    public function send($data = [], $status = 200, $header =[])
    {
        // add name of status code
        header(sprintf('HTTP/1.1 %d', $status));

        foreach ($header as $name => $value)
        {
            header(sprintf('%s: %s', $name, $value));
        }

        json_out($data);
    }

}