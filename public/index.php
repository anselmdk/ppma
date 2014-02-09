<?php

require_once __DIR__ . '/../vendor/autoload.php';

// load config
$config = require(__DIR__ . '/../config.php');

// create and run app
(new Manager($config))->run();