<?php

return [

    'url'      => 'http://localhost:8080/ppmasilex/public/index.php',

    'database' => [
        'username' => 'root',
        'password' => 'bitnami',
        'host'     => 'localhost',
        'database' => 'ppmasilex',
    ],

    'log' => [
        'writer'  => [
            [
                'id'      => '\ppma\Logger\Writer\EchoWriterImpl',
                'enabled' => true,
            ],
            [
                'id'      => '\ppma\Logger\Writer\ChromeWriterImpl',
                'enabled' => DEV_MODE,
            ],
        ],
    ],

    // services
    'services' => [
        // orm/database services
        'database' => [
            'user'  => [
                'id' => '\ppma\Service\Database\Spot\UserServiceImpl',
            ],
            'entry' => [
                'id' => '\ppma\Service\Database\Spot\EntryServiceImpl',
            ],
        ],

        // response/rendering
        'response' => [
            'html' => [
                'id' => '\ppma\Service\Response\Html\DispatchServiceImpl',
            ],

            'json' => [
                'id' => '\ppma\Service\Response\Json\DispatchServiceImpl',
            ],
        ],

        // session handling
        'session' => [
            'id'   => '\ppma\Service\Session\DispatchServiceImpl',
            'path' => __DIR__ . '/tmp/sessions',
        ],

        // (web)user
        'user' => [
            'id' => '\ppma\Service\User\SessionServiceImpl',
        ]
    ],

    // path to views
    'views' => __DIR__ . '/views',

];