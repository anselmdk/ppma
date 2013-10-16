<?php


namespace ppma\Service\Response\Json;


use ppma\Service\ResponseService;

class PhpServiceImpl implements ResponseService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
    }

    /**
     * @param mixed $data
     * @return void
     */
    public function send($data)
    {
        header('Content-type: application/json');
        echo json_encode($data);
    }

}