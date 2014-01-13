<?php


namespace ppma\Factory;


use ppma\Exception\InstanceIsNotAService;
use ppma\Exception\ServiceDoesNotExist;
use ppma\Logger;
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
     * @throws \InvalidArgumentException
     * @return void
     */
    public static function adorn(Serviceable $object)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        foreach ($object->services() as $config) {
            // check if index 'target' exist
            if (!isset($config['target'])) {
                throw new \InvalidArgumentException('"target" is not set');
            }

            // create service
            $service = self::get($config);

            // set service to object
            $object->setService($config['target'], $service);
        }
    }

    /**
     * @param array $config
     * @return Service|Serviceable
     * @throws \ppma\Exception\ServiceDoesNotExist
     * @throws \InvalidArgumentException
     * @throws \ppma\Exception\InstanceIsNotAService
     * @return void
     */
    protected static function create($config)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        // check if index 'id' exist
        if (!isset($config['id'])) {
            throw new \InvalidArgumentException('"id" is not set');
        }

        $id = $config['id'];

        // check if class $id exist
        if (!class_exists($id)) {
            throw new ServiceDoesNotExist($id);
        }

        // create service
        /* @var Service $service */
        $service = new $id();

        // check if $service really a service
        if (!($service instanceof Service)) {
            throw new InstanceIsNotAService($id);
        }

        // attach services if object serviceable
        if ($service instanceof Serviceable) {
            /* @var Serviceable $service */
            self::adorn($service);
        }

        // init service
        $service->init($config);

        return $service;
    }

    /**
     * @param array $config
     * @return Service
     */
    public static function get($config)
    {
        Logger::debug(sprintf('execute %s()', __METHOD__), __CLASS__);

        $key = md5(serialize($config));

        if (!isset(self::$services[$key])) {
            self::$services[$key] = self::create($config);

        }

        return self::$services[$key];
    }
}
