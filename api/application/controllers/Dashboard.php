<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 1) {

			//VERIFICANDO SI EXISTE OPERACION PENDIENTE
			if (isset($_SESSION['id_operacion'])) {

				$this->operaciones_model->check_cancelar($_SESSION['id_operacion'],$this->session->userdata('id'));
				//Vaciando las variables de session de la operacion
				$array_items = array('tipo', 'recibe', 'cambio', 'monto', 'id_operacion');
				$this->session->unset_userdata($array_items);
				unset($_SESSION['id_operacion']);
			}

			if (isset($_SESSION['id_operacion'])) {
				$this->check_cancelar($_SESSION['id_operacion'],$this->session->userdata('id'));
				unset($_SESSION['id_operacion']);
			}

			$data = array(
				'header' => $this->load->view('users/header','',TRUE),
				'footer' => $this->load->view('users/footer','',TRUE),
				'cotizacion' => $this->cotizacion_model->getCotizacion(),
				'cotizacionRegistro' => $this->cotizacion_model->listaCotizacion(),
				'operacion' => $this->operaciones_model->all_user_operacion($this->session->userdata('id')),
				'usuario' => $this->users_model->getUsers_id($this->session->userdata('id')),
			);
			$this->load->view('users/dashboard', $data);
		}else{
			show_404();
		}
		
	}

	// public function api(){
		
	// }

	
	
}
