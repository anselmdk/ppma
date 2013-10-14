<?php


namespace ppma\Service;


use ppma\Service;

interface ViewService extends Service
{

    /**
     * @param string $template
     * @return mixed
     */
    public function render($template);

}