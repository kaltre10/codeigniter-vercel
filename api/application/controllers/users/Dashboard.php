<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('usuarios_model');
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 1) {

			$data = array(
				'header' => $this->load->view('users/header','',TRUE),
				'footer' => $this->load->view('users/footer','',TRUE),
				'usuario' => $this->usuarios_model->getUsers_id($this->session->userdata('id')),
			);
			$this->load->view('users/dashboard', $data);
		}else{
			show_404();
		}
		
	}

	public function api(){
		
	}

	
	
}
