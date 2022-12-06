<?php 
	
	function sumar_divisa($divisas, $operaciones, $ent_sal, $cuentas, $cierre){
		// print_r($cierre);
		$i = 0;
		$cod_divisa = [];
		$array = [];
		foreach ($divisas as $divisa) {
			$cod_divisa[$i] = $divisa->cod_divisa;
			$caja_compras_entrada = 0;
			
			foreach ($operaciones as $operacion) {
					
				//COMPRAS-ENTRADAS 
				if ($cod_divisa[$i] == $operacion->div_operacion && $operacion->tip_operacion == "COMPRA" && $operacion->status == 1) {
					//CALCULAMOS CON EL MONTO QUE ENTRA A LA CAJA
					$caja_compras_entrada = $caja_compras_entrada + $operacion->mon_operacion;
				}
				if ($cod_divisa[$i] == $operacion->mon_rec_operacion && $operacion->tip_operacion == "COMPRA" && $operacion->status == 1) {
					//CALCULAMOS CON EL MONTO QUE SALE DE LA CAJA
					$caja_compras_entrada = $caja_compras_entrada - $operacion->rec_operacion;

				}

				//VENTAS-SALIDAS
				if ($cod_divisa[$i] == $operacion->div_operacion && $operacion->tip_operacion == "VENTA" && $operacion->status == 1) {
					//CALCULAMOS CON EL MONTO QUE SALE DE LA CAJA
					$caja_compras_entrada = $caja_compras_entrada - $operacion->mon_operacion;
				}
				if ($cod_divisa[$i] == $operacion->mon_rec_operacion && $operacion->tip_operacion == "VENTA" && $operacion->status == 1) {
					//CALCULAMOS CON EL MONTO QUE ENTRA A LA CAJA
					$caja_compras_entrada = $caja_compras_entrada + $operacion->rec_operacion;
				}
				
			}

			//CALCULO SALIDAS Y ENTRADAS DE CAJA
			if ($ent_sal) {
				foreach ($ent_sal as $e) {

					$suma_entradas = 0;
				    $suma_salidas = 0;

					if ($e->id_divisa == $divisa->id_divisa && $e->sta_ent_sal == 1 && $e->tip_ent_sal == "Entrada") {
						$suma_entradas = $suma_entradas + $e->can_ent_sal;
						$caja_compras_entrada = $caja_compras_entrada + $suma_entradas;
					}

					if($e->id_divisa == $divisa->id_divisa && $e->sta_ent_sal == 1 && $e->tip_ent_sal == "Salida"){
						$suma_salidas = $suma_salidas + $e->can_ent_sal;

						$caja_compras_entrada = $caja_compras_entrada - $suma_salidas;
					}

				}
			}
			

			//CALCULO Y SUMA DE CUENTAS A LA CAJA
			// foreach ($cuentas as $cuenta) {
			// 	if ($cod_divisa[$i] == $cuenta->cod_divisa) {
			// 		$caja_compras_entrada = $caja_compras_entrada + $cuenta->sal_cuenta;
			// 	}
			// }
			
			//CALCULO DE CAJA DEL DIA ANTERIOR
			foreach ($cierre as $c) {

				if ($cod_divisa[$i] == $c->cod_divisa_cierre) {
					$caja_compras_entrada = $caja_compras_entrada + $c->can_cierre;
				}
				//SI ES EL MISMO DIA Y SE HA CERRADO LA CAJA
				if ($cod_divisa[$i] == $c->cod_divisa_cierre && $c->fec_cierre == date('Y-m-d')) {
					$caja_compras_entrada = $c->can_cierre;
				}
			}

			// print_r($cierre);

				$datos_divisas = array(
					'codigo' => $cod_divisa[$i],
					'nombre' => $divisa->nom_divisa,
				    'caja' => $caja_compras_entrada,
				    'cotizacion' => $divisa->com_divisa,
				);
	
				array_push($array, $datos_divisas);
		
			$i++;
		}
		return $array;
	}
 ?>