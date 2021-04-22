<?php 

function form(Synext\Components\Htmls\Form $form ,string $method,$btn_label,$id,$students,$matters){
    $studentsoption = "";
    foreach($students as $student) :
        $studentsoption .= "<option selected value='{$student->getId()}'>{$student->getLast_name()}" . " {$student->getFirst_name()}</option>";
    endforeach;

    $mattersoption = "";
    foreach($matters as $matter) :
        $mattersoption .= "<option selected value='{$matter->id}'>{$matter->wording}</option>";
    endforeach;
    return <<<HTML
    <form method="{$method}" id="{$id}">
        <div class="form-group">
                <label for="student">Nom Etudiant</label>
                <select  class="form-control" id="student" name="student">
                    {$studentsoption}
                </select>
        </div>
        <div class="form-group">
                <label for="matter">Nom Matière</label>
                <select  class="form-control" id="matter" name="matter">
                    {$mattersoption}
                </select>
        </div>
        {$form->input('cc1','Note en controle continue 1','number')}
        {$form->input('cc2','Note en controle continue 2','number')}
        {$form->input('exam','Note en contorle examen','number')}
        <!-- { $ form->input('note','Note en la matière','number')} -->

        <!-- <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="cc1" value="cc1">
            <label class="form-check-label" for="cc1">C continue 1</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="cc2" value="cc2">
            <label class="form-check-label" for="cc2">C continue 2</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="type" id="exam" value="exam" >
            <label class="form-check-label" for="exam">C Exam </label>
        </div> 
        <br><br>-->
        <button type="submit" class="btn btn-primary">{$btn_label}</button>
    </form>
HTML;
}