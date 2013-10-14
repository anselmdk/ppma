<?php


namespace ppma\Service\Session;


use Packfire\Session\Session;
use Packfire\Session\Storage\SessionStorage;
use ppma\Service\SessionService;

class PackfireServiceImpl implements SessionService
{

    /**
     * @var Session
     */
    protected $session;

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        $this->session->get($name);
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        $this->session = new Session(new SessionStorage());

        if (!Session::detectCookie())
        {
            Session::register();
        }
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function set($name, $value)
    {
        $this->set($name, $value);
    }

}