<?php


namespace ppma\Service\Request;


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
        $this->instance = Request::createFromGlobals();
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        return $this->instance->query->get($name);
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function post($name, $default = null)
    {
        return $this->instance->request->get($name, $default);
    }

} 