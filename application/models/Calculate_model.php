<?php
	class Calculate_model extends CI_Model{
		//add data
		public function calculate(){
			$data = array(
				'water' => $this->input->post('water_use') * 0.668, // 0.668 is EF
				'electricity' => $this->input->post('elect_use') * 0.6, // 0.6 is EF
				'gas' => ((1.96 * $this->input->post('gas_weight')) * 1.8) / $this->input->post('gas_use'), //1.96L = 1kg, 1.8 is EF
				'user_id' => $this->session->userdata('user_id'),
				'date' => date("F Y")
			);

			return $this->db->insert('calculate', $data);
		}
	}