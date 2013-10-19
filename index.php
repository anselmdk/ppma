<?php

require_once 'vendor/autoload.php';

// set mode
define('DEV_MODE', true);

// load config
$config = require(__DIR__ . '/config.php');

// create and run app
(new ppma($config))->run();