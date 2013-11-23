<?php


namespace ppma\Service;


use ppma\Service;

interface ResponseService extends Service
{

    /**
     * @param string $name
     * @param string $value
     * @return ResponseService
     */
    public function addHeader($name, $value);

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return array
     */
    public function getHeader();

    /**
     * @return int
     */
    public function getStatusCode();

    /**
     * @param mixed $body
     * @return ResponseService
     */
    public function setBody($body);

    /**
     * @param array $header
     * @return ResponseService
     */
    public function setHeader(array $header);

    /**
     * @param int $status
     * @return ResponseService
     */
    public function setStatusCode($status);

}