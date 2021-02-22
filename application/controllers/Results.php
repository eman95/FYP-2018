<?php
	class Results extends CI_Controller {
		public function index()	{
			//check login
			if(!$this->session->userdata('logged_in')) {
				redirect('users/login');
			}

			$data['title'] = 'Results';

			$this->load->view('templates/header');
			$this->load->view('results/index', $data);
			$this->load->view('templates/footer');
		}

		public function get_data() {
        	$data = $this->result_model->get_result();
			print_r(json_encode($data, true));
    	}

   		public function get_data_normal() {
        	$data = $this->result_model->get_result_normal();
			print_r(json_encode($data, true));
    	}

    	public function suggest() {
    		//check login
			if(!$this->session->userdata('logged_in')) {
				redirect('users/login');
			}
			
			$data['title'] = 'Suggested Ways';
			
			$this->load->view('templates/header');
			$this->load->view('results/suggest', $data);
			$this->load->view('templates/footer');
		}
	}
?>