<?php

return [

    'database' => [
        'host'     => '127.0.0.1',
        'name'     => 'ppma',
        'username' => 'root',
        'password' => ''
    ],

    'mail' => [
        'from' => 'ppma@pklink.github.com',
        'smtp' => [
            'host'     => 'smtp.mailgun.org',
            'port'     => 25,
            'username' => 'postmaster@domain.com',
            'password' => '',
            'tls'      => false,
            'dryrun'   => false
        ]
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

        // orm
        'orm' => [
            'id' => '\ppma\Service\Orm\Impl\PhormiumServiceImpl',
        ],

        // smtp
        'smtp' => [
            'id' => '\ppma\Service\Smpt\SwiftServiceImpl',
        ],

    ],

    'testing' => [
        'mail' => [
            'recipient' => 'yourmail@domain.com',
        ]
    ],

    'version' => '1.0.0-alpha',

];