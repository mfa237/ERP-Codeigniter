<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_gudang extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_gudang';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(7);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Gudang',
			'title_page2' 	=> 'Master Gudang',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('gudang/V_gudang', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(7);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'gudang_nama,cabang_nama,jenis_gudang_nama,gudang_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select,'v_gudang');
		$query_filter = $this->mod->select($select, 'v_gudang', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_gudang', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->gudang_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormGudang('.$val->gudang_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->gudang_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}

				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormGudang('.$val->gudang_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->gudang_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}

				}
				$response['data'][] = array(
					$no,
					$val->gudang_nama,
					$val->cabang_nama,
					$val->jenis_gudang_nama,
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
		$query = $this->mod->select('cabang_id, cabang_nama', 'm_cabang');
		$cab['cabang'] = $query->result_array();
		$queryJenis = $this->mod->select('jenis_gudang_id, jenis_gudang_nama', 'm_jenis_gudang');
		$jenis['jenisgudang'] = $queryJenis->result_array();
		$data = array(
			'cabang' => $cab['cabang'],
			'jenis' => $jenis['jenisgudang'],
		);
 		$this->load->view("gudang/V_form_gudang", $data);
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'gudang_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI Kota
				$hasil3['val2'] = array();
				$where_kota['data'][] = array(
					'column' => 'id',
					'param'	 => $val->gudang_kota
				);
				$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
				foreach ($query_kota->result() as $val2) {
					$hasil3['val2'][] = array(
						'id' 	=> $val2->id,
						'text' 	=> $val2->name
					);
				}
				// END CARI Kota
				// CARI JENIS GUDANG
				$hasil1['val2'] = array();
				$where_type['data'][] = array(
					'column' => 'jenis_gudang_id',
					'param'	 => $val->m_jenis_gudang_id
				);
				$query_type = $this->mod->select('*','m_jenis_gudang',NULL,$where_type);
				foreach ($query_type->result() as $val2) {
					$hasil1['val2'][] = array(
						'id' 	=> $val2->jenis_gudang_id,
						'text' 	=> $val2->jenis_gudang_nama
					);
				}
				// END CARI JENIS GUDANG
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
				$array_telp = json_decode($val->gudang_telepon);
				for ($i = 0; $i < sizeof($array_telp); $i++) {
					$hasil4['val2'][] = array(
						'text' 	=> $array_telp[$i]
					);
				}
				$array_fax = json_decode($val->gudang_fax);
				for ($i = 0; $i < sizeof($array_fax); $i++) {
					$hasil5['val2'][] = array(
						'text' 	=> $array_fax[$i]
					);
				}
				$array_email = json_decode($val->gudang_email);
				for ($i = 0; $i < sizeof($array_email); $i++) {
					$hasil6['val2'][] = array(
						'text' 	=> $array_email[$i]
					);
				}
				$response['val'][] = array(
					'kode' 					=> $val->gudang_id,
					'gudang_nama' 			=> $val->gudang_nama,
					'gudang_alamat' 		=> $val->gudang_alamat,
					'gudang_kota' 			=> $hasil3,
					// 'gudang_telepon' 		=> $val->gudang_telepon,
					'gudang_telepon' 		=> $hasil4,
					'jml_telepon'			=> sizeof(json_decode($val->gudang_telepon)),
					'gudang_fax' 			=> $hasil5,
					'jml_fax'				=> sizeof(json_decode($val->gudang_fax)),
					'gudang_email' 			=> $hasil6,
					'jml_email'				=> sizeof(json_decode($val->gudang_email)),
					'm_cabang_id' 			=> $hasil2,
					'm_jenis_gudang_id' 	=> $hasil1,
					'gudang_status_aktif' 	=> $val->gudang_status_aktif
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
			'column' => 'gudang_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'gudang_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'gudang_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->gudang_id,
					'text'	=> $val->gudang_nama
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function loadData_selectGudang($type){
		$table = "m_gudang a";

		$select_ = "a.*, b.m_cabang_id, c.cabang_gudangdisplay";
	  $tableuser = 's_user a';

	  $join_['data'][] = array(
	    'table' => 'm_karyawan b',
	    'join'	=> 'b.karyawan_id = a.m_karyawan_id',
	    'type'	=> 'left'
	  );

	  $join_['data'][] = array(
	    'table' => 'm_cabang c',
	    'join'	=> 'c.cabang_id = b.m_cabang_id',
	    'type'	=> 'left'
	  );

	  $where_['data'][] = array(
	    'column' => 'a.user_id',
	    'param'	 => $this->session->userdata('user_id')
	  );


	  $user = $this->mod->select($select_, $tableuser, $join_, $where_)->row();
		$cabang = $user->m_cabang_id;
		$gudangdisplayid = $user->cabang_gudangdisplay;


		if ($type == 1){
			$select = 'a.*';

			$join['data'][] = array(
				'table' => 'm_cabang b',
				'join'	=> 'b.cabang_id = a.m_cabang_id',
				'type'	=> 'left'
			);

			$where['data'][] = array(
				'column' => 'a.gudang_status_aktif',
				'param'	 => 'y'
			);

			$where['data'][] = array(
				'column' => 'a.m_cabang_id',
				'param'	 => $this->input->get('id')
			);

			$order['data'][] = array(
				'column' => 'a.gudang_nama',
				'type'	 => 'ASC'
			);

			$query = $this->mod->select($select, $table, NULL, $where, NULL, NULL, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->gudang_id,
						'text'	=> $val->gudang_nama
					);
				}
				$response['status'] = '200';
			}
		} else if ($type == 2) {
			$param = $this->input->get('q');
			if ($param!=NULL) {
				$param = $this->input->get('q');
			} else {
				$param = "";
			}
			$selectdisplay = 'a.*';

			$joindisplay['data'][] = array(
				'table' => 'm_cabang b',
				'join'	=> 'b.cabang_id = a.m_cabang_id',
				'type'	=> 'left'
			);

			$wheredisplay['data'][] = array(
				'column' => 'a.gudang_status_aktif',
				'param'	 => 'y'
			);
			$wheredisplay['data'][] = array(
				'column' => 'a.m_cabang_id',
				'param'	 => $this->session->userdata('cabang_id'),
			);
			$where_likedisplay['data'][] = array(
				'column' => 'a.gudang_nama',
				'param'	 => $this->input->get('q')
			);
			$orderdisplay['data'][] = array(
				'column' => 'a.gudang_nama',
				'type'	 => 'ASC'
			);

			$where2display = array('a.gudang_id !=' => $gudangdisplayid);

			$query = $this->mod->select($selectdisplay, $table, $joindisplay, $wheredisplay, $where2display, $where_likedisplay, $orderdisplay);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->gudang_id,
						'text'	=> $val->gudang_nama
					);
				}
				$response['status'] = '200';
			}
		}
		echo json_encode($response);
	}

	public function loadData_selectKota(){ // untuk select data kota
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where_like['data'][] = array(
			'column' => 'name',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'name',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, 'regencies', NULL, NULL, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->id,
					'text'	=> $val->name
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	// Function Insert & Update
	public function postData()
	{
		$id = $this->input->post('kode');
		if (strlen($id)>0) {
			//UPDATE
			$data = $this->general_post_data(2, $id);
			$where['data'][] = array(
				'column' => 'gudang_id',
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
			'column' => 'gudang_id',
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
			'column' => 'gudang_id',
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
			'column' => 'gudang_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('gudang_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['gudang_revised'] + 1;
		}
		if ($type == 1) {
			$defaultValue = json_encode($this->input->post('gudang_telepon'));
			$fax = json_encode($this->input->post('gudang_fax'));
			$email = json_encode($this->input->post('gudang_email'));
			$data = array(
				'gudang_nama' 				=> $this->input->post('gudang_nama', TRUE),
				'gudang_alamat' 			=> $this->input->post('gudang_alamat', TRUE),
				'gudang_kota' 				=> $this->input->post('gudang_kota', TRUE),
				'gudang_telepon' 			=> $defaultValue,
				'gudang_fax' 				=> $fax,
				'gudang_email' 				=> $email,
				'm_cabang_id' 				=> $this->input->post('m_cabang_id', TRUE),
				'm_jenis_gudang_id' 		=> $this->input->post('m_jenis_gudang_id', TRUE),
				'gudang_status_aktif' 		=> $this->input->post('gudang_status_aktif', TRUE),
				'gudang_create_date' 		=> date('Y-m-d H:i:s'),
				'gudang_update_date' 		=> date('Y-m-d H:i:s'),
				'gudang_create_by' 			=> $this->session->userdata('user_username'),
				'gudang_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$defaultValue = json_encode($this->input->post('gudang_telepon'));
			$fax = json_encode($this->input->post('gudang_fax'));
			$email = json_encode($this->input->post('gudang_email'));
			$data = array(
				'gudang_nama' 				=> $this->input->post('gudang_nama', TRUE),
				'gudang_alamat' 			=> $this->input->post('gudang_alamat', TRUE),
				'gudang_kota' 				=> $this->input->post('gudang_kota', TRUE),
				'gudang_telepon' 			=> $defaultValue,
				'gudang_fax' 				=> $fax,
				'gudang_email' 				=> $email,
				'm_cabang_id' 				=> $this->input->post('m_cabang_id', TRUE),
				'm_jenis_gudang_id' 		=> $this->input->post('m_jenis_gudang_id', TRUE),
				'gudang_status_aktif' 		=> $this->input->post('gudang_status_aktif', TRUE),
				'gudang_update_date' 		=> date('Y-m-d H:i:s'),
				'gudang_update_by' 			=> $this->session->userdata('user_username'),
				'gudang_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'gudang_status_aktif' 		=> 'n',
				'gudang_update_date' 		=> date('Y-m-d H:i:s'),
				'gudang_update_by' 			=> $this->session->userdata('user_username'),
				'gudang_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'gudang_status_aktif' 		=> 'y',
				'gudang_update_date' 		=> date('Y-m-d H:i:s'),
				'gudang_update_by' 			=> $this->session->userdata('user_username'),
				'gudang_revised' 			=> $rev,
			);
		}

		return $data;
	}


	/* end Function */

}
