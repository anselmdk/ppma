<?php


namespace ppma\Service\User;


use ppma\Config;
use ppma\Entity\User;
use ppma\Service\UserService;
use ppma\Service;
use ppma\Serviceable;

class SessionServiceImpl implements UserService, Serviceable
{

    /**
     * @var string
     */
    private $sessionName = '__user';

    /**
     * @var Service\Session\PackfireServiceImpl
     */
    protected $sessionService;

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        // TODO: Implement init() method.
    }

    /**
     * @param User $user
     * @return void
     */
    public function login(User $user)
    {
        $this->sessionService->set($this->sessionName, $user);
    }

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
        return [
            [
                'name' => 'sessionService',
                'id'   => Config::get('services.session')
            ]
        ];
    }

    /**
     * @param string $name
     * @param Service $service
     * @return void
     */
    public function setService($name, Service $service)
    {
        $this->$name = $service;
    }

}