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
        'config'   => '\ppma\Service\Configuration\DotorServiceImpl',
        'database' => [
            'user'  => '\ppma\Service\Database\Spot\UserServiceImpl',
            'entry' => '\ppma\Service\Database\Spot\EntryServiceImpl'
        ],
        'response' => [
            //'html' => '\ppma\Service\Response\JsonServiceImpl',
            'json' => '\ppma\Service\Response\JsonServiceImpl',
        ],
        'session' => '\ppma\Service\Session\PackfireServiceImpl',
        'user'    => '\ppma\Service\User\SessionServiceImpl',
        'view'    => '\ppma\Service\View\PhpServiceImpl',
    ]

];