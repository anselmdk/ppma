<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['server']);

$guy = new TestGuy($scenario);
$guy->wantTo('test server');

// create valid user
$guy->sendGET('/');
$guy->seeResponseCodeIs(200);
$guy->seeHttpHeader('Content-Type', 'application/hal+json');
$guy->seeResponseContainsJson(['_links' => ['self' => ['href' => '/']], 'message' => 'pong']);