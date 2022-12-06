<?php 
	/**
	 * CATEGOARIAS
	 */
	class categorias_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getall() {
			$sql = $this->db->get_where('categorias');
			return $sql->result();
		}

		public function save($data){
			$this->db->insert('categorias', $data);
		}

		public function delete($id){
			$this->db->where('id_categoria', $id);
			$this->db->delete('categorias');
		}
		
	}

 ?>