<?php

require_once 'vendor/autoload.php';

// load config
$config = include('./config.php');

// run app
ppma::app($config)->silex()->run();