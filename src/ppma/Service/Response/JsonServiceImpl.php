<?php


namespace ppma\Service\Response;


use ppma\Service\ResponseService;

class JsonServiceImpl implements ResponseService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
    }

    /**
     * @param array $data
     * @return string
     */
    public function send(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }

}