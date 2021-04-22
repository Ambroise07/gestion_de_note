<?php 

function form(Synext\Components\Htmls\Form $form ,string $method,$btn_label,$id){
    return <<<HTML
    <form method="{$method}" id="{$id}">
        {$form->input('matricule','Entrer le numero matricule ','number')}
        <button type="submit" class="btn btn-primary btn-block">{$btn_label}</button>
    </form>
HTML;
}