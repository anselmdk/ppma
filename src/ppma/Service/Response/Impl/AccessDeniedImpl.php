<?php


namespace ppma\Service\Response\Impl;


use ppma\Service\ResponseService;

/**
 * will trigger a 403-error
 *
 * @package ppma\Service\Response\Impl
 */
class AccessDeniedImpl implements ResponseService
{
    /**
     * @param string $name
     * @param string $value
     * @return ResponseService
     */
    public function addHeader($name, $value)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return '';
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        return [];
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return 0;
    }

    /**
     * @param mixed $body
     * @return ResponseService
     */
    public function setBody($body)
    {
        return $this;
    }

    /**
     * @param array $header
     * @return ResponseService
     */
    public function setHeader(array $header)
    {
        return $this;
    }

    /**
     * @param int $status
     * @return ResponseService
     */
    public function setStatusCode($status)
    {
        return $this;
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        return $this;
    }

} 