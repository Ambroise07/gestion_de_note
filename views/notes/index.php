<?php
$scriptPath = '../templates/js/';
$scripts = [$scriptPath.'notes/app.js'];
use Synext\Controllers\Students;
use Synext\Controllers\Matters;
use Synext\Components\Htmls\Form;
use Synext\Controllers\Notes;
use Synext\Helpers\Session;
use Synext\Components\Auths\Auth;
Session::checkSession();
Auth::isConnect($router) ;
//SELECT students.last_name, students.first_name,matters.wording,notes.cc1,notes.cc2,notes.exam FROM students JOIN note_students ON note_students.id_student = students.id JOIN matters ON matters.id=note_students.id_matter JOIN notes ON notes.id=note_students.id_note
$students = (new Students)->allStudientsWithName();
$matters = (new Matters)->getMatters();
$notes  = (new Notes)->getNotes('sql');
//dd($notes);
$form = new Form([],[]);
include('form.php');
include('modal.php');
;?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5>Gestion des notes des etudiants</h5>
                    <?= form($form,'POST','AJOUTER','form-note',$students,$matters);?>
                </div>
            </div>
        </div>
        <div class="col-8 text-center">
            <table class="table table-striped table-bordered table-hover mt-2">
                <thead class="table-dark">
                    <th> Etudiant </th>
                    <th> Matière </th>
                    <th colspan="3"> Note </th>
                    <th> Actions </th>
                </thead>
                <tbody id="noteTable">
                    <?php foreach($notes as $note):?>
                        <tr>
                            <th><?=$note->last_name.' '.$note->first_name;?></th>
                            <th><?=$note->wording;?></th>
                            <th><span>CC1</span> <?=$note->cc1;?></th>
                            <th><span>CC2</span> <?=$note->cc2;?></th>
                            <th><span>EXAM</span> <?=$note->exam;?></th>
                            <th>
                                <div class="d-flex justify-content-around">
                                    <span data-edit='<?=$note->id;?>' class="edit btn btn-info d-inline-block">Modifier</span>
                                    <span data-delete='<?=$note->id;?>' class="delete btn btn-danger d-inline-block">Supprimer</span>
                                </div>
                            </th>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?= modal($form,'POST','update-note','VALIDER',$students,$matters); ?>
    </div>
</div>