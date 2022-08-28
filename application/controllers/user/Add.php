<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("User_model");
	}

	public function index()
	{
		$this->load->view('user/add');
	}

	public function save(){
		$nombre = $this->input->post("nombre");
		$ap = $this->input->post("ap");
		$am = $this->input->post("am");
		$fn = $this->input->post("fn");
		$genero = $this->input->post("genero");
		$DPI = $this->input->post("DPI");
		$Telefono = $this->input->post("Telefono");
		$correo_electronico = $this->input->post("correo_electronico");

		$this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
		$this->form_validation->set_rules('ap', 'Primer Apellido', 'required');
		$this->form_validation->set_rules('am', 'Segundo Apellido', 'required');
		$this->form_validation->set_rules('fn', 'Fecha', 'required');
		$this->form_validation->set_rules('genero', 'Genero', 'required');
		$this->form_validation->set_rules('DPI', 'DPI', 'required');
		$this->form_validation->set_rules('Telefono', 'Teléfono', 'required');
		$this->form_validation->set_rules('correo_electronico', 'Correo Electrónico', 'required');
		
		if ($this->form_validation->run() == FALSE){
			$this->load->view('user/add');
		}else{
			$data = array(
				"nombre"=>$nombre,
				"ap"=>$ap,
				"am"=>$am,
				"fn"=>$fn,
				"genero"=>$genero,
				"DPI"=>$DPI,
				"Telefono"=>$Telefono,
				"correo_electronico"=>$correo_electronico
			);
			
			$this->User_model->save($data);
			redirect(base_url()."usuarios");
		}
	}
}
