<?php

return [

    'url'      => 'http://localhost:8080/ppmasilex/index.php',

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
                'enabled' => true,
            ],
        ],
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