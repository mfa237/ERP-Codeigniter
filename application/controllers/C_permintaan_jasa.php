<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_permintaan_jasa extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_permintaan_jasa';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		// $this->view();
	}

	public function view($type){
		$this->check_session();

		if ($type == 1) {
			$priv = $this->cekUser(34);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Produksi',
				'title_page2' 	=> 'Permintaan Jasa',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('permintaan-jasa/V_permintaan_jasa', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		} else if ($type == 2) {
			$priv = $this->cekUser(35);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Gudang',
				'title_page2' 	=> 'Permintaan Jasa',
				);
			if($priv['read'] == 1)
			{
				$this->open_page('permintaan-jasa/V_permintaan_jasa2', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		}
	}

	public function loadData($type){
		// $privGudang = $this->cekUser(21);
		// $priv = $this->cekUser(22);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'departemen_nama, permintaan_jasa_nomor, permintaan_jasa_tanggal, permintaan_jasa_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_permintaan_jasa');
		$query_filter = $this->mod->select($select, 'v_permintaan_jasa', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_permintaan_jasa', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$status = '';
				$button2 = '';
				if ($val->permintaan_jasa_status >= 4) {
					$status = 'disabled';
				}

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Produksi/Permintaan-Jasa/Form/'.$val->permintaan_jasa_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat SPP">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Produksi/Permintaan-Jasa/print-PJ/'.$val->permintaan_jasa_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Gudang/Permintaan-Jasa/Form/'.$val->permintaan_jasa_id.'">
					<button class="btn blue-ebonyclay" type="button" onclick="checkStatusPJ('.$val->permintaan_jasa_id.')" title="Lihat PJ">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Gudang/Permintaan-Jasa/print-PJ/'.$val->permintaan_jasa_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				}
				$response['data'][] = array(
					$no,
					$val->departemen_nama,
					$val->permintaan_jasa_nomor,
					date("d/m/Y",strtotime($val->permintaan_jasa_tanggal)),
					$val->permintaan_jasa_status_nama,
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

	public function getForm1($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Produksi',
			'title_page2' 	=> 'Permintaan Jasa',
			'id'			=> $id
		);
		$this->open_page('permintaan-jasa/V_form_permintaan_jasa', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Gudang',
			'title_page2' 	=> 'Permintaan Jasa',
			'id'			=> $id
		);
		$this->open_page('permintaan-jasa/V_form_permintaan_jasa2', $data);
	}

	public function loadDataWhere($type){
		$select = '*';
		$where['data'][] = array(
			'column' => 'permintaan_jasa_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$where_det['data'][] = array(
					'column' => 't_permintaan_jasa_id',
					'param'	 => $val->permintaan_jasa_id
				);
				$query_det = $this->mod->select('*','t_permintaan_jasadet',NULL,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						// CARI BARANG DAN STOK
						if (@$join_brg['data']) {
							unset($join_brg['data']);
						}
						if (@$where_brg['data']) {
							unset($where_brg['data']);
						}
						$join_brg['data'][] = array(
							'table' => 'm_jenis_barang c',
							'join'	=> 'c.jenis_barang_id = a.m_jenis_barang_id',
							'type'	=> 'left'
						);
						$join_brg['data'][] = array(
							'table' => 'm_satuan d',
							'join'	=> 'd.satuan_id = a.m_satuan_id',
							'type'	=> 'left'
						);
						$where_brg['data'][] = array(
							'column' => 'a.barang_id',
							'param'	 => $val2->m_barang_id
						);
						$query_brg = $this->mod->select('a.*, c.jenis_barang_nama, d.satuan_nama','m_barang a',$join_brg,$where_brg);
						if ($query_brg) {
							foreach ($query_brg->result() as $val3) {
								$response['val2'][] = array(
									'permintaan_jasadet_id'				=> $val2->permintaan_jasadet_id,
									'barang_kode'						=> $val3->barang_kode,
									'barang_nama'						=> $val3->barang_nama,
									'barang_nomor'						=> $val3->barang_nomor,
									'jenis_barang_nama'					=> $val3->jenis_barang_nama,
									'satuan_nama'						=> $val3->satuan_nama,
									'permintaan_jasadet_qty'			=> $val2->permintaan_jasadet_qty,
									'permintaan_jasadet_qty_realisasi'	=> $val2->permintaan_jasadet_qty_realisasi,
									'permintaan_jasadet_status'			=> $val2->permintaan_jasadet_status,
									'permintaan_jasadet_keterangan'		=> $val2->permintaan_jasadet_keterangan,
									'm_barang_id'						=> $val2->m_barang_id,
								);
							}
						}
						// CARI BARANG DAN STOK
					}
				}
				// END CARI DETAIL
				// CARI DEPARTEMEN
				$hasil1['val2'] = array();
				$where_departemen['data'][] = array(
					'column' => 'departemen_id',
					'param'	 => $val->m_departemen_id
				);
				$query_departemen = $this->mod->select('*','m_departemen',NULL,$where_departemen);
				foreach ($query_departemen->result() as $val2) {
					$hasil1['val2'][] = array(
						'id' 	=> $val2->departemen_id,
						'text' 	=> $val2->departemen_nama
					);
				}
				// END CARI DEPARTEMEN
				$response['val'][] = array(
					'kode' 									=> $val->permintaan_jasa_id,
					'permintaan_jasa_nomor' 				=> $val->permintaan_jasa_nomor,
					'permintaan_jasa_tanggal'				=> date("d/m/Y",strtotime($val->permintaan_jasa_tanggal)),
					'permintaan_jasa_tanggal_dibutuhkan'	=> date("d/m/Y",strtotime($val->permintaan_jasa_tanggal_dibutuhkan)),
					'm_departemen_id' 						=> $hasil1,
					'permintaan_jasa_status' 				=> $val->permintaan_jasa_status,
				);
			}

			echo json_encode($response);
		}
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'permintaan_jasa_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->permintaan_jasa_status == 1) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'permintaan_jasa_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 								=> $id,
						'permintaan_jasalog_status_dari' 			=> 1,
						'permintaan_jasalog_status_ke' 				=> 2,
						'permintaan_jasalog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'permintaan_jasalog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_permintaan_jasalog', NULL, $data_log);
					$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}
			}
		} else {
			$response['status'] = '204';
		}
		echo json_encode($response);
	}

	public function loadData_select(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where_like['data'][] = array(
			'column' => 'permintaan_jasa_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'permintaan_jasa_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->permintaan_jasa_id,
					'text'	=> $val->permintaan_jasa_nomor
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'permintaan_jasa_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$where_det['data'][] = array(
					'column' => 't_permintaan_jasa_id',
					'param'	 => $val->permintaan_jasa_id
				);
				$query_det = $this->mod->select('*','t_permintaan_jasadet',NULL,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						// CARI BARANG DAN STOK
						if (@$join_brg['data']) {
							unset($join_brg['data']);
						}
						if (@$where_brg['data']) {
							unset($where_brg['data']);
						}
						$join_brg['data'][] = array(
							'table' => 'm_jenis_barang c',
							'join'	=> 'c.jenis_barang_id = a.m_jenis_barang_id',
							'type'	=> 'left'
						);
						$join_brg['data'][] = array(
							'table' => 'm_satuan d',
							'join'	=> 'd.satuan_id = a.m_satuan_id',
							'type'	=> 'left'
						);
						$where_brg['data'][] = array(
							'column' => 'a.barang_id',
							'param'	 => $val2->m_barang_id
						);
						$query_brg = $this->mod->select('a.*, c.jenis_barang_nama, d.satuan_nama','m_barang a',$join_brg,$where_brg);
						if ($query_brg) {
							foreach ($query_brg->result() as $val3) {
								$response['val2'][] = array(
									'permintaan_jasadet_id'				=> $val2->permintaan_jasadet_id,
									'barang_kode'						=> $val3->barang_kode,
									'barang_nama'						=> $val3->barang_nama,
									'barang_nomor'						=> $val3->barang_nomor,
									'jenis_barang_nama'					=> $val3->jenis_barang_nama,
									'satuan_nama'						=> $val3->satuan_nama,
									'permintaan_jasadet_qty'			=> $val2->permintaan_jasadet_qty,
									'permintaan_jasadet_keterangan'			=> $val2->permintaan_jasadet_keterangan,
									'm_barang_id'						=> $val2->m_barang_id,
								);
							}
						}
						// CARI BARANG DAN STOK
					}
				}
				// END CARI DETAIL
				// CARI DEPARTEMEN
				$hasil1['val2'] = array();
				$where_departemen['data'][] = array(
					'column' => 'departemen_id',
					'param'	 => $val->m_departemen_id
				);
				$query_departemen = $this->mod->select('*','m_departemen',NULL,$where_departemen);
				if ($query_departemen) {
					foreach ($query_departemen->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->departemen_id,
							'text' 	=> $val2->departemen_nama
						);
					}
				}
				// END CARI DEPARTEMEN
				// CARI CABANG
				$hasil2['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI KOTA
						$hasil3['val2'] = array();
						$where_kota['data'][] = array(
							'column' => 'id',
							'param'	 => $val2->cabang_kota
						);
						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
						if ($query_kota) {
							foreach ($query_kota->result() as $val3) {
								$hasil3['val3'][] = array(
									'id' 		=> $val3->id,
									'text' 		=> $val3->name,
								);
							}
						}
						// END CARI KOTA
						$hasil2['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil3,
							'telp'  => json_decode($val2->cabang_telepon)
						);
					}
				}
				// END CARI CABANG
				// CARI PENYETUJU
				// $hasil4['val2'] = array();
				// $where_penyetuju['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->permintaan_pembelian_penyetuju
				// );
				// $query_penyetuju = $this->mod->select('*','m_karyawan',NULL,$where_penyetuju);
				// if ($query_penyetuju) {
				// 	foreach ($query_penyetuju->result() as $val2) {
				// 		$hasil4['val2'][] = array(
				// 			'id' 	=> $val2->karyawan_id,
				// 			'text' 	=> $val2->karyawan_nama
				// 		);
				// 	}
				// }
				// END CARI PENYETUJU
				$name = $val->permintaan_jasa_nomor;
				$response['val'][] = array(
					'kode' 									=> $val->permintaan_jasa_id,
					'permintaan_jasa_nomor' 				=> $val->permintaan_jasa_nomor,
					'permintaan_jasa_tanggal'				=> date("d/m/Y",strtotime($val->permintaan_jasa_tanggal)),
					'permintaan_jasa_tanggal_dibutuhkan'	=> date("d/m/Y",strtotime($val->permintaan_jasa_tanggal_dibutuhkan)),
					'm_departemen_id'						=> $hasil1,
					'permintaan_jasa_status' 				=> $val->permintaan_jasa_status,
					'cabang'								=> $hasil2,
					'permintaan_jasa_created_by' 			=> $val->permintaan_jasa_created_by,
					// 'permintaan_jasa_penyetuju' 			=> $hasil4,
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Permintaan Jasa',
			'title_page2' 	=> 'Print Permintaan Jasa',
		);
		// echo json_encode($response);
		$this->pdf->load_view('print/P_permintaan_jasa', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	// public function loadData_select(){
	// 	$param = $this->input->get('q');
	// 	if ($param!=NULL) {
	// 		$param = $this->input->get('q');
	// 	} else {
	// 		$param = "";
	// 	}
	// 	$select = '*';
	// 	$where['data'][] = array(
	// 		'column' => 'barang_status_aktif',
	// 		'param'	 => 'y'
	// 	);
	// 	$where_like['data'][] = array(
	// 		'column' => 'barang_nama',
	// 		'param'	 => $this->input->get('q')
	// 	);
	// 	$order['data'][] = array(
	// 		'column' => 'barang_nama',
	// 		'type'	 => 'ASC'
	// 	);
	// 	$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
	// 	$response['items'] = array();
	// 	if ($query<>false) {
	// 		foreach ($query->result() as $val) {
	// 			$response['items'][] = array(
	// 				'id'	=> $val->barang_id,
	// 				'text'	=> $val->barang_nama
	// 			);
	// 		}
	// 		$response['status'] = '200';
	// 	}

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['test'] = $type;
		if (strlen($id)>0) {
			if ($type == 2) {
				//UPDATE
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'permintaan_jasa_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					// INSERT LOG 
					if (@$data['permintaan_jasa_status']) {
						if ($data['permintaan_jasa_status'] == 4){
							$data_log = array(
								'referensi_id' 								=> $id,
								'permintaan_jasalog_status_dari' 			=> 2,
								'permintaan_jasalog_status_ke' 				=> 4,
								'permintaan_jasalog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'permintaan_jasalog_status_update_by' 		=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_permintaan_jasalog', NULL, $data_log);
						} else if ($data['permintaan_jasa_status'] == 5){
							$data_log = array(
								'referensi_id' 								=> $id,
								'permintaan_jasalog_status_dari' 			=> 4,
								'permintaan_jasalog_status_ke' 				=> 5,
								'permintaan_jasalog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'permintaan_jasalog_status_update_by' 		=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_permintaan_jasalog', NULL, $data_log);
						}
					}
					// UPDATE DETAIL
					for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 
						if (@$where_det['data']) {
							unset($where_det['data']);
						}
						$where_det['data'][] = array(
							'column' => 'permintaan_jasadet_id',
							'param'	 => $this->input->post('permintaan_jasadet_id', TRUE)[$i]
						);
						$data_det = $this->general_post_data2(2, $update->output, $i, $this->input->post('permintaan_jasadet_id', TRUE)[$i]);
						$update_det = $this->mod->update_data_table('t_permintaan_jasadet', $where_det, $data_det);
						if($update_det->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
					// END FOR DETAIL
				} else {
					$response['status'] = '204';
				}
			} else {
				//UPDATE
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'permintaan_jasa_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					// INSERT LOG 
					if (@$data['permintaan_jasa_status']) {
						if ($data['permintaan_jasa_status'] == 4){
							$data_log = array(
								'referensi_id' 								=> $id,
								'permintaan_jasalog_status_dari' 			=> 2,
								'permintaan_jasalog_status_ke' 				=> 4,
								'permintaan_jasalog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'permintaan_jasalog_status_update_by' 		=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_permintaan_jasalog', NULL, $data_log);
						} else if ($data['permintaan_jasa_status'] == 5){
							$data_log = array(
								'referensi_id' 								=> $id,
								'permintaan_jasalog_status_dari' 			=> 4,
								'permintaan_jasalog_status_ke' 				=> 5,
								'permintaan_jasalog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'permintaan_jasalog_status_update_by' 		=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_permintaan_jasalog', NULL, $data_log);
						}
					}
					// UPDATE DETAIL
					for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 
						if (@$where_det['data']) {
							unset($where_det['data']);
						}
						$where_det['data'][] = array(
							'column' => 'permintaan_jasadet_id',
							'param'	 => $this->input->post('permintaan_jasadet_id', TRUE)[$i]
						);
						$data_det = $this->general_post_data2(3, $update->output, $i, $this->input->post('permintaan_jasadet_id', TRUE)[$i]);
						$update_det = $this->mod->update_data_table('t_permintaan_jasadet', $where_det, $data_det);
						if($update_det->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
					// END FOR DETAIL
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
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_permintaan_jasadet', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
			} else {
				$response['status'] = '204';
			}
		}
		echo json_encode($response);
	}

	// // Function Delete
	// public function deleteData(){
	// 	$id = $this->input->post('id');
	// 	$data = $this->general_post_data(3, $id);
	// 	$where['data'][] = array(
	// 		'column' => 'barang_id',
	// 		'param'	 => $id
	// 	);
	// 	$update = $this->mod->update_data_table($this->tbl, $where, $data);
	// 	if($update->status) {
	// 		$response['status'] = '200';
	// 	} else {
	// 		$response['status'] = '204';
	// 	}

	// 	echo json_encode($response);
	// }

	// public function aktifData(){
	// 	$id = $this->input->post('id');
	// 	$data = $this->general_post_data(4, $id);
	// 	$where['data'][] = array(
	// 		'column' => 'barang_id',
	// 		'param'	 => $id
	// 	);
	// 	$update = $this->mod->update_data_table($this->tbl, $where, $data);
	// 	if($update->status) {
	// 		$response['status'] = '200';
	// 	} else {
	// 		$response['status'] = '204';
	// 	}

	// 	echo json_encode($response);
	// }

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('permintaan_jasa_tanggal', TRUE));
		$arrDate2 = explode('/', $this->input->post('permintaan_jasa_tanggal_dibutuhkan', TRUE));
		$where['data'][] = array(
			'column' => 'permintaan_jasa_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('permintaan_jasa_status, permintaan_jasa_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['permintaan_jasa_revised'] + 1;
			$status = $revised['permintaan_jasa_status'];
		}
		if ($type == 1) {
			$permintaan_jasa_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 							=> $this->session->userdata('cabang_id'),
				'permintaan_jasa_nomor' 				=> $permintaan_jasa_nomor,
				'permintaan_jasa_tanggal'				=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'm_departemen_id' 						=> $this->input->post('m_departemen_id', TRUE),
				'permintaan_jasa_tanggal_dibutuhkan'	=> $arrDate2[2]."-".$arrDate2[1]."-".$arrDate2[0],
				'permintaan_jasa_status' 				=> 1,
				'permintaan_jasa_status_date'			=> date('Y-m-d H:i:s'),
				'permintaan_jasa_printed'				=> 0,
				'permintaan_jasa_created_date'			=> date('Y-m-d H:i:s'),
				'permintaan_jasa_update_date'			=> date('Y-m-d H:i:s'),
				'permintaan_jasa_created_by'			=> $this->session->userdata('user_username'),
				'permintaan_jasa_revised' 				=> 0,
			);
		} else if ($type == 2) {
			if ($status == $this->input->post('permintaan_jasa_status', TRUE)) {
				if ($this->input->post('m_karyawan_id_penyetuju', TRUE)) {
					$data = array(
						'permintaan_jasa_penyetuju' 		=> $this->input->post('m_karyawan_id_penyetuju', TRUE),
						'permintaan_jasa_update_date'		=> date('Y-m-d H:i:s'),
						'permintaan_jasa_update_by'			=> $this->session->userdata('user_username'),
						'permintaan_jasa_revised' 			=> $rev,
					);
				} else {
					$data = array(
						'permintaan_jasa_update_date'		=> date('Y-m-d H:i:s'),
						'permintaan_jasa_update_by'			=> $this->session->userdata('user_username'),
						'permintaan_jasa_revised' 			=> $rev,
					);	
				}
			} else {
				if ($this->input->post('m_karyawan_id_penyetuju', TRUE)) {
					$data = array(
						'permintaan_jasa_penyetuju' 		=> $this->input->post('m_karyawan_id_penyetuju', TRUE),
						'permintaan_jasa_status' 			=> $this->input->post('permintaan_jasa_status', TRUE),
						'permintaan_jasa_update_date'		=> date('Y-m-d H:i:s'),
						'permintaan_jasa_update_by'			=> $this->session->userdata('user_username'),
						'permintaan_jasa_revised' 			=> $rev,
					);
				} else {
					$data = array(
						'permintaan_jasa_status' 			=> $this->input->post('permintaan_pembelian_status', TRUE),
						'permintaan_jasa_status_date'		=> date('Y-m-d H:i:s'),
						'permintaan_jasa_update_date'		=> date('Y-m-d H:i:s'),
						'permintaan_jasa_update_by'			=> $this->session->userdata('user_username'),
						'permintaan_jasa_revised' 			=> $rev,
					);	
				}
			}
		} else if ($type == 3) {
			$data = array(
				'permintaan_jasa_status'		=> 2,
				'permintaan_jasa_status_date'	=> date('Y-m-d H:i:s'),
				'permintaan_jasa_update_date'	=> date('Y-m-d H:i:s'),
				'permintaan_jasa_update_by'		=> $this->session->userdata('user_username'),
				'permintaan_jasa_revised' 		=> $rev,
			);
		} 

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'permintaan_jasadet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('permintaan_jasadet_revised', 't_permintaan_jasadet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['permintaan_jasadet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_permintaan_jasa_id' 				=> $idHdr,
				'm_barang_id' 						=> $this->input->post('m_barang_id', TRUE)[$seq],
				'permintaan_jasadet_qty' 			=> $this->input->post('permintaan_jasadet_qty', TRUE)[$seq],
				'permintaan_jasadet_keterangan'		=> $this->input->post('permintaan_jasadet_keterangan', TRUE)[$seq],
				'permintaan_jasadet_create_date'	=> date('Y-m-d H:i:s'),
				'permintaan_jasadet_create_by'		=> $this->session->userdata('user_username'),
				'permintaan_jasadet_update_date'	=> date('Y-m-d H:i:s'),
				'permintaan_jasadet_revised' 		=> 0,
			);
		} else if ($type == 2) {
			if ($status == $this->input->post('permintaan_jasadet_status', TRUE)[$seq]) {
				$data = array(
					'permintaan_jasadet_qty_realisasi'	=> ($this->input->post('permintaan_jasadet_qty_realisasi', TRUE)[$seq] + $this->input->post('permintaan_jasadet_qty_kirim', TRUE)[$seq]),
					'permintaan_jasadet_update_date'	=> date('Y-m-d H:i:s'),
					'permintaan_jasadet_update_by'		=> $this->session->userdata('user_username'),
					'permintaan_jasadet_revised' 		=> $rev,
				);	
			} else {
				$data = array(
					'permintaan_jasadet_qty_realisasi'		=> ($this->input->post('permintaan_jasadet_qty_realisasi', TRUE)[$seq] + $this->input->post('permintaan_jasadet_qty_kirim', TRUE)[$seq]),
					'permintaan_jasadet_status' 			=> $this->input->post('permintaan_jasadet_status', TRUE)[$seq],
					'permintaan_jasadet_status_date'		=> date('Y-m-d H:i:s'),
					'permintaan_jasadet_update_date'		=> date('Y-m-d H:i:s'),
					'permintaan_jasadet_update_by'			=> $this->session->userdata('user_username'),
					'permintaan_jasadet_revised' 			=> $rev,
				);	
			}
		} else if ($type == 3) {
			$data = array(
				'm_barang_id' 						=> $this->input->post('m_barang_id', TRUE)[$seq],
				'permintaan_jasadet_update_date'	=> date('Y-m-d H:i:s'),
				'permintaan_jasadet_update_by'		=> $this->session->userdata('user_username'),
				'permintaan_jasadet_revised' 		=> $rev,
			);	
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(permintaan_jasa_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(permintaan_jasa_nomor,1,9)',
			'param'	 => 'PJ'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'permintaan_jasa_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('PJ',$query);
		return $kode_baru;
	}
	/* end Function */

}
