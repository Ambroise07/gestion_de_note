<?php

use Synext\Helpers\Json;
use Synext\Requests\Http;
use Synext\Models\Matters;
$matters = new Matters();
//SELECT students.last_name,students.first_name,spinnerets.wording,registereds.id,registereds.year FROM students JOIN registereds ON registereds.id_student = students.id JOIN spinnerets ON spinnerets.id = registereds.id_spinneret WHERE registereds.id =:id";
if(Http::methods('GET')){
    $registered = $matters->pdo()->select("SELECT students.id as students_id,spinnerets.id as spinnerets_id ,registereds.id FROM students JOIN registereds ON registereds.id_student = students.id JOIN spinnerets ON spinnerets.id = registereds.id_spinneret WHERE registereds.id =:id",false,['id'=>$params['id']]);
    $data = [
        'id' => (int)$registered->id,
        'spinneret'=> $registered->spinnerets_id,
        'student'=> $registered->students_id
    ];
    echo Json::message(false,null,$data);
    exit;
}

if(Http::methods('POST')){
    $data = Http::input();
    // INSERT INTO `registereds` (`id_student`, `id_spinneret`, `year`) VALUES (:id_student, :id_spinneret, :year)
    //SELECT * FROM registereds WHERE id_student = :id_student, AND id_spinneret = :id_spinneret
    $registerExist = $matters->pdo()->select("SELECT * FROM registereds WHERE id_student = :id_student AND id_spinneret = :id_spinneret",false,[
        'id_student'=>$data['student'],
        'id_spinneret'=>$data['spinneret'] 
    ]);
    $registerExistYear = $matters->pdo()->select("SELECT * FROM registereds WHERE id_student = :id_student AND year = :year",false,[
        'id_student'=>$data['student'],
        'year'=> date("Y") 
    ]);
    if(is_object($registerExist) || is_object($registerExistYear)){
        echo Json::message(true,'Vous ne pouvez pas réinscrit l\'étudiant ');
        exit;
    }else{
        if($matters->pdo()->insert("INSERT INTO `registereds` (`id_student`, `id_spinneret`, `year`) VALUES (:id_student, :id_spinneret, :year)",[
            'id_student'=>$data['student'],
            'id_spinneret'=>$data['spinneret'] , 
            'year'=> date('Y')
        ])
        ){
            echo Json::message(false,'Un étudiant inscrit avec succèss');
            exit;
        };
    }


}

if(Http::methods('PATCH')){
    $data = Http::input();
    $matters->pdo()->update("UPDATE registereds SET id_student = :id_student, id_spinneret = :id_spinneret WHERE registereds.id = :id",[
        'id_student'=>$data['student'],
        'id_spinneret'=>$data['spinneret'],
        'id' => $params['id']
    ]);
    echo Json::message(false,'L\'inscription de l\'étudiant a été mise à ajout avec success');
    exit;
}

if(Http::methods('DELETE')){
    $matters->pdo()->delete("DELETE FROM registereds  WHERE id =:id",['id'=>$params['id']]);
    echo Json::message(false,'L\'inscription de l\'étudiant a été supprimé');
    exit;
}
?>