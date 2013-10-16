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
     * @return string
     */
    public function send($data)
    {
        ob_start();
        json_out($data);
        return ob_get_clean();
    }

}