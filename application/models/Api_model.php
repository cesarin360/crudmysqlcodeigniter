<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function save($data){
        return $this->db->insert("estudiante",$data);;
    }

    public function verify_if_token_exist($token)
    {
        $this->db->select("*");
        $this->db->from("estudiante");
        $this->db->where("token", $token);
        $results=$this->db->get();
        return empty($results->result());
    }
    
}
