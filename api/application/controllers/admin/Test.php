<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('operaciones_model', 'divisas_model', 'ent_sal_model', 'cierre_model'));
		$this->load->helper(array('reporte/operaciones'));
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
		|| $this->session->userdata('rango') == 1) {

		if ($this->input->post('desde') /*&& $this->input->post('hasta')*/) {
			$desde = $this->input->post('desde') . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = $this->input->post('desde') . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}else{
			$desde = date("Y-m-d") . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = date("Y-m-d") . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}

		
			$operaciones = $this->operaciones_model->getall($desde, $hasta);
			$divisas = $this->divisas_model->getall();
			$array = operaciones_diarias($divisas, $operaciones, $ent_sal);
			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'ent_sal' => $ent_sal,
				'operaciones' => $operaciones,
				'divisas' => $array
			);

			$this->load->view('admin/test', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}

}
