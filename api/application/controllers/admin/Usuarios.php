<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->model(array('usuarios_model', 'cajas_model'));
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'usuarios' => $this->usuarios_model->getall(),
				'cajas' => $this->cajas_model->getall()
			);

			$this->load->view('admin/Usuarios', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function delete_usuario($id) {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {
			$this->usuarios_model->delete($id);
			redirect('admin/Usuarios');

		}else{
			redirect(base_url('login'));
		}
		
	}

	public function save_usuario() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

	     		$datos = array(
	     			'nom_usuario' => $this->input->post('nom_usuario'),
	     			'pas_usuario' => $this->input->post('pas_usuario'),  
	     			'id_caja' => $this->input->post('id_caja'),
	     			'niv_usuario' => $this->input->post('niv_usuario')
	     		);
	     		$this->usuarios_model->save($datos);
	     		redirect(base_url('admin/Usuarios')); 

		}else{
			redirect(base_url('login'));
		}
		
	}


}
