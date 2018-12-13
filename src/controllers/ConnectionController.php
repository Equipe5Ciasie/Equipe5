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
		$user = new m\User();
		$user->email = $email;
		$user->nom = $nom;
		$user->siret = $siret;
		$user->password = $mdp;
		$user->account_type = $type;
		$user->save();
		return $user->id;
	}
	public static function createEntreprise($id, $domaine){
		$entreprise = new m\Entreprise();
		$entreprise->id = $id;
		$entreprise->domaine = $domaine;
		$entreprise->save();
	}
	public static function createMOA($id, $ville){
		$MOA = new m\MOA();
		$MOA->id = $id;
		$MOA->ville = $ville;
		$MOA->save();
	}

	// Method that checks the creating of an account
	public static function checkAccountCreation() {
		
		$mdp = $_POST['password'];
		$email = $_POST['email'];
		$type = $_POST['type'];
		$siret= $_POST['siret'];
		$nom = $_POST['nom'];

		// Function that allows password hashing
		$mdp = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$id=self::createUser( $mdp, $email,$type,$siret,$nom);
		if($type==2){
			self::createEntreprise( $id, $_POST['domaine']);
		}
		else{
			self::createMOA( $id, $_POST['ville']);
		}
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