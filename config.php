<?php

return [

    'url'      => 'http://localhost:8080/ppmasilex/index.php',

    'database' => [
        'username' => 'root',
        'password' => 'bitnami',
        'host'     => 'localhost',
        'database' => 'ppmasilex',
    ],

    // services
    'services' => [
        // orm/database services
        'database' => [
            'user'  => [
                'id'   => '\ppma\Service\Database\Spot\UserServiceImpl',
                'name' => 'userEntity',
            ],
            'entry' => [
                'id'   => '\ppma\Service\Database\Spot\EntryServiceImpl',
                'name' => 'entryEntity',
            ],
        ],

        // logging
        'log' => [
            'id'   => '\ppma\Service\Log\ChromeServiceImpl',
            'name' => 'log',
        ],

        // response/rendering
        'response' => [
            'html' => [
                'id'   => '\ppma\Service\Response\Html\DispatchServiceImpl',
                'name' => 'html',
            ],

            'json' => [
                'id'   => '\ppma\Service\Response\Json\DispatchServiceImpl',
                'name' => 'json',
            ],
        ],

        // session handling
        'session' => [
            'id'   => '\ppma\Service\Session\DispatchServiceImpl',
            'name' => 'session',
        ],

        // (web)user
        'user'    => [
            'id'   => '\ppma\Service\User\SessionServiceImpl',
            'name' => 'user',
        ]
    ],

    // path to views
    'views' => __DIR__ . '/views',

];