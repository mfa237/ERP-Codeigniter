<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_cabang extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_cabang';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(2);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Cabang',
			'title_page2' 	=> 'Master Cabang',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('cabang/V_cabang', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(2);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama,cabang_status_aktif',
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
				if ($val->cabang_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormCabang('.$val->cabang_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->cabang_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}

				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormCabang('.$val->cabang_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->cabang_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
						</button>';
					}

				}
				$response['data'][] = array(
					$no,
					$val->cabang_kode,
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
		$this->load->view("cabang/V_form_cabang");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'cabang_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI Kota
				$hasil1['val2'] = array();
				$where_type['data'][] = array(
					'column' => 'id',
					'param'	 => $val->cabang_kota
				);
				$query_type = $this->mod->select('*','regencies',NULL,$where_type);
				foreach ($query_type->result() as $val2) {
					$hasil1['val2'][] = array(
						'id' 	=> $val2->id,
						'text' 	=> $val2->name
					);
				}
				// END CARI Kota
				$array_telp = json_decode($val->cabang_telepon);
				for ($i = 0; $i < sizeof($array_telp); $i++) {
					$hasil3['val2'][] = array(
						'text' 	=> $array_telp[$i]
					);
				}
				$array_fax = json_decode($val->cabang_fax);
				for ($i = 0; $i < sizeof($array_fax); $i++) {
					$hasil2['val2'][] = array(
						'text' 	=> $array_fax[$i]
					);
				}
				$array_email = json_decode($val->cabang_email);
				for ($i = 0; $i < sizeof($array_email); $i++) {
					$hasil4['val2'][] = array(
						'text' 	=> $array_email[$i]
					);
				}
				$where_ ="";
				if ($val->cabang_gudangdisplay) {
					$where_['data'][] = array(
						'column' => 'gudang_id',
						'param'	 => $val->cabang_gudangdisplay
					);
				}

				$gudang = $this->mod->select('gudang_nama', 'm_gudang', NULL, $where_)->row();
				// echo $this->db->last_query();
				$response['val'][] = array(
					'kode' 					=> $val->cabang_id,
					'cabang_kode' 					=> $val->cabang_kode,
					'cabang_nama' 			=> $val->cabang_nama,
					'cabang_alamat' 		=> $val->cabang_alamat,
					'cabang_kota' 			=> $hasil1,
					'cabang_telepon' 		=> $hasil3,
					'jml_telepon'			=> sizeof(json_decode($val->cabang_telepon)),
					'cabang_fax' 			=> $hasil2,
					'jml_fax'				=> sizeof(json_decode($val->cabang_fax)),
					'cabang_email' 			=> $hasil4,
					'jml_email'				=> sizeof(json_decode($val->cabang_email)),
					'cabang_status_aktif' 	=> $val->cabang_status_aktif,
					'cabang_gudangdisplay'	=> $val->cabang_gudangdisplay,
					'cabang_gudangdisplaynama'	=> $gudang->gudang_nama
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
			'column' => 'cabang_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'cabang_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'cabang_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->cabang_id,
					'text'	=> $val->cabang_nama
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
				'column' => 'cabang_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($data['cabang_status_aktif'] == 'n')
			{
				$updateGudang = $this->nonaktif_gudang($id);
				$updateKaryawan = $this->nonaktif_karyawan($id);
				if($update->status) {
					if(($updateGudang) && ($updateKaryawan))
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
			'column' => 'cabang_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		$updateGudang = $this->nonaktif_gudang($id);
		$updateKaryawan = $this->nonaktif_karyawan($id);
		if($update->status) {
			if(($updateGudang) && ($updateKaryawan))
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
			'column' => 'cabang_id',
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
			'column' => 'cabang_id',
			'param'	 => $id
		);

		$queryRevised = $this->mod->select('cabang_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['cabang_revised'] + 1;
		}

		if ($type == 1) {
			$defaultValue = json_encode($this->input->post('cabang_telepon'));
			$fax = json_encode($this->input->post('cabang_fax'));
			$email = json_encode($this->input->post('cabang_email'));
			$data = array(
				'cabang_kode' 						=> $this->input->post('cabang_kode', TRUE),
				'cabang_nama' 						=> $this->input->post('cabang_nama', TRUE),
				'cabang_alamat' 					=> $this->input->post('cabang_alamat', TRUE),
				'cabang_kota' 						=> $this->input->post('cabang_kota', TRUE),
				'cabang_telepon' 					=> $defaultValue,
				'cabang_fax' 							=> $fax,
				'cabang_email' 						=> $email,
				'cabang_status_aktif' 		=> $this->input->post('cabang_status_aktif', TRUE),
				'cabang_create_date' 			=> date('Y-m-d H:i:s'),
				'cabang_update_date' 			=> date('Y-m-d H:i:s'),
				'cabang_create_by' 				=> $this->session->userdata('user_username'),
				'cabang_revised' 					=> 0,
				'cabang_gudangdisplay' 		=> $this->input->post('cabang_display', TRUE)
			);
		} else if ($type == 2) {
			$defaultValue = json_encode($this->input->post('cabang_telepon'));
			$fax = json_encode($this->input->post('cabang_fax'));
			$email = json_encode($this->input->post('cabang_email'));
			$data = array(
				'cabang_kode' 						=> $this->input->post('cabang_kode', TRUE),
				'cabang_nama' 					=> $this->input->post('cabang_nama', TRUE),
				'cabang_alamat' 				=> $this->input->post('cabang_alamat', TRUE),
				'cabang_kota' 					=> $this->input->post('cabang_kota', TRUE),
				'cabang_telepon' 				=> $defaultValue,
				'cabang_fax' 						=> $fax,
				'cabang_email' 					=> $email,
				'cabang_status_aktif' 	=> $this->input->post('cabang_status_aktif', TRUE),
				'cabang_update_date' 		=> date('Y-m-d H:i:s'),
				'cabang_update_by' 			=> $this->session->userdata('user_username'),
				'cabang_revised' 				=> $rev,
				'cabang_gudangdisplay' 	=> $this->input->post('cabang_display', TRUE)
			);
		} else if ($type == 3) {
			$data = array(
				'cabang_status_aktif' 	=> 'n',
				'cabang_update_date' 		=> date('Y-m-d H:i:s'),
				'cabang_update_by' 			=> $this->session->userdata('user_username'),
				'cabang_revised' 				=> $rev
			);
		} else if ($type == 4) {
			$data = array(
				'cabang_status_aktif' 	=> 'y',
				'cabang_update_date' 		=> date('Y-m-d H:i:s'),
				'cabang_update_by' 			=> $this->session->userdata('user_username'),
				'cabang_revised' 				=> $rev
			);
		}

		return $data;
	}

	function nonaktif_gudang($type_id)
	{
		$tblGudang= 'm_gudang';
		$where['data'][] = array(
			'column' => 'm_cabang_id',
			'param'	 => $type_id,
		);
		$queryRevised = $this->mod->select('gudang_revised', $tblGudang, NULL, $where);
		if($queryRevised)
		{
			$revised = $queryRevised->row_array();
			$rev = $revised['gudang_revised'] + 1;
			$dataGudang = array(
				'gudang_status_aktif' 		=> 'n',
				'gudang_update_date' 		=> date('Y-m-d H:i:s'),
				'gudang_update_by' 			=> $this->session->userdata('user_username'),
				'gudang_revised' 			=> $rev,
			);
			$updateGudang = $this->mod->update_data_table($tblGudang, $where, $dataGudang);
			if($updateGudang->status)
				return true;
			else
				return false;
		}
		else
			return true;

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

	function loadDataSelectDisplay()
	{
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = 'a.gudang_id, a.gudang_nama';
		$cabang_id = $this->input->get('id');
		// echo $cabang_id;
		$join = array();
		if ($cabang_id) {

			$select = 'a.gudang_id, a.gudang_nama, b.cabang_gudangdisplay';
			$join['data'][] = array(
				'table' => 'm_cabang b',
				'join'	=> 'b.cabang_id = a.m_cabang_id',
				'type'	=> 'left'
			);
		}

		$where['data'][] = array(
			'column' => 'a.m_cabang_id',
			'param'	 => $cabang_id
		);

		$where['data'][] = array(
			'column' => 'a.gudang_status_aktif',
			'param'	 => 'y'
		);

		$response['items'] = array();
		$qGudangDisplay = $this->mod->select($select, 'm_gudang a', $join, $where);

		if ($qGudangDisplay<>false) {
			foreach ($qGudangDisplay->result() as $row) {
				$response['items'][] = array(
					'id' 		=> $row->gudang_id,
					'text' 	=> $row->gudang_nama
				);
			}
		}
		echo json_encode($response);
	}

	function checkKode(){
		$data['status'] = "204";
		$cabang_kode = $this->input->post('cabang_kode');
		$cabang_id = $this->input->post('cabang_id');
		if ($cabang_kode != null) {
			if ($cabang_id != null) {
				$where = array('cabang_id !=' => $cabang_id, "cabang_kode" => $cabang_kode );
			} else {
				$where = array("cabang_kode" => $cabang_kode );
			}


			$checkkode = $this->mod->select_config_one("m_cabang", "COUNT(cabang_id) as result", $where);
			$checkkode = $checkkode->result;
			if ($checkkode) {
				$data['status'] = "200";
			}
		}

		echo json_encode($data);
	}
	/* end Function */

}
