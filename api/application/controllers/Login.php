<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('form_validation','session'));
		$this->load->helper(array('login/login_rules','url'));
		$this->load->model('Autenticacion');
	}

	public function index() {
		$datos = array(
			'header' => $this->load->view('session/header','',TRUE),
			'footer' => $this->load->view('session/footer','',TRUE),
		);
		$this->load->view('session/login', $datos);
	}

	public function validate() {
		$this->form_validation->set_error_delimiters('', '');
		$rules = getLoginRules();
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() === FALSE) {
			$errors = array(
				'email' => form_error('email'),
				'password' => form_error('password'),
			);
			echo json_encode($errors);
			$this->output->set_status_header(400);
		}else{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			if (!$res = $this->Autenticacion->login($email,$password)){
				echo json_encode(array('msg' => 'verifique las credenciales'));
				$this->output->set_status_header(401);
				exit;
			}
			$data = array(
				'id' => $res->id_usuario,
				'rango' => $res->niv_usuario,
				'nombre_usuario' => $res->nom_usuario,
				'isLogged' => TRUE,
			);
			$this->session->set_userdata($data);
			//REDIRECCIONAMOS AL DASHBOARD CORRESPONDIENTE 
			if ($res->niv_usuario == 1 || $res->niv_usuario == 0) {
				echo json_encode(array('url' => site_url('admin/Admin_dashboard')));
			}else{
				echo json_encode(array('url' => site_url('admin/NULL')));
			}
			
		}
	}

	public function logout(){
		$vars = array('id','rango','nombre_usuario','is_logged');
		$this->session->unset_userdata($vars);
		$this->session->sess_destroy();
		redirect(base_url('Login'));
	}

	public function success(){
		$datos = array(
			'header' => $this->load->view('session/header','',TRUE),
			'footer' => $this->load->view('session/footer','',TRUE),
		);
		$this->load->view('session/success', $datos);
	}

}
