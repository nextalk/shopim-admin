<?php 
/*
 * Admin App
 */

include_once "common.php";

$app->get('/login', function() {
	echo "login.....";
});

$app->get('/logout', function() {
	echo "logout.....";
});

$app->run();

