<?php

use Synext\Helpers\Json;
use Synext\Requests\Http;
use Synext\Models\Matters;
$matters = new Matters();
//spinneret coefficient
//SELECT matters.id,matters.code,matters.wording,spinnerets.wording as spinneret FROM matters JOIN  matter_spinnerets ON matter_spinnerets.id_matter = matters.id JOIN spinnerets ON spinnerets.id = matter_spinnerets.id_spinneret ORDER BY id DESC
if(Http::methods('GET')){
    $matter = $matters->pdo()->select("SELECT matter_spinnerets.coefficient,matters.id,matters.code,matters.wording,spinnerets.wording as spinneret,spinnerets.id as spinneret_id FROM matters JOIN  matter_spinnerets ON matter_spinnerets.id_matter = matters.id JOIN spinnerets ON spinnerets.id = matter_spinnerets.id_spinneret  WHERE matters.id =:id",false,['id'=>$params['id']]);
    $data = [
        'id' => (int)$matter->id,
        'code'=> $matter->code,
        'wording'=> $matter->wording,
        'spinneret'=> $matter->spinneret,
        'spinneret_id'=> $matter->spinneret_id,
        'coefficient' => $matter->coefficient
    ];
    echo Json::message(false,null,$data);
    exit;
}

if(Http::methods('POST')){
    $data = Http::input();
    $matter_last_id = $matters->pdo()->insert("INSERT INTO matters (code,wording) VALUES (:code,:wording)",[
        'code'=>$data['code'],
        'wording'=>$data['wording']  
    ],true);
   if($matter_last_id ){
        $matters->pdo()->insert('INSERT INTO matter_spinnerets (id_matter, id_spinneret,coefficient) VALUES (:id_matter, :id_spinneret,:coefficient)',[
            'id_matter' => $matter_last_id,
            'id_spinneret' => $data['spinneret'],
            'coefficient' => $data['coefficient']
        ]);
        echo Json::message(false,'La Matière a été ajouté avec success');
        exit;
   };

}

if(Http::methods('PATCH')){
    $data = Http::input();
    $matters->pdo()->update("UPDATE matters SET code = :code, wording = :wording WHERE matters.id = :id",[
        'code'=>$data['code'],
        'wording'=>$data['wording'],
        'id' => $params['id']
    ]);
    //id_matter id_spinneret
    $matters->pdo()->update("UPDATE matter_spinnerets SET id_spinneret = :spinneret,coefficient=:coefficient WHERE matter_spinnerets.id_matter = :id",[
        'spinneret'=>$data['spinneret'],
        'coefficient' => $data['coefficient'],
        'id' => $params['id']
    ]);
    echo Json::message(false,'La Matière a été mise à ajout avec success');
    exit;
}

if(Http::methods('DELETE')){
    $matters->pdo()->delete("DELETE FROM matters WHERE id =:id",['id'=>$params['id']]);
    echo Json::message(false,'La Matière a été supprimée avec success');
    exit;
}
?>