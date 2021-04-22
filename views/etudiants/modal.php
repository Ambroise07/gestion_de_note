<!-- Update Student Modal -->
<?php function modal(Synext\Components\Htmls\Form $form,$method,$id,$btn_label){
    return <<<HTML
        <div class="modal fade" id="editstudents" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Mettre à Jour</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="{$method}" id="{$id}">
                    <div class="form-group">
                        <label for="matricule_">Numero Matricule</label>
                        <input type="text" id="matricule_" value="" readonly name="matricule_" class="form-control mb-1" placeholder="Numero Matricule" required >
                    </div>
                    {$form->input('last_name_','Nom Etudiant')}
                    {$form->input('first_name_','Prénom Etudiant')}
                    {$form->input('address_','Addresse Etudiant')}
                    {$form->input('date_of_birth_','Date de naissance','date')}
                    <!-- {$form->input('photo_','Photo Etudiant','file')} -->
                        <button type="submit" class="btn btn-primary">{$btn_label}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
HTML;
} ?>
