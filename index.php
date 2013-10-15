<?php

require_once 'vendor/autoload.php';

// load config
$config = include('./config.php');

// create and run app
(new ppma($config))->run();