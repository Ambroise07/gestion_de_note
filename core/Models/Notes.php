<?php 
namespace Synext\Models;

use Synext\Components\Databases\Database;
use Synext\Models\Model;

class Notes extends Model{
    private $id;
    private $cc1;
    private $cc2;
    private $exam;



    public function pdo():Database{
        return $this->db;
    }

    

    /**
     * Get the value of exam
     */ 
    public function getExam()
    {
        return $this->exam;
    }

    /**
     * Set the value of exam
     *
     * @return  self
     */ 
    public function setExam($exam)
    {
        $this->exam = $exam;

        return $this;
    }

    /**
     * Get the value of cc2
     */ 
    public function getCc2()
    {
        return $this->cc2;
    }

    /**
     * Set the value of cc2
     *
     * @return  self
     */ 
    public function setCc2($cc2)
    {
        $this->cc2 = $cc2;

        return $this;
    }

    /**
     * Get the value of cc1
     */ 
    public function getCc1()
    {
        return $this->cc1;
    }

    /**
     * Set the value of cc1
     *
     * @return  self
     */ 
    public function setCc1($cc1)
    {
        $this->cc1 = $cc1;

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