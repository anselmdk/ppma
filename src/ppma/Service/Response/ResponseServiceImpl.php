<?php


namespace ppma\Service\Response;


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
    }

    /**
     * @param string $name
     * @param string $value
     * @return ResponseService
     */
    public function addHeader($name, $value)
    {
        $this->header[$name] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $body
     * @return ResponseService
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @param array $header
     * @return ResponseService
     */
    public function setHeader(array $header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @param int $status
     * @return ResponseService
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

}