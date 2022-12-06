<?php 
	/**
	 * OPERACIONES
	 */
	class usuarios_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getUsers_id($id_user){
			$sql = $this->db->get_where('usuarios', array('id_usuario' => $id_user));
			return $sql->result();
		}

		public function getall(){
			$this->db->select('*');
			$this->db->from('usuarios');
			$this->db->join('cajas', 'cajas.id_caja = usuarios.id_caja');
			$sql = $this->db->get();
			return $sql->result();
		}

		public function save($data){
			$this->db->insert('usuarios', $data);
		}

		public function delete($id){
			$this->db->where('id_usuario', $id);
			$this->db->delete('usuarios');
		}
		
	}

 ?>