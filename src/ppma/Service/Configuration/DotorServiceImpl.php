<?php


namespace ppma\Service\Configuration;


use Dotor\Dotor;
use ppma\Service\ConfigurationService;

class DotorServiceImpl extends Dotor implements ConfigurationService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        $this->params = include(__DIR__ . '/../../../../config.php');
    }

}