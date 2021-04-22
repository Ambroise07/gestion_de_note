<?php 
namespace Synext\Helpers;
class Redirect{
    public static function to(string $url){
        header('Location: '.$url);
        exit;
    }

    public static function To404(){
        http_response_code(404);
        self::To('/404');
    }
}