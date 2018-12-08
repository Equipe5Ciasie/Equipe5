<?php

namespace equipe5\controllers;

use \Slim\Views\Twig as twig;
use equipe5\views\HomeView;
class HomeController {

    protected $view;

	/**
	 * Constructor of the class HomeController
	 * @param view
	 */
    public function __construct(twig $view) {
        $this->view = $view;
    }

	public function displayHome($request, $response,$args) {
        
		// if (Authentication::checkConnection()) {
        //     $nameMember = $_SESSION['forenameMember'];
        //     $roleMember = $_SESSION['roleMember'];
        // } else {
        //     $nameMember = "";
        //     $roleMember = 0;
        // }
		return $this->view->render($response, 'HomeView.html.twig');
	}
}