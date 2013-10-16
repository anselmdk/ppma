<?php


namespace ppma\Service\Response\Html;


use ppma\Service\Response\HtmlService;

abstract class HtmlServiceImpl implements HtmlService
{

    /**
     * @param array $args
     * @return mixed
     */
    public function init($args = []) { }

    /**
     * @param string $data
     * @return string
     */
    public function send($data)
    {
        return $data;
    }

}