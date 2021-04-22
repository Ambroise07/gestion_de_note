<?php
namespace Synext\Helpers;
class Json{
    public static function message(bool $error = false,string $message=null, array $data = null){
        header('Content-Type: application/json');
        if(is_null($message)){
            return json_encode(['error' =>$error,'data'=>$data]);

        }elseif(is_null($data)){
            return json_encode(['error' =>$error,'message'=>$message]);

        }
        return json_encode(['error' =>$error,'message'=>$message,'data'=>$data]);
    }

}