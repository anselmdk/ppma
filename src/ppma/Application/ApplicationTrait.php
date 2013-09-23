<?php


namespace ppma\Application;


trait ApplicationTrait
{

    /**
     * Alias for getApplication()
     *
     * @return \ppma
     */
    public function app()
    {
        return $this->getApplication();
    }

    /**
     * @return \ppma
     */
    public function getApplication()
    {
        return \ppma::app();
    }

}