<?php 

function form(Synext\Components\Htmls\Form $form ,string $method,$btn_label,$id,$spinnerets){
    $spinneretsoption = "";
    foreach($spinnerets as $spinneret) :
      //  dd($spinneret->getId());
        $spinneretsoption .= "<option selected value='{$spinneret->getId()}'>{$spinneret->getWording()}</option>";
    endforeach;
    return <<<HTML
    <form method="{$method}" id="{$id}">
        <div class="form-group">
                <label for="spinneret">Nom Filière</label>
                <select  class="form-control" id="spinneret" name="spinneret">
                    {$spinneretsoption}
                </select>
        </div>
        {$form->input('code','Code Matière')}
        {$form->input('wording','Nom Matière')}
        {$form->input('coefficient','Coefficient Matière')}
        <button type="submit" class="btn btn-primary">{$btn_label}</button>
    </form>
HTML;
}