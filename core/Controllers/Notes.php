<?php
namespace Synext\Controllers;

use Synext\Models\Model;
//SELECT notes.id,students.last_name, students.first_name,matters.wording,notes.cc1,notes.cc2,notes.exam FROM students JOIN note_students ON note_students.id_student = students.id JOIN matters ON matters.id=note_students.id_matter JOIN notes ON notes.id=note_students.id_note
class Notes extends Model{

    public function getNotes($sql=null){
        if($sql){
            return $this->db->select("SELECT notes.id,students.last_name, students.first_name,matters.wording,notes.cc1,notes.cc2,notes.exam FROM students JOIN note_students ON note_students.id_student = students.id JOIN matters ON matters.id=note_students.id_matter JOIN notes ON notes.id=note_students.id_note ORDER BY id DESC");
        }
        return $this->findAllOrderByDesc('notes');
    }

    //
}