<?php 

function form(Synext\Components\Htmls\Form $form ,string $method,$btn_label,$id,$spinnerets,$students){
    $studentsoption = "";
    foreach($students as $student) :
        $studentsoption .= "<option selected value='{$student->getId()}'>{$student->getLast_name()}" . " {$student->getFirst_name()}</option>";
    endforeach;

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
        <div class="form-group">
                <label for="student">Nom Etudiant</label>
                <select  class="form-control" id="student" name="student">
                    {$studentsoption}
                </select>
        </div>
        <!-- {form->select('student','Nom Etudiant',student)} -->
        <button type="submit" class="btn btn-primary">{$btn_label}</button>
    </form>
HTML;
}