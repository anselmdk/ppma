<?php


namespace ppma\Service;


use Hahns\Hahns;
use ppma\Service;

class ServiceImpl implements Service
{

    /**
     * @var Hahns
     */
    protected $app;

    /**
     * @return void
     */
    public function init()
    {
    }

    /**
     * @param Hahns $app
     * @return void
     */
    public function setApplication(Hahns $app)
    {
        $this->app = $app;
    }
}