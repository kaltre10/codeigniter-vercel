<?php 
	
	function getRegistroRules(){
		return array(
			        array(
		                'field' => 'nombres', 
		                'label' => 'nombres',
		                'rules' => 'required|trim',
		                'errors' => array(
		                	'required' => 'Por favor ingrese sus nombre completo',
		                ),
			        ),
			        array(
		                'field' => 'documento',
		                'label' => 'documento',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Por favor seleccione un %s',
		                ),
			        ),
			        array(
		                'field' => 'numero',
		                'label' => 'numero',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Por favor ingrese el %s de documento',
		                ),
			        ),
			        array(
		                'field' => 'telefono',
		                'label' => 'telefono',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Por favor ingrese su %s personal',
		                ),
			        ),
			        array(
		                'field' => 'email',
		                'label' => 'email',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Por favor ingrese un %s',
		                ),
			        ),
			        array(
		                'field' => 'password',
		                'label' => 'Contraseña',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Por favor ingrese una %s',
		                ),
			        ),
			        array(
		                'field' => 'password_2',
		                'label' => 'Contraseña',
		                'rules' => 'required',
		                'errors' => array(
		                        'required' => 'Por favor repita la %s',
		                ),
			        ),
		);
	}

 ?>