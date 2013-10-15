<?php


namespace ppma;


class Response
{

    /**
     * @var array
     */
    protected $parameter = [];

    /**
     * @return array
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * @param string $name
     * @param mixed  $value
     * @return void
     */
    public function setParameter($name, $value)
    {
        $this->parameter[$name] = $value;
    }

}