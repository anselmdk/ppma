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
     * @var Service\SessionService
     */
    protected $session;

    /**
     * @return User
     */
    public function getEntity()
    {
        $entity = $this->session->get('user');

        if ($entity instanceof User)
        {
            return $entity;
        }
        else
        {
            return new User();
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getEntity()->getId();
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->getEntity()->getUsername();
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = []) { }

    /**
     * @return boolean
     */
    public function isLoggedIn()
    {
        return $this->getEntity() instanceof User;
    }

    /**
     * @param User $user
     * @return void
     */
    public function login(User $user)
    {
        $this->session->set('user', $user);
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->session->set('user', null);
    }

    /**
     * @return array ['propertyName' => 'class name of service']
     */
    public function services()
    {
        return [
            array_merge(Config::get('services.session'), ['target' => 'session']),
        ];
    }

    /**
     * @param string $target
     * @param Service $service
     * @return void
     */
    public function setService($target, Service $service)
    {
        $this->$target = $service;
    }

}