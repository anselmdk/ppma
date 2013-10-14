<?php


namespace ppma;


interface Entity
{

    /**
     * @param array $properties ['propertyName' => 'propertyValue']
     * @return void
     */
    public function assignToProperties($properties = []);

}