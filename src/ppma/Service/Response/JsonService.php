<?php


namespace ppma\Service\Response;


use ppma\Service\ResponseService;

interface JsonService extends ResponseService
{

    /**
     * @param string $name
     * @param mixed $value
     * @return JsonService
     */
    public function addData($name, $value);

    /**
     * @return array
     */
    public function getData();

    /**
     * @param array $data
     * @return JsonService
     */
    public function setData($data = []);
}
