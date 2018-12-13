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
        return $this->view->render($response, 'BrowseAppelsOffres.twig', ['appels_offres' => AO::all()]);
    }

    public function displayAppelOffrePage($request, $response, $args){
        return $this->view->render($response, 'AppelOffreView.twig', ['appel_offre' => AO::byId($args['id'])]);
    }
}