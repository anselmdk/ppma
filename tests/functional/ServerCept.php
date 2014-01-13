<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['server']);

$guy = new TestGuy($scenario);
$guy->wantTo('test server');

// redirect to ping
$guy->sendGET('/');
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['message' => 'pong']);

// ping
$guy->sendGET('/ping');
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContainsJson(['message' => 'pong']);