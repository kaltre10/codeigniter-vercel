<?php 
	/**
	 * DIVISAS
	 */
	class divisas_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getall() {
			$sql = $this->db->get_where('divisas');
			return $sql->result();
		}

		public function update($compra, $venta, $id){
			$this->db->set('com_divisa', $compra);
			$this->db->set('ven_divisa', $venta);
			$this->db->where('id_divisa', $id);
			$this->db->update('divisas');
		}

		public function delete($id){
			$this->db->where('id_divisa', $id);
			$this->db->delete('divisas');
		}

		public function save($data){
			$this->db->insert('divisas', $data);
		}
		
	}

 ?>