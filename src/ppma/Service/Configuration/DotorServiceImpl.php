<?php


namespace ppma\Service\Configuration;


use Dotor\Dotor;
use ppma\Service\ConfigService;

class DotorServiceImpl extends Dotor implements ConfigService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        $this->params = $args['config'];
    }

}