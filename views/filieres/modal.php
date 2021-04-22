<!-- Update spinnerets Modal -->
<?php function modal(Synext\Components\Htmls\Form $form,$method,$id,$btn_label){
    return <<<HTML
        <div class="modal fade" id="editspinneret" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                    {$form->input('code_','Code Filière')}
                    {$form->input('wording_','Nom Filière')}
                        <button type="submit" class="btn btn-primary">{$btn_label}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
HTML;
} ?>
