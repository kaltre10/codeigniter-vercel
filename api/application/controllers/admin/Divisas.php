<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divisas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->model('divisas_model');
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
			|| $this->session->userdata('rango') == 1) {

			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'divisas' => $this->divisas_model->getall()
			);

			$this->load->view('admin/divisas', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}
	public function editar_divisa() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
			|| $this->session->userdata('rango') == 1) {

			$compra = $this->input->post('compra');
			$venta = $this->input->post('venta');
			$id = $this->input->post('id');

			$this->divisas_model->update($compra, $venta, $id);
			redirect('admin/Divisas');
		}else{
			redirect(base_url('login'));
		}
	}

	public function delete_divisa($id, $cod_divisa) {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			if (file_exists("assets/img/$cod_divisa.jpg")) {

				unlink("assets/img/$cod_divisa.jpg");

			}else if(file_exists("assets/img/$cod_divisa.jpeg")){

				unlink("assets/img/$cod_divisa.jpeg");

			}else if(file_exists("assets/img/$cod_divisa.png")){

				unlink("assets/img/$cod_divisa.png");

			}else{
				echo "error el archivo no existe";
			}

			$this->divisas_model->delete($id);
			redirect('admin/Divisas');

		}else{
			redirect(base_url('login'));
		}
		
	}

	public function save_divisa() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$img = $this->input->post('cod_divisa');

		/*******************************************************************
		*********************CONFIGURACION DE IMAGEN************************
		*******************************************************************/
		$archivo = (isset($_FILES['img'])) ? $_FILES['img'] : null;
		if ($archivo) {
		   $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
		   $extension = strtolower($extension);
		   $extension_correcta = ($extension == 'jpg' or $extension == 'jpeg' or $extension == 'png');
		   if ($extension_correcta) {
		      $ruta_destino_archivo = "assets/img/{$img}" . ".$extension";
		      $archivo_ok = move_uploaded_file($archivo['tmp_name'], $ruta_destino_archivo);
		   }
		}

	    if (isset($archivo)): 
	     	if ($archivo_ok): 
	     		$datos = array(
	     			'cod_divisa' => strtoupper($this->input->post('cod_divisa')), 
					'com_divisa' => $this->input->post('com_divisa'), 
					'ven_divisa' => $this->input->post('ven_divisa'), 
					'nom_divisa' => $this->input->post('nom_divisa'),
	     			//'img' => $this->input->post('img') . "." . $extension,//IMAGEN
	     		);
	     		$this->divisas_model->save($datos);
	     		redirect(base_url('admin/Divisas'));
	     	else: 
	        	echo "<script>alert('Error al subir la imagen, El formato no es valido, debe tener extencion png');</script>";
	        	redirect('./admin/Divisas');
	    	endif; 
	 	endif;

		}else{
			redirect(base_url('login'));
		}
		
	}


}
