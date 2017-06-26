<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 's_user';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(81);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Setting',
			'title_page2' 	=> 'User',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('user/V_user', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(3);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'karyawan_nama, user_username',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_user');
		$query_filter = $this->mod->select($select, 'v_user', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_user', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->user_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormUser('.$val->user_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->user_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormUser('.$val->user_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->user_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				}
				$response['data'][] = array(
					$no,
					$val->karyawan_nama,
					$val->user_username,
					$status,
					$button
				);
				$no++;
			}
		}

		$response['recordsTotal'] = 0;
		if ($query_total<>false) {
			$response['recordsTotal'] = $query_total->num_rows();
		}
		$response['recordsFiltered'] = 0;
		if ($query_filter<>false) {
			$response['recordsFiltered'] = $query_filter->num_rows();
		}

		echo json_encode($response);
	}

	public function getForm(){
		$this->check_session();
		$this->load->view("user/V_form_user");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'user_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$hasil['val2'] = array();
				$where_karyawan['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->m_karyawan_id
				);
				$query_karyawan = $this->mod->select('*','m_karyawan',NULL,$where_karyawan);
				foreach ($query_karyawan->result() as $val2) {
					$hasil['val2'][] = array(
						'id' 	=> $val2->karyawan_id,
						'text' 	=> $val2->karyawan_nama
					);
				}
				$response['val'][] = array(
					'kode' 					=> $val->user_id,
					'm_karyawan_id' 		=> $hasil,
					'user_username' 		=> $val->user_username,
					'user_status_aktif' 	=> $val->user_status_aktif
				);
			}

			echo json_encode($response);
		}
	}

	public function loadData_select(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'm_cabang_id',
			'param'	 => $this->session->userdata('cabang_id')
		);
		$where['data'][] = array(
			'column' => 'user_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'user_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'user_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->user_id,
					'text'	=> $val->user_nama.' ('.$val->user_atas_nama.' - '.$val->user_no_rek.')',
					'user_nama' 			=> $val->user_nama,
					'user_atas_nama' 		=> $val->user_atas_nama,
					'user_no_rek' 			=> $val->user_no_rek,
				);
			}
			// $response['status'] = '200';
		}

		echo json_encode($response);
	}

	// Function Insert & Update
	public function postData(){
		$id = $this->input->post('kode');
		if (strlen($id)>0) {
			//UPDATE
			$data = $this->general_post_data(2, $id);
			$where['data'][] = array(
				'column' => 'user_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($update->status) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		}
		
		echo json_encode($response);
	}

	// Function Delete
	public function deleteData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(3, $id);
		$where['data'][] = array(
			'column' => 'user_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		if($update->status) {
			$response['status'] = '200';
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	public function aktifData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(4, $id);
		$where['data'][] = array(
			'column' => 'user_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		if($update->status) {
			$response['status'] = '200';
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'user_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('user_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['user_revised'] + 1;
		}
		if ($type == 1) {
			$password = md5(base64_decode($this->input->post('user_password', TRUE)));
			$data = array(
				'm_karyawan_id' 		=> $this->input->post('m_karyawan_id', TRUE),
				'user_username' 		=> $this->input->post('user_username', TRUE),
				'user_password' 		=> $password,
				'user_status_aktif' 	=> $this->input->post('user_status_aktif', TRUE),
				'user_create_date' 		=> date('Y-m-d H:i:s'),
				'user_update_date' 		=> date('Y-m-d H:i:s'),
				'user_create_by' 		=> $this->session->userdata('user_username'),
				'user_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$password = md5(base64_decode($this->input->post('user_password', TRUE)));
			$data = array(
				'user_username' 		=> $this->input->post('user_username', TRUE),
				'user_password' 		=> $password,
				'user_status_aktif' 	=> $this->input->post('user_status_aktif', TRUE),
				'user_update_date' 		=> date('Y-m-d H:i:s'),
				'user_update_by' 		=> $this->session->userdata('user_username'),
				'user_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'user_status_aktif' 	=> 'n',
				'user_update_date' 		=> date('Y-m-d H:i:s'),
				'user_update_by' 		=> $this->session->userdata('user_username'),
				'user_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'user_status_aktif' 	=> 'y',
				'user_update_date' 		=> date('Y-m-d H:i:s'),
				'user_update_by' 		=> $this->session->userdata('user_username'),
				'user_revised' 			=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

}
