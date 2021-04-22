<?php 
$scriptPath = '../templates/js/';
$scripts = [$scriptPath.'matieres/app.js'];
use Synext\Models\Spinnerets;
use Synext\Controllers\Matters;
use Synext\Components\Htmls\Form;
use Synext\Helpers\Session;
use Synext\Components\Auths\Auth;
Session::checkSession();
Auth::isConnect($router) ;
$matters = (new Matters)->getMatters('sql');
$spinnerets = (new Spinnerets)->findAllIdWithName('spinnerets');
$form = new Form([],[]);
include('form.php');
include('modal.php');?>

<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h3>Ajouter une Matière</h3>
                    <?= form($form,'POST','AJOUTER','form-matters',$spinnerets)?>
                </div>
            </div>
        </div>
        <div class="col-8 text-center">
            <div class="card">
                <div class="card-body">
                <h3>Liste des matières Ajoutées</h3>
                    <table class="table table-striped table-bordered table-hover mt-2 ">
                        <thead class="table-dark">
                            <th> Code Matière</th>
                            <th> Nom Matière</th>
                            <th> Filière</th>
                            <th> Coefficient</th>
                            <th> Actions </th>
                        </thead>
                        <tbody id='matterTable'>
                        <?php foreach($matters as $matter):?>
                            <tr>
                                <th><?=$matter->code;?></th>
                                <th><?=$matter->wording;?></th>
                                <th><?=$matter->spinneret;?></th>
                                <th><?=$matter->coefficient;?></th>
                                <th>
                                    <div class="d-flex justify-content-around">
                                        <span data-edit='<?=$matter->id;?>' class="edit btn btn-info d-inline-block">Modifier</span>
                                        <span data-delete='<?=$matter->id;?>'
                                            class="delete btn btn-danger d-inline-block">Supprimer</span>
                                    </div>
                                </th>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?= modal($form,'POST','update-matter','VALIDER',$spinnerets); ?>
    </div>
</div>