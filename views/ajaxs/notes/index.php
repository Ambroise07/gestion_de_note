<?php

use Synext\Helpers\Json;
use Synext\Requests\Http;
use Synext\Models\Notes;
$notes = new Notes();

 
if(Http::methods('GET')){
    $note = $notes->pdo()->select("SELECT notes.id,students.id as studentsId, matters.id as mattersId,notes.cc1,notes.cc2,notes.exam FROM students JOIN note_students ON note_students.id_student = students.id JOIN matters ON matters.id=note_students.id_matter JOIN notes ON notes.id=note_students.id_note WHERE notes.id =:id",false,['id'=>$params['id']]);
    $data = [
        'id' => (int)$note->id,
        'student'=>$note->studentsId,
        'matter'=>$note->mattersId,
        'cc1'=>$note->cc1,
        'cc2'=>$note->cc2,
        'exam'=>$note->exam
    ];
    echo Json::message(false,null,$data);
    exit;
}

if(Http::methods('POST')){
    $data = Http::input();
    $note_last_id = $notes->pdo()->insert("INSERT INTO notes (cc1,cc2,exam) VALUES (:cc1,:cc2,:exam)",[ 
        'cc1'=>$data['cc1'],
        'cc2'=>$data['cc2'],
        'exam'=>$data['exam']
    ],true);
   if($note_last_id ){
        $notes->pdo()->insert('INSERT INTO note_students (id_student,id_matter,id_note) VALUES (:id_student,:id_matter,:id_note)',[
            'id_student' => $data['student'],
            'id_matter' => $data['matter'],
            'id_note' => $note_last_id
        ]);
        echo Json::message(false,'Les notes ont été ajoutés avec success');
        exit;
   };

}

if(Http::methods('PATCH')){
    $data = Http::input();
    $notes->pdo()->update("UPDATE notes SET cc1 = :cc1, cc2 = :cc2,exam =:exam WHERE notes.id = :id",[
        'cc1'=>$data['cc1'],
        'cc2'=>$data['cc2'],
        'exam'=>$data['exam'],
        'id' => $params['id']
    ]);

    $notes->pdo()->update("UPDATE note_students SET id_student = :id_student, id_matter = :id_matter WHERE note_students.id_note = :id",[
        'id_student' => $data['student'],
        'id_matter' => $data['matter'],
        'id' => $params['id']
    ]);
    echo Json::message(false,'Les notes ont été  mises à ajout avec success');
    exit;
}

if(Http::methods('DELETE')){
    $notes->pdo()->delete("DELETE FROM notes WHERE id =:id",['id'=>$params['id']]);
    echo Json::message(false,'Les notes ont été  supprimées avec success');
    exit;
}
?>