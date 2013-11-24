<?php


namespace ppma\Service\Response\Impl;


use ppma\Service\Response\JsonService;
use ppma\Service\Response\ResponseServiceImpl;

class JsonServiceImpl extends ResponseServiceImpl implements JsonService
{

    /**
     * @param string $name
     * @param mixed $value
     * @return JsonService
     */
    public function addData($name, $value)
    {
        $data        = $this->getData();
        $data[$name] = $value;
        $this->setData($data);

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return json_decode($this->getBody(), true);
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
        $this->setBody(json_encode($data));
        return $this;
    }


} 