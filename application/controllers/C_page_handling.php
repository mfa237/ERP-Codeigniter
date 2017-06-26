<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_page_handling extends MY_Controller {
	private $any_error = array();

	public function __construct() {
        parent::__construct();
	}

	/*
		PAGE LOGIN FUNCTION
	*/

	// Page Login
	public function PageLogin(){
	   	if($this->logged_in)
			redirect('Dashboard');
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Page Login',
		);
		$this->load->view('gate/V_login', $data);
	}

	public function doLogin(){
		$user = $this->input->post('username', TRUE);
		$pass = md5(base64_decode($this->input->post('password', TRUE)));
		$user_data = $this->mod->check_exist_user($user,$pass);

		if(!$user_data)
			$response['status'] = '204'; 
		else{				if($user_data->user_status_aktif == 'y')			{								$this->session->set_userdata('logged', 'in');
				$this->session->set_userdata('user_id', $user_data->user_id);
				$this->session->set_userdata('karyawan_id', $user_data->karyawan_id);
				$this->session->set_userdata('user_username', $user_data->user_username);
				$this->session->set_userdata('karyawan_nama', $user_data->karyawan_nama);
				$this->session->set_userdata('type_karyawan_id', $user_data->type_karyawan_id);
				$this->session->set_userdata('cabang_id', $user_data->m_cabang_id);
				$response['status'] = '200';			}			else			{				$response['status'] = '204'; 			}
		}
			
		echo json_encode($response);
	}

	public function doLogout(){
		$this->session->sess_destroy();
		$response['status'] = '200';
		echo json_encode($response);
	}

	public function formLogin($type = NULL){
		if ($type == 1) {
			$data = array(
				'id'		=> $this->input->get('id', TRUE),
				'action'	=> 'Login/checkLogin/1',
			);
			$this->load->view("gate/V_form_login", $data);
		} else if ($type == 2) {
			$data = array(
				'id'		=> $this->input->get('id', TRUE),
				'action'	=> 'Login/checkLogin/2',
			);
			$this->load->view("gate/V_form_login", $data);
		}
	}

	public function checkLogin($type = NULL){
		if ($type == 1) {
			$user = $this->input->post('i_username', TRUE);
			$pass = md5(base64_decode($this->input->post('i_password', TRUE)));
			$user_data = $this->mod->check_exist_user($user,$pass);

			if(!$user_data)
				$response['status'] = '204'; 
			else{
				// HARDCODE
				if ($user_data->type_karyawan_id == 1 || $user_data->type_karyawan_id == 14) {
					$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}
				
			}
		} else if ($type == 2) {
			$user = $this->input->post('i_username', TRUE);
			$pass = md5(base64_decode($this->input->post('i_password', TRUE)));
			$user_data = $this->mod->check_exist_user($user,$pass);

			if(!$user_data)
				$response['status'] = '204'; 
			else{
				// HARDCODE
				if ($user_data->type_karyawan_id == 1) {
					$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}
				
			}
		}
		echo json_encode($response);
	}

	/*
		END PAGE LOGIN FUNCTION
	*/

	// Page 404
	public function Page404(){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Page 404',
			'title' 		=> '',
			// 'c'				=> $c
		);
		$this->load->view('layout/V_404', $data);
	}

}
