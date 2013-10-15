<?php


namespace ppma\Entity;


use ppma\Entity;
use ppma\Exception\MethodDoesNotExistException;

abstract class EntityImpl implements Entity
{

    /**
     * @param array $properties
     * @throws \ppma\Exception\MethodDoesNotExistException
     * @return void
     */
    public function assignToProperties($properties = [])
    {
        foreach ($properties as $name => $value)
        {
            $method = 'set' . ucfirst($name);

            // check if setter is exist
            if (!method_exists($this, $method))
            {
                throw new MethodDoesNotExistException(sprintf('%s::%s', get_class($this), $method));
            }

            $this->$method($value);
        }
    }

}