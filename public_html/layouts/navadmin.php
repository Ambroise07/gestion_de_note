<?php 
use Synext\Helpers\Html;
?>
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <?= Html::navbaractive('Etudiant ', $router->url('etudiantManagment'), 'align-center'); ?>
            <?= Html::navbaractive('Inscription', $router->url('inscriptionManagment'), 'users'); ?>
            <?= Html::navbaractive('Filière ', $router->url('filiereManagment'), 'layers'); ?>
            <?= Html::navbaractive('Matière ', $router->url('matiereManagment'), 'layers'); ?>
            <?= Html::navbaractive('Notes ', $router->url('noteManagment'), 'book-open'); ?>
            <?= Html::navbaractive('Bulletin ', $router->url('bulletinManagment'), 'book-open'); ?>
        </ul>
    </div>
</nav>