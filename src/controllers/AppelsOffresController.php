<?php

namespace equipe5\controllers;

use \Slim\Views\Twig as twig;
use equipe5\models\User as User;
use equipe5\models\Appel_offres as AO;

class AppelsOffresController {

    protected $view;

    public function __construct(twig $view) {
        $this->view = $view;
    }

    public function displayListPage($request, $response, $args){
        if (Authentication::checkConnection()!=false) {
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
         } else {
             $email = "";
             $type = 0;
         }
        return $this->view->render($response, 'BrowseAppelsOffres.twig', [
        'appels_offres' => AO::all(),
        'email' => $email,
        'type' => $type,
        ]);
    }

    public function displayAppelOffrePage($request, $response, $args){
        if (Authentication::checkConnection()!=false) {
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
         } else {
             $email = "";
             $type = 0;
         }
        return $this->view->render($response, 'AppelOffreView.twig', [
            'ao' => AO::byId($args),
            'email' => $email,
            'type' => $type,
            ]);
    }

    public function displayAnswerForm($request, $response, $args){
        if (Authentication::checkConnection()!=false) {
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
         } else {
             $email = "";
             $type = 0;
         }
        return $this->view->render($response, 'ReponseAppelOffre.twig', [
            'ao_id' => $args,
            'email' => $email,
            'type' => $type,
            ]);
    }
}