<?php 

	function last_cierre($cierres){
		
        $last_date = $cierres[0][array_key_last($cierres)]->fec_cierre;

		$result = array_filter($cierres, function($a) {
			return $a == $last_date;
		}, ARRAY_FILTER_USE_KEY);

		return $result[0];
	}

 ?>