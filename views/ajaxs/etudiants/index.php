<?php

use Synext\Helpers\Json;
use Synext\Helpers\Session;
use Synext\Requests\Http;
use Synext\Models\Students;
$students = new Students();

if(Http::methods('GET')){
    $etudiant = $students->pdo()->select("SELECT * FROM students WHERE id =:id",false,['id'=>$params['id']]);
    $data = [
        'id' => (int)$etudiant->id,
        'matricule' => (int)$etudiant->matricule,
        'last_name'=> $etudiant->last_name,
        'first_name'=> $etudiant->first_name,
        'address'=> $etudiant->address,
        'date_of_birth'=> $etudiant->date_of_birth,
        'photo'=> $etudiant->photo,
    ];
    echo Json::message(false,null,$data);
    exit;
}

if(Http::methods('POST')){
    Session::checkSession();
    if(!isset($_SESSION['image'])){
        echo Json::message(true,'Vous devez mettre une photo');
        exit;
    }
    $data = Http::input();
    $matricule = htmlspecialchars($data['matricule']);
    $last_name = htmlspecialchars($data['last_name']);
    $first_name = htmlspecialchars($data['first_name']);
    $address = htmlspecialchars($data['address']);
    $date_of_birth = htmlspecialchars($data['date_of_birth']);

    $photo = $_SESSION['image'];
    unset($_SESSION['image']);
    $matricule_exit = $students->pdo()->select('SELECT matricule FROM students WHERE matricule=:matricule',false,['matricule'=>$matricule]);
    if(!$matricule_exit){
        if($students->pdo()->insert("INSERT INTO students (matricule,last_name,first_name,date_of_birth,address,photo) VALUES (:matricule,:last_name,:first_name,:date_of_birth,:address,:photo)",[
                'matricule'=> $matricule,
                'last_name'=> $last_name,
                'first_name'=> $first_name,
                'address'=> $address,
                'date_of_birth'=> $date_of_birth,
                'photo'=> $photo
            ])
            ){  $path = dirname(__DIR__,3).'/public_html/storages/imgs/';
                echo Json::message(false,'Etudiant Ajouter avec success');
                exit;
        };
    }else{
        echo Json::message(true,'error');
        exit;
    }


}

if(Http::methods('PATCH')){
    $data = Http::input();
    $students->pdo()->update("UPDATE students SET matricule = :matricule, last_name = :last_name,first_name = :first_name,address = :address,date_of_birth = :date_of_birth WHERE students.id = :id",[
        'matricule' => (int) $data['matricule'],
        'last_name'=>  $data['last_name'],
        'first_name'=>  $data['first_name'],
        'address'=>  $data['address'],
        'date_of_birth'=>  $data['date_of_birth'],
        //'photo'=> $etudiant->photo,
        'id' => $params['id']
    ]);
    echo Json::message(false,'Les données de l\'etudiant ont été mise à jour avec success');
    exit;
}

if(Http::methods('DELETE')){
    $etudiant_photo = $students->pdo()->select("SELECT photo FROM students WHERE id =:id",false,['id'=>$params['id']])->photo;
    $students->pdo()->delete("DELETE FROM students WHERE id =:id",['id'=>$params['id']]);
    $path = dirname(__DIR__,3).'/public_html/storages/imgs/'.$etudiant_photo;
    unlink($path);
    echo Json::message(false,'Etudiant Supprimer avec success');
    exit;
}
?>