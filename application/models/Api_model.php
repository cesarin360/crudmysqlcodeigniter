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
    
    public function get_pass($carrera, $periodo, $correlativo)
    {
        $this->db->select("u.password, u.primer_nombre, u.primer_apellido");
        $this->db->from("estudiante u");
        $this->db->where("u.no_carrera",$carrera);
        $this->db->where("u.no_periodo",$periodo);
        $this->db->where("u.no_correlativo",$correlativo);
        $result=$this->db->get();
        return $result->result();
    }

    public function change_pass($token, $password)
    {
        $data = [
            'password' => $password
        ];

        $this->db->select("u.token");
        $this->db->from("estudiante u");
        $this->db->where("u.token",$token);
        $result=$this->db->get();
        if(!empty($result->result())){
            $this->db->where("token", $token);
            $this->db->update("estudiante",$data);
            return true;
        }else{
            return false;
        }
    }
}
