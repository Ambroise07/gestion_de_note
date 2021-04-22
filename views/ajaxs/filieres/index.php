<?php

use Synext\Helpers\Json;
use Synext\Requests\Http;
use Synext\Models\Spinnerets;
$spinnerets = new Spinnerets();

if(Http::methods('GET')){
    $spinner = $spinnerets->pdo()->select("SELECT * FROM spinnerets WHERE id =:id",false,['id'=>$params['id']]);
    $data = [
        'id' => (int)$spinner->id,
        'code'=> $spinner->code,
        'wording'=> $spinner->wording
    ];
    echo Json::message(false,null,$data);
    exit;
}

if(Http::methods('POST')){
    $data = Http::input();
   if($spinnerets->pdo()->insert("INSERT INTO spinnerets (code,wording) VALUES (:code,:wording)",[
    'code'=>$data['code'],
    'wording'=>$data['wording']  
    ])
    ){
        echo Json::message(false,'La Filière a été ajouté avec success');
        exit;
   };

}

if(Http::methods('PATCH')){
    $data = Http::input();
    $spinnerets->pdo()->update("UPDATE spinnerets SET code = :code, wording = :wording WHERE spinnerets.id = :id",[
        'code'=>$data['code'],
        'wording'=>$data['wording'],
        'id' => $params['id']
    ]);
    echo Json::message(false,'La Filière a été mise à ajout avec success');
    exit;
}

if(Http::methods('DELETE')){
    $spinnerets->pdo()->delete("DELETE FROM spinnerets WHERE id =:id",['id'=>$params['id']]);
    echo Json::message(false,'La Filière a été supprimée avec success');
    exit;
}
?>