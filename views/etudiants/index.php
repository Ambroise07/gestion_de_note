<?php 
$css = ['https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css'];
$scriptPath = '../templates/js/';
$scripts = ['https://code.jquery.com/ui/1.12.1/jquery-ui.js',$scriptPath.'etudiants/app.js'];
use Synext\Components\Htmls\Form;
use Synext\Controllers\Students;
use Synext\Helpers\Session;
use Synext\Components\Auths\Auth;
Session::checkSession();
Auth::isConnect($router) ;

$students = (new Students)->getStudients();
// dd($students);
$form = new Form([],[]);
include('form.php');
include('modal.php');?>
<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h6>Ajouter un(e) Etudiant(e)</h6>
                    <?= form($form,'POST','Ajouter','form-students');?>
                </div>
            </div>
        </div>
        <div class="col-9 text-center">
            <table class="table table-striped table-bordered table-hover mt-2">
                <thead class="">
                    <th> Matricule </th>
                    <th> Nom </th>
                    <th> Prenom </th>
                    <th> Addresse </th>
                    <th> Date de naissance </th>
                    <th> Photo </th>
                    <th> Actions </th>
                </thead>
                <tbody id='etudiantTable'>
                    <?php foreach($students as $student):?>
                    <tr>
                        <td><?=$student->matricule;?></td>
                        <td><?=$student->last_name;?></td>
                        <td><?=$student->first_name;?></td>
                        <td><?=$student->address;?></td>
                        <td><?=$student->date_of_birth;?></td>
                        <td><img style="width: 50px;" src="/storages/imgs/<?=$student->photo;?>" class="img-thumnail" alt=""></td>
                        <td>
                            <div class="d-flex justify-content-around">
                                <span data-edit='<?=$student->id;?>' class="edit btn btn-info d-inline-block">Modifier</span>
                                <span data-delete='<?=$student->id;?>' class="delete btn btn-danger d-inline-block">Supprimer</span>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
        <?= modal($form,'POST','update-students','VALIDER'); ?>
    </div>
</div>