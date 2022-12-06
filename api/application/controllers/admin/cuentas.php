<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('cuentas_model', 'cajas_model', 'divisas_model'));
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'cuentas' => $this->cuentas_model->getall(),
				'cajas' => $this->cajas_model->getall(),
				'divisas' => $this->divisas_model->getall(),
			);

			$this->load->view('admin/cuentas', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function save_cuenta() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$data = array(
				'nom_cuenta' => $this->input->post('nom_cuenta'),
				'des_cuenta' => $this->input->post('des_cuenta'),
				'id_divisa' => $this->input->post('id_divisa'),
				'id_caja' => $this->input->post('id_caja')
			);

			$this->cuentas_model->save($data);
			redirect(base_url('admin/Cuentas'));
			
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function delete_cuenta($id) {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$this->cuentas_model->delete($id);
			redirect(base_url('admin/Cuentas'));
			
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function update_cuenta($id, $cantidad) {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$this->cuentas_model->update($id, $cantidad);
			redirect(base_url('admin/Cuentas'));
			
		}else{
			redirect(base_url('login'));
		}
		
	}

}
