<?php

require_once 'vendor/autoload.php';

// load config
$config = require(__DIR__ . '/config.php');

// create and run app
(new ppma($config))->run();