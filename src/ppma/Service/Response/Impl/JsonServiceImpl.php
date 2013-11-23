<?php


namespace ppma\Service\Response\Impl;


use ppma\Service\Response\JsonService;
use ppma\Service\Response\ResponseServiceImpl;

class JsonServiceImpl extends ResponseServiceImpl implements JsonService
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $name
     * @param mixed $value
     * @return JsonService
     */
    public function addData($name, $value)
    {
        $this->data[$name] = $value;
        return $this;
    }


    public function getBody()
    {
        if (count($this->data) == 0)
        {
            return null;
        }

        return json_encode($this->getData());
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        $header = parent::getHeader();

        if (!isset($header['Content-Type']))
        {
            $header['Content-Type'] = 'application/json';
        }

        return $header;
    }


    /**
     * @param array $data
     * @return JsonService
     */
    public function setData($data = [])
    {
        $this->data = $data;
        return $this;
    }


} 