<?php 
	
	function gastos_operaciones($divisas, $operaciones, $ent_sal){
		$i = 0;
		$cod_divisa = [];
		$array = [];
		foreach ($divisas as $divisa) {
			$cod_divisa[$i] = $divisa->cod_divisa;
			$caja = 0;
			$suma_compras_entrada = 0;
			$suma_compras_salida = 0;
			$suma_compras_ventas = 0;
			$suma_ventas_salidas = 0;
			$suma_entrada = 0;
			$suma_ventas = 0;
			$suma_entradas = 0;
			$suma_salidas = 0;
			$suma_ventas_salida = 0;
			$salida = 0;
			$suma_ventas_entrada = 0;
			foreach ($operaciones as $operacion) {

				//ENTRADAS 
				if ( $cod_divisa[$i] == $operacion->div_operacion && $operacion->tip_operacion == "COMPRA" && $operacion->status == 1 && $operacion->mon_rec_operacion == "PEN" ) {
					//CALCULAMOS CON EL MONTO QUE ENTRA A LA CAJA
					$suma_compras_entrada = $suma_compras_entrada + $operacion->mon_operacion;
					$suma_compras_salida = $suma_compras_salida + $operacion->rec_operacion;
				}

				if ($cod_divisa[$i] == $operacion->div_operacion && $operacion->tip_operacion == "COMPRA" && $operacion->status == 1 && $operacion->mon_rec_operacion != "PEN" ) {
					$com = $divisa->com_divisa / $operacion->cot_operacion;
					$salida = $com * $operacion->rec_operacion;
					$suma_compras_salida = round( $suma_compras_salida + $salida , 2);

					$suma_compras_entrada = $suma_compras_entrada + $operacion->mon_operacion;
				}

				//SALIDAS
				if($cod_divisa[$i] == $operacion->div_operacion && $operacion->tip_operacion == "VENTA"  && $operacion->status == 1 && $operacion->mon_rec_operacion == "PEN" ){
					$suma_ventas_salida = $suma_ventas_salida + $operacion->mon_operacion;
					$suma_ventas_entrada = $suma_ventas_entrada + $operacion->rec_operacion;
				}

				if ($cod_divisa[$i] == $operacion->div_operacion && $operacion->tip_operacion == "VENTA" && $operacion->status == 1 && $operacion->mon_rec_operacion != "PEN" ) {
					$ven = $divisa->ven_divisa / $operacion->cot_operacion;
					$entrada = $ven * $operacion->rec_operacion;
					$suma_ventas_entrada = round($suma_ventas_entrada + $entrada , 2 );

					$suma_ventas_salida  = $suma_ventas_salida + $operacion->mon_operacion;
				}
				
			}

				$datos_divisas = array(
					'codigo' => $cod_divisa[$i],
					'nombre' => $divisa->nom_divisa,
				    'compras' => $suma_compras_entrada,
				    'ventas' => $suma_ventas_salida,
				    'gastos_compra' => $suma_compras_salida,
					'gastos_venta' => $suma_ventas_entrada,
				);
				array_push($array, $datos_divisas);
		
			$i++;
		}
		return $array;
	}
 ?>