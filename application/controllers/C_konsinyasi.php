<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_konsinyasi extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'v_konsinyasi';

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
			'title_page' 	=> 'Konsinyasi',
			'title_page2' 	=> 'Master Konsinyasi',

			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('konsinyasi/V_konsinyasi', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(77);
		$select = '*';

		// $join

		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'barang_nama, jenis_barang_nama, category_2_nama, konsinyasi_status_aktif',
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
		$query = $this->mod->select($select, 'v_konsinyasi', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->konsinyasi_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormKonsinyasi('.$val->m_barang_id.')" title="Edit" data-toggle="modal" href="#modaladd">
																<i class="icon-pencil text-center"></i>
															</button>';
					}
					$select2 = 'stok_gudang_jumlah';

					$whereBarangid['data'][] = array(
						'column' => 'm_barang_id',
						'param'	 => $val->m_barang_id
					);

					$qcheckstockgudang = $this->mod->select($select2 ,'t_stok_gudang', NULL, $whereBarangid);
					$stok_gudang_jumlah = 0;
					if ($qcheckstockgudang<>false) {
						$result = $qcheckstockgudang->row();
						$stok_gudang_jumlah = $result->stok_gudang_jumlah;
					}
					// exit();
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->m_barang_id.','.$stok_gudang_jumlah.')" title="Non Aktifkan">
															 	<i class="icon-power text-center"></i>
															 </button>';
					}

				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormKonsinyasi('.$val->m_barang_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->m_barang_id.')" title="Aktifkan">
																<i class="icon-power text-center"></i>
															 </button>';
					}

				}

				$response['data'][] = array(
					$no,
					$val->barang_nama,
					$val->jenis_barang_nama,
					$val->category_2_nama,
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
		// echo $this->db->last_query();
		echo json_encode($response);
	}

//untuk select2 11 may 2017
	function loadDataSelectKons()
	{
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';

		$join['data'][] = array(
			'table' => 'm_barang b',
			'join'  => 'b.barang_id = a.m_barang_id',
			'type'  => 'left'
		);

		$where['data'][] = array(
			'column' => 'a.konsinyasi_status_aktif',
			'param'	 => 'y'
		);

		$where_like['data'][] = array(
			'column' => 'b.barang_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'b.barang_nama',
			'type'	 => 'ASC'
		);

		$query = $this->mod->select($select, 'm_konsinyasi a', $join, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->barang_id,
					'text'	=> $val->barang_nama
				);
			}
			$response['status'] = '200';
		}
		echo json_encode($response);
	}

	public function getForm(){
		$this->load->view("konsinyasi/V_form_konsinyasi");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'm_barang_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI JENIS BARANG
				$hasil1['val2'] = array();
				$where_cat1['data'][] = array(
					'column' => 'jenis_barang_id',
					'param'	 => $val->m_jenis_barang_id
				);
				$query_cat1 = $this->mod->select('*','m_jenis_barang',NULL,$where_cat1);
				foreach ($query_cat1->result() as $val2) {
					$hasil1['val2'][] = array(
						'id' 	=> $val2->jenis_barang_id,
						'text' 	=> $val2->jenis_barang_nama
					);
				}

				$hasil2['val2'] = array();
				$where_cat2['data'][] = array(
					'column' => 'category_2_id',
					'param'	 => $val->m_category_2_id
				);
				$query_cat2 = $this->mod->select('*','m_category_2',NULL,$where_cat2);
				foreach ($query_cat2->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->category_2_id,
						'text' 	=> $val2->category_2_nama
					);
				}

				$hasil3['val2'] = array();
				$where_barang['data'][] = array(
					'column' => 'barang_id',
					'param'	 => $val->m_barang_id
				);
				$query_barang = $this->mod->select('*','m_barang',NULL,$where_barang);
				foreach ($query_barang->result() as $val2) {
					$hasil3['val2'][] = array(
						'id' 	=> $val2->barang_id,
						'text' 	=> $val2->barang_nama
					);
				}

				$response['val'][] = array(
					'kode' 						=> $val->m_barang_id,
					'm_jenis_barang_id' 		=> $hasil1,
					'm_category_2_id' 			=> $hasil2,
					'm_barang_id' 				=> $hasil3,
					'konsinyasi_status_aktif' 	=> $val->konsinyasi_status_aktif
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
			'column' => 'konsinyasi_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'barang_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'barang_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->konsinyasi_id,
					'text'	=> $val->barang_nama
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function loadDataSelectWhere(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$param2 = $this->input->get('parameter');
		if ($param2!=NULL) {
			$where['data'][] = array(
				'column' => 'b.m_barang_id',
				'param'	 => $this->input->get('parameter')
			);
		}
		$select = '*';
		$join['data'][] = array(
			'table' => 'm_konversi_satuan b',
			'join'	=> 'b.m_satuan_id = a.satuan_id',
			'type'	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'a.satuan_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'category_2_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'm_barang_id',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, 'v_konsinyasi', null, null, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->m_barang_id,
					'text'	=> $val->barang_nama
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
				'column' => 'm_barang_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table('m_konsinyasi', $where, $data);
			if($data['konsinyasi_status_aktif'] == 'n')
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
			$insert = $this->mod->insert_data_table('m_konsinyasi', NULL, $data);
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
			'column' => 'm_barang_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table('m_konsinyasi', $where, $data);
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
			'column' => 'm_barang_id',
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
			'column' => 'm_barang_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('konsinyasi_revised', 'm_konsinyasi', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['konsinyasi_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'konsinyasi_id' 			=> $this->input->post('konsinyasi_id', TRUE),
				'm_jenis_barang_id' 		=> $this->input->post('m_jenis_barang_id', TRUE),
				'm_category_2_id' 			=> $this->input->post('m_category_2_id', TRUE),
				'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE),
				'konsinyasi_status_aktif' 	=> $this->input->post('konsinyasi_status_aktif', TRUE),
				'konsinyasi_create_date' 	=> date('Y-m-d H:i:s'),
				'konsinyasi_create_by' 		=> $this->session->userdata('user_username'),
				'konsinyasi_update_date' 	=> '',
				'konsinyasi_update_by' 		=> '',
				'konsinyasi_revised' 		=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'm_jenis_barang_id' 		=> $this->input->post('m_jenis_barang_id', TRUE),
				'm_category_2_id' 			=> $this->input->post('m_category_2_id', TRUE),
				'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE),
				'konsinyasi_status_aktif' 	=> $this->input->post('konsinyasi_status_aktif', TRUE),
				'konsinyasi_update_date' 	=> '',
				'konsinyasi_update_by' 		=> '',
				'konsinyasi_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'konsinyasi_status_aktif' 	=> 'n',
				'konsinyasi_update_date' 	=> '',
				'konsinyasi_update_by' 		=> '',
				'konsinyasi_revised' 		=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'konsinyasi_status_aktif' 	=> 'y',
				'konsinyasi_update_date' 	=> '',
				'konsinyasi_update_by' 		=> '',
				'konsinyasi_revised' 		=> $rev,
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

	function cekStok()
	{
		$id = $this->input->post('id');
		// $tblBarang = 'm_barang';
		// $select = 'barang_minimum_stok';
		// $where['data'][] = array(
		// 	'column' => 'barang_id',
		// 	'param'	 => $id,
		// );
		$query = $this->db->get_where('m_barang', array('barang_id'=>$id));
		$result = $query->row();
		echo $result->barang_minimum_stok;
	}
	/* end Function */

function loadDataSelectBarang(){
	$param = $this->input->get('q');
	$m_category_2_id = $this->input->get('parameter');
	$table = "m_barang a";

	if ($param!=NULL) {
		$param = $this->input->get('q');
	} else {
		$param = "";
	}

	$select = 'a.*, c.stok_gudang_jumlah';


	$join_['data'][] = array(
		'table' => 'm_konversi_satuan b',
		'join'	=> 'b.m_satuan_id = a.satuan_id',
		'type'	=> 'left'
	);

	$join['data'][] = array(
		'table' => 't_stok_gudang c',
		'join'	=> 'c.m_barang_id = a.barang_id',
		'type'	=> 'left'
	);

	$where['data'][] = array(
		'column' => 'a.m_category_2_id',
		'param'	 => $m_category_2_id
	);

	$where_like['data'][] = array(
		'column' => 'a.barang_nama',
		'param'	 => $this->input->get('q')
	);

	$where2 = "a.barang_id NOT IN (SELECT m_barang_id FROM m_konsinyasi)";

	$order['data'][] = array(
		'column' => 'a.barang_nama',
		'type'	 => 'ASC'
	);

	$query = $this->mod->select($select, $table, $join, $where, $where2, $where_like, $order);
	$response['items'] = array();
	if ($query<>false) {
		foreach ($query->result() as $val) {
			$response['items'][] = array(
				'id'									=> $val->barang_id,
				'text'								=> $val->barang_nama,
				'stock_gudang_jumlah'	=> $val->stok_gudang_jumlah ? $val->stok_gudang_jumlah : 0
			);
		}
		$response['status'] = '200';
	}

	echo json_encode($response);
	
}

}
