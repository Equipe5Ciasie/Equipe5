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
        
		if (Authentication::checkConnection()!=false) {
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
         } else {
             $email = "";
             $type = 0;
         }
		return $this->view->render($response, 'HomeView.html.twig', [
            'email' => $email,
            'type' => $type,
        ]);
    }

    public function displayVosOffres($request, $response, $args) {
        
            return $this->view->render($response, 'HomeOffre.html.twig', [
                'email' => $_SESSION['email'],
                'type' => $_SESSION['type'],
			]);
            }

	
}