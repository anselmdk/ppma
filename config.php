<?php

return [

    'url'      => 'http://localhost:8080/ppmasilex/index.php',
    'database' => [
        'username' => 'root',
        'password' => 'bitnami',
        'host'     => 'localhost',
        'database' => 'ppmasilex',
    ],

    'services' => [
        'database' => [
            'user'  => '\ppma\Service\Database\Spot\UserServiceImpl',
            'entry' => '\ppma\Service\Database\Spot\EntryServiceImpl'
        ],
        'response' => [
            'html' => '\ppma\Service\Response\Html\DispatchServiceImpl',
            'json' => '\ppma\Service\Response\Json\DispatchServiceImpl',
        ],
        'session' => '\ppma\Service\Session\DispatchServiceImpl',
        'user'    => '\ppma\Service\User\SessionServiceImpl',
    ],
    'views' => __DIR__ . '/views',
];