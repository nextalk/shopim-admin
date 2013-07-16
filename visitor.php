<?php

/*
 * Visitor App
 */

include_once "common.php";

$app->get('/', function() use ($app) {
	$app->render('index.html');
});

$app->get('/hello/:name', function($name) {
	echo "hello.....{$name}";
});

$app->get('/online', function() {
	echo "online....";
});

$app->get('/offline', function() {
	echo "offline";
});

$app->run();

