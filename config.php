<?php

return [

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
            'json' => [
                'id' => '\ppma\Service\Response\Json\DispatchServiceImpl',
            ],
        ],

    ],

    'version' => '1.0.0-alpha',

];