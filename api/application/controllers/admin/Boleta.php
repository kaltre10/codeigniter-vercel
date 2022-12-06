<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Boleta extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('boleta_model');
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'boleta' => $this->boleta_model->getall()
			);

			$this->load->view('admin/boleta', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function save_token() {
		$this->boleta_model->edit($this->input->post('token'));
		redirect(base_url('admin/Boleta'));	
	}

	public function get_token(){
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {
			echo json_encode($this->boleta_model->getall());
		}else{
			redirect(base_url('login'));
		}
	}

}
