<?php
	class Result_model extends CI_Model{

		public function get_result(){
			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->order_by('calculate_id', 'DESC');
			$query = $this->db->get_where('calculate');
			return $query->result();
		}
		public function get_result_normal(){
			$this->db->where('user_id', $this->session->userdata('user_id'));
			$query = $this->db->get_where('calculate');
			return $query->result();
		}
	}