<?php 

require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
	'templates.path' => 'templates',
	'debug' => true,
	'log.level' => 4,
	'log.enabled' => true,
	'log.writer' => new \Slim\Extras\Log\DateTimeFileWriter(array(
		'path' => 'logs',
		'name_format' => 'y-m-d'
	))
));

\Slim\Extras\Views\Twig::$twigOptions = array(
	'charset' => 'utf-8',
	'cache' => realpath('templates/cache'),
	'auto_reload' => true,
	'strict_variables' => false,
	'autoescape' => true
);

$app->view(new \Slim\Extras\Views\Twig());

