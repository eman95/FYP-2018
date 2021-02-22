<?php
	class Users extends CI_Controller	{
		//register user
		public function register()	{

			if($this->session->userdata('logged_in')){
				redirect("/");
			}

			$data['title'] = 'Sign Up';

			$this->form_validation->set_error_delimiters('<div style="background-color: red; text-align: center; padding: 8px; margin-bottom: 5px">', '</div>');

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE)	{
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			} else{
				$enc_password = md5($this->input->post('password'));
				$this->user_model->register($enc_password);

				$this->session->set_flashdata('user_registered', 'You are now registered and can log in');
				redirect("/");
			}
		}

		//check username exists
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is taken. Please choose a different username' );

			if ($this->user_model->check_username_exists($username)) {
				return true;
			} else{
				return false;
			}
		}

		//check email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'That email is taken. Please choose a different email' );

			if ($this->user_model->check_email_exists($email)) {
				return true;
			} else{
				return false;
			}
		}

		//login user
		public function login()	{

			if($this->session->userdata('logged_in')){
				redirect("/");
			}

			$data['title'] = 'Sign In';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE)	{
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			} else{
				//get username
				$username = $this->input->post('username');

				//get and encrypt password
				$password = md5($this->input->post('password'));


				//login user
				$user_id = $this->user_model->login($username, $password);

				$name = $this->user_model->getname($username);

				$profile_image = $this->user_model->get_image($user_id);

				if($user_id){
					//create session
					$user_data = array (
						'user_id' => $user_id,
						'username' => $username,
						'name' => ucfirst($name),
						'image' => $profile_image,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					//set message
					$this->session->set_flashdata('user_loggedin', 'Welcome, '.$this->session->userdata('name').'. You are now logged in');

					redirect("/");
				} else {
					$this->session->set_flashdata('login_failed', 'Unable to login. Username and Password did not match');

					redirect("users/login");
				}

			}
		}

		//logout user
		public function logout()	{
			//unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('image');

			//set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');

			redirect("users/login");
		}

		public function profile()	{
			if(!$this->session->userdata('logged_in')) {
				redirect("users/login");
			}

			$data['title'] = 'Profile';

			$data['results'] = $this->user_model->profile();

			$this->load->view('templates/header');
			$this->load->view('users/profile', $data);
			$this->load->view('templates/footer');
		}

		public function edit()	{
			if(!$this->session->userdata('logged_in')) {
				redirect("users/login");
			}

			$data['results'] = $this->user_model->profile();

			$data['title'] = 'Edit Profile';

			$this->load->view('templates/header');
			$this->load->view('users/edit', $data);
			$this->load->view('templates/footer');
		}

		public function update() {

			$data['title'] = 'Edit Profile';
			$data['results'] = $this->user_model->profile();

			$this->form_validation->set_error_delimiters('<div style="background-color: red; text-align: center; padding: 8px; margin-bottom: 5px">', '</div>');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('age', 'Age', 'required|max_length[2]|numeric');
			$this->form_validation->set_rules('phone', 'Phone Number', 'required|exact_length[10]|numeric');
			$this->form_validation->set_rules('userfile', '', 'callback_file_check');

			//upload image
			$config['upload_path'] = './assets/images/profile';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2048';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';

			$this->load->library('upload', $config);

			if (empty($_FILES['userfile']['name'])) {
				$errors = array('error' => $this->upload->display_errors());
				$profile_image = $this->user_model->get_image($this->session->userdata('user_id'));
			} else {
				$data = array('upload_data' => $this->upload->data());
				$profile_image = $_FILES['userfile']['name'];
				$this->upload->do_upload('userfile');
			}

			if($this->form_validation->run() === FALSE)	{
				$this->load->view('templates/header');
				$this->load->view('users/edit', $data);
				$this->load->view('templates/footer');
			} else{
				$this->user_model->update_profile($profile_image);
				$this->session->set_userdata('image', $profile_image);
				$this->session->set_flashdata('update_profile', 'You have successfully updated your profile');
				redirect("users/profile");
			}
		}

		public function file_check($str){
			$allowed_mime_type_arr = array('image/gif','image/jpeg','image/png','image/jpg', '');
	        $mime = get_mime_by_extension($_FILES['userfile']['name']);
	        if(in_array($mime, $allowed_mime_type_arr)){
	            return true;
	        } else{
	            $this->form_validation->set_message('file_check', 'Invalid file extension');
	            return false;
	        }
	    }
	}
?>