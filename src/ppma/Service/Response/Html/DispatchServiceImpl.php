<?php


namespace ppma\Service\Response\Html;


use ppma\Config;

class DispatchServiceImpl extends HtmlServiceImpl
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = [])
    {
        parent::init();
        config('dispatch.views', Config::get('views'));
    }

    /**
     * @param string $template
     * @param array $data
     * @return void
     */
    public function render($template, $data = [])
    {
        ob_start();
        render($template, $data, false);
        $this->send(ob_get_clean());
    }

}