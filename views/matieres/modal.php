<!-- Update Category Modal -->
<?php function modal(Synext\Components\Htmls\Form $form,$method,$id,$btn_label,$spinnerets){
        $spinneretsoption = "";
        foreach($spinnerets as $spinneret) :
          //  dd($spinneret->getId());
            $spinneretsoption .= "<option selected value='{$spinneret->getId()}'>{$spinneret->getWording()}</option>";
        endforeach;
    return <<<HTML
        <div class="modal fade" id="editmatter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <label for="spinneret_">Nom Filière</label>
                            <select  class="form-control" id="spinneret_" name="spinneret_">
                                {$spinneretsoption}
                            </select>
                        </div>
                        {$form->input('code_','Code Matière')}
                        {$form->input('wording_','Nom Matière')}
                        {$form->input('coefficient_','Coefficient Matière')}
                        <button type="submit" class="btn btn-primary">{$btn_label}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
HTML;
} ?>
