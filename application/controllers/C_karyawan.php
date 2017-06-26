<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_karyawan extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_karyawan';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(5);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Karyawan',
			'title_page2' 	=> 'Master Karyawan',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('karyawan/V_karyawan', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(5);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'karyawan_nip, karyawan_nama, type_karyawan_nama, cabang_nama, karyawan_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_karyawan');
		$query_filter = $this->mod->select($select, 'v_karyawan', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_karyawan', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->karyawan_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormKaryawan('.$val->karyawan_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->karyawan_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormKaryawan('.$val->karyawan_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->karyawan_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				}
				$response['data'][] = array(
					$no,
					$val->karyawan_nip,
					$val->karyawan_nama,
					$val->type_karyawan_nama,
					$val->cabang_nama,
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
		$this->load->view("karyawan/V_form_karyawan");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'karyawan_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, 'v_karyawan', NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI TYPE
				$hasil1['val2'] = array();
				$where_type['data'][] = array(
					'column' => 'type_karyawan_id',
					'param'	 => $val->m_type_karyawan_id
				);
				$query_type = $this->mod->select('*','m_type_karyawan',NULL,$where_type);
				foreach ($query_type->result() as $val2) {
					$hasil1['val2'][] = array(
						'id' 	=> $val2->type_karyawan_id,
						'text' 	=> $val2->type_karyawan_nama
					);
				}
				// END CARI TYPE
				// CARI CABANG
				$hasil2['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				foreach ($query_cabang->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->cabang_id,
						'text' 	=> $val2->cabang_nama
					);
				}
				// END CARI CABANG
				// CARI DEPARTEMEN
				$hasil4['val2'] = array();
				$where_departemen['data'][] = array(
					'column' => 'departemen_id',
					'param'	 => $val->m_departemen_id
				);
				$query_departemen = $this->mod->select('*','m_departemen',NULL,$where_departemen);
				foreach ($query_departemen->result() as $val2) {
					$hasil4['val2'][] = array(
						'id' 	=> $val2->departemen_id,
						'text' 	=> $val2->departemen_nama
					);
				}
				// END CARI DEPARTEMEN
				$array_telp = json_decode($val->karyawan_telepon);
				for ($i = 0; $i < sizeof($array_telp); $i++) { 
					$hasil3['val2'][] = array(
						'text' 	=> $array_telp[$i]
					);
				}
				$response['val'][] = array(
					'kode' 							=> $val->karyawan_id,
					'karyawan_nip' 					=> $val->karyawan_nip,
					'karyawan_nama' 				=> $val->karyawan_nama,
					'karyawan_alamat' 				=> $val->karyawan_alamat,
					'karyawan_telepon' 				=> $hasil3,
					'jml_telepon'					=> sizeof(json_decode($val->karyawan_telepon)),
					'm_type_karyawan_id' 			=> $hasil1,
					'm_cabang_id' 					=> $hasil2,
					'm_departemen_id'				=> $hasil4,
					'karyawan_status_aktif' 		=> $val->karyawan_status_aktif
				);
			}

			echo json_encode($response);
		}
	}

	public function loadData_select(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'karyawan_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'karyawan_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'karyawan_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->karyawan_id,
					'text'	=> $val->karyawan_nama
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function checkNip(){
		$nip = $this->input->get('nip', TRUE);
		$select = '*';
		$where['data'][] = array(
			'column' => 'karyawan_nip',
			'param'	 => $nip
		);
		$query = $this->mod->select($select, 'v_karyawan', NULL, $where);
		if ($query<>false) {
			$response['status'] = '204';
		} else {
			$response['status'] = '200';
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
				'column' => 'karyawan_id',
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

		// update m_karyawan
		$data = $this->general_post_data(3, $id);
		$where['data'][] = array(
			'column' => 'karyawan_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		// end update m_karyawan

		//Update s_user
		$whereUser['data'][] = array(
			'column' => 'm_karyawan_id',
			'param'	 => $id
		);
		$queryUser = $this->mod->select('user_revised', 's_user', NULL, $whereUser);
		if($queryUser)
		{
			$dataUser = $this->general_post_data(6, $id);
			$updateUser = $this->mod->update_data_table('s_user', $whereUser, $dataUser);
		}
		// end update s_user

		if($update->status) {
			$response['status'] = '200';
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	public function aktifData(){
		$id = $this->input->post('id');
		//update karyawan
		$data = $this->general_post_data(4, $id);
		$where['data'][] = array(
			'column' => 'karyawan_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		// end update karyawan

		//update user
		$whereUser['data'][] = array(
			'column' => 'm_karyawan_id',
			'param'	 => $id
		);
		$queryUser = $this->mod->select('user_revised', 's_user', NULL, $whereUser);
		if($queryUser)
		{
			$dataUser = $this->general_post_data(5, $id);
			$updateUser = $this->mod->update_data_table('s_user', $whereUser, $dataUser);
		}
		// end update user

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
			'column' => 'karyawan_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('karyawan_revised', $this->tbl, NULL, $where);
		if($queryRevised)
		{
			$revised = $queryRevised->row_array();
			$rev = $revised['karyawan_revised'] + 1;
		}
		
		$whereUser['data'][] = array(
			'column' => 'm_karyawan_id',
			'param'	 => $id
		);
		$queryUser = $this->mod->select('user_revised', 's_user', NULL, $whereUser);
		if($queryUser)
		{
			$revisedUser = $queryUser->row_array();
			$revUser = $revisedUser['user_revised'] + 1;
		}
		if ($type == 1) {
			$defaultValue = json_encode($this->input->post('karyawan_telepon'));
			$data = array(
				'karyawan_nip' 				=> $this->input->post('karyawan_nip', TRUE),
				'karyawan_nama' 			=> $this->input->post('karyawan_nama', TRUE),
				'karyawan_alamat' 			=> $this->input->post('karyawan_alamat', TRUE),
				'karyawan_telepon' 			=> $defaultValue,
				'm_type_karyawan_id' 		=> $this->input->post('m_type_karyawan_id', TRUE),
				'm_cabang_id' 				=> $this->input->post('m_cabang_id', TRUE),
				'm_departemen_id'			=> $this->input->post('m_departemen_id', TRUE),
				'karyawan_status_aktif' 	=> $this->input->post('karyawan_status_aktif', TRUE),
				'karyawan_create_date' 		=> date('Y-m-d H:i:s'),
				'karyawan_update_date' 		=> date('Y-m-d H:i:s'),
				'karyawan_create_by' 		=> $this->session->userdata('user_username'),
				'karyawan_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$defaultValue = json_encode($this->input->post('karyawan_telepon'));
			$data = array(
				'karyawan_nip' 				=> $this->input->post('karyawan_nip', TRUE),
				'karyawan_nama' 			=> $this->input->post('karyawan_nama', TRUE),
				'karyawan_alamat' 			=> $this->input->post('karyawan_alamat', TRUE),
				'karyawan_telepon' 			=> $defaultValue,
				'm_type_karyawan_id' 		=> $this->input->post('m_type_karyawan_id', TRUE),
				'm_cabang_id' 				=> $this->input->post('m_cabang_id', TRUE),
				'm_departemen_id'			=> $this->input->post('m_departemen_id', TRUE),
				'karyawan_status_aktif' 	=> $this->input->post('karyawan_status_aktif', TRUE),
				'karyawan_update_date' 		=> date('Y-m-d H:i:s'),
				'karyawan_update_by' 		=> $this->session->userdata('user_username'),
				'karyawan_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'karyawan_status_aktif' 	=> 'n',
				'karyawan_update_date' 		=> date('Y-m-d H:i:s'),
				'karyawan_update_by' 		=> $this->session->userdata('user_username'),
				'karyawan_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'karyawan_status_aktif' 	=> 'y',
				'karyawan_update_date' 		=> date('Y-m-d H:i:s'),
				'karyawan_update_by' 		=> $this->session->userdata('user_username'),
				'karyawan_revised' 			=> $rev,
			);
		} else if ($type == 5) {
			$data = array(
				'user_status_aktif' 	=> 'y',
				'user_update_date' 		=> date('Y-m-d H:i:s'),
				'user_update_by' 		=> $this->session->userdata('user_username'),
				'user_revised' 			=> $revUser,
			);
		} else if ($type == 6) {
			$data = array(
				'user_status_aktif' 	=> 'n',
				'user_update_date' 		=> date('Y-m-d H:i:s'),
				'user_update_by' 		=> $this->session->userdata('user_username'),
				'user_revised' 			=> $revUser,
			);
		}

		return $data;
	}
	/* end Function */

}
