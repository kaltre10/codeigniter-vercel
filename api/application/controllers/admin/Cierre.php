<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cierre extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('session');
		$this->load->model(array('operaciones_model', 'divisas_model', 'ent_sal_model', 'cierre_model', 'cuentas_model', 'ganancia_model'));
		$this->load->helper(array('reporte/divisas', 'reporte/operaciones'));
	}

	public function save_cierre() {

		if ($this->session->userdata('isLogged') && $this->session->userdata('rango') == 0) {

			$desde = date("Y-m-d") . " 00:00:00";//ajustando la fecha para que tome todo el dia
			$hasta = date("Y-m-d") . " 23:59:59";//ajustando la fecha para que tome todo el dia
		
			$ent_sal = $this->ent_sal_model->getall($desde, $hasta);
			$operaciones = $this->operaciones_model->getall($desde, $hasta);
			$divisas = $this->divisas_model->getall();
			$cuentas = $this->cuentas_model->getall();

			//reporte de divisas para calcular y guardar la cotizacion
			$array = operaciones_diarias($divisas, $operaciones, $ent_sal);
			$suma_gastos_compra = 0; 
			$cotizacion = 0;

			//DIA ANTERIOR
			$d = date("Y-m-d 00:00:00", strtotime('-1 day', time()));
			$h = date("Y-m-d 23:59:59", strtotime('-1 day', time()));
			$cierre = $this->cierre_model->getall($d, $h);
			$i = 1;
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
			$compra_divisa = 0;
			$venta_divisa = 0;
			
			foreach ($ganancia as $key) {
				
				if ($key['caja'] == 0) {
					continue;
				} 
				
				//asignamos primero la cotizacion registrada en el sistema
				$cot = $key['cotizacion'];
				
				if (!$this->cierre_model->get_check(date("Y-m-d"), $key['codigo'])) {
					
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
						
						
						// if($cie[$index]->cod_divisa_cierre === $key['codigo']){
						
						foreach ($ope_cotizacion as $arr){
							// echo  "<br>". $cot. "-".  $key["codigo"] . "<br>";
							
							//asignamos la cotizacion del cierre anterior si es la misma divisa 
							// echo $arr['codigo'] . "-" .$cie[$index]->cod_divisa_cierre."-".$key["codigo"]."<br>";
						
							if($arr['codigo'] == $cie[$index]->cod_divisa_cierre && $key['codigo'] == $arr['codigo']){ 
								$cot = $cie[$index]->cot_cierre;
							
								if ( $arr['compras'] == 0 && $key["caja"] == 0){
									continue;
								} 
								//   if($arr['codigo'] == $key["codigo"]){
									
								// 	$caja_sal_ent = 0;
							
								// 	//salidas y entradas
								foreach($ent_sal as $ent){
			
									if($ent->cod_divisa == $key['codigo'] && $ent->tip_ent_sal == 'Entrada'){
								
										$caja_sal_ent = $caja_sal_ent + $ent->can_ent_sal;
										
									}
			
									if($ent->cod_divisa == $key['codigo'] && $ent->tip_ent_sal == 'Salida'){
												
										$caja_sal_ent = $caja_sal_ent - $ent->can_ent_sal; 
									
									}
			
								}
		

								
								
								//formula calcular cotizacion
								//cantidad_cierre_anterior * 100 / cantidad _total;
								
								// $porcentaje_compra_anterior = ($cie[$index]->can_cierre * 100) / ((($key['caja'] + $arr['ventas']) - $caja_sal_ent));
								// $peso_anterior = $porcentaje_compra_anterior * $cie[$index]->cot_cierre;
								
								// $cotizacion = str_pad(round($arr['gastos_compra'] / $arr['compras'] , 4), 4);
								// $porcentaje_compra = ($arr['compras'] * 100) /((($key['caja'] + $arr['ventas']) - $caja_sal_ent));
								// $peso = $cotizacion * $porcentaje_compra;
								
								// $cot =  ($peso_anterior + $peso) / 100;
								$base = 100;
								if($arr['compras'] > 0){
									
									
									$porcentaje_anterior = ($cie[$index]->compra_cierre * $base)/($cie[$index]->compra_cierre + $arr['compras']);
									$porcentaje_actual = ($arr['compras'] * $base)/($cie[$index]->compra_cierre + $arr['compras']);
									$cot_anterior = ($cie[$index]->cot_cierre * $porcentaje_anterior) / $base;
									$cot_actual = (($arr['gastos_compra']/$arr['compras']) * $porcentaje_actual) / $base;
									
									$cot = $cot_anterior + $cot_actual;
									
									$compra_divisa = $arr['compras'];
									$venta_divisa = $arr['ventas'];
								}
								
				
								
								
							}
							// print_r($arr);
						}
						// echo $key['codigo']."-".$arr['compras']."-".$cot."<br>";
						

					
						//si no hay compras en el dia y la cotizacion es 0 se iguala al cierre anterior
						// $last_date_cierre = $cierres[0][0]->fec_cierre;
						// print_r($last_date_cierre);
						foreach($cie as $c){

						//   foreach($registro_cotizacion as $reg){  
							 
							  if($c->cod_divisa_cierre == $key["codigo"] && $arr['compras'] == 0){
								// echo $cot ."-" .$c->cot_cierre . "-".$key["codigo"]."-". $c->cod_divisa_cierre . "-". $cie[$index]->cod_divisa_cierre ."-".$reg['codigo'] ."<br>";
								  $cot = $c->cot_cierre;
								  
							  }else{
								// if($c->cod_divisa_cierre == $key["codigo"] && $arr['compras'] == 0){
									//si se ha comprado y no hay cierre de esta moneda
									$verify = array_filter($cie, function($a) {
										return $a == $arr['codigo'];
									  }, ARRAY_FILTER_USE_KEY);

									
									if(!$verify || $key["codigo"] == "EUR"){
										// print_r($verify);
										$cot = $key["cotizacion"];
									}else{
										
										// echo "nel"."-".$cot."<br>";
									}
									// echo $cot ."-" .$c->cot_cierre . "-".$key["codigo"]."-". $c->cod_divisa_cierre . "-". $cie[$index]->cod_divisa_cierre ."-".$reg['codigo'] ."<br>";
									// echo "no hay " .$key["codigo"]."-".$key["cotizacion"]."<br>";
								// }
								// print_r($key);
								
							  }

							//   echo $cot ."-" .$c->cot_cierre . "-".$key["codigo"]."-". $c->cod_divisa_cierre . "-". $cie[$index]->cod_divisa_cierre ."-".$reg['codigo'] ."<br>";
						   
						//   }
						  
						}
						// echo $cot ."-" .$c->cot_cierre . "-".$key["codigo"]."-". $c->cod_divisa_cierre . "-". $cie[$index]->cod_divisa_cierre ."-".$reg['codigo'] ."<br>";   
						

						//verificamos si ya se hizo el cierre del dia
						
						// if($cie[$index]->fec_cierre == date('Y-m-d')){ 	
						  
						//   foreach ($cie as $c){  
							
						// 	if($c->cod_divisa_cierre == $key["codigo"] && $reg['codigo'] == $c->cod_divisa_cierre){
							  
							 
						// 	  $cot = $c->cot_cierre;
						// 	}
						//   }
						// }
					}
					

						//si no hay compras en el dia y la cotizacion es 0 se iguala al cierre anterior
						if(!$cot){
							// echo $cot ."-".$key["codigo"] . "-".$c->cot_cierre . "-". $c->cod_divisa_cierre . "-". $cie[$index]->cod_divisa_cierre ."-".$reg['codigo'] ."<br>"; 
							$cot = $cie[$index]->cot_cierre;	
						}
					
						//si la divisa es soles igualamos a 1 la cotizacion
						if($key['codigo'] == 'PEN'){
							$cot = 1;
						} 
						
						$index++;
					// }

					
					
					//si no hay cierre anterior(primer dia)		
					// if($cierres === 0){ 
					// 	$cot = $key["cotizacion"];
					// 	foreach ($ope_cotizacion as $arr){
							
					// 		if ( $arr['compras'] == 0){
					// 			continue;
					// 		} 
					// 		if($arr['codigo'] == $key["codigo"] && $key["cotizacion"] > 0){
					// 			$cot = str_pad(round($arr['gastos_compra'] / $arr['compras'] , 4), 4);
					// 			$compra_divisa = $arr['compras'];
					// 			$venta_divisa = $arr['ventas'];
					// 		}
					// 	}
						
					// }
					
					if($key['codigo'] == 'PEN'){
						$compra_divisa = 0;
						$venta_divisa = 0;
						$cot = 1;
					} 

					
					
					$data = array(
						'cod_divisa_cierre' => $key['codigo'],
						'nom_divisa_cierre' => $key['nombre'],
						'cot_cierre' => $cot,
						'can_cierre' => $key["caja"],
						'compra_cierre' => $compra_divisa,
						'venta_cierre' => $venta_divisa,
						'fec_cierre' => date("Y-m-d"),
					);
							
					$datos = array(
						'can_ganancia' => $this->ganancia(), 
						'fec_ganancia' => date("Y-m-d"),
					);

					// echo $this->ganancia() . "<br>";
					// echo $compra_divisa . "<br>";
					// echo $venta_divisa . "<br>";
					// print_r($data);
					// return;
					
					if (!$this->check_ganancia()) {

						$this->ganancia_model->save($datos);

					}
					
					$this->cierre_model->save($data);

				
				}

			}			 
				
		
			// return;
					
			// 		}else{

			// 			// echo "<script>cierre_ejecutado();</script>";
	
			// 		}
	
			// 	}
				
			// }
		redirect(base_url('admin/Admin_dashboard?err'));
			
		}else{
			redirect(base_url('login'));
		}
		
	}

	public function get_cierre(){
	
			//CALCULAMOS DIA ANTERIOR QUE TENGA REGISTROS DE CIERRE
			$d = date("Y-m-d 00:00:00", strtotime('-1 day', time()));
			$h = date("Y-m-d 23:59:59", strtotime('-1 day', time()));
			$cierre = $this->cierre_model->getall($d, $h);	
			$i = 1;
			$suma_total = 0;
			$suma = 0;
			$hay_datos = $this->cierre_model->get();
			if (!$cierre) {
			while (!$cierre && count($hay_datos) > 0 && $hay_datos[0]->fec_cierre != date('Y-m-d')) {
					$d = date("Y-m-d 00:00:00", strtotime("-$i day", time()));
					$h = date("Y-m-d 23:59:59", strtotime("-1 day", time()));
					$cierre = $this->cierre_model->getall($d, $h);
					$i++;	
				}
			
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

	public function get_reporte(){
		
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
					
					if($cierreDay){
						array_push($cierres, $cierreDay);
					}

					$index++;
					
				} while ($row[0] != $d && count($cierres) <= 5);
			}
		
			$ope_cotizacion = operaciones_diarias($divisas, $operaciones, $ent_sal);
			
			if(!$cierres){
				$cierres = 0;
			}

	 
			// $porcentaje_compra_anterior = 0;
			// $porcentaje_compra = 0;
			// $peso_anterior = 0; //peso del valor porcentual
			// $peso = 0; //peso del valor porcentual
			
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
					// echo "cotizacion2:". $key['codigo']."-".$cie[$index]->cot_cierre. "-".$cie[$index]->cod_divisa_cierre."-".$cot ."<br>";
					if($cie[$index]->cod_divisa_cierre === $key["codigo"]){
						
					  foreach ($ope_cotizacion as $arr){
						
						//asignamos la cotizacion del cierre anterior si es la misma divisa 
						if($arr['codigo'] == $key["codigo"]){ 
							$cot = $cie[$index]->cot_cierre;
						}
						
						  if ( $arr['compras'] == 0 && $key["caja"] == 0){
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
							
							//formula calcular cotizacion
							//cantidad_cierre_anterior * 100 / cantidad _total;
							// $porcentaje_compra_anterior = ($cie[$index]->can_cierre * 100) / ((($key['caja'] + $arr['ventas']) - $caja_sal_ent));
							// $peso_anterior = $porcentaje_compra_anterior * $cie[$index]->cot_cierre;
							
							// $cotizacion = str_pad(round($arr['gastos_compra'] / $arr['compras'] , 4), 4);
							// $porcentaje_compra = ($arr['compras'] * 100) /((($key['caja'] + $arr['ventas']) - $caja_sal_ent));
							// $peso = $cotizacion * $porcentaje_compra;
							
							// $cot =  ($peso_anterior + $peso) / 100;

							$base = 100;
							if($arr['compras'] > 0){
							$porcentaje_anterior = ($cie[$index]->compra_cierre * $base)/($cie[$index]->compra_cierre + $arr['compras']);
							$porcentaje_actual = ($arr['compras'] * $base)/($cie[$index]->compra_cierre + $arr['compras']);
							$cot_anterior = ($cie[$index]->cot_cierre * $porcentaje_anterior) / $base;
							$cot_actual = (($arr['gastos_compra']/$arr['compras']) * $porcentaje_actual) / $base;
							$cot = $cot_anterior + $cot_actual;
							}
							
							// echo "cotizacion2:". $cot . "<br>";
						  }
						 
					  }
					  
					  //si no hay compras en el dia y la cotizacion es 0 se iguala al cierre anterior
					  $last_date_cierre = $cierres[0][0]->fec_cierre;
                       
					  foreach($cie as $c){
					   
												  // echo $key["codigo"] . "-" . $key["codigo"] . "-" . $c->cod_divisa_cierre . "-" . $c->fec_cierre . "-" .  $c->cot_cierre . "<br/>";
						foreach($registro_cotizacion as $reg){  
						  // echo $cot ."-".$c->cot_cierre ."<br>"; 
						  // if($reg['codigo'] == $key["codigo"] && $c->cod_divisa_cierre == $key["codigo"] && $c->fec_cierre == $last_date_cierre && $reg['compras'] == 0){   
							
							if($reg['codigo'] == $key["codigo"] && $c->cod_divisa_cierre == $key["codigo"] && $c->fec_cierre == $last_date_cierre && $reg['compras'] > 0){   
							 
							  $cot = $c->cot_cierre;
							}
						 
						}
						
					  }
					 
					  //verificamos si ya se hizo el cierre del dia
					  
					  if($cie[$index]->fec_cierre == date('Y-m-d')){ 	
						
						foreach ($cie as $c){  
						
						  if($c->cod_divisa_cierre == $key["codigo"] && $reg['codigo'] == $c->cod_divisa_cierre){
							
							
							$cot = $c->cot_cierre;
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
				
				if ($key['codigo'] == 'PEN' ) {
					$suma = $suma + $key['caja']; 
				}
				if ($key['codigo'] != 'PEN') {
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
		
		//verificamos que no sea negativo
		// if($suma < 0) $suma = 0;
		// echo $suma . "<br>";
		// return;
		return $suma;
	}

	public function ganancia(){
		$cierre = $this->get_cierre();
		$reporte_dia = $this->get_reporte();
		// echo $cierre;
		// echo $reporte_dia;
		// return;
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

	public function check_ganancia(){
		$fecha = date("Y-m-d");
		$check = $this->ganancia_model->get_check($fecha);
		return $check;
	}

	public function anular_cierre(){
		$fecha = date("Y-m-d");
		$this->cierre_model->anular($fecha);
		$this->ganancia_model->anular($fecha);
		redirect(base_url('admin/Admin_dashboard'));
	}

}
