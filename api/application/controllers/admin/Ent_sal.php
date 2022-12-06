<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ent_sal extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('divisas_model', 'categorias_model', 'ent_sal_model', 'ganancia_model'));
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
		|| $this->session->userdata('rango') == 1) {

		if ($this->input->post('desde') && $this->input->post('hasta')) {
			$desde = $this->input->post('desde') . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = $this->input->post('hasta') . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}else{
			$desde = date("Y-m-d") . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = date("Y-m-d") . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}

			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'divisas' => $this->divisas_model->getall(),
				'categorias' => $this->categorias_model->getall(),
				'ent_sal' => $this->ent_sal_model->getall($desde, $hasta)
			);

			$this->load->view('admin/ent_sal', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function save_ent_sal() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
		|| $this->session->userdata('rango') == 1) {

			if (!$this->check_ganancia()) {
				$data = array(
					'id_usuario' => $this->session->id,
					'tip_ent_sal' => $this->input->post('tip_ent_sal'),
					'can_ent_sal' => $this->input->post('can_ent_sal'),
					'id_divisa' => $this->input->post('id_divisa'),
					'id_categoria' => $this->input->post('id_categoria'),
					'des_ent_sal' => $this->input->post('des_ent_sal')
				);
				$this->ent_sal_model->save($data);
				redirect(base_url('admin/Ent_sal'));
			}else{
				// echo "<button onclick='modal();'>modal</button>";
				redirect('admin/Ent_sal?err');
			}


			
			
			
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function anular_ent_sal($id) {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
		|| $this->session->userdata('rango') == 1) {

			$this->ent_sal_model->anular($id);
			redirect(base_url('admin/Ent_sal'));
			
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function check_ganancia(){
		$fecha = date("Y-m-d");
		$check = $this->ganancia_model->get_check($fecha);
		return $check;
	}

}
