<?php
use Synext\Requests\Http;
use Synext\Models\Notes;
//SELECT matters.id,matters.code,matters.wording,spinnerets.wording as spinneret FROM matters JOIN  matter_spinnerets ON matter_spinnerets.id_matter = matters.id JOIN spinnerets ON spinnerets.id = matter_spinnerets.id_spinneret ORDER BY id DESC
if(Http::methods('GET')){
    $notes = (new Notes)->pdo()->select("SELECT notes.id,students.last_name, students.first_name,matters.wording,notes.cc1,notes.cc2,notes.exam FROM students JOIN note_students ON note_students.id_student = students.id JOIN matters ON matters.id=note_students.id_matter JOIN notes ON notes.id=note_students.id_note ORDER BY id DESC");
    $html = '';
    $i = 0;
    foreach($notes as $note){
        $i++;
       $html .= <<<HTML
        <tr>
            <th>$note->last_name $note->first_name</th>
            <th>$note->wording</th>
            <th><span>CC1</span> $note->cc1</th>
            <th><span>CC2</span> $note->cc2</th>
            <th><span>EXAM</span> $note->exam</th>
            <th>
                <div class="d-flex justify-content-around">
                    <span data-edit='{$note->id}' class="edit btn btn-info d-inline-block">Modifier</span>
                    <span data-delete='{$note->id}' class="delete btn btn-danger d-inline-block">Supprimer</span>
                </div>
            </th>
        </tr>
HTML;
    }
echo $html;
    exit;
}
?>