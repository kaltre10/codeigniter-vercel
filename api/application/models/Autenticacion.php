<?php 

	class Autenticacion extends CI_Model {
		
		public function __construct(){
			$this->load->database();
		}

		public function login($email,$password){
			$data = $this->db->get_where('usuarios', array('nom_usuario' => $email, 'pas_usuario' => $password), 1);
			if (!$data->result()) {
				return false;
			}
			return $data->row();
		}

	}

 ?>