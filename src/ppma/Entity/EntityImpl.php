<?php


namespace ppma\Entity;


use ppma\Entity;

abstract class EntityImpl implements Entity
{

    /**
     * @param array $properties ['propertyName' => 'propertyValue']
     * @return void
     */
    public function assignToProperties($properties = [])
    {
        // TODO: validation
        foreach ($properties as $name => $value)
        {
            $this->{'set' . ucfirst($name)}($value);
        }
    }

}