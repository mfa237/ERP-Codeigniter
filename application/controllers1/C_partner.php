<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_partner extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_partner';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(6);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Partner',
			'title_page2' 	=> 'Master Partner',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('partner/V_partner', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(6);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'partner_status, partner_nama, partner_nama_cetak, partner_status_aktif',
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
				if($val->partner_status == '1') {
					$partnerStatus = 'Vendor';
				}
				elseif ($val->partner_status == '2') {
					$partnerStatus = 'Member';
				}
				else {
					$partnerStatus = 'Vendor dan Member';
				}
				if ($val->partner_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormPartner('.$val->partner_id.')" title="Edit" data-toggle="modal" href="#modaladd">
																	<i class="icon-pencil text-center"></i>
																</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->partner_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}

				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormPartner('.$val->partner_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->partner_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}

				}
				$array_value = json_decode($val->partner_nama_cetak, TRUE);
				$default_value = implode(', ', $array_value);
				$response['data'][] = array(
					$no,
					$partnerStatus,
					$val->partner_nama,
					$default_value,
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
		$this->load->view("partner/V_form_partner");
	}

	public function getFormLogin(){
		$id = $this->input->post('id');
		$data = array(
				'id_partner' => $id,
				'action'		 => 'C_partner/checklogin'
			);
		$this->load->view("partner/V_form_login", $data);
		// echo $data['id_partner'];
	}

	function checklogin()
	{
		$user = $this->input->post('i_username', TRUE);
		$pass = md5(base64_decode($this->input->post('i_password', TRUE)));
		$user_data = $this->mod->check_exist_user($user,$pass);

		if(!$user_data)
			$response['status'] = '204';
		else{
			$response['status'] = '200';
		}

		echo json_encode($response);
	}



	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'partner_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$array_namaCetak = json_decode($val->partner_nama_cetak);
				$hasil7['val2'] = array();
				for ($i = 0; $i < sizeof($array_namaCetak); $i++) {
					$hasil7['val2'][] = array(
						'text' 	=> $array_namaCetak[$i]
					);
				}
				$array_alamatCetak = json_decode($val->partner_alamat_cetak);
				$hasil8['val2'] = array();
				for ($i = 0; $i < sizeof($array_alamatCetak); $i++) {
					$hasil8['val2'][] = array(
						'text' 	=> $array_alamatCetak[$i]
					);
				}
				$array_telp = json_decode($val->partner_telepon);
				$hasil1['val2'] = array();
				for ($i = 0; $i < sizeof($array_telp); $i++) {
					$hasil1['val2'][] = array(
						'text' 	=> $array_telp[$i]
					);
				}
				$array_telpCetak = json_decode($val->partner_telepon_cetak);
				$hasil2['val2'] = array();
				for ($i = 0; $i < sizeof($array_telpCetak); $i++) {
					$hasil2['val2'][] = array(
						'text' 	=> $array_telpCetak[$i]
					);
				}
				$array_email = json_decode($val->partner_email);
				$hasil3['val2'] = array();
				for ($i = 0; $i < sizeof($array_email); $i++) {
					$hasil3['val2'][] = array(
						'text' 	=> $array_email[$i]
					);
				}
				$array_emailCetak = json_decode($val->partner_email_cetak);
				$hasil4['val2'] = array();
				for ($i = 0; $i < sizeof($array_emailCetak); $i++) {
					$hasil4['val2'][] = array(
						'text' 	=> $array_emailCetak[$i]
					);
				}
				$array_fax = json_decode($val->partner_fax);
				$hasil5['val2'] = array();
				for ($i = 0; $i < sizeof($array_fax); $i++) {
					$hasil5['val2'][] = array(
						'text' 	=> $array_fax[$i]
					);
				}
				$array_faxCetak = json_decode($val->partner_fax_cetak);
				$hasil6['val2'] = array();
				for ($i = 0; $i < sizeof($array_faxCetak); $i++) {
					$hasil6['val2'][] = array(
						'text' 	=> $array_faxCetak[$i]
					);
				}
				$hasil9['val2'] = array();
				$where_kota['data'][] = array(
					'column' => 'id',
					'param'	 => $val->partner_kota
				);
				$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
				if($query_kota)
				{
					foreach ($query_kota->result() as $val2) {
						$hasil9['val2'][] = array(
							'id' 	=> $val2->id,
							'text' 	=> $val2->name
						);
					}
				}
				$response['val'][] = array(
					'kode' 							=> $val->partner_id,
					'partner_status' 				=> $val->partner_status,
					'partner_nama' 					=> $val->partner_nama,
					// 'partner_nama_cetak' 			=> $val->partner_nama_cetak,
					'partner_nama_cetak' 			=> $hasil7,
					'partner_nama_cetak2'			=> implode(', ', $array_namaCetak),
					'jml_namaCetak'					=> sizeof(json_decode($val->partner_nama_cetak)),
					'partner_alamat' 				=> $val->partner_alamat,
					'partner_kota'					=> $hasil9,
					// 'partner_alamat_cetak'			=> $val->partner_alamat_cetak,
					'partner_alamat_cetak' 			=> $hasil8,
					'partner_alamat_cetak2'			=> implode(', ', $array_alamatCetak),
					'jml_alamatCetak'				=> sizeof(json_decode($val->partner_alamat_cetak)),
					'partner_telepon' 				=> $hasil1,
					'partner_telepon2' 				=> implode(', ', $array_telp),
					'jml_telepon'					=> sizeof(json_decode($val->partner_telepon)),
					'partner_telepon_cetak' 		=> $hasil2,
					'partner_telepon_cetak2'		=> implode(', ', $array_telpCetak),
					'jml_telpCetak'					=> sizeof(json_decode($val->partner_telepon_cetak)),
					'partner_email' 				=> $hasil3,
					'jml_email'						=> sizeof(json_decode($val->partner_email)),
					'partner_email_cetak' 			=> $hasil4,
					'jml_emailCetak'				=> sizeof(json_decode($val->partner_email_cetak)),
					'partner_fax' 					=> $hasil5,
					'partner_fax2' 					=> implode(', ', $array_fax),
					'jml_fax'						=> sizeof(json_decode($val->partner_fax)),
					'partner_fax_cetak'				=> $hasil6,
					'partner_fax_cetak2'			=> implode(', ', $array_faxCetak),
					'jml_faxCetak'					=> sizeof(json_decode($val->partner_fax_cetak)),
					'partner_limit_kredit'			=> $val->partner_limit_kredit,
					'partner_nomor_npwp'			=> $val->partner_nomor_npwp,
					'partner_file_npwp'				=> $val->partner_file_npwp,
					'partner_status_aktif' 			=> $val->partner_status_aktif
				);
			}

			echo json_encode($response);
		}
	}

	public function loadDataLimit(){
		$select = 'a.partner_id, a.partner_nama, a.partner_limit_kredit, SUM(e.faktur_penjualan_total) AS jumlah';
		$join['data'][] = array(
			'table' => 't_po_customer b',
			'join'	=> 'b.m_partner_id = a.partner_id',
			'type'	=> 'left'
		);
		$join['data'][] = array(
			'table' => 't_so_customer c',
			'join'	=> 'c.t_po_customer_id = b.po_customer_id',
			'type'	=> 'left'
		);
		$join['data'][] = array(
			'table' => 't_surat_jalan d',
			'join'	=> 'd.t_so_customer_id = c.so_customer_id',
			'type'	=> 'left'
		);
		$join['data'][] = array(
			'table' => 't_faktur_penjualan e',
			'join'	=> 'e.t_surat_jalan_id = d.surat_jalan_id',
			'type'	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'partner_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, 'm_partner a', $join, $where);
		if ($query<>false) {
			$response['query'] = $query;
			foreach ($query->result() as $val) {
				if (($val->partner_limit_kredit - $val->jumlah) > 0) {
					$jumlah_sisa = $val->partner_limit_kredit - $val->jumlah;
				} else {
					$jumlah_sisa = 0;
				}
				$response['val'][] = array(
					'kode' 					=> $val->partner_id,
					'partner_nama' 			=> $val->partner_nama,
					'partner_limit_kredit' 	=> $val->partner_limit_kredit,
					'partner_kredit' 		=> $val->jumlah,
					'partner_sisa_kredit'	=> $jumlah_sisa,
				);
			}
		}
		echo json_encode($response);
	}

	// SELECT SUPPLIER
	public function loadData_select1(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where = 'partner_status = 1 AND  CONCAT_WS(" ", partner_nama) LIKE "%'.$param.'%" ESCAPE "!"
		AND partner_status_aktif = "y"
		OR partner_status = 3 AND  CONCAT_WS(" ", partner_nama) LIKE "%'.$param.'%" ESCAPE "!"
		AND partner_status_aktif = "y" ';
		$order['data'][] = array(
			'column' => 'partner_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, NULL, $where, NULL, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->partner_id,
					'text'	=> $val->partner_nama
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	// SELECT CUSTOMER
	public function loadData_select2(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where = 'partner_status = 2 AND  CONCAT_WS(" ", partner_nama) LIKE "%'.$param.'%" ESCAPE "!"
		AND partner_status_aktif = "y"
		OR partner_status = 3 AND  CONCAT_WS(" ", partner_nama) LIKE "%'.$param.'%" ESCAPE "!"
		AND partner_status_aktif = "y" ';
		$order['data'][] = array(
			'column' => 'partner_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, NULL, $where, NULL, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->partner_id,
					'text'	=> $val->partner_nama
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	// Function Insert & Update
	public function postData(){
		$id = $this->input->post('kode');
		$config['upload_path']          = './uploads/file_npwp_partner/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|doc';
        $config['max_size']             = 30000;

		$this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('partner_file_npwp'))
        {
                $error = array('error' => $this->upload->display_errors());
                $response['check'] = $error;
        }
        else
        {
                $success = array('upload_data' => $this->upload->data());
                $response['check'] = $success;
        }

		if (strlen($id)>0) {
			//UPDATE
			$data = $this->general_post_data(2, $id);
			$where['data'][] = array(
				'column' => 'partner_id',
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
		$response['data'] = $data;

		echo json_encode($response);
	}

	// Function Delete
	public function deleteData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(3, $id);
		$where['data'][] = array(
			'column' => 'partner_id',
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
			'column' => 'partner_id',
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
			'column' => 'partner_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('partner_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['partner_revised'] + 1;
		}
		if ($type == 1) {
			$namCetak = json_encode($this->input->post('partner_nama_cetak'));
			$alamatCetak = json_encode($this->input->post('partner_alamat_cetak'));
			$telp = json_encode($this->input->post('partner_telepon'));
			$telpCetak = json_encode($this->input->post('partner_telepon_cetak'));
			$email = json_encode($this->input->post('partner_email'));
			$emailCetak = json_encode($this->input->post('partner_email_cetak'));
			$fax = json_encode($this->input->post('partner_fax'));
			$faxCetak = json_encode($this->input->post('partner_fax_cetak'));
			$data = array(
				'partner_status' 			=> $this->input->post('partner_status', TRUE),
				'partner_nama' 				=> $this->input->post('partner_nama', TRUE),
				'partner_nama_cetak' 		=> $namCetak,
				'partner_alamat' 			=> $this->input->post('partner_alamat', TRUE),
				'partner_alamat_cetak' 		=> $alamatCetak,
				'partner_kota' 				=> $this->input->post('partner_kota', TRUE),
				'partner_telepon' 			=> $telp,
				'partner_telepon_cetak' 	=> $telpCetak,
				'partner_email' 			=> $email,
				'partner_email_cetak' 		=> $emailCetak,
				'partner_fax' 				=> $fax,
				'partner_fax_cetak'			=> $faxCetak,
				'partner_limit_kredit' 		=> $this->replaceFormatNumber($this->input->post('partner_limit_kredit', TRUE)),
				'partner_nomor_npwp' 		=> $this->input->post('partner_nomor_npwp', TRUE),
				'partner_file_npwp' 		=> $this->upload->file_name,
				'partner_status_aktif' 		=> $this->input->post('partner_status_aktif', TRUE),
				'partner_create_date' 		=> date('Y-m-d H:i:s'),
				'partner_update_date' 		=> date('Y-m-d H:i:s'),
				'partner_create_by' 		=> $this->session->userdata('user_username'),
				'partner_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$namCetak = json_encode($this->input->post('partner_nama_cetak'));
			$alamatCetak = json_encode($this->input->post('partner_alamat_cetak'));
			$telp = json_encode($this->input->post('partner_telepon'));
			$telpCetak = json_encode($this->input->post('partner_telepon_cetak'));
			$email = json_encode($this->input->post('partner_email'));
			$emailCetak = json_encode($this->input->post('partner_email_cetak'));
			$fax = json_encode($this->input->post('partner_fax'));
			$faxCetak = json_encode($this->input->post('partner_fax_cetak'));
			if(($namafile = $this->upload->file_name) != "")
			{
				$namafile = $this->upload->file_name;
			}
			else
			{
				$namafile = $this->input->post('partner_file_npwp_lama', TRUE);
			}
			$data = array(
				'partner_status' 			=> $this->input->post('partner_status', TRUE),
				'partner_nama' 				=> $this->input->post('partner_nama', TRUE),
				'partner_nama_cetak' 		=> $namCetak,
				'partner_alamat' 			=> $this->input->post('partner_alamat', TRUE),
				'partner_alamat_cetak' 		=> $alamatCetak,
				'partner_kota' 				=> $this->input->post('partner_kota', TRUE),
				'partner_telepon' 			=> $telp,
				'partner_telepon_cetak' 	=> $telpCetak,
				'partner_email' 			=> $email,
				'partner_email_cetak' 		=> $emailCetak,
				'partner_fax' 				=> $fax,
				'partner_fax_cetak'			=> $faxCetak,
				'partner_limit_kredit' 		=> $this->replaceFormatNumber($this->input->post('partner_limit_kredit', TRUE)),
				'partner_nomor_npwp' 		=> $this->input->post('partner_nomor_npwp', TRUE),
				'partner_file_npwp' 		=> $namafile,
				'partner_status_aktif' 		=> $this->input->post('partner_status_aktif', TRUE),
				'partner_update_date' 		=> date('Y-m-d H:i:s'),
				'partner_update_by' 		=> $this->session->userdata('user_username'),
				'partner_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'partner_status_aktif' 		=> 'n',
				'partner_update_date' 		=> date('Y-m-d H:i:s'),
				'partner_update_by' 		=> $this->session->userdata('user_username'),
				'partner_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'partner_status_aktif' 		=> 'y',
				'partner_update_date' 		=> date('Y-m-d H:i:s'),
				'partner_update_by' 		=> $this->session->userdata('user_username'),
				'partner_revised' 			=> $rev,
			);
		}

		return $data;
	}




	/* end Function */

}
