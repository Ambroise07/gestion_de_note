<?php 
$scriptPath = '../templates/js/';
$scripts = [$scriptPath.'filieres/app.js'];
use Synext\Components\Htmls\Form;
use Synext\Controllers\Spinnerets;
use Synext\Helpers\Session;
use Synext\Components\Auths\Auth;
Session::checkSession();
Auth::isConnect($router) ;
$spinnerets = (new Spinnerets)->getSpinnerets();
$form = new Form([],[]);
include('form.php');
include('modal.php');?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h3>Ajouter une Filière</h3>
                    <?= form($form,'POST','AJOUTER','form-spinnerets')?>
                </div>
            </div>
        </div>
        <div class="col-6 text-center">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover mt-4 ">
                        <thead class="">
                            <th> Code </th>
                            <th> Nom </th>
                            <th> Actions </th>
                        </thead>
                        <tbody id='spinneretTable'>
                        <?php foreach($spinnerets as $spinneret):?>
                            <tr>
                                <th><?=$spinneret->code;?></th>
                                <th><?=$spinneret->wording;?></th>
                                <th>
                                    <div class="d-flex justify-content-around">
                                        <span data-edit='<?=$spinneret->id;?>' class="edit btn btn-info d-inline-block">Modifier</span>
                                        <span data-delete='<?=$spinneret->id;?>'
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
        <?= modal($form,'POST','update-spinneret','VALIDER'); ?>
    </div>
</div>