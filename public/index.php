<?php

require_once __DIR__ . '/../vendor/autoload.php';

// set mode
if (!defined('DEV_MODE')) define('DEV_MODE', false);

// load config
$config = require(__DIR__ . '/../config.php');

// create and run app
(new ppma($config))->run();