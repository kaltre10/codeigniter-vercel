<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operaciones extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('divisas_model', 'clientes_model', 'operaciones_model', 'ganancia_model', 'ent_sal_model', 'cierre_model', 'cuentas_model'));
		$this->load->helper(array('reporte/divisas', 'reporte/operaciones'));
	}

	public function index() {
		
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
		|| $this->session->userdata('rango') == 1) {
			
			$data = array(
				'divisas' => $this->divisas_model->getall(),
				'clientes' => $this->clientes_model->getall(),
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'cotizaciones' => $this->get_cotizacion()
			);
			
			$this->load->view('admin/operaciones', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function get_divisas() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
			|| $this->session->userdata('rango') == 1) {

			$divisas = $this->divisas_model->getall();
			echo json_encode($divisas);

		}else{
			redirect(base_url('login'));
		}
		
	}

	public function save_operacion() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
			|| $this->session->userdata('rango') == 1) {

			if (!$this->check_ganancia()) {

				$data = serialize($this->input->raw_input_stream);
	
				$data = explode('"', $data);

				//ajuste monto
				$monto = explode(':', $data[3]);
				$monto = explode(",", $monto[1]);
				$monto = $monto[0];

				//ajuste cotizacion
				$cotizacion = explode(':', $data[5]);
				$cotizacion = explode(",", $cotizacion[1]);
				$cotizacion = $cotizacion[0];

				//ajuste recibe
				$monto_recibe = explode(':', $data[7]);
				$monto_recibe = explode(",", $monto_recibe[1]);
				$monto_recibe = $monto_recibe[0];

				//ajuste gananciaTicket 
				if($data[32] == "gananciaTicket"){
					$gananciaTicket = explode(':', $data[33]);
					$gananciaTicket = explode(",", $gananciaTicket[1]);
					$gananciaTicket = $gananciaTicket[0];
				}
				if($data[36] == "gananciaTicket"){
					$gananciaTicket = explode(':', $data[37]);
					$gananciaTicket = explode(",", $gananciaTicket[1]);
					$gananciaTicket = $gananciaTicket[0];
				}
				if($data[30] == "gananciaTicket"){
					$gananciaTicket = explode(':', $data[31]);
					$gananciaTicket = explode(",", $gananciaTicket[1]);
					$gananciaTicket = $gananciaTicket[0];
				}
				

				if(!$data[26] != 0){
					$newData = array(
						'id_usuario' => $this->session->userdata('id'), 
						'tip_operacion' => $data[10], 
						'mon_operacion' => $monto, 
						'div_operacion' => $data[14], 
						'cot_operacion' => $cotizacion, 
						'rec_operacion' => $monto_recibe, 
						'mon_rec_operacion' => $data[18], 
						'cli_operacion' => $data[26], 
						'utilidad_emitida' => $gananciaTicket, 
					);
				}else{
					$newData = array(
						'id_usuario' => $this->session->userdata('id'), 
						'tip_operacion' => $data[10], 
						'mon_operacion' => $monto, 
						'div_operacion' => $data[14], 
						'cot_operacion' => $cotizacion, 
						'rec_operacion' => $monto_recibe, 
						'mon_rec_operacion' => $data[18], 
						'cli_operacion' => $data[30],
						'utilidad_emitida' => $gananciaTicket,  
					);
				}
				// echo json_encode($data);
				$this->operaciones_model->save($newData);
				// redirect('admin/Operaciones');

			}else{
				// echo "<button onclick='modal();'>modal</button>";
				redirect('admin/Operaciones?err');
			}
			//retornamos el id insertado
			echo json_encode($this->db->insert_id());
			// echo json_encode($data);
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function update_operacion(){
		$data = serialize($this->input->raw_input_stream);
		$queryData = explode('"', $data);
		$this->operaciones_model->update($queryData[1]);
		// echo json_encode($queryData[1]);
	}

	public function check_ganancia(){
		$fecha = date("Y-m-d");
		$check = $this->ganancia_model->get_check($fecha);
		return $check;
	}

	public function check_operacion_id(){
		$data = serialize($this->input->raw_input_stream);
		$id = explode('"', $data);
		$query = $this->operaciones_model->get_operacion($id[1]);
		echo json_encode($query[0]);
	}

	public function operacionesAll(){
		$data = serialize($this->input->raw_input_stream);
		$date = explode('"', $data);
		
		$query = array(
			'desde' => $date[4], 
			'hasta' => $date[8]
		);
		$queryDB = $this->operaciones_model->getall($date[4], $date[8]);
		echo json_encode($queryDB);
	}

	public function get_cotizacion(){

		$array_cotizacion = array();
		
		$desde = date("Y-m-d") . " 00:00:00";//ajustando la fecha para que tome todo el dia
		$hasta = date("Y-m-d") . " 23:59:59";//ajustando la fecha para que tome todo el dia
	
		$ent_sal = $this->ent_sal_model->getall($desde, $hasta);
		// $ent_sal = 0;
		$operaciones = $this->operaciones_model->getall($desde, $hasta);
		$divisas = $this->divisas_model->getall();
		$cuentas = $this->cuentas_model->getall();

		//reporte de divisas para calcular y guardar la cotizacion
		$array = operaciones_diarias($divisas, $operaciones, $ent_sal);
		$suma_gastos_compra = 0; 
		$cotizacion = 0;

		//CALCULAMOS DIA ANTERIOR QUE TENGA REGISTROS DE CIERRE
		$d = date("Y-m-d 00:00:00", strtotime('-1 day', time()));
		$h = date("Y-m-d 23:59:59", strtotime('-1 day', time()));
		$cierre = $this->cierre_model->getall($d, $h);	
		$i = 1;
		$suma = 0;

		$hay_datos = $this->cierre_model->get();
		if (!$cierre) {
			while (!$cierre && count($hay_datos) > 0 && $hay_datos[0]->fec_cierre != date('Y-m-d')) {
				$d = date("Y-m-d 00:00:00", strtotime("-$i day", time()));
				$h = date("Y-m-d 23:59:59", strtotime("-1 day", time()));
				$cierre = $this->cierre_model->getall($d, $h);
				$i++;	
			}
			
		
		}

		$ganancia = sumar_divisa($divisas, $operaciones, $ent_sal, $cuentas, $cierre);

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
		
		if(!$cierres){
			$cierres = 0;
		}
		
		$suma_gastos_compra = 0; 
		$porcentaje_anterior = 0;
		$porcentaje_actual = 0;
		$cot_anterior = 0; //peso del valor porcentual
		$cot_actual = 0; //peso del valor porcentual
		$index = 0;
		$cotizacion = 0;
		$cot = 0;

		foreach ($ganancia as $key){
		
			if ($key['caja'] == 0) {
				continue;
			}

			//asignamos primero la cotizacion registrada en el sistema
			$cot = $key["cotizacion"];
			
			if($cierres != 0){
				$last_date = $cierres[0][array_key_last($cierres)]->fec_cierre;

				$result = array_filter($cierres, function($a) {
				  return $a == $last_date;
				}, ARRAY_FILTER_USE_KEY);

			}else{
				$result = $cierres;
			}
			
			foreach ($result as $cie){
				
				if($cie[$index]->cod_divisa_cierre === $key["codigo"]){
					
				  foreach ($ope_cotizacion as $arr){
					
					//asignamos la cotizacion del cierre anterior si es la misma divisa 
					if($arr['codigo'] == $key["codigo"]){ 
						$cot = $cie[$index]->cot_cierre;
					}
					
					  if ( $arr['compras'] == 0){
						continue;
					  } 
					  if($arr['codigo'] == $key["codigo"]){

						$caja_sal_ent = 0;
						//salidas y entradas
						foreach($ent_sal as $ent){
	
							if($ent->cod_divisa == $key['codigo'] && $ent->tip_ent_sal == 'Entrada'){
						
								$caja_sal_ent = $caja_sal_ent + $ent->can_ent_sal;
								
							}
	
							if($ent->cod_divisa == $key['codigo'] && $ent->tip_ent_sal == 'Salida'){
										
								$caja_sal_ent = $caja_sal_ent - $ent->can_ent_sal; 
							
							}
	
						}

						$base = 100;
						if($arr['compras'] > 0){
						$porcentaje_anterior = ($cie[$index]->compra_cierre * $base)/($cie[$index]->compra_cierre + $arr['compras']);
						$porcentaje_actual = ($arr['compras'] * $base)/($cie[$index]->compra_cierre + $arr['compras']);
						$cot_anterior = ($cie[$index]->cot_cierre * $porcentaje_anterior) / $base;
						$cot_actual = (($arr['gastos_compra']/$arr['compras']) * $porcentaje_actual) / $base;
						$cot = $cot_anterior + $cot_actual;
						}

						//verificamos si ya se hizo el cierre del dia
						if($cie[$index]->fec_cierre == date('Y-m-d')){
						  $cot = $cie[$index]->cot_cierre;
						}
						
					  }
					 
				  }
				
				}
				
				//si no hay compras en el dia y la cotizacion es 0 se iguala al cierre anterior
				if(!$cot){
			 
				  $cot = $cie[$index]->cot_cierre;
				  
				}
				
				$index++;
			  }
	  
			 
			  //si la divisa es soles igualamos a 1 la cotizacion
			  if($key['codigo'] === 'PEN'){
				$cot = 1;
			  } 
			 
			 //si no hay cierre anterior(primer dia)
			if($cierres === 0){
				
			  $cot = $key["cotizacion"];
			  foreach ($ope_cotizacion as $arr){
		
				if ( $arr['compras'] == 0){

				  continue;
				} 
			
				if($arr['codigo'] == $key["codigo"] && $key["cotizacion"] > 0){
				
				  $cot = str_pad(round($arr['gastos_compra'] / $arr['compras'] , 4), 4);
				}
			  }
			 
			}
			// echo $cot . "-" . $key['codigo'] . "<br>";
			array_push($array_cotizacion, array('codigo' => $key['codigo'], 'cotizacion' => $cot));
		}
		// print_r($array_cotizacion);
		return $array_cotizacion;
	}

}
