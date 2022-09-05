<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model', 'est');        
    }

    public function get_token($len) 
    {
        $tk = "";
        $alphabeth = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        for ($i = 0; $i < $len; $i++){
            $tk .= $alphabeth[mt_rand(0, strlen($alphabeth)-1)];
        }

        return $tk;
    }

    public function index_post()
    {
        $no_carrera = $this->input->post('no_carrera');
        $no_periodo = $this->input->post('no_periodo');
        $no_correlativo = $this->input->post('no_correlativo');
        $primer_nombre = $this->input->post('primer_nombre');
        $primer_apellido = $this->input->post('primer_apellido');
        $correo_electronico = $this->input->post('correo_electronico');
        $token = $this->get_token(8);

        while (!$this->est->verify_if_token_exist($token)){
            $token = $this->get_token(8);
        }

        $data = array(
            'no_carrera' => $no_carrera,
            'no_periodo' => $no_periodo,
            'no_correlativo' => $no_correlativo,
            'primer_nombre'	=> $primer_nombre, 
            'primer_apellido' => $primer_apellido, 
            'correo_electronico' => $correo_electronico,
            'token' => $token

        );
        
        
        $cond  = $this->est->save($data);
        $http_code = 200; 
        if($cond) {
            $res['error'] = false;
            $res['message'] = 'insert success';
            $res['data'] = $data;
        } else {
            $res['error'] = true;
            $res['message'] = 'insert failed';
            $res['data'] = $data;
            $http_code = 400;
        }

        $this->response($res, $http_code);        
    }

}