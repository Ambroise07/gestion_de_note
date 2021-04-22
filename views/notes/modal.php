<!-- Update Category Modal -->
<?php function modal(Synext\Components\Htmls\Form $form,$method,$id,$btn_label,$students,$matters){
        $studentsoption = "";
        foreach($students as $student) :
            $studentsoption .= "<option selected value='{$student->getId()}'>{$student->getLast_name()}" . " {$student->getFirst_name()}</option>";
        endforeach;
    
        $mattersoption = "";
        foreach($matters as $matter) :
            $mattersoption .= "<option selected value='{$matter->id}'>{$matter->wording}</option>";
        endforeach;
    return <<<HTML
        <div class="modal fade" id="editnote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <label for="student_">Nom Etudiant</label>
                            <select  class="form-control" id="student_" name="student_">
                                {$studentsoption}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="matter_">Nom Matière</label>
                            <select  class="form-control" id="matter_" name="matter_">
                                {$mattersoption}
                            </select>
                        </div>
                        <!-- { $ form->input('note_','Note en la matière','number')} -->
                        {$form->input('cc1_','Note en controle continue 1','number')}
                        {$form->input('cc2_','Note en controle continue 2','number')}
                        {$form->input('exam_','Note en contorle examen','number')}
                        <!-- <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_" id="cc1_" value="cc1">
                            <label class="form-check-label" for="cc1_">C continue 1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_" id="cc2_" value="cc2">
                            <label class="form-check-label" for="cc2_">C continue 2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_" id="exam_" value="exam" >
                            <label class="form-check-label" for="exam_">C Exam </label>
                        </div>
                        <br><br> -->
                        <button type="submit" class="btn btn-primary">{$btn_label}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
HTML;
} ?>
