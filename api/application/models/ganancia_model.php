<?php 
	/**
	 * TABLA GANANCIAs
	 */
	class ganancia_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getall() {
			$this->db->select('*');
			$this->db->order_by('id_ganancia', 'DESC');
			$query = $this->db->get('ganancia', 12);
			
			return $query->result();
		}

		public function save($data){
			$this->db->insert('ganancia', $data);
		}

		public function anular($fecha){
			$this->db->delete('ganancia', array('fec_ganancia' => $fecha));
		}

		public function get_check($fecha) {
			$query = $this->db->get_where('cierre', array('fec_cierre' => $fecha));
			return $query->result();
		}

		public function get_date($desde, $hasta) {
			$this->db->select('*');
			$this->db->from('ganancia');
			$sql = $this->db->where("fec_ganancia BETWEEN '$desde' AND '$hasta'");
			$query = $this->db->get();
			return $query->result();
		}
		
	}

 ?>
