<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use equipe5\bd\Connection;
// use equipe5\controllers\ConnectionController;
// use equipe5\controllers\ConnectionController;



Connection::setConfig('src/conf/conf.ini');
$db = Connection::makeConnection();

$ini = parse_ini_file('src/conf/conf.ini');

$db = new DB();

$db->addConnection([
	'driver' => $ini['driver'],
	'host' => $ini['host'],
	'database' => $ini['dbname'],
	'username' => $ini['username'],
	'password' => $ini['password'],
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => ''
]);

$db->setAsGlobal();
$db->bootEloquent();

session_start();

require('container.php');

$app = new \Slim\App($container);

$app->get('/', 'HomeController:displayHome')->setName('Home');

$app->get('/CreateAccount', 'ConnectionController:displayCreateAccount')->setName('CreateAccount');

$app->post('/CreateAccount', function($request, $response, $args){
	$controller = $this['ConnectionController'];
	$checkAccountCreation = $controller->checkAccountCreation($request, $response, $args);
	$router = $this->router;
	return $response->withRedirect($router->pathFor('HomeConnect', []));
})->setName("checkAccountCreation");

$app->get('/Connection', 'ConnectionController:displayConnection')->setName("Connection");

$app->post('/Connection', function($request, $response, $args){
	$controller = $this['ConnectionController'];
	$checkConnection = $controller->checkTheConnection($request, $response, $args);
	$router = $this->router;
	return $response->withRedirect($router->pathFor('HomeConnect', []));
})->setName("checkAccountCreation");

$app->get('/HomeConnect', function($request, $response, $args){
	// if (Authentication::checkTheConnection()) {
		$controller = $this['HomeController'];
		$displayHomeConnect = $controller->displayHomeConnect($request, $response, $args);
	// }
	// else {
	// 	$router = $this->router;
	// 	return $response->withRedirect($router->pathFor('Home', []));
	// }
	
})->setName('HomeConnect');

$app->get('/Disconnection', function($request, $response, $args){
	$controller = $this['ConnectionController'];
	$controller->checkDestroySession($request, $response, $args);
	$router = $this->router;
	return $response->withRedirect($router->pathFor('Home', []));
})->setName('Disconnection');

$app->get('/Consulter', 'AppelsOffresController:displayListPage')->setName('Consulter');

$app->get('/AppelOffre:id', function($request, $response, $args){
	$this['AppelsOffresController']->displayAppelOffrePage($args['id'], $response);
})->setName('Appeloffre');

$app->run();