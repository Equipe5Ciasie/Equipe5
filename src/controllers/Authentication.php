<?php

namespace trivial\controllers;

/**
 * Class Authentication
 */
class Authentication {

    /**
     * Method that instantiates a session
     * @param idPlayer
     * @param pseudoPlayer
     */ 
    public static function instantiateSession($idPlayer, $pseudoPlayer){
      $_SESSION['idPlayer'] = $idPlayer;
      $_SESSION['pseudoPlayer'] = $pseudoPlayer;
      $_SESSION['role'] = 1;
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