<?php 
	/**
	 * BOLETA
	 */
	class boleta_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getall() {
			$sql = $this->db->get('boleta', 1);
			return $sql->result();
		}

		public function edit($data){
			$this->db->set('token', $data);
			$this->db->update('boleta');
		}
		
	}

 ?>