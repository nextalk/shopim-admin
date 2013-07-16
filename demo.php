<?php 

/*
 * Demo App
 */

include_once "common.php";

$app->get('/', function() {
	echo "shopim demo.....";
});

$app->run();

