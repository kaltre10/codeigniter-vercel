<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->model('categorias_model');
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'categorias' => $this->categorias_model->getall()
			);

			$this->load->view('admin/Categorias', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function delete_categoria($id) {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$this->categorias_model->delete($id);
			redirect('admin/Categorias');

		}else{
			redirect(base_url('login'));
		}
		
	}

	public function save_categoria() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

	     		$datos = array(
	     			'nom_categoria' => $this->input->post('nom_categoria'),  
	     		);
	     		$this->categorias_model->save($datos);
	     		redirect(base_url('admin/Categorias')); 

		}else{
			redirect(base_url('login'));
		}
		
	}


}
