<?php

namespace equipe5\controllers;

/**
 * Class Authentication
 */
class Authentication {

    public static function instantiateSession($user){
      $_SESSION['id'] = $user->id;
      $_SESSION['email'] = $user->email;
      $_SESSION['type'] = $user->account_type;
    }
    
    // Method that checks a connection
    public static function checkConnection(){
      if (isset($_SESSION['email']) && isset($_SESSION['type'])){
        return $_SESSION['type'];
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