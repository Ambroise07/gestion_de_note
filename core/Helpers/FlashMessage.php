<?php 
namespace Synext\Helpers;

class FlashMessage{

    public static function success(string $message){
        Session::checkSession();
        $_SESSION['flash']['succes'] = $message;
    }

    public static function erreur(string $message){
        Session::checkSession();
        $_SESSION['flash']['error'] = $message;
    }
}