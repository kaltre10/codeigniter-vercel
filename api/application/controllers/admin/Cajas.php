<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cajas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('cajas_model');
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'cajas' => $this->cajas_model->getall()
			);

			$this->load->view('admin/cajas', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function save_caja() {
		if ($this->session->userdata('is_logged') && $this->session->userdata('rango') == 0) {

			$data = array(
				'nom_caja' => $this->input->post('nom_caja'),
				'des_caja' => $this->input->post('des_caja'),
			);

			$this->cajas_model->save($data);
			redirect(base_url('admin/Cajas'));
			
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function delete_caja($id) {
		if ($this->session->userdata('is_logged') && $this->session->userdata('rango') == 0) {

			$this->cajas_model->delete($id);
			redirect(base_url('admin/Cajas'));
			
		}else{
			redirect(base_url('login'));
		}
		
	}

}
