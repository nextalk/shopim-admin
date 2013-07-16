<?php 

/*
 * User App
 */

include_once "common.php";

$app->get('/login', function() {
	echo "user login.....";
});

$app->get('/logout', function() {
	echo "user logout.....";
});

$app->run();

