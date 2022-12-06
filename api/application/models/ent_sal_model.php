<?php 
	/**
	 * OPERACIONES
	 */
	class ent_sal_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getall($desde, $hasta) {
			$this->db->select('*');
			$this->db->from('ent_sal');
			$this->db->join('usuarios', 'usuarios.id_usuario = ent_sal.id_usuario');
			$this->db->join('divisas', 'divisas.id_divisa = ent_sal.id_divisa');
			$this->db->join('categorias', 'categorias.id_categoria = ent_sal.id_categoria');
			$this->db->order_by('ent_sal.id_usuario','DESC');
			$sql = $this->db->where("fec_ent_sal BETWEEN '$desde' AND '$hasta'");

			$query = $this->db->get();
			return $query->result();
		}

		public function anular($id){
			$this->db->set('sta_ent_sal', 0);
			$this->db->where('id_ent_sal', $id);
			$this->db->update('ent_sal');
		}

		public function save($data){
			$this->db->insert('ent_sal', $data);
		}
		
	}

 ?>