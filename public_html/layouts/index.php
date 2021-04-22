<?php
 ?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title> App Gestion Etudiant</title>
        <!---Meta contents-->
        <link rel="stylesheet" href="../templates/css/bootstrap.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="../templates/css/admin.css">
        <link rel="stylesheet" href="../templates/fonts/font-awesome.min.css">
        <?php if(isset($css)):?>
        <?php foreach($css as $cs) :?>
            <link rel="stylesheet" href="<?=$cs;?>">
        <?php endforeach;?>
        <?php endif;?>
        <link rel="shortcut icon" href="../templates/imgs/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">GESTION NOTES</a>
            <input class="form-control form-control-dark w-100" type="text" placeholder="Chercher un(e) étudiant(e)" aria-label="Search">
            <ul class="navbar-nav px-3">
                <li class="nav-item text-nowrap">
                    <a class="nav-link btn-danger btn p-2 text-white" href="/deconnection">Se Déconnter</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <?php require 'navadmin.php'; ?>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                    <?= $contents ?? 'Invalide'; ?>
                </main>
            </div>
        </div>
        <!--End Site footer-->
        <script src="../templates/js/jquery.min.js"></script>
        <script src="../templates/js/popper.min.js"></script>
        <script src="../templates/js/bootstrap.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <?php if(isset($scripts)):?>
            <?php foreach($scripts as $script) :?>
                <script src='<?=$script?>'></script>
            <?php endforeach;?>
        <?php endif;?>
        <script src="../templates/js/app.js"></script>
    </body>

</html>