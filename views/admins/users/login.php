<?php

use Synext\Controllers\UserControllers;
$userController = (new UserControllers)->login($router,$_POST);
[$errors_login,$form,$message]= $userController;
?>
<div class="container pt-2">
    <div class="row">
        <div class="col-12">
            <h2 class="text-left">Espace de Connexion </h2>
            <?php if($errors_login):?>
                <div class="alert alert-danger"><?=$message?></div>
            <?php endif;?>
            <div class="card mt-3 mb-2">
                <div class="card-body">
                        <form action="" method="post">
                            <?=$form->input('email','Votre adresse mail','email');?>
                            <?=$form->input('password','Votre mot de passe ','password');?>
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>