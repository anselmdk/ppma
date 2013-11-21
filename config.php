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
            ]
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

        // request
        'request' => [
            'id' => '\ppma\Service\Request\HttpFoundationServiceImpl'
        ],

        // response
        'response' => [
            'id' => '\ppma\Service\Response\Json\RequestServiceImpl',
        ],

    ],

    'version' => '1.0.0-alpha',

];