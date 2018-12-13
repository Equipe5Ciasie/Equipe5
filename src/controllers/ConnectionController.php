<?php

namespace equipe5\controllers;

use equipe5\models as m;
use equipe5\controllers\Authentication;
use \Slim\Views\Twig as twig;
use equipe5\views\ConnexionView;
use equipe5\views\CreateAccountView;
use equipe5\models\User;

/**
 * Class ConnectionController
 */
class ConnectionController {

	protected $view, $flash;

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
		$flash = [];
		if(isset($_SESSION['slim.flash']['error'])){
			$flash = $_SESSION['slim.flash']['error'];
		}
		return $this->view->render($response, 'ConnexionView.html.twig', ['error' => $flash]);
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
	 * Method that creates a User
	 * @param em$emailUser
	 * @param passwordUser
	 * @param emailUser
	 */
	public static function createUser($mdp, $email,$type,$siret,$nom){
		$r = new m\User();
		$r->email = $email;
		$r->password = $mdp;
		$r->account_type = $type;
		$r->save();
	}

	// Method that checks the creating of an account
	public static function checkAccountCreation() {
		
		$mdp = $_POST['password'];
		$email = $_POST['email'];
		$type = $_POST['type'];
		$siret= $_POST['siret'];
		$nom = $_POST['nom'];
		$adresse = $_POST['adresse'];

		var_dump($mdp,$email,$type,$siret,$nom,$adresse);

		// Function that allows password hashing
		$mdp = password_hash($_POST['password'], PASSWORD_BCRYPT);
		self::createUser( $mdp, $email,$type,$siret,$nom);
		self::checkTheConnection();
	}

	// Method that checks the connection
	public static function checkTheConnection(){
		$user = User::byMail(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
		if ($user) {
			if (password_verify($_POST['password'], $user->password)) {
				Authentication::instantiateSession($user);
				return true;
			} else {
				return false;
			}
		} else {	
			return false;
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