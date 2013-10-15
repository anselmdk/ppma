<?php


namespace ppma\Factory;


use ppma\Exception\InstanceIsNotAService;
use ppma\Exception\ServiceDoesNotExist;
use ppma\Service;
use ppma\Serviceable;

class ServiceFactory
{

    /**
     * @var Service\ConfigService
     */
    protected static $configService;

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
        $object->setConfigService(self::$configService);

        foreach ($object->services() as $configuration)
        {
            $name = $configuration['name'];
            $id   = $configuration['id'];
            $args = [];

            if (isset($configuration['args']))
            {
                $args = $configuration['args'];
            }

            // create service
            $service = self::get($id, $args);

            // set service to object
            $object->setService($name, $service);
        }
    }

    /**
     * @param $id
     * @param array $args
     * @return Service|Serviceable
     * @throws \ppma\Exception\ServiceDoesNotExist
     * @throws \ppma\Exception\InstanceIsNotAService
     */
    protected static function create($id, $args = [])
    {
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
        $service->init($args);

        return $service;
    }

    /**
     * @param string $id
     * @param array $args
     * @return Service
     */
    public static function get($id, $args = [])
    {
        $argId = md5(serialize($args));

        if (!isset(self::$services[$id]))
        {
            self::$services[$id] = [];

        }

        if (!isset(self::$services[$id][$argId]))
        {
            self::$services[$id][$argId] = self::create($id, $args);
        }

        return self::$services[$id][$argId];
    }

    /**
     * @param Service\ConfigService $config
     * @return void
     */
    public static function init(Service\ConfigService $config)
    {
        self::$configService = $config;
    }

}