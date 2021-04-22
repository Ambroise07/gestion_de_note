<?php 

function form(Synext\Components\Htmls\Form $form ,string $method,$btn_label,$id){
    return <<<HTML
    <form method="{$method}" id="{$id}">
        {$form->input('code','Code Filière')}
        {$form->input('wording','Nom Filière')}
        <button type="submit" class="btn btn-primary">{$btn_label}</button>
    </form>
HTML;
}