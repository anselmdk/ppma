<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['user', 'create', 'mail']);

// get and init conig
use ppma\Config as Config;
$config = require(__DIR__ . '/../../config.php');
Config::init($config);


$guy = new TestGuy($scenario);
$guy->wantTo('create user');

// create valid user
$guy->sendPOST('/users', [
    'username' => 'jane-doe',
    'email'    => Config::get('testing.mail.recipient'),
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'
]);
$guy->seeResponseCodeIs(201);
$guy->seeHttpHeader('Content-Type', 'application/hal+json');
$guy->seeResponseContainsJson(['_links' => ['user' => ['href' => '/users/jane-doe']]]);
$guy->seeResponseContains('"authkey"');
$guy->seeHttpHeader('Location', '/users/jane-doe');

// valid with same slug
$guy->sendPOST('/users', [
    'username' => 'jane doe',
    'email'    => Config::get('testing.mail.recipient'),
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'
]);
$guy->seeResponseCodeIs(201);
$guy->seeHttpHeader('Location', '/users/jane-doe-2');

// valid with same slug
$guy->sendPOST('/users', [
    'username' => 'jane‘doe',
    'email'    => Config::get('testing.mail.recipient'),
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'
]);
$guy->seeResponseCodeIs(201);
$guy->seeHttpHeader('Location', '/users/jane-doe-3');

// without username
$guy->sendPOST('/users', [
    'email'    => 'jane@doe.net',
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'
]);
$guy->seeResponseCodeIs(400);
$guy->seeHttpHeader('Content-Type', 'application/hal+json');
$guy->seeResponseContainsJson(['code' => 1]);

// existing username
$guy->sendPOST('/users', [
    'username' => 'jane‘doe',
    'email'    => 'jane@doe.net',
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'
]);
$guy->seeResponseCodeIs(400);
$guy->seeHttpHeader('Content-Type', 'application/hal+json');
$guy->seeResponseContainsJson(['code' => 2]);

// without email
$guy->sendPOST('/users', [
    'username' => 'janedoe2',
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'
]);
$guy->seeResponseCodeIs(400);
$guy->seeHttpHeader('Content-Type', 'application/hal+json');
$guy->seeResponseContainsJson(['code' => 3]);

// without password
$guy->sendPOST('/users', [
    'username' => 'janedoe2',
    'email'    => 'jane@doe.net',
]);
$guy->seeResponseCodeIs(400);
$guy->seeHttpHeader('Content-Type', 'application/hal+json');
$guy->seeResponseContainsJson(['code' => 4]);

// with invalid password
$guy->sendPOST('/users', [
    'username' => 'janedoe2',
    'email'    => 'jane@doe.net',
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d'
]);
$guy->seeResponseCodeIs(400);
$guy->seeHttpHeader('Content-Type', 'application/hal+json');
$guy->seeResponseContainsJson(['code' => 5]);
