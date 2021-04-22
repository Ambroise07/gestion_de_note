<?php
namespace Synext\Controllers;

use Synext\Models\Model;

class Matters extends Model{

    public function getMatters($sql=null){
        if($sql){
            return $this->db->select("SELECT matter_spinnerets.coefficient,matters.id,matters.code,matters.wording,spinnerets.wording as spinneret FROM matters JOIN  matter_spinnerets ON matter_spinnerets.id_matter = matters.id JOIN spinnerets ON spinnerets.id = matter_spinnerets.id_spinneret ORDER BY id DESC");
        }
        return $this->findAllOrderByDesc('matters');
    }

    
}