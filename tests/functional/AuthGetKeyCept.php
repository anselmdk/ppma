<?php

/* @var \Codeception\Scenario $scenario */
$scenario->groups(['auth']);

$guy = new TestGuy($scenario);
$guy->wantTo('geht auth key');

// valid
$guy->sendGET('/users/janedoe/auth/5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');
$guy->seeResponseCodeIs(200);
$guy->seeResponseIsJson();
$guy->seeResponseContains('"key"');

// invalid username
$guy->sendGET('/users/johndoe/auth/5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');
$guy->seeResponseCodeIs(400);

// invalid password hash
$guy->sendGET('/users/janedoe/auth/5baa61e4c9b93f3f0682250b6cf8331b7ee68fd7');
$guy->seeResponseCodeIs(400);
