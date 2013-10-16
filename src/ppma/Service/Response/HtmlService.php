<?php


namespace ppma\Service\Response;


use ppma\Service\ResponseService;

interface HtmlService extends ResponseService
{

    /**
     * @param string $template
     * @param array $data
     * @return void
     */
    public function render($template, $data = []);

}