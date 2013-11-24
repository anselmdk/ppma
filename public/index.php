<?php

require_once __DIR__ . '/../vendor/autoload.php';

// load config
$config = require(__DIR__ . '/../config.php');

// set mode
if (!defined('DEV_MODE'))
{
    define('DEV_MODE', false);
}

// create and run app
(new ppma($config))->run();