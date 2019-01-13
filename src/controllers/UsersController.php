<?php

namespace equipe5\controllers;

use equipe5\models\Entreprise;
use equipe5\models\MOA;
use equipe5\models\User;
use \Slim\Views\Twig as twig;

class UsersController
{

    protected $view;

    /**
     * Constructor of the class HomeController
     * @param view
     */
    public function __construct(twig $view)
    {
        $this->view = $view;
    }

    public function displayUser($request, $response, $args)
    {
        $user = User::where("id","=",$args["id"])->first()->toArray();
        if ($user["account_type"] == 2) {
            $user["detail"] = Entreprise::where("id","=",$args["id"])->first()->toArray();
        }

        if ($user["account_type"] == 3) {
            $user["detail"] = MOA::where("id","=",$args["id"])->first()->toArray();
        }
        if (Authentication::checkConnection() != false) {
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
            $id = $_SESSION['id'];
        } else {
            $email = "";
            $type = 0;
            $id=0;
        }
        return $this->view->render($response, 'UserView.html.twig', [
            'email' => $email,
            'type' => $type,
            'id'=>$id,
            "user"=>$user
        ]);
    }

    public function displayModifUser($request, $response, $args)
    {
        $user = User::where("id","=",$args["id"])->first()->toArray();
        if ($user["account_type"] == 2) {
            $user["detail"] = Entreprise::where("id","=",$args["id"])->first()->toArray();
        }

        if ($user["account_type"] == 3) {
            $user["detail"] = MOA::where("id","=",$args["id"])->first()->toArray();
        }
        if (Authentication::checkConnection() != false) {
            $email = $_SESSION['email'];
            $type = $_SESSION['type'];
            $id = $_SESSION['id'];
        } else {
            $email = "";
            $type = 0;
            $id=0;
        }
        return $this->view->render($response, 'UserModifView.html.twig', [
            'email' => $email,
            'type' => $type,
            'id'=>$id,
            "user"=>$user
        ]);
    }

    public function modifUser($request, $response, $args){
        $user = User::where("id","=",$args["id"])->first();
        $user->nom=$_POST["nom"];
        $user->email=$_POST["email"];
        $user->siret=$_POST["siret"];
        $user->save();

        if ($user->account_type == 2) {
            $entreprise = Entreprise::where("id","=",$args["id"])->first();
            $entreprise->domaine=$_POST["domaine"];
            $entreprise->save();
        }

        if ($user->account_type == 3) {
            $MOA = MOA::where("id","=",$args["id"])->first();
            $MOA->ville=$_POST["ville"];
            $MOA->save();
        }
        
    }
}
