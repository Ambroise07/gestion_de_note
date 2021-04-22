<?php
$scriptPath = '../templates/js/';
$scripts = [$scriptPath.'bulletins/app.js'];
use Synext\Helpers\Session;
use Synext\Components\Auths\Auth;
use Synext\Components\Htmls\Form;
Session::checkSession();
Auth::isConnect($router) ;
$form = new Form([],[]);
include('form.php');?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?= form($form,'POST','Génerer le bulletin','form-bulletin')?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container pt-5" id="Bulletin">

</div>