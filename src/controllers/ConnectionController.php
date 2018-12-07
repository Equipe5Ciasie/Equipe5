<?php

namespace trivial\controllers;

use trivial\models as m;
use trivial\controllers\Authentication;
use \Slim\Views\Twig as twig;
use trivial\views\ConnexionView;
use trivial\views\CreateAccountView;

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
		if (Authentication::checkConnection()) {
			$pseudo = "Bienvenue ".$_SESSION['pseudoPlayer'];
		}
		else {
			$pseudo = "";
		}
		return $this->view->render($response, 'ConnexionView.html.twig', [
			'pseudo' => $pseudo,
		]);
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
		$email = $_POST['email'];
		$mdp = $_POST['mdp'];
		$nb = m\Joueur::where('adresseMail', '=', $email);
		if ($nb->count() != 1) {
			echo "Email invalide" ;
		}
		else {	
			if (password_verify($mdp, $nb->first()->password)) {
				$nb = $nb->first();
				Authentication::instantiateSession($nb->idJoueur, $nb->pseudoJoueur);
			}
			else {
				echo "Mot de passe invalide";
			}
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

}