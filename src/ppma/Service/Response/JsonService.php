<?php

namespace ppma\Service\Response;


use ppma\Service\ResponseService;

interface JsonService extends ResponseService
{

    public function send($data = [], $status = 200, $header = []);

}