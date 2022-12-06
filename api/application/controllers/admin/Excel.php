<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends CI_Controller {
    
	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('operaciones_model'));
	}

    public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
		|| $this->session->userdata('rango') == 1) {

		if ($this->input->get('desde') && $this->input->get('hasta')) {
			$desde = $this->input->get('desde') . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = $this->input->get('hasta') . " 23:59:59";//ajustando la fecha para que tome todo el dia

			$tipo = $this->input->get('tipo');
			$mayor = $this->input->get('mayor');
			$menor = $this->input->get('menor');

			if ($tipo == ""){$tipo = NULL;}
			if($mayor == ""){$mayor = NULL;}
			if($menor == ""){$menor = NULL;}

		}else{
			$desde = date("Y-m-d") . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = date("Y-m-d") . " 23:59:59";//ajustando la fecha para que tome todo el dia
			$tipo = NULL;
			$mayor = NULL;
			$menor = NULL;
		}

			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'operaciones' => $this->operaciones_model->getall($desde, $hasta, $tipo, $mayor, $menor)
			);

			$this->load->view('admin/excel', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}
    
}

