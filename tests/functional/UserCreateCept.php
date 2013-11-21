<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['user', 'create']);

$guy = new TestGuy($scenario);
$guy->wantTo('create user');

// create valid user
$guy->sendPOST('/users', [
    'username' => 'jane-doe',
    'email'    => 'jane@doe.net',
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'
]);
$guy->seeResponseCodeIs(201);
$guy->seeHttpHeader('Location', '/users/jane-doe');

// valid with same slug
$guy->sendPOST('/users', [
    'username' => 'jane doe',
    'email'    => 'jane@doe.net',
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'
]);
$guy->seeResponseCodeIs(201);
$guy->seeHttpHeader('Location', '/users/jane-doe-2');

// valid with same slug
$guy->sendPOST('/users', [
    'username' => 'jane‘doe',
    'email'    => 'jane@doe.net',
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
$guy->seeResponseContainsJson(['code' => 1]);

// existing username
$guy->sendPOST('/users', [
    'username' => 'jane‘doe',
    'email'    => 'jane@doe.net',
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseContainsJson(['code' => 2]);

// without email
$guy->sendPOST('/users', [
    'username' => 'janedoe2',
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseContainsJson(['code' => 3]);

// without password
$guy->sendPOST('/users', [
    'username' => 'janedoe2',
    'email'    => 'jane@doe.net',
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseContainsJson(['code' => 4]);

// with invalid password
$guy->sendPOST('/users', [
    'username' => 'janedoe2',
    'email'    => 'jane@doe.net',
    'password' => '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d'
]);
$guy->seeResponseCodeIs(400);
$guy->seeResponseContainsJson(['code' => 5]);
