<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['auth']);

$guy = new TestGuy($scenario);
$guy->wantTo('create new key');


// invalid (no auth header)
$guy->sendPOST('/users/janedoe/auth');
$guy->seeResponseCodeIs(403);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 101]);
$guy->seeResponseContains('"message"');

// invalid (wrong auth header)
$guy->haveHttpHeader('X-Authkey', 'f30d2f04433f0db4265ddc7d39eeeb5440e65fa4');
$guy->sendPOST('/users/janedoe/auth');
$guy->seeResponseCodeIs(403);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['code' => 101]);
$guy->seeResponseContains('"message"');

// valid
$guy->haveHttpHeader('X-Authkey', 'f30d2f04433f0db4265ddc7d39eeeb5440e65fa5');
$guy->sendPOST('/users/janedoe/auth');
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContains('"key"');