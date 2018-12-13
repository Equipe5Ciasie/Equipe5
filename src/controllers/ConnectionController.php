<?php

namespace equipe5\controllers;

use equipe5\models as m;
use equipe5\controllers\Authentication;
use \Slim\Views\Twig as twig;
use equipe5\views\ConnexionView;
use equipe5\views\CreateAccountView;

/**
 * Class ConnectionController
 */
class ConnectionController {

	protected $view;

	/**
	 * Constructor of the class ConnectionController
	 * @param view
	 */
    public function __construct(twig $view) {
        $this->view = $view;
    }

	/**
	 * Method that displays a connection
	 * @param request
	 * @param response
	 * @param args
	 */
	public function displayConnection($request, $response, $args) {
		return $this->view->render($response, 'ConnexionView.html.twig');
	}

	/**
	 * Method that displays a form for account creation
	 * @param request
	 * @param response
	 * @param args
	 */
	public function createAccount($request, $response, $args) {
		return $this->view->render($response, 'CreateAccountView.html.twig', []);
	}

	/**
	 * Method that creates a player
	 * @param pseudoPlayer
	 * @param passwordPlayer
	 * @param emailPlayer
	 */
	public static function createPlayer($pseudoPlayer, $passwordPlayer, $emailPlayer){
		$r = new m\Joueur();
		$r->pseudoJoueur = $pseudoPlayer;
		$r->adresseMail = $emailPlayer;
		$r->password = $passwordPlayer;
		$r->save();
	}

	// Method that checks the creating of an account
	public static function checkAccountCreation() {
		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];
		$email = $_POST['email'];
		// Function that allows password hashing
		$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT, ['cost'=>12]);
		self::createPlayer($pseudo, $mdp, $email);
		self::checkTheConnection();
	}

	// Method that checks the connection
	public static function checkTheConnection(){
		$user = User::byMail(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
		if($user){
			if(password_verify($_POST['password'], $user->password)){
				$_SESSION['id'] = $user->id;
				$_SESSION['name'] = $user->name;
			} else {
				$app->flash('error', "L'adresse email ou le mot de passe est invalide");
			}
		} else {
			$app->flash('error', "L'adresse email ou le mot de passe est invalide");
		}
	}

	/**
	 * Method that checks the desctruction of a session
	 * @param request
	 * @param response
	 * @param args
	 */
	public static function checkDestroySession($request, $response, $args) {
		Authentication::destroySession();
	}

	public function displayCreateAccount($request, $response, $args) {
		return $this->view->render($response, 'CreateAccountView.html.twig', []);
    }



}