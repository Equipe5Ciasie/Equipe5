<?php

namespace equipe5\controllers;

use \Slim\Views\Twig as twig;
use equipe5\models\User as User;
use equipe5\models\Appel_offres as AO;
use equipe5\models\Reponse as Reponse;

class AppelsOffresController {

    protected $view;

    public function __construct(twig $view) {
        $this->view = $view;
    }

    public function displayListPage($request, $response, $args){
        if (Authentication::checkConnection() != false) {
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
            $id = $_SESSION['id'];
        } else {
            $email = "";
            $type = 0;
            $id=0;
        }
        return $this->view->render($response, 'BrowseAppelsOffres.twig', [
        'appels_offres' => AO::all(),
        'email' => $email,
        'id'=>$id,
        'type' => $type,
        ]);
    }

    public function displayAppelOffrePage($request, $response, $args){
        if (Authentication::checkConnection() != false) {
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
            $id = $_SESSION['id'];
        } else {
            $email = "";
            $type = 0;
            $id=0;
        }
        return $this->view->render($response, 'AppelOffreView.twig', [
            'ao' => AO::byId($args),
            'email' => $email,
            "id"=>$id,
            'type' => $type,
            ]);
    }

    public function displayCreateAppelOffre($request, $response, $args){
        if (Authentication::checkConnection() != false) {
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
            $id = $_SESSION['id'];
        } else {
            $email = "";
            $type = 0;
            $id=0;
        }
        return $this->view->render($response, 'CreateAppelOffreView.twig', [
            'email' => $email,
            'type' => $type,
            "id"=>$id,
            ]);
    }
    public static function createAppelOffre($request, $response, $args){
		$AppelOffre = new AO();
        $AppelOffre->titre =  $_POST['titre'];
        $AppelOffre->description=  $_POST['description'];
        $AppelOffre->contenu=  $_POST['contenu'];
        $AppelOffre->user_id=  $_SESSION['id'];
		$AppelOffre->save();
    }
    
    
    public function displayVosOffres($request, $response, $args) {
        return $this->view->render($response, 'HomeOffre.html.twig', [
            'appels_offres' => AO::where('user_id','=',$_SESSION["id"])->get()->toArray(),
            'email' => $_SESSION['email'],
            'type' => $_SESSION['type'],
            "id"=>$_SESSION['id'],
        ]);
        }
    
    public function displayAnswerForm($request, $response, $args){
        if (Authentication::checkConnection() != false) {
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
            $id = $_SESSION['id'];
        } else {
            $email = "";
            $type = 0;
            $id=0;
        }
        return $this->view->render($response, 'ReponseAppelOffre.twig', [
            'ao_id' => $args,
            'email' => $email,
            'type' => $type,
            "id"=>$id
            ]);
    }

    public function postResponse($id_appel){
        if(!empty($_POST['contenu'])){
            $rep = new Reponse();
          
        }
    }
}