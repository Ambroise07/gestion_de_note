<?php
use Synext\Helpers\Json;
use Synext\Models\Students;
use Synext\Requests\Http;
if (Http::methods('POST')) {
    $data = Http::input();
    $matricule = htmlspecialchars($data['matricule']);
    $bulletin_de_note = [];
    $pdo = (new Students)->pdo();
    $bulletins = $pdo->select(
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
    if(empty($bulletins)){
        echo Json::message(true,'Le numero matricule ne correspont à aucun éléve');
        exit;
    }else{
        foreach($bulletins as $bulletin){
        $bulletin_de_note['nom'] = $bulletin->studentsLastName;
        $bulletin_de_note['prenom'] = $bulletin->studentsFirstName;
        $bulletin_de_note['matricule'] = $bulletin->studentsMatricule;
        $bulletin_de_note['photo'] = $bulletin->studentsPhoto;
        $bulletin_de_note['annee'] = $bulletin->registeredsYear;
        $bulletin_de_note['code_filiere'] = $bulletin->spinneretsCode;
        $bulletin_de_note['nom_filiere'] = $bulletin->spinneretsWording;
        $bulletin_de_note['data']['code_matiere'][] = $bulletin->mattersCode;
        $bulletin_de_note['data']['nom_matiere'][] = $bulletin->mattersWording;
        $bulletin_de_note['data']['coef_matiere'][] = $bulletin->mattersCoefficient;
        $bulletin_de_note['data']['note']['cc1'][] = $bulletin->notesCc1;
        $bulletin_de_note['data']['note']['cc2'][] = $bulletin->notesCc2;
        $bulletin_de_note['data']['note']['exam'][] = $bulletin->notesExam;

        
        }
        $name = $bulletin_de_note['nom'].' '.  $bulletin_de_note['prenom'];
        $MCC = [];
        $mexam = [];
        $noteexam = [];
        $mcoef = [];
        foreach($bulletin_de_note['data']['code_matiere'] as $k => $v) {
            $MCC[] = ($bulletin_de_note['data']['note']['cc1'][$k] + $bulletin_de_note['data']['note']['cc2'][$k])/2;
            $MMat[] = ($MCC[$k] + $bulletin_de_note['data']['note']['exam'][$k])/2; 
            $mcoef[] = ($MMat[$k] * $bulletin_de_note['data']['coef_matiere'][$k]);
        }
        $cccc = array_sum($bulletin_de_note['data']['coef_matiere']);
        $eeee = array_sum($bulletin_de_note['data']['note']['exam']);
        $MCC1 = array_sum($MCC);
        $MMat1 = array_sum($MMat);
        $mcoef1 =array_sum($mcoef);
        $mt = number_format($mcoef1 / array_sum($bulletin_de_note['data']['coef_matiere']),2);
        $htmlg = "";
        foreach($bulletin_de_note['data']['code_matiere'] as $k =>$v){
            $htmlg .= <<<HTML
                <tr>
                    <td>{$v}</td>
                    <td colspan="2 "> {$bulletin_de_note['data']['nom_matiere'][$k]}</td>
                    <td> Semestre {$bulletin_de_note['annee']}</td>
                    <td> {$bulletin_de_note['data']['coef_matiere'][$k]}</td>
                    <td> {$MCC[$k]}</td>
                    <td> {$bulletin_de_note['data']['note']['exam'][$k]}</td>
                    <td> {$MMat[$k]}</td>
                    <td> {$mcoef[$k]} </td>
                </tr>
HTML;
            }

$html = "";
$html .= <<<HTML
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 text-left text-center">
                                    <img class="img-fluid w-50  img-thumbnail" src="/storages/imgs/{$bulletin_de_note['photo']}" alt="">
                                </div>
                                <div class="col-sm-8 text-right">
                                    <h5 class="text-left"><strong >Matricule : </strong> {$bulletin_de_note['matricule']}</h5>
                                    <h5 class="text-left"><strong >Nom & Prénom : </strong>{$name}</h5>
                                    <h5 class="text-left"><strong >Filière : </strong>{$bulletin_de_note['nom_filiere']}</h5>
                                    <h5 class="text-left"><strong >Année Académique  : </strong>{$bulletin_de_note['annee']}</h5>
                                </div>
                                <div class="col-12 pt-3 text-center">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <td colspan="3"><strong>Cours</strong> </td>
                                                <td rowspan="2" class="pt-5"> <strong>Semestre</strong></td>
                                                <td rowspan="2" class="pt-5"><strong>Coefficient</strong> </td>
                                                <td colspan=" 4 "> <strong>Notes</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Code</strong> </td>
                                                <td colspan="2 "><strong>Nom</strong> </td>
                                                <td> <strong>Moy CC </strong></td>
                                                <td><strong> Moy Exam</strong></td>
                                                <td><strong> Moy Matière</strong></td>
                                                <td><strong> Moy Coef</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
HTML; 
$html .= $htmlg ;                                       

    $html .= <<<HTML
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4 " class="text-left"><strong>Total</strong></td>
                                                <td> {$cccc}</td>
                                                <td> $MCC1 </td>
                                                <td > {$eeee}</td>
                                                <td >{$MMat1} </td>
                                                <td > {$mcoef1}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5 " class="text-left"><strong>Moyenne Générale</strong></td>
                                                <td colspan="4 ">{ $mt} </td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
HTML;
echo $html;
    }
}

;?>