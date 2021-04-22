<?php
namespace Synext\Components\Htmls;
class Form
{
    private $data;
    private  $errors;
    public function __construct($data, array $errors)
    {
        $this->data =$data;
        $this->errors = $errors;
    }
    /**
     * get hmtl input
     *
     * @param string $name
     * @param string $placeholder
     * @param string $type
     * @return string
     */
    public function input($name,string $placeholder,$type = 'text'):string{
        $inputClass = 'form-control';
        $errorMessage = '';
        if(isset($this->errors[$name])){
            $inputClass .= ' is-invalid';
            $errorMessage = '<div class="invalid-feedback">'.implode('<br>',$this->errors[$name]).'</div>';
        }
        $value = null;
        if($type != 'password'){$value = $this->getValue($name);}
        return <<<HTML
            <div class="form-group">
                <label for="{$name}">{$placeholder}</label>
                <input type="{$type}" id="{$name}" value="{$value}" name="{$name}" class="{$inputClass} mb-1" placeholder="{$placeholder}" required >
                {$errorMessage}
            </div>
        HTML;
    }

    public function select($name,string $placeholder ,array $options=[]):string {
        $inputClass = 'form-control';
        $errorMessage = '';
        if(isset($this->errors[$name])){
            $inputClass .= ' is-invalid';
            $errorMessage = '<div class="invalid-feedback">'.implode('<br>',$this->errors[$name]).'</div>';
        }
        $dataOption = '';
        foreach($options as $option => $value){
            if(is_object($this->data)){
                $field = 'get'.ucfirst($name);
                if($this->data->$field() == $value->getId()){
                    $dataOption .= "<option selected value='{$value->getId()}'>{$value->getName()}</option>";
                   
                }else{
                    $dataOption .= "<option value='{$value->getId()}'>{$value->getName()}</option>";
                }
            }
            if(is_array($this->data)){
                $field = $this->data[$name] ?? null;
                if($field  == $value->getId()){
                    $dataOption .= "<option selected value='{$value->getId()}'>{$value->getName()}</option>";
                }else{
                    $dataOption .= "<option value='{$value->getId()}'>{$value->getName()}</option>";
                }

            }//for is not object $value ??
            
        }
        return <<<HTML
            <div class="form-group">
                <label for="{$name}">{$placeholder}</label>
                <select  class="{$inputClass}" id="{$name}" name="{$name}">
                    {$dataOption}
                </select>
                {$errorMessage}
            </div>
        HTML;
    }

    public function textarea($name,string $label):string{
        $inputClass = 'form-control';
        $errorMessage = '';
        if(isset($this->errors[$name])){
            $inputClass .= ' is-invalid';
            $errorMessage = '<div class="invalid-feedback">'.implode('<br>',$this->errors[$name]).'</div>';
        }
        $value = null;
        $value = $this->getValue($name);
        return <<<HTML
            <div class="form-group">
                <label for="{$name}">{$label}</label>
                <textarea class="{$inputClass}" id="{$name}" name="{$name}" rows="3">{$value}</textarea>
                {$errorMessage}
            </div>
        HTML;
    }

    public function file($name,string $label){
        $errorMessage = '';
        if(isset($this->errors[$name])){
            $errorMessage = '<div class="invalid-feedback">'.implode('<br>',$this->errors[$name]).'</div>';
        }
        return <<<HTML
            <div class="custom-file mb-3">
                <input type="file" name="{$name}" class="custom-file-input" id="{$name}" required>
                <label class="custom-file-label" for="{$name}">{$label}</label>
                {$errorMessage}
            </div>
        HTML;
              
    }

    public function checkbox(string $name ,$label):string{
        $inputClass = '';
        $attribut ='';
        $errorMessage = '';
        if(isset($this->errors[$name])){
            $inputClass .= ' is-invalid';
            $errorMessage = '<div class="invalid-feedback">'.implode('<br>',$this->errors[$name]).'</div>';
        }
        if($this->getValue($name)=== "on"){
            $attribut .= 'checked';
        }
        //come back
        return <<<HTML
            <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input {$inputClass}" type="checkbox" id="{$name}" required $attribut name="{$name}">
                <label class="custom-control-label" for="{$name}"> $label </label>
                {$errorMessage}
            </div>
        HTML;
    }

    private function getValue(string $name) {
        if(is_array($this->data)){
            return htmlentities($this->data[$name] ?? null) ;
        }
        $dynamiqueName = 'get'.ucfirst($name);
        return $this->data->$dynamiqueName();
    }

    private function getClass(){
        //for class
    }
}
