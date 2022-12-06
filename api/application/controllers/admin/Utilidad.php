<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilidad extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('operaciones_model', 'ent_sal_model', 'divisas_model', 'cierre_model', 'cuentas_model', 'ganancia_model'));
		$this->load->helper(array('reporte/divisas', 'reporte/fecha_cierre', 'gastos_operaciones', 'reporte/operaciones'));
	}

	public function index() {
		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0
		|| $this->session->userdata('rango') == 1) {

		$gastos = $this->gastos();

		if ($this->input->post('desde') /*&& $this->input->post('hasta')*/) {
			$desde = $this->input->post('desde') . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = $this->input->post('hasta') . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}else{
			$desde = date("Y-m-d") . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = date("Y-m-d") . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}

		$desdeDays = date("Y-m-d",strtotime($desde."+" . '0' . "days")). " 00:00:00";
		$hastaDays = date("Y-m-d",strtotime($desdeDays."+" . '0' . "days")). " 23:59:59";
		$arrayDays = [];
		$gananciaTotal = $this->ganancia_model->get_date(date("Y-m-d",strtotime($desde)), date("Y-m-d",strtotime($hasta)));
		$ent_salTotal = $this->ent_sal_model->getall($desde, $hasta);
		// $arrayFechas = [];
		
		for($i = 0; strtotime($desdeDays) <= strtotime($hasta); $i++){
			
			$ent_salData = $this->ent_sal_model->getall($desdeDays, $hastaDays);
			$ganancias = $this->ganancia_model->get_date(date("Y-m-d",strtotime($desdeDays)), date("Y-m-d",strtotime($hastaDays)));
			// $operacionesData = $this->operaciones_model->getall($desdeDays, $hastaDays);
			// $gastos = gastos_operaciones($desdeDays, $hastaDays);
			
			$f = 0;
			
			foreach ($gananciaTotal as $g){
				
				

				$check = false;
				foreach($arrayDays as $a){
					
					if($a['fecha'] == $g->fec_ganancia){
						$check = true;
					}
				}

				if(!$check){

					$suma_gasto = 0;
					foreach ($ent_salTotal as $row){

						// echo date("Y-m-d",strtotime($g->fec_ganancia)) . " // ";
						// echo date("Y-m-d",strtotime($row->fec_ent_sal)). "<br>";
						
						if($row->tip_ent_sal != 'Salida'){
							continue;
						}
						
						
						
						

						if(
							date("Y-m-d",strtotime($g->fec_ganancia)) == 
							date("Y-m-d",strtotime($row->fec_ent_sal))
							
							){

								// echo $row->can_ent_sal . "-" . $row->tip_ent_sal  . "-" . $row->cod_divisa . "-"  . $g->fec_ganancia . "<br>";

							if($row->cod_divisa != 'PEN'){
								$row->can_ent_sal = $row->can_ent_sal * $row->com_divisa;
								
							}
							
								
							$suma_gasto = $suma_gasto + $row->can_ent_sal;
							
						}
						
					}
					
					$dataPush = array(
						//'tipo' => $row->tip_ent_sal,
						'gasto' => $suma_gasto,
						'ganancia' => $g->can_ganancia,
						'fecha' => $g->fec_ganancia,
					);
					array_push($arrayDays, $dataPush);
				}
				
				$f++;
			}
			$desdeDays = date("Y-m-d",strtotime($desdeDays."+" . '1' . "days")). " 00:00:00"; 
			$hastaDays = date("Y-m-d",strtotime($desdeDays."+" . '0' . "days")). " 23:59:59";
			
		}
		
			$data = array(
				'header' => $this->load->view('admin/header','',TRUE),
				'footer' => $this->load->view('admin/footer','',TRUE),
				'gastos' => $gastos['suma_gastos'], //LLAMAMOS AL METODO
				'ganancia' => $this->ganancia(),
				'nav' => $this->load->view('admin/nav','',TRUE),
				'dataDays' => $arrayDays
			);
			// print_r($data);
			$this->load->view('admin/utilidad', $data);
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function ganancia(){
		$cierre = $this->get_cierre();
		$reporte_dia = $this->get_reporte();
		// echo $cierre . "<br>";
		// echo $reporte_dia . "<br>";
		
		if ($cierre > $reporte_dia) {
			$ganancia = $cierre - $reporte_dia;
		}else{
			$ganancia = $reporte_dia - $cierre;
		}
		if ($ganancia) {
			return str_pad(round($ganancia, 2), 2);
		}else{
			$ganancia = 0;
			return $ganancia;
		}

	}

	public function get_reporte(){
		
		if ($this->input->post('desde') && $this->input->post('hasta')) {
			$desde = $this->input->post('desde') . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = $this->input->post('hasta') . " 23:59:59";//ajustando la fecha para que tome todo el dia

		}else{
			$desde = date("Y-m-d") . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = date("Y-m-d") . " 23:59:59";//ajustando la fecha para que tome todo el dia
		}


		$ent_sal = $this->ent_sal_model->getall($desde, $hasta);
		// $ent_sal = 0;
		$operaciones = $this->operaciones_model->getall($desde, $hasta);
		$divisas = $this->divisas_model->getall();
		$cuentas = $this->cuentas_model->getall();

		//reporte de divisas para calcular y guardar la cotizacion
		// $array = operaciones_diarias($divisas, $operaciones, $ent_sal);
		// $suma_gastos_compra = 0; 
		// $cotizacion = 0;

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
		//$row[0]; //primera fecha del cierre insertado para detener el while
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

	if(!$cierres){
		$cierres = 0;
	}
 
	// $peso_anterior = 0; //peso del valor porcentual
	// $peso = 0; //peso del valor porcentual
	// $index = 0;
	$divisas = $this->divisas_model->getall();

	$suma = 0;
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
					// foreach($ent_sal as $ent){

					// 	//verificamos que no este anulado
					// 	if($ent->sta_ent_sal == 0){
					// 		continue;
					// 	}
  
					// 	if($ent->cod_divisa == $key['codigo'] && $ent->tip_ent_sal == 'Entrada'){
					  
					// 		$caja_sal_ent = $caja_sal_ent + $ent->can_ent_sal;
							 
					// 	  }

					// 	  if($ent->cod_divisa == $key['codigo'] && $ent->tip_ent_sal == 'Salida'){
									
					// 		$caja_sal_ent = $caja_sal_ent - $ent->can_ent_sal; 
						   
					// 	  }

					// }

					//formula calcular cotizacion
					//cantidad_cierre_anterior * 100 / cantidad _total;
					// $porcentaje_compra_anterior = ($cie[$index]->can_cierre * 100) / ((($key['caja'] + $arr['ventas']) - $caja_sal_ent));
					// $peso_anterior = $porcentaje_compra_anterior * $cie[$index]->cot_cierre;
					
					// $cotizacion = str_pad(round($arr['gastos_compra'] / $arr['compras'] , 6), 6);
					// $porcentaje_compra = ($arr['compras'] * 100) /((($key['caja'] + $arr['ventas']) - $caja_sal_ent));
					// $peso = $cotizacion * $porcentaje_compra;
					
					// $cot =  ($peso_anterior + $peso) / 100;

					$base = 100;
					$porcentaje_anterior = ($cie[$index]->compra_cierre * $base)/($cie[$index]->compra_cierre + $arr['compras']);
					$porcentaje_actual = ($arr['compras'] * $base)/($cie[$index]->compra_cierre + $arr['compras']);
					$cot_anterior = ($cie[$index]->cot_cierre * $porcentaje_anterior) / $base;
					$cot_actual = (($arr['gastos_compra']/$arr['compras']) * $porcentaje_actual) / $base;
					$cot = $cot_anterior + $cot_actual;
					// echo  $arr['compras'] . "<br>"; 
				  }
			  }
			
			}
			

			//si no hay compras en el dia y la cotizacion es 0 se iguala al cierre anterior
			$last_date_cierre = $cierres[0][0]->fec_cierre;
			foreach($cie as $c){
			  foreach($ope_cotizacion as $reg){                           
				if($reg['codigo'] == $key["codigo"] && $c->cod_divisa_cierre == $key["codigo"] && $c->fec_cierre == $last_date_cierre && $reg['compras'] == 0){
				  $cot = $c->cot_cierre;
				}
			  }
			}

			 //verificamos si ya se hizo el cierre del dia
			 if($cie[$index]->fec_cierre == date('Y-m-d')){       
				foreach ($cie as $c){       
				  if($c->cod_divisa_cierre == $key["codigo"]){
					$cot = $c->cot_cierre;
				  }
				}
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
			
			  $cot = str_pad(round($arr['gastos_compra'] / $arr['compras'] , 6), 6);
			}
		  }

		}

		
		if ($key['codigo'] == 'PEN' ) {
		
			$suma = $suma + $key['caja']; 
		}
	
		if ($key['codigo'] != 'PEN' ) {
			
			$suma = $suma + $key['caja'] * $cot; 
		
		}
		
				
		//restamos las entradas a la caja para no sumarlo a la ganancia
		foreach($ent_sal as $ent){
			// echo $key['caja']. "- ".$cot. "-" .$suma . "-". $ent->can_ent_sal . "<br>";

			//verificamos que no este anulado
			if($ent->sta_ent_sal == 0){
				continue;
			}

			if($ent->cod_divisa == $key['codigo'] && $ent->tip_ent_sal == 'Entrada'){
				
				if ($ent->cod_divisa == 'PEN') {
					$suma = $suma - $ent->can_ent_sal; 
				}
				if ($ent->cod_divisa != 'PEN') {
					$suma = $suma - ($ent->can_ent_sal * $cot); 
					
				}
				
			}
			
			if($ent->cod_divisa == $key['codigo'] && $ent->tip_ent_sal == 'Salida'){
			
				if ($ent->cod_divisa == 'PEN' ) {
					$suma = $suma + $ent->can_ent_sal; 
					
				}
				if ($ent->cod_divisa != 'PEN') {
					
					$suma = $suma + ($ent->can_ent_sal * $cot); 
					
				}
				
			}
			
		}
	}
	

	return $suma;

}

public function get_cierre(){
	//CALCULAMOS DIA ANTERIOR QUE TENGA REGISTROS DE CIERRE
	$d = date("Y-m-d 00:00:00", strtotime('-1 day', time()));
	$h = date("Y-m-d 23:59:59", strtotime('-1 day', time()));
	$cierre = $this->cierre_model->getall($d, $h);	
	$i = 1;
	//Verificamos si existe datos en la BD tabla cierre
	$hay_datos = $this->cierre_model->get();
	$suma_total = 0;

	if (!$cierre) {

		while (!$cierre && count($hay_datos) > 0 && $hay_datos[0]->fec_cierre != date('Y-m-d') ) {

			$d = date("Y-m-d 00:00:00", strtotime("-$i day", time()));
			$h = date("Y-m-d 23:59:59", strtotime("-1 day", time()));

			$cierre = $this->cierre_model->getall($d, $h);
	
			$i++;
			// // $hay_datos[0]->fec_cierre
			// var_dump(date('Y-m-d'));
			// exit;
		}
		
		$suma = 0;
		foreach ($cierre as $key) {
			

			if ($key->cod_divisa_cierre == 'PEN') {
				$suma_total = $suma_total + $key->can_cierre;
			}
			if ($key->cod_divisa_cierre != 'PEN') {
				$divisas = $this->divisas_model->getall();
				foreach ($divisas as $divisa) {
					if ($divisa->cod_divisa == $key->cod_divisa_cierre) {
						$suma = $key->can_cierre * $key->cot_cierre;
					}	
				}
				$suma_total = $suma_total + $suma;
			}
		}
	}


	return $suma_total;
	
}

public function gastos(){

	if ($this->input->post('desde') && $this->input->post('hasta')) {
		$desde = $this->input->post('desde') . " 00:00:00";//ajustando la fecha para que tome todo el dia
		$hasta = $this->input->post('hasta') . " 23:59:59";//ajustando la fecha para que tome todo el dia

	}else{
		$desde = date("Y-m-d") . " 00:00:00";//ajustando la fecha para que tome todo el dia
		$hasta = date("Y-m-d") . " 23:59:59";//ajustando la fecha para que tome todo el dia
	}


	$divisas = $this->divisas_model->getall();
	//CONSULTA DB DE LAS ENTRADAS Y SALIDAS DEL DIA
	$gastos = $this->ent_sal_model->getall($desde, $hasta);
	$suma_gastos = 0;
	$suma = 0;
	foreach ($gastos as $gasto) {

		if ($gasto->sta_ent_sal == 1 && $gasto->tip_ent_sal == "Salida" && $gasto->cod_divisa == "PEN") {
			  $suma_gastos = $suma_gastos + $gasto->can_ent_sal; 
		}  
		if ($gasto->cod_divisa != "PEN" && $gasto->sta_ent_sal == 1 && $gasto->tip_ent_sal == "Salida") {
			foreach ($divisas as $divisa) {

				if ($divisa->cod_divisa == $gasto->cod_divisa) {
					$suma_gastos = $suma_gastos + ($gasto->can_ent_sal * $divisa->com_divisa);
				}
				
			}

		}
	}
	$datos = array(
				'suma_gastos' => $suma_gastos,
			);
	if ($datos) {
		return $datos;
	}else{
		$datos = 0;
		return $datos;
	}
}

}
