<?php

require_once __DIR__ . '/vendor/autoload.php';

use equipe5\controllers\HomeController as HomeController;
use equipe5\controllers\ConnectionController as ConnectionController;
use equipe5\controllers\AppelsOffresController as AppelsOffresController;


$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$container = new \Slim\Container($configuration);

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('src/views');
    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container->get('request')->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $basePath));
    return $view;
};

$container['EXEMPLEController'] = function ($c){
    $view = $c->get('view');
    return new EXEMPLEController($view);
};


$container['HomeController'] = function ($c){
    $view = $c->get('view');
    return new HomeController($view);
};

$container['ConnectionController'] = function ($c){
    $view = $c->get('view');
    
    return new ConnectionController($view, $c);
};

$container['AppelsOffresController'] = function($c){
    $view = $c->get('view');
    return new AppelsOffresController($view, $c);
}
?>