<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['user', 'update']);

$guy = new TestGuy($scenario);
$guy->wantTo('update user');

// invalid authkey
$guy->haveHttpHeader('X-Authkey', 'f30d2f04433f0db4265ddc7d39eeeb5440e65fa4');
$guy->sendPUT('/users/janedoe', [
    'email'    => 'jane@doe.com',
    'password' => '0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e'
]);
$guy->seeResponseCodeIs(403);
$guy->seeHttpHeader('Content-Type', 'application/hal+json');
$guy->seeResponseContainsJson(['code' => 101]);
$guy->seeResponseContains('"message"');

// invalid password
$guy->haveHttpHeader('X-Authkey', 'f30d2f04433f0db4265ddc7d39eeeb5440e65fa5');
$guy->sendPUT('/users/janedoe', [
    'password' => '0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94'
]);
$guy->seeResponseCodeIs(400);
$guy->haveHttpHeader('Content-Type', 'application/hal+json');
$guy->seeResponseContainsJson(['code' => 1]);
$guy->seeResponseContains('"message"');

// only email
$guy->haveHttpHeader('X-Authkey', 'f30d2f04433f0db4265ddc7d39eeeb5440e65fa5');
$guy->sendPUT('/users/janedoe', [
    'email' => 'jane@doe.com',
]);
$guy->seeResponseCodeIs(200);
$guy->haveHttpHeader('Content-Type', 'application/hal+json');

// only password
$guy->haveHttpHeader('X-Authkey', 'f30d2f04433f0db4265ddc7d39eeeb5440e65fa5');
$guy->sendPUT('/users/janedoe', [
    'password' => '0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e',
]);
$guy->seeResponseCodeIs(200);
$guy->haveHttpHeader('Content-Type', 'application/hal+json');

// email and password
$guy->haveHttpHeader('X-Authkey', 'f30d2f04433f0db4265ddc7d39eeeb5440e65fa5');
$guy->sendPUT('/users/janedoe', [
    'email'    => 'jane@doe.com',
    'password' => '0b14d501a594442a01c6859541bcb3e8164d183d32937b851835442f69d5c94e'
]);
$guy->seeResponseCodeIs(200);
$guy->haveHttpHeader('Content-Type', 'application/hal+json');

