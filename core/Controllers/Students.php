<?php
namespace Synext\Controllers;

use Synext\Models\Model;
use Synext\Models\Students as ModelsStudents;

class Students extends Model{

    public function getStudients(){
        return $this->findAllOrderByDesc('students');
    }
    public function allStudientsWithName(){
        return $this->db->select("SELECT id,last_name,first_name from students ",true,null,\PDO::FETCH_CLASS,ModelsStudents::class);
    }
    
}