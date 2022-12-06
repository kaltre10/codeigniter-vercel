<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_general extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('operaciones_model', 'divisas_model', 'ent_sal_model', 'cierre_model', 'cuentas_model'));
		$this->load->helper(array('reporte/divisas', 'reporte/fecha_cierre', 'reporte/operaciones'));
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
		|| $this->session->userdata('rango') == 1) {

		if ($this->input->post('desde')) {

			$desde = $this->input->post('desde') . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = $this->input->post('desde') . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}else{
			$desde = date("Y-m-d") . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = date("Y-m-d") . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}

			$ent_sal = $this->ent_sal_model->getall($desde, $desde);
			$operaciones = $this->operaciones_model->getall($desde, $hasta);
			$divisas = $this->divisas_model->getall();
			$cuentas = $this->cuentas_model->getall();
			$hay_datos  = $this->cierre_model->get();
			$var = count($hay_datos) - 1; //optener ultimo registro de cierre
			$i = 0;
			if ($this->input->post('desde') && $this->input->post('desde') != date('Y-m-d')) {
				$d = $this->input->post('desde');
				$h = $this->input->post('desde');
				$cierre = $this->cierre_model->getall($d, $h);
				if (!$cierre) {
					while (!$cierre && count($hay_datos) > 0 && $hay_datos[$var]->fec_cierre != date('Y-m-d')) {
							
							$d = date("Y-m-d", strtotime("-$i day", time()));
						    $h = date("Y-m-d", strtotime("-$i day", time()));
						    $cierre = $this->cierre_model->getall($d, $h);
							$i++;
						}
				}
				$array = [];
				foreach ($cierre as $c) {
					$datos_divisas = array(
						'codigo' => $c->cod_divisa_cierre,
						'nombre' => $c->nom_divisa_cierre,
					    'caja' => $c->can_cierre,
					    'cotizacion' => $c->cot_cierre
					);
					array_push($array, $datos_divisas);
				}

				//calculo de los 5 ultimos cierres
				$index = 0;
				$cierres = [];
				if(count($hay_datos) > 0){
					$row = array_column($hay_datos, 'fec_cierre'); //primer registro 
					$row[0]; //primera fecha del cierre insertado para detener el while
					do {
						$d = date("Y-m-d", strtotime("-$index day", time()));
						$h = date("Y-m-d", strtotime("-$index day", time()));
						$cierreDay = $this->cierre_model->getall($d, $h);
						
						if($cierreDay){;
							array_push($cierres, $cierreDay);
						}

						$index++;
						
					} while ($row[0] != $d && count($cierres) <= 5);
				}
		
				$ope_cotizacion = operaciones_diarias($divisas, $operaciones, $ent_sal);
				
			}

			//si post es la misma fecha del dia se elimina para calcular el mismo dia correctamente
			if ($this->input->post('desde') == date('Y-m-d')) {
				$fecha_post = null;
			}else{
				$fecha_post = $this->input->post('desde');
			}

			if (empty($fecha_post)) {
				//CALCULAMOS DIA ANTERIOR QUE TENGA REGISTROS DE CIERRE
				$d = date("Y-m-d", strtotime("-1 day", time()));
				$h = date("Y-m-d");

				$cierre = $this->cierre_model->getall($desde, $hasta);
				$ent_sal = $this->ent_sal_model->getall($desde, $hasta);
				
				$i = 0; 
				if (!$cierre) {
					// echo $hay_datos[$var]->fec_cierre;
					do {
						$i++;
						$d = date("Y-m-d", strtotime("-$i day", time()));
						$i--;
					    $h = date("Y-m-d", strtotime("-$i day", time()));
					    $cierre = $this->cierre_model->getall($d, $h);
						$i++;
					} while (!$cierre && count($hay_datos) > 0 && $hay_datos[$var]->fec_cierre != date('Y-m-d'));
					// print_r($cierre);
				}
				
				$array = sumar_divisa($divisas, $operaciones, $ent_sal, $cuentas, $cierre);

				//calculo de los 5 ultimos cierres
				$index = 0;
				$cierres = [];
				if(count($hay_datos) > 0){
					$row = array_column($hay_datos, 'fec_cierre'); //primer registro 
					$row[0]; //primera fecha del cierre insertado para detener el while
					do {
					    $d = date("Y-m-d", strtotime("-$index day", time()));
					    $h = date("Y-m-d", strtotime("-$index day", time()));
					    $cierreDay = $this->cierre_model->getall($d, $h);
						
						if($cierreDay){;
							array_push($cierres, $cierreDay);
						}

						$index++;
					    
					} while ($row[0] != $d && count($cierres) <= 5);
				}
				// var_dump($cierres);
				$ope_cotizacion = operaciones_diarias($divisas, $operaciones, $ent_sal);
			}

			if(!$cierres){
				$cierres = 0;
			}
	


			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'ent_sal' => $ent_sal,
				'operaciones' => $operaciones,
				'divisas' => $array,
				'registro_cotizacion' => $ope_cotizacion,
				'cierre' => $cierre,
				'cierres' => $cierres,
			);

			$this->load->view('admin/Reporte_general', $data);
			
		}else{
			redirect(base_url('login'));
		}
		
	}

}
