<?php 
	/**
	 * CUENTAS
	 */
	class cuentas_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getall() {
			$this->db->select('*');
			$this->db->from('cuentas');
			$this->db->join('cajas', 'cajas.id_caja = cuentas.id_caja');
			$this->db->join('divisas', 'divisas.id_divisa = cuentas.id_divisa');
			$query = $this->db->get();
			return $query->result();
		}

		public function delete($id){
			$this->db->where('id_cuenta', $id);
			$this->db->delete('cuentas');
		}

		public function save($data){
			$this->db->insert('cuentas', $data);
		}
		
		public function update($id, $cantidad){

			$data = array(
				'sal_cuenta' => $cantidad,
			);

			$this->db->where('id_cuenta', $id);
			$this->db->update('cuentas', $data);
		}

	}

 ?>