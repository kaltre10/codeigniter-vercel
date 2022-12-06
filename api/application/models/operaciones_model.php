<?php 
	/**
	 * OPERACIONES
	 */
	class operaciones_model extends CI_Model{

		public function __construct(){
			$this->load->database();
		}

		public function getall($desde, $hasta, $tipo = NULL, $mayor = NULL, $menor = NULL) {
			$this->db->select('*');
			$this->db->from('operaciones');
			$this->db->join('usuarios', 'usuarios.id_usuario = operaciones.id_usuario');
			$this->db->join('clientes', 'clientes.id_cliente = operaciones.cli_operacion');
			$this->db->where_in('operaciones.tip_operacion', $tipo);
			$this->db->where("fec_operacion BETWEEN '$desde' AND '$hasta'");
			if($mayor && $menor){
				$this->db->where("mon_operacion BETWEEN '$mayor' AND '$menor'");
			}else{
				if($mayor){
					$this->db->where("mon_operacion > '$mayor'");
				}
				if($menor){
					$this->db->where("mon_operacion < '$menor'");
				}
			}
			$this->db->order_by('id_operacion', 'DESC');
			$query = $this->db->get();
			return $query->result();
		}

		public function get_n_operaciones($desde, $hasta){
			$this->db->select('*');
			$this->db->from('operaciones');
			$this->db->join('usuarios', 'usuarios.id_usuario = operaciones.id_usuario');
			$this->db->join('clientes', 'clientes.id_cliente = operaciones.cli_operacion');
			$sql = $this->db->where("fec_operacion BETWEEN '$desde' AND '$hasta'");
			$this->db->where('status', 1);
			$query = $this->db->get();
			return $query->result();
		}

		public function save($data){
			//ajustamos el correlativo segun el ultimo registro
			$data['correlative_sunat'] = $this->last_operacion()[0]->correlative_sunat + 1;
			// if($data['tip_operacion'] === "COMPRA"){
			// 	$data['correlative_sunat'] = $this->last_operacion()[0]->correlative_sunat;
			// }
			
			// echo json_encode($data);
			$this->db->insert('operaciones', $data);
		}

		public function get_operacion($id){
			$this->db->where('id_operacion', $id);
			$query = $this->db->get('operaciones');
			return $query->result();
		}

		public function update($id){
			$this->db->set('report', 1);
			$this->db->where('id_operacion', $id);
			$this->db->update('operaciones');
		}

		public function anular($id){
			$this->db->set('status', 0);
			$this->db->where('id_operacion', $id);
			$this->db->update('operaciones');
		}

		public function last_operacion(){
			$this->db->order_by('id_operacion', 'DESC');
			$query = $this->db->get('operaciones', 1);
			return $query->result();
		}

		
		
	}

 ?>
