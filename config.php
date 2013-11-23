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
        'model' => [
            'user'  => [
                'id' => '\ppma\Service\Model\Phormium\UserServiceImpl',
            ],
        ],

        // request
        'request' => [
            'id' => '\ppma\Service\Request\HttpFoundationServiceImpl'
        ],

        // response
        'response' => [
            'id' => '\ppma\Service\Response\Json\ResponseServiceImpl',
        ],

        'orm' => [
            'id' => '\ppma\Service\Orm\Impl\PhormiumServiceImpl',
        ]

    ],

    'version' => '1.0.0-alpha',

];