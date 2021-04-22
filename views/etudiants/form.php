<?php


use Synext\Helpers\Helpers;
function form(Synext\Components\Htmls\Form $form ,string $method,$btn_label,$id){
    
    $matricule = Helpers::matricule(12);
    return <<<HTML
    <form method="{$method}" id="{$id}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="matricule">Numero Matricule</label>
            <input type="text" id="matricule" value="{$matricule}" readonly name="matricule" class="form-control mb-1" placeholder="Numero Matricule" required >
        </div>
        {$form->input('last_name','Nom Etudiant')}
        {$form->input('first_name','Prénom Etudiant')}
        {$form->input('address','Addresse Etudiant')}
        {$form->input('date_of_birth','Date de naissance','date')}
        <!-- {$form->input('photo','Photo Etudiant','file')} -->
        <label for="">Photo Etudiant</label>
        <div class="card mb-2 p-4  badge-info text-center" id='areaDrop'>
            <div class="card-body" id='show-img'>
                <!-- <img src="/storages/products/image5.jpg" alt="" srcset="" class="img-fluid"> -->
                <span class="text">Glisser Déposer la photo ici  </span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{$btn_label}</button>
    </form>
HTML;
}