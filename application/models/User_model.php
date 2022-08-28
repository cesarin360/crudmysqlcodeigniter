<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function save($data){
        $this->db->query("ALTER TABLE personas AUTO_INCREMENT 1");
        $this->db->insert("personas",$data);
    }

    public function getUsers(){
        $this->db->select("*");
        $this->db->from("personas");
        $results=$this->db->get();
        return $results->result();
    }

    public function getUser($id){
        $this->db->select("u.id, u.nombre, u.ap, u.am, u.fn, u.genero, u.DPI, u.Telefono, u.correo_electronico");
        $this->db->from("personas u");
        $this->db->where("u.id",$id);
        $result=$this->db->get();
        return $result->row();
    }

    public function update($data,$id){
        $this->db->where("id",$id);
        $this->db->update("personas",$data);
    }

    public function delete($id){
        $this->db->where("id",$id);
        $this->db->delete("personas");
    }
    
}
