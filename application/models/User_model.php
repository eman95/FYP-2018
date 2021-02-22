<?php
	class User_model extends CI_Model{
		//
		public function register($enc_password){
			$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'profile_image' => 'noimage.jpg',
				'password' => $enc_password
			);

			//insert user
			return $this->db->insert('users', $data);
		}

		//log in user
		public function login($username,$password)	{
			//validate
			$this->db->where('username', $username);
			$this->db->where('password', $password);

			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				return $result->row(0)->user_id;
			} else {
				return false;
			}
		}

		//get name
		public function getname($username)	{
			//validate
			$this->db->where('username', $username);

			$result = $this->db->get('users');

			if($result->num_rows() == 1){
				return $result->row(0)->name;
			} else {
				return false;
			}
		}

		//check username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));

			if(empty($query->row_array())){
				return true;
			} else{
				return false;
			}
		}

		//check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));
			if(empty($query->row_array())){
				return true;
			} else{
				return false;
			}
		}

		public function profile()	{
			$this->db->where('user_id', $this->session->userdata('user_id'));

			$query = $this->db->get('users');

			if($query->num_rows() == 1){
				return $query->result();
			} else {
				return false;
			}
		}

		public function update_profile($profile_image)	{
			$data = array(
				'name' => $this->input->post('name'),
				'age' => $this->input->post('age'),
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'profile_image' => $profile_image
			);

			$this->db->where('user_id', $this->input->post('user_id'));
			return $this->db->update('users', $data);
		}

		public function get_image($user_id) {
			$this->db->where('user_id', $user_id);

			$query = $this->db->get('users');

			if($query->num_rows() == 1){
				$data = $query->result_array();
				return ($data[0]['profile_image']);
			} else {
				return false;
			}
		}
	}