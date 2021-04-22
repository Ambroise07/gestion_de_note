<?php

use Synext\Routers\Router;
define('DEBUG_TIME', microtime(true));
require '../vendor/autoload.php';
/** Error handler */
(new \Whoops\Run())->pushHandler(new \Whoops\Handler\PrettyPageHandler())->register();
//(new DatabaseManager);
/**public folder */
$public_paths = DIRECTORY_SEPARATOR.basename($_SERVER['DOCUMENT_ROOT']);
/** global views paths */
$view_paths = DIRECTORY_SEPARATOR.dirname($_SERVER['DOCUMENT_ROOT']).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR;

//Router start
$router = new Router($view_paths,$public_paths);
$router
    //ADMIN PANEL
    ->getPost('/', 'admins/users/login')
    ->getPost('/connection', 'admins/users/login','loginManagment')
    ->getPost('/inscription', 'admins/users/register','registerManagment')
    ->getPost('/deconnection', 'admins/users/deconnection','deconnectionManagment')
        ->resource(
            [
                ['GET','/logout', 'ajaxs/users/index']
            ])

    ->get('/appnote', 'etudiants/index','appnote#home')

    ->get('/etudiant', 'etudiants/index', 'etudiantManagment')
        //AJAX ETUDIANTS RESSOURCES 
        ->resource([
            ['POST','/requests/etudiant','ajaxs/etudiants/index'],
            ['POST','/requests/etudiant/image','ajaxs/etudiants/image'],
            ['GET','/requests/etudiant/[i:id]','ajaxs/etudiants/index'],
            ['GET','/requests/etudiant','ajaxs/etudiants/indexget'],
            ['PATCH','/requests/etudiant/[i:id]','ajaxs/etudiants/index'],
            ['DELETE','/requests/etudiant/[i:id]','ajaxs/etudiants/index']
        ])

    ->get('/note', 'notes/index', 'noteManagment')
            //AJAX INSCRIPTION RESSOURCES 
            ->resource([
                ['POST','/requests/note','ajaxs/notes/index'],
                ['GET','/requests/note/[i:id]','ajaxs/notes/index'],
                ['GET','/requests/note','ajaxs/notes/indexget'],
                ['PATCH','/requests/note/[i:id]','ajaxs/notes/index'],
                ['DELETE','/requests/note/[i:id]','ajaxs/notes/index']
            ])
    ->get('/inscrit', 'inscriptions/index', 'inscriptionManagment')
            //AJAX INSCRIPTION RESSOURCES 
            ->resource([
                ['POST','/requests/inscription','ajaxs/inscriptions/index'],
                ['GET','/requests/inscription/[i:id]','ajaxs/inscriptions/index'],
                ['GET','/requests/inscription','ajaxs/inscriptions/indexget'],
                ['PATCH','/requests/inscription/[i:id]','ajaxs/inscriptions/index'],
                ['DELETE','/requests/inscription/[i:id]','ajaxs/inscriptions/index']
            ])
    
    ->get('/filiere', 'filieres/index', 'filiereManagment')
            //AJAX FILIÈRES RESSOURCES 
            ->resource([
                ['POST','/requests/filiere','ajaxs/filieres/index'],
                ['GET','/requests/filiere/[i:id]','ajaxs/filieres/index'],
                ['GET','/requests/filiere','ajaxs/filieres/indexget'],
                ['PATCH','/requests/filiere/[i:id]','ajaxs/filieres/index'],
                ['DELETE','/requests/filiere/[i:id]','ajaxs/filieres/index']
            ])
    ->get('/matiere', 'matieres/index', 'matiereManagment')
                //AJAX MATIÈRES RESSOURCES 
                ->resource([
                    ['POST','/requests/matiere','ajaxs/matieres/index'],
                    ['GET','/requests/matiere/[i:id]','ajaxs/matieres/index'],
                    ['GET','/requests/matiere','ajaxs/matieres/indexget'],
                    ['PATCH','/requests/matiere/[i:id]','ajaxs/matieres/index'],
                    ['DELETE','/requests/matiere/[i:id]','ajaxs/matieres/index']
                ])

    ->get('/bulletin', 'bulletins/index', 'bulletinManagment')
                //AJAX MATIÈRES RESSOURCES 
                ->resource([
                    //['POST','/requests/bulletin','ajaxs/bulletins/index'],
                    ['GET','/requests/bulletin/[i:id]','ajaxs/bulletins/indexgetp'],
                    ['POST','/requests/bulletin','ajaxs/bulletins/indexget']
                ])
    ->run();
