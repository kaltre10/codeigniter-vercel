<?php 
	/**
	 * CIERRE
	 */
	class cierre_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function get() {
			$query = $this->db->get_where('cierre');
			return $query->result();
		}

		public function getall($desde, $hasta) {
			$this->db->select('*');
			$this->db->from('cierre');
			$sql = $this->db->where("fec_cierre BETWEEN '$desde' AND '$hasta'");
			$query = $this->db->get();
			return $query->result();
		}

		public function save($data){
			$this->db->insert('cierre', $data);
		}

		public function anular($fecha){
			$this->db->delete('cierre', array('fec_cierre' => $fecha));
		}

		public function get_check($fecha, $codigo_divisa) {
			$query = $this->db->get_where('cierre', array('fec_cierre' => $fecha, 'cod_divisa_cierre' => $codigo_divisa));
			return $query->result();
		}
		
	}

 ?>