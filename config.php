<?php

return [

    'database' => [
        'host'     => '127.0.0.1',
        'name'     => 'ppma',
        'username' => 'root',
        'password' => 'bitnami'
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
                'id' => '\ppma\Service\Database\Impl\UserServiceImpl',
            ],
            'entry' => [
                'id' => '\ppma\Service\Database\Impl\EntryServiceImpl',
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