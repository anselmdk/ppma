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