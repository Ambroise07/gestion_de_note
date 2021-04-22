<?php
namespace Synext\Controllers;

use Synext\Models\Model;

class Spinnerets extends Model{

    public function getSpinnerets(){
        return $this->findAllOrderByDesc('spinnerets');
    }
    
}