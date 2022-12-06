<?php 
	
	function getLoginRules(){
		return array(
			        array(
		                'field' => 'email', 
		                'label' => 'correo',
		                'rules' => 'required|trim',
		                'errors' => array(
		                	'required' => 'Por favor ingrese un %s',
		                ),
			        ),
			        array(
		                'field' => 'password',
		                'label' => 'contraseña',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Por favor ingrese una %s',
		                ),
			        ),
		);
	}

 ?>