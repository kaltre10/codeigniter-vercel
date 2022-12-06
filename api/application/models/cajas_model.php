<?php 
	/**
	 * CAJAS
	 */
	class cajas_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getall() {
			$sql = $this->db->get_where('cajas');
			return $sql->result();
		}

		public function delete($id){
			$this->db->where('id_caja', $id);
			$this->db->delete('cajas');
		}

		public function save($data){
			$this->db->insert('cajas', $data);
		}
		
	}

 ?>