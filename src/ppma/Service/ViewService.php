<?php


namespace ppma\Service;


use ppma\Service;

interface ViewService extends Service
{

    /**
     * @param string $template
     * @param array $data
     * @return string
     */
    public function render($template, $data = []);

}