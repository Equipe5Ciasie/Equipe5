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

$container = $app->getContainer();
$container['flash'] = function(){
	return new \Slim\Flash\Messages();
};

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
	if($this['ConnectionController']->checkTheConnection($request, $response, $args)){
		return $response->withRedirect($this->router->pathFor('HomeConnect'));
	} else {
		$this->flash->addMessage('error', "Adresse email ou mot de passe invalide.");
		return $response->withRedirect($this->router->pathFor('Connection'));
	}
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

$app->get('/AppelsOffres', 'AppelsOffresController:displayListPage')->setName('Consulter');

$app->get('/AppelsOffres/{id}', function($request, $response, $args){
	$this['AppelsOffresController']->displayAppelOffrePage($request, $response, $args['id']);
})->setName('Appeloffre');

$app->get('/AppelsOffres/{id}/repondre', 'AppelsOffresController:displayAnswerForm')->setName('RepondreAppelOffre');

$app->run();