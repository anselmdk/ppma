<?php


namespace ppma\Factory;


use ppma\Exception\InstanceIsNotAService;
use ppma\Exception\ServiceDoesNotExist;
use ppma\Service;
use ppma\Serviceable;

class ServiceFactory
{

    /**
     * @var Service[]
     */
    protected static $services = [];

    /**
     * @param Serviceable $object
     * @return void
     */
    public static function adorn(Serviceable $object)
    {
        foreach ($object->services() as $config)
        {
            // create service
            $service = self::get($config);

            // set service to object
            $object->setService($config['name'], $service);
        }
    }

    protected static function create($config)
    {
        $id = $config['id'];

        // check if class $id exist
        if (!class_exists($id))
        {
            throw new ServiceDoesNotExist($id);
        }

        // create service
        /* @var Service $service */
        $service = new $id();

        // check if $service really a service
        if (!($service instanceof Service))
        {
            throw new InstanceIsNotAService($id);
        }

        // attach services if object serviceable
        if ($service instanceof Serviceable)
        {
            /* @var Serviceable $service */
            self::adorn($service);
        }

        // init service
        $service->init($config);

        return $service;
    }

    public static function get($config)
    {
        $key = md5(serialize($config));

        if (!isset(self::$services[$key]))
        {
            self::$services[$key] = self::create($config);

        }

        return self::$services[$key];
    }

}