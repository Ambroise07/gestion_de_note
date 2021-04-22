<?php 
namespace Synext\Requests;

class Http{
    public static function  methods(string $request_method): bool{
        if($_SERVER['REQUEST_METHOD'] === $request_method){
            return true;
        }
        return false;
    }
    public static function input(){
        return json_decode(file_get_contents('php://input'), true);
    }
    public static function _header(string $status_code){

    }
}