<?php


namespace ppma\Service\Request;


use ppma\Logger;
use ppma\Service;
use Symfony\Component\HttpFoundation\Request;

class HttpFoundationServiceImpl implements Service\RequestService
{

    /**
     * @var Request
     */
    private $instance;


    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        $this->instance = Request::createFromGlobals();
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this->instance->query->get($name);
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function header($name, $default = null)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this->instance->headers->get($name, $default);
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function post($name, $default = null)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);
        return $this->instance->request->get($name, $default);
    }

} 