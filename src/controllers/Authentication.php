<?php

namespace equipe5\controllers;

/**
 * Class Authentication
 */
class Authentication {

    /**
     * Method that instantiates a session
     * @param idPlayer
     * @param pseudoPlayer
     */ 
    public static function instantiateSession($user){
      $_SESSION['id'] = $user->id;
      $_SESSION['email'] = $user->email;
    }
    
    // Method that checks a connection
    public static function checkConnection(){
      if (isset($_SESSION['idPlayer'])){
        return true;
      }
      else{
        return false;
      }
    }

    // Method that destroys a session
    public static function destroySession(){
      session_destroy();
    }

}