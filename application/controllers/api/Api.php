<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Api_model', 'est');   
        $this->load->library('encryption');     

    }

    //Obtener Token
    public function get_token($len) 
    {
        $tk = "";
        $alphabeth = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        for ($i = 0; $i < $len; $i++){
            $tk .= $alphabeth[mt_rand(0, strlen($alphabeth)-1)];
        }

        return $tk;
    }

    //Obtener Cambio al día
    public function index_get(){
        $client = new SoapClient("https://banguat.gob.gt/variables/ws/TipoCambio.asmx?WSDL");

        $result = $client->TipoCambioDia();

        $fecha_cambio = str_replace("/","-",strval($result->TipoCambioDiaResult->CambioDolar->VarDolar->fecha));
        $referencia_cambio = strval($result->TipoCambioDiaResult->CambioDolar->VarDolar->referencia);
        $res['fecha_cambio'] = $fecha_cambio;
        $res['referencia_cambio'] = $referencia_cambio;

        $this->response($res); 
    }

    //Comprobar contraseña
    public function pass_post()
    {
        $no_carrera = $this->input->post('no_carrera');
        $no_periodo = $this->input->post('no_periodo');
        $no_correlativo = $this->input->post('no_correlativo');
        $password = $this->input->post('password');
        
        $val = $this->est->get_pass($no_carrera, $no_periodo, $no_correlativo);

        $desencrypted_pass = '';
        $data = array('NULL');
        if (!empty($val)){
            $encrypted_pass = $val[0]->password;
            $primer_nombre = $val[0]->primer_nombre;
            $primer_apellido = $val[0]->primer_apellido;
            $desencrypted_pass = $this->encryption->decrypt($encrypted_pass); 
            $data = array(
                'primer_nombre'	=> $primer_nombre, 
                'primer_apellido' => $primer_apellido, 
            );
        }
        
        $http_code = 200;
        if ($desencrypted_pass != ''){
            if ($desencrypted_pass === $password) 
            {
                $res['error'] = false;
                $res['message'] = 'password correcto';
                $res['nombre'] = $data;
                $this->response($res, $http_code); 
            } else {
                $res['error'] = true;
                $res['message'] = 'password fallido';
                $this->response($res, $http_code); 
            }
        }else{
            $res['error'] = true;
            $res['message'] = 'password fallido';
            $this->response($res, $http_code); 
        }
        
    }

    //Cambiar Contraseña
    function change_pass_post(){
        $token = $this->input->post('token');
        $password = $this->encryption->encrypt($this->input->post('password'));
        
        $data = $this->est->change_pass($token,$password);

        $res['insertado'] = $data;
        $this->response($res);
    }

    public function index_post()
    {
        $no_carrera = $this->input->post('no_carrera');
        $no_periodo = $this->input->post('no_periodo');
        $no_correlativo = $this->input->post('no_correlativo');
        $primer_nombre = $this->input->post('primer_nombre');
        $primer_apellido = $this->input->post('primer_apellido');
        $correo_electronico = $this->input->post('correo_electronico');
        $password = $this->encryption->encrypt($this->input->post('password'));

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
            'token' => $token,
            'password' => $password

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
        }

        $this->response($res, $http_code);        
    }

}