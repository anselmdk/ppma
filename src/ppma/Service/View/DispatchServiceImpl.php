<?php


namespace ppma\Service\View;


use ppma\Config;
use ppma\Service\ViewService;

class DispatchServiceImpl implements ViewService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        config('dispatch.views', Config::get('views'));
    }

    /**
     * @param string $template
     * @param array $data
     * @return string
     */
    public function render($template, $data = [])
    {
        render($template, $data, false);
    }

}