<?php


namespace ppma\Service\Response;


use ppma\Logger;
use ppma\Service\ResponseService;

class ResponseServiceImpl implements ResponseService
{

    /**
     * @var string
     */
    protected $body = '';

    /**
     * @var array
     */
    protected $header = [];

    /**
     * @var int
     */
    protected $status = 200;

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
    }

    /**
     * @param string $name
     * @param string $value
     * @return ResponseService
     */
    public function addHeader($name, $value)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $this->header[$name] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this->body;
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this->header;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this->status;
    }

    /**
     * @param mixed $body
     * @return ResponseService
     */
    public function setBody($body)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $this->body = $body;
        return $this;
    }

    /**
     * @param array $header
     * @return ResponseService
     */
    public function setHeader(array $header)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $this->header = $header;
        return $this;
    }

    /**
     * @param int $status
     * @return ResponseService
     */
    public function setStatusCode($status)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $this->status = $status;
        return $this;
    }

}