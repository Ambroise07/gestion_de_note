<?php
namespace Synext\Models;

use Synext\Components\Databases\Database;
use PDO;
class Model{
    
    protected $db;
    public function __construct()
    {   /** @var Database */
        $this->db = new Database();
    }
    public function  findAll(string $table){
        return $this->db->select("SELECT * from {$table}");
    }
    public function  findAllOrderByDesc(string $table){
        return $this->db->select("SELECT * from {$table} ORDER BY id DESC");
    }
    public function  findAllIdWithName(string $table){
        return $this->db->select("SELECT id,wording from {$table}",true,null,PDO::FETCH_CLASS,get_class($this));
    }
    public function findWhereId(string $table,int $id){
        return $this->db->select("SELECT * FROM {$table} WHERE id = :id",true,['id'=>$id]);
    }
    public function findWhereEqual(string $table,$field,int $equal){
        return $this->db->select("SELECT * FROM {$table} WHERE $field=:$field",true,[$field=>$equal]);
    }
    public function findWhereIdAndSlug(string $table,int $id,$slug){
        return $this->db->select("SELECT * FROM {$table} WHERE id =:id AND slug = :slug",false,['id'=>$id,'slug'=>$slug]);
    }
    public function  findId(string $table){
        return $this->db->select("SELECT id from {$table}");
    }
    public function save($table,$data){
        //if($this->db->insert("INSERT INTO {$table} (".implode(',',array_keys($data)).")",$data)){}
    }
}