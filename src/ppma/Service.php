<?php


namespace ppma;


use Hahns\Hahns;

interface Service
{

    /**
     * @return void
     */
    public function init();

    /**
     * @param Hahns $app
     * @return void
     */
    public function setApplication(Hahns $app);
}
