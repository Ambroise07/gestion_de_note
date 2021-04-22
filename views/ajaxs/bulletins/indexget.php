<?php
use Synext\Helpers\Json;
use Synext\Models\Students;
use Synext\Requests\Http;
function bulletinGen($matricule){
        $pdo = (new Students)->pdo();
    return  $pdo->select(
        "   SELECT  students.id as studentsId,
        students.matricule as studentsMatricule, 
        students.last_name as studentsLastName,
        students.first_name as studentsFirstName, 
        students.photo as studentsPhoto,
        registereds.year as registeredsYear,
        spinnerets.code as spinneretsCode,
        spinnerets.wording as spinneretsWording,
        matter_spinnerets.coefficient as mattersCoefficient,
        matters.code as mattersCode,
        matters.wording as mattersWording,
        notes.cc1 as notesCc1,
        notes.cc2 as notesCc2,
        notes.exam as notesExam
    FROM students
    JOIN registereds ON registereds.id_student=students.id
    JOIN spinnerets ON registereds.id_spinneret=spinnerets.id
    JOIN matter_spinnerets ON matter_spinnerets.id_spinneret = spinnerets.id
    JOIN matters ON matters.id=matter_spinnerets.id_matter
    JOIN note_students ON note_students.id_student = students.id AND note_students.id_matter =matters.id
    JOIN notes ON notes.id = note_students.id_note
    WHERE students.matricule = $matricule"
    );
}
if (Http::methods('POST')) {
    $data = Http::input();
    $matricule = htmlspecialchars((int)$data['matricule']);
    
    $bulletins = bulletinGen($matricule);
    if (empty($bulletins)) {
        echo Json::message(true, 'Pas de donnée disponible pour ce numero matricule');
        exit;
    } else {
        echo Json::message(false, null,['matricule'=>$matricule]);
        exit;
    }
}
;?>
