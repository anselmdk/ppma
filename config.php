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
                'id'     => '\ppma\Service\Database\Spot\UserServiceImpl',
                'target' => 'userEntity',
            ],
            'entry' => [
                'id'     => '\ppma\Service\Database\Spot\EntryServiceImpl',
                'target' => 'entryEntity',
            ],
        ],

        // logging
        'log' => [
            'id'     => '\ppma\Service\Log\ChromeServiceImpl',
            'target' => 'log',
        ],

        // response/rendering
        'response' => [
            'html' => [
                'id'     => '\ppma\Service\Response\Html\DispatchServiceImpl',
                'target' => 'html',
            ],

            'json' => [
                'id'     => '\ppma\Service\Response\Json\DispatchServiceImpl',
                'target' => 'json',
            ],
        ],

        // session handling
        'session' => [
            'id'     => '\ppma\Service\Session\DispatchServiceImpl',
            'target' => 'session',
        ],

        // (web)user
        'user'    => [
            'id'     => '\ppma\Service\User\SessionServiceImpl',
            'target' => 'user',
        ]
    ],

    // path to views
    'views' => __DIR__ . '/views',

];