<?php 
	/**
	 * OPERACIONES
	 */
	class clientes_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getall() {
			$this->db->where('id_cliente != ', 0);
			$sql = $this->db->get_where('clientes');
			return $sql->result();
		}

		public function save($data){
			$this->db->insert('clientes', $data);
		}

		public function editar($data){
			$this->db->where('id_cliente', $data['id_cliente']);
			$this->db->update('clientes', $data);
		}

		public function delete($id){
			$this->db->where('id_cliente', $id);
			$this->db->delete('clientes');
		}

		public function get_id($id){
			$this->db->where('id_cliente', $id);
			$sql = $this->db->get_where('clientes');
			return $sql->result();
		}
		
	}

 ?>
