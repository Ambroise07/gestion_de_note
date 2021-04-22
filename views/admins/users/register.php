<?php

use Synext\Controllers\UserControllers;

$register = (new UserControllers)->register($router);
$errors_register = $register[0];
$create_account = $register[1];
$form = $register[2];
$message = $register[3];
?>
<div class="container pt-2">
    <div class="row">

        <div class="col-12">
            <h2 class="text-left">Espace d'inscription </h2>
            <?php if($errors_register):?>
                <div class="alert alert-danger"><?=$message;?></div>
            <?php endif;?>
            <?php if($create_account):?>
                <div class="alert alert-success">Votre compte a été crée avec succès ! </div>
            <?php endif;?>
            <div class="card mt-3 mb-2">
                <div class="card-body">
                        <form action="" method="post">
                            <?=$form->input('username','Nom utilisateur');?>
                            <?=$form->input('email','Votre adresse mail','email');?>
                            <?=$form->input('password','Mot de passe ','password');?>
                            <!-- <? //= $form->checkbox('terms-conditions','I agree the terms and conditions ')?> -->
                            <button type="submit" class="btn btn-primary">S'inscrit</button>
                        </form>
                </div>
            </div>
        </div>

    </div>
</div>