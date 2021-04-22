<?php 
namespace Synext\Models;

use Synext\Components\Databases\Database;
use Synext\Models\Model;

class Spinnerets extends Model{
    private $id;
    private $code;
    private $wording;



    public function pdo():Database{
        return $this->db;
    }

    /**
     * Get the value of wording
     */ 
    public function getWording()
    {
        return $this->wording;
    }

    /**
     * Set the value of wording
     *
     * @return  self
     */ 
    public function setWording($wording)
    {
        $this->wording = $wording;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}