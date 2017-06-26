<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_brand extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_brand';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(77);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Brand',
			'title_page2' 	=> 'Master Brand',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('brand/V_brand', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(77);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'brand_nama,brand_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, $this->tbl);
		$query_filter = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->brand_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormBrand('.$val->brand_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->brand_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
						</button>';
					}
					
				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormBrand('.$val->brand_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->brand_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				}
				$response['data'][] = array(
					$no,
					$val->brand_nama,
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
		$this->load->view("brand/V_form_brand");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'brand_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'kode' 					=> $val->brand_id,
					'brand_nama' 			=> $val->brand_nama,
					'brand_status_aktif' 	=> $val->brand_status_aktif
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
			'column' => 'brand_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'brand_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'brand_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->brand_id,
					'text'	=> $val->brand_nama
				);
			}
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
				'column' => 'brand_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($data['brand_status_aktif'] == 'n')
			{
				$updateKaryawan = $this->nonaktif_karyawan($id);
				if($update->status) {
					if($updateKaryawan)
					{
						$response['status'] = '200';
					}
					else
					{
						$response['status'] = '204';
					}
				} else {
					$response['status'] = '204';
				}
			} else {
				if($update->status) {
					$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}	
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
			'column' => 'brand_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		$updateKaryawan = $this->nonaktif_karyawan($id);
		if($update->status) {
			if($updateKaryawan)
			{
				$response['status'] = '200';
			}
			else
			{
				$response['status'] = '204';
			}
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}
	public function aktifData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(4, $id);
		$where['data'][] = array(
			'column' => 'brand_id',
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
			'column' => 'brand_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('brand_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['brand_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'brand_nama' 			=> $this->input->post('brand_nama', TRUE),
				'brand_status_aktif' 	=> $this->input->post('brand_status_aktif', TRUE),
				'brand_create_date' 	=> date('Y-m-d H:i:s'),
				'brand_update_date' 	=> date('Y-m-d H:i:s'),
				'brand_create_by' 		=> $this->session->userdata('user_username'),
				'brand_revised' 		=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'brand_nama' 			=> $this->input->post('brand_nama', TRUE),
				'brand_status_aktif' 	=> $this->input->post('brand_status_aktif', TRUE),
				'brand_update_date' 	=> date('Y-m-d H:i:s'),
				'brand_update_by' 		=> $this->session->userdata('user_username'),
				'brand_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'brand_status_aktif' 	=> 'n',
				'brand_update_date' 	=> date('Y-m-d H:i:s'),
				'brand_update_by' 		=> $this->session->userdata('user_username'),
				'brand_revised' 		=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'brand_status_aktif' 	=> 'y',
				'brand_update_date' 	=> date('Y-m-d H:i:s'),
				'brand_update_by' 		=> $this->session->userdata('user_username'),
				'brand_revised' 		=> $rev,
			);
		}

		return $data;
	}

	function nonaktif_karyawan($type_id)
	{
		// select data karyawan
		$tblKaryawan = 'm_karyawan';
		$select = 'karyawan_id, karyawan_revised';
		$where['data'][] = array(
			'column' => 'm_departemen_id',
			'param'	 => $type_id,
		);
		$idKaryawan = $this->mod->select($select, $tblKaryawan, NULL, $where);
		if ($idKaryawan) {
			$idKaryawan = $idKaryawan->result_array();$dataKaryawan = array();
			$data = array();
			$i = 0;
			foreach ($idKaryawan as $id) {
				// masukkan data karyawan ke dalam array
				$dataKaryawan[$i] = array(
					'karyawan_id' 				=> $id['karyawan_id'],
					'karyawan_status_aktif' 	=> 'n',
					'karyawan_update_date' 		=> date('Y-m-d H:i:s'),
					'karyawan_update_by' 		=> $this->session->userdata('user_username'),
					'karyawan_revised' 			=> $id['karyawan_revised'] + 1, 
				);
				//
				//select user_revised
				$select = 'user_revised';
				$whereUser['data'][] = array(
					'column' => 'm_karyawan_id',
					'param'	 => $id['karyawan_id'],
				);
				$revUser = $this->mod->select($select, 's_user', NULL, $whereUser);
				// end select
				// cek jika data ada
				if($revUser)
				{
					// ambil data dan masukkan ke dalam array data
					$revisedUser = $revUser->row_array();
					$data[$i] = array(
					    'm_karyawan_id' 		=> $id['karyawan_id'] ,
					    'user_status_aktif' 	=> 'n',
						'user_update_date' 		=> date('Y-m-d H:i:s'),
						'user_update_by' 		=> $this->session->userdata('user_username'),
						'user_revised' 			=> $revisedUser['user_revised'] + 1,
				    );
				}
				$i++;
			}
			$updateKaryawan = $this->db->update_batch($tblKaryawan, $dataKaryawan, 'karyawan_id');
			if(count($data) > 0)
			{
				$updateUser = $this->db->update_batch('s_user', $data, 'm_karyawan_id');
			}
		}
		

        return true;
	}

	public function loadDataSelectWhere(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'brand_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'brand_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'brand_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->brand_id,
						'text'	=> $val->brand_nama
					);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}
	/* end Function */

}
