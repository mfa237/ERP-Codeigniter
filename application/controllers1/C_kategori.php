<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kategori extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'v_category_2';

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
			'title_page' 	=> 'Category 2',
			'title_page2' 	=> 'Master Category 2',
			
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('kategori/V_kategori', $data);
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
			'column' => 'category_2_nama, jenis_barang_nama, category_2_status_aktif',
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
		$query = $this->mod->select($select, 'v_category_2', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->category_2_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormCategory2('.$val->category_2_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->category_2_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
						</button>';
					}
					
				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormCategory2('.$val->category_2_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->category_2_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				}
				
				$response['data'][] = array(
					$no,
					$val->category_2_nama,
					$val->jenis_barang_nama,
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
		$this->load->view("kategori/V_form_kategori");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'category_2_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI JENIS BARANG
				$hasil1['val2'] = array();
				$where_type['data'][] = array(
					'column' => 'jenis_barang_id',
					'param'	 => $val->m_jenis_barang_id
				);
				$query_type = $this->mod->select('*','m_jenis_barang',NULL,$where_type);
				foreach ($query_type->result() as $val2) {
					$hasil1['val2'][] = array(
						'id' 	=> $val2->jenis_barang_id,
						'text' 	=> $val2->jenis_barang_nama
					);
				}
				$response['val'][] = array(
					'kode' 						=> $val->category_2_id,
					'category_2_nama' 			=> $val->category_2_nama,
					'm_jenis_barang_id' 		=> $hasil1,
					'category_2_status_aktif' 	=> $val->category_2_status_aktif
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
			'column' => 'category_2_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'category_2_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'category_2_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->category_2_id,
					'text'	=> $val->category_2_nama
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function loadDataSelectWhere(){
		$param = $this->input->get('q');
		$m_jenis_barang_id = $this->input->get('parameter');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		
		$select = '*';
		$join['data'][] = array(
			'table' => 'm_konversi_satuan b',
			'join'	=> 'b.m_satuan_id = a.satuan_id',
			'type'	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'm_jenis_barang_id',
			'param'	 => $m_jenis_barang_id
		);
		$where_like['data'][] = array(
			'column' => 'category_2_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'category_2_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, null, $where, null, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->category_2_id,
					'text'	=> $val->category_2_nama
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
				'column' => 'category_2_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($data['category_2_status_aktif'] == 'n')
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
			'column' => 'category_2_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table('m_category_2', $where, $data);
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
			'column' => 'category_2_id',
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
			'column' => 'category_2_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('category_2_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['category_2_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'm_jenis_barang_id' 		=> $this->input->post('m_jenis_barang_id', TRUE),
				'category_2_nama' 			=> $this->input->post('category_2_nama', TRUE),
				'category_2_status_aktif' 	=> $this->input->post('category_2_status_aktif', TRUE),
				'category_2_create_date' 	=> date('Y-m-d H:i:s'),
				'category_2_update_date' 	=> date('Y-m-d H:i:s'),
				'category_2_create_by' 		=> $this->session->userdata('user_username'),
				'category_2_revised' 		=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'm_jenis_barang_id' 		=> $this->input->post('m_jenis_barang_id', TRUE),
				'category_2_nama' 			=> $this->input->post('category_2_nama', TRUE),
				'category_2_status_aktif' 	=> $this->input->post('category_2_status_aktif', TRUE),
				'category_2_update_date' 	=> date('Y-m-d H:i:s'),
				'category_2_update_by' 		=> $this->session->userdata('user_username'),
				'category_2_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'category_2_status_aktif' 	=> 'n',
				'category_2_update_date' 	=> date('Y-m-d H:i:s'),
				'category_2_update_by' 		=> $this->session->userdata('user_username'),
				'category_2_revised' 		=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'category_2_status_aktif' 	=> 'y',
				'category_2_update_date' 	=> date('Y-m-d H:i:s'),
				'category_2_update_by' 		=> $this->session->userdata('user_username'),
				'category_2_revised' 		=> $rev,
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
	/* end Function */

}
