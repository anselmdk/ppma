<?php


namespace ppma\Service\Response\Impl;


use ppma\Logger;
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
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return '';
    }

    /**
     * @return array
     */
    public function getHeader()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return [];
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return 0;
    }

    /**
     * @param mixed $body
     * @return ResponseService
     */
    public function setBody($body)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this;
    }

    /**
     * @param array $header
     * @return ResponseService
     */
    public function setHeader(array $header)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this;
    }

    /**
     * @param int $status
     * @return ResponseService
     */
    public function setStatusCode($status)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this;
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this;
    }
}
