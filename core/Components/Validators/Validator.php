<?php 
namespace Synext\Components\Validators;

use Valitron\Validator as ValitronValidator;

class Validator {
    private $validator;

    public function __construct($data)
    {
        $this->validator = new ValitronValidator($data);
    }
    public function rule($rule,$fields){
        $this->validator->rule($rule,$fields);
        return $this;
    }
    public function rules(array $rules){
        $this->validator->rules($rules);
        return $this;
    }
    public function is_valide(){
        return $this->validator->validate();
    }
    public function errors($fields=null){
        return $this->validator->errors($fields);

    }
    public function validateInstance(){
        return $this->validator;
    }
}