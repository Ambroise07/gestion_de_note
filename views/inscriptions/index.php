<?php
$scriptPath = '../templates/js/';
$scripts = [$scriptPath.'inscriptions/app.js'];
use Synext\Models\Spinnerets;
use Synext\Controllers\Students;
use Synext\Components\Htmls\Form;
use Synext\Helpers\Session;
use Synext\Components\Auths\Auth;
Session::checkSession();
Auth::isConnect($router) ;
//SELECT * FROM registereds WHERE id_student = 17 AND id_spinneret = 5
// $rt =  (new Spinnerets)->pdo()->select("SELECT * FROM registereds WHERE id_student = 17 AND id_spinneret = 55;" ,false);
// dd(($rt));
$spinnerets = (new Spinnerets)->findAllIdWithName('spinnerets');
$students = (new Students)->allStudientsWithName();
$inscrits =  (new Spinnerets)->pdo()->select("SELECT students.last_name,students.first_name,spinnerets.wording,registereds.id,registereds.year FROM students JOIN registereds ON registereds.id_student = students.id JOIN spinnerets ON spinnerets.id = registereds.id_spinneret;");
$form = new Form([],[]);
include('form.php');
include('modal.php');
;?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4>Inscription des etudiants</h4>
                    <?= form($form,'POST','INSCRIR','inscription-forms',$spinnerets,$students);?>
                </div>
            </div>
        </div>
        <div class="col-8 text-center">
            <table class="table table-striped table-bordered table-hover mt-2">
                <thead class="table-dark">
                    <th> Etudiant </th>
                    <th> Filière </th>
                    <th> Année Acd </th>
                    <th> Actions </th>
                </thead>
                <tbody id="inscriptionTable">
                    <?php foreach($inscrits as $inscrit):?>
                    <tr>
                        <th><?=$inscrit->last_name .'  '. $inscrit->first_name;?></th>
                        <th><?=$inscrit->wording;?></th>
                        <th><?=$inscrit->year;?></th>
                        <th>
                            <div class="d-flex justify-content-around">
                                <span data-edit='<?=$inscrit->id;?>' class="edit btn btn-info d-inline-block">Modifier</span>
                                <span data-delete='<?=$inscrit->id;?>' class="delete btn btn-danger d-inline-block">Supprimer</span>
                            </div>
                        </th>
                    </tr>
                    <?php endforeach;?>
                </tbody>

            </table>
        </div>
        <?= modal($form,'POST','update-inscriptions','VALIDER',$spinnerets,$students); ?>
    </div>
</div>