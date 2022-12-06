<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model('clientes_model');
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0 
		|| $this->session->userdata('rango') == 1) {

			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'clientes' => $this->clientes_model->getall()
			);

			$this->load->view('admin/clientes', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function save_cliente() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
			|| $this->session->userdata('rango') == 1) {

			$data = array(
				'doc_cliente' => $this->input->post('doc_cliente'),
				'n_cliente' => $this->input->post('n_cliente'),
				'nom_cliente' => $this->input->post('nom_cliente'),
				'pais_cliente' => $this->input->post('pais_cliente'),
				'ocu_cliente' => $this->input->post('ocu_cliente'),
				'po_cliente' => $this->input->post('po_cliente')
			);

			$this->clientes_model->save($data);
			redirect(base_url('admin/Clientes'));

		}else{
			redirect(base_url('login'));
		}
		
	}

	public function editar_cliente() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
			|| $this->session->userdata('rango') == 1) {

			$data = array(
				'id_cliente' => $this->input->post('id_cliente'),
				'doc_cliente' => $this->input->post('doc_cliente'),
				'n_cliente' => $this->input->post('n_cliente'),
				'nom_cliente' => $this->input->post('nom_cliente'),
				'pais_cliente' => $this->input->post('pais_cliente'),
				'ocu_cliente' => $this->input->post('ocu_cliente'),
				'po_cliente' => $this->input->post('po_cliente')
			);

			$this->clientes_model->editar($data);
			redirect(base_url('admin/Clientes'));

		}else{
			redirect(base_url('login'));
		}
		
	}
	public function delete($id) {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {
			$this->clientes_model->delete($id);
			redirect(base_url('admin/Clientes'));
		}else{
			redirect(base_url('login'));
		}
	}

	public function get_cliente_id(){
		$data = serialize($this->input->raw_input_stream);
		$id = explode('"', $data);
		echo json_encode($this->clientes_model->get_id($id[2]));
		// echo json_encode($id[2]);
	}

}
