<?php
	class Calculates extends CI_Controller {
		//add data
		public function calculate()	{
			//check login
			if(!$this->session->userdata('logged_in')){
				redirect("users/login");
			}

			$data['title'] = 'Calculate Carbon Footprint';
			$this->form_validation->set_rules('water_use', 'Water Activity Data', 'required|callback_numeric_water');
			$this->form_validation->set_rules('elect_use', 'Electricity Activity Data', 'required|callback_numeric_elect');
			$this->form_validation->set_rules('gas_weight', 'Gas Weight', 'required|callback_numeric_gas_weight');
			$this->form_validation->set_rules('gas_use', 'Gas Activity Data', 'required|callback_numeric_gas');

			if($this->form_validation->run() === FALSE)	{
				$this->load->view('templates/header');
				$this->load->view('pages/calculate', $data);
				$this->load->view('templates/footer');
			} else{
				$this->calculate_model->calculate();
				$this->session->set_flashdata('calculated', 'You have calculated your carbon footprint');
				redirect("results/index");

			}

		}

		function numeric_water ($water_use) {
			if (!is_numeric($water_use) && !($water_use === '')){
    			$this->form_validation->set_message('numeric_water','Water Activity Data should be in number format');
				return FALSE;
			}
    		else {
    			return true;
			}
		}

		function numeric_elect ($elect_use) {
			if (!is_numeric($elect_use) && !($elect_use === '')){
    			$this->form_validation->set_message('numeric_elect','Electricity Activity Data should be in number format');
    			return FALSE;
			}
    		else {
    			return true;
			}
		}

		function numeric_gas ($gas_use) {
			if (!is_numeric($gas_use) && !($gas_use === '')) {
				$this->form_validation->set_message('numeric_gas','Gas Activity Data should be in number format');
				return FALSE;
			}
    		else {
    			return true;
			}
		}

		function numeric_gas_weight ($gas_weight) {
			if (!is_numeric($gas_weight) && !($gas_weight === '')) {
				$this->form_validation->set_message('numeric_gas_weight','Gas weight should be in number format');
				return FALSE;
			}
    		else {
    			return true;
			}
		}
	}
?>