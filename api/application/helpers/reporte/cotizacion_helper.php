<?php 

	function cotizacion($divisa, $divisas, $operaciones){
	
		$operaciones_divisa = array_filter($operaciones, function($a) {
								return $a == "USD";
							}, ARRAY_FILTER_USE_KEY);
		print_r($operaciones_divisa);


		$cotizacion = "Hola";
        
		return $cotizacion;
	}

 ?>