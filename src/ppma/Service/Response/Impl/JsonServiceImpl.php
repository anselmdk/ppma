<?php


namespace ppma\Service\Response\Impl;


use ppma\Logger;
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
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

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
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return json_decode($this->getBody(), true);
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
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
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $this->setBody(json_encode($data));
        return $this;
    }


} 