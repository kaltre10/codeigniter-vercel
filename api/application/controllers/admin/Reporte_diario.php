<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_diario extends CI_Controller {

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
			$hasta = $this->input->post('hasta') . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}else{
			$desde = date("Y-m-d") . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = date("Y-m-d") . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}

			$ent_sal = $this->ent_sal_model->getall($desde, $hasta);
			$operaciones = $this->operaciones_model->getall($desde, $hasta);
			$divisas = $this->divisas_model->getall();
			$array = operaciones_diarias($divisas, $operaciones, $ent_sal);



			$desdeDays = date("Y-m-d",strtotime($desde."+" . '0' . "days")). " 00:00:00"; ; 
			$hastaDays = date("Y-m-d",strtotime($desdeDays."+" . '0' . "days")). " 23:59:59";
			$arrayDays = [];
			$arrayFechas = [];

			for($i = 0; strtotime($desdeDays) <= strtotime($hasta); $i++){
				$ent_salData = $this->ent_sal_model->getall($desdeDays, $hastaDays);
				$operacionesData = $this->operaciones_model->getall($desdeDays, $hastaDays);
				$data = operaciones_diarias($divisas, $operacionesData, $ent_salDatant_sal);

				foreach ($data as $row){
					// print_r($arrayDays[$i]);
					// print_r($desdeDays);
					

					if ( $row['compras'] == 0 && $row['ventas'] == 0 ){
						continue;
					}
				
					$dataPush = array(
						'codigo' => $row['codigo'],
						'nombre' => $row['nombre'],
						'compras' => $row['compras'],
						'gastos_compra' => $row['gastos_compra'],
						'ventas' => $row['ventas'],
						'gastos_venta' => $row['gastos_venta'],
						'fecha' => $desdeDays
					);
					array_push($arrayDays, $dataPush);
					array_push($arrayFechas, $desdeDays);
				}
				
				$desdeDays = date("Y-m-d",strtotime($desdeDays."+" . '1' . "days")). " 00:00:00"; 
				$hastaDays = date("Y-m-d",strtotime($desdeDays."+" . '0' . "days")). " 23:59:59";
				
			}

			// print_r($arrayDays);

			
			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'ent_sal' => $ent_sal,
				'operaciones' => $operaciones,
				'divisas' => $array,
				'arrayDays' => $arrayDays, 
				'arrayFechas' => $arrayFechas 
			);

			$this->load->view('admin/Reporte_diario', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}
}
