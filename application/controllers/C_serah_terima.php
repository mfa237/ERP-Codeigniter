<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_serah_terima extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_serah_terima';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		// $this->view();
	}

	public function view($type){
		$this->check_session();
		if ($type == 1) {
			$priv = $this->cekUser(31);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Produksi',
				'title_page2' 	=> 'Serah Terima',
				// 'priv_add'		=> $priv['create']
				);
			// if($priv['read'] == 1)
			// {
				$this->open_page('serah-terima/V_serah_terima', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Gudang',
				'title_page2' 	=> 'Serah Terima',
				// 'priv_add'		=> ''
				);

			$this->open_page('serah-terima/V_serah_terima2', $data);
		}		
	}

	public function loadData($type){
		// $priv = $this->cekUser(31);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, serah_terima_nomor, serah_terima_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_serah_terima');
		$query_filter = $this->mod->select($select, 'v_serah_terima', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_serah_terima', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Produksi/Serah-Terima/Form/'.$val->serah_terima_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Serah Terima">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Produksi/Serah-Terima/print-Serah-Terima/'.$val->serah_terima_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Gudang/Serah-Terima/Form/'.$val->serah_terima_id.'">
					<button class="btn blue-ebonyclay" type="button"  title="Lihat Serah Terima">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Gudang/Serah-Terima/print-Serah-Terima/'.$val->serah_terima_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->serah_terima_nomor,
					$val->serah_terima_status_nama,
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
			'title_page2' 	=> 'Serah Terima',
			'id'			=> $id
		);
		$this->open_page('serah-terima/V_form_serah_terima', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Gudang',
			'title_page2' 	=> 'Serah Terima',
			'id'			=> $id
		);
		$this->open_page('serah-terima/V_form_serah_terima2', $data);
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'serah_terima_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join['data'][] = array(
					'table' => 't_pengubahan_bahanakhir c',
					'join'	=> 'c.pengubahan_bahanakhir_id = a.t_pengubahan_bahan_akhir_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = c.m_barang_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 't_pengubahan_bahan d',
					'join'	=> 'd.pengubahan_bahan_id = c.t_pengubahan_bahan_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_satuan e',
					'join'	=> 'e.satuan_id = b.m_satuan_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_jenis_barang f',
					'join'	=> 'f.jenis_barang_id = b.m_jenis_barang_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 't_perolehan_produksi g',
					'join'	=> 'g.perolehan_produksi_id = d.t_perolehan_produksi_id',
					'type' 	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 't_serah_terima_id',
					'param'	 => $val->serah_terima_id
				);
				$query_det = $this->mod->select('a.*, c.*, b.*, d.*, e.*, f.*, g.*', 't_serah_terimadet a', $join, $where_det);
				$response['val2'] = array();
				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$where_detail['data'][] = array(
							'column'	=> 't_perolehan_produksi_id',
							'param'		=> $val2->perolehan_produksi_id
						);
						$where_detail['data'][] = array(
							'column'	=> 'm_barang_id',
							'param'		=> $val2->barang_id
						);
						$query_detail = $this->mod->select('a.*', 't_perolehan_produksi_akhirdet a', null, $where_detail);
						$hasil = array();
						if($query_detail)
						{
							// $response['masuk'] = 'masuk';
							foreach ($query_detail->result() as $val4) {
								$hasil['val2'][] = array(
									'perolehan_produksi_akhirdet_berat'	=> $val4->perolehan_produksi_akhirdet_berat,
									'perolehan_produksi_akhirdet_panjang'	=> $val4->perolehan_produksi_akhirdet_panjang,
									'perolehan_produksi_akhirdet_tebal'	=> $val4->perolehan_produksi_akhirdet_tebal,
									'perolehan_produksi_akhirdet_qty'	=> $val4->perolehan_produksi_akhirdet_qty,
								);
							}
						}
						$response['val2'][] = array(
							'serah_terimadet_id'					=> $val2->serah_terimadet_id,
							't_serah_terima_id'						=> $val2->t_serah_terima_id,
							'barang_id'								=> $val2->barang_id,
							'barang_kode'							=> $val2->barang_kode,
							'barang_nama'							=> $val2->barang_nama,
							'barang_uraian'							=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'pengubahan_bahan_id'					=> $val2->pengubahan_bahan_id,
							'pengubahan_bahan_nomor'				=> $val2->pengubahan_bahan_nomor,
							'pengubahan_bahanakhir_qty'				=> $val2->pengubahan_bahanakhir_qty,
							'perolehan_produksi_akhirdet'			=> $hasil,
							'satuan_nama'							=> $val2->satuan_nama,
							'serah_terimadet_keterangan'			=> $val2->serah_terimadet_keterangan,
						);
					}
				}

				// NO ORDER
				// $where1['data'][] = array(
				// 	'column' => 'jadwal_produksi_id',
				// 	'param'	 => $val->t_jadwal_produksi_id
				// );
				// $query1 = $this->mod->select('*', 't_jadwal_produksi', NULL, $where1);
				// $hasil1['val2'] = array();
				// $hasil2 = '';
				// $hasil3 = '';
				// if ($query1) {
				// 	foreach ($query1->result() as $val2) {
				// 		$hasil1['val2'][] = array(
				// 			'id' 	=> $val2->jadwal_produksi_id,
				// 			'text' 	=> $val2->jadwal_produksi_nomor
				// 		);
				// 		$hasil2 = $val2->jadwal_produksi_shift;
				// 		$hasil3 = $val2->jadwal_produksi_jenis;
				// 	}
				// }

				$where_dari['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->serah_terima_daribagian
				);
				$query_dari = $this->mod->select('*', 'm_gudang', NULL, $where_dari);
				$hasil1['val2'] = array();
				if ($query_dari) {
					foreach ($query_dari->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->gudang_id,
							'text' 	=> $val2->gudang_nama
						);
					}
				}
				$where_ke['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->serah_terima_kebagian
				);
				$query_ke = $this->mod->select('*', 'm_gudang', NULL, $where_ke);
				$hasil2['val2'] = array();
				if ($query_ke) {
					foreach ($query_ke->result() as $val2) {
						$hasil2['val2'][] = array(
							'id' 	=> $val2->gudang_id,
							'text' 	=> $val2->gudang_nama
						);
					}
				}
				$response['val'][] = array(
					'kode' 								=> $val->serah_terima_id,
					'serah_terima_nomor' 				=> $val->serah_terima_nomor,
					'serah_terima_daribagian' 			=> $hasil1,
					'serah_terima_darishift' 			=> $val->serah_terima_darishift,
					'serah_terima_kebagian' 			=> $hasil2,
					'serah_terima_keshift' 				=> $val->serah_terima_keshift,
					'serah_terima_status' 				=> $val->serah_terima_status,
				);
			}

			echo json_encode($response);
		}
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'serah_terima_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->serah_terima_status == 1) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'serah_terima_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 							=> $id,
						'serah_terimalog_status_dari' 			=> 1,
						'serah_terimalog_status_ke' 			=> 2,
						'serah_terimalog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'serah_terimalog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_serah_terimalog', NULL, $data_log);
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

	// public function loadData_select(){
	// 	$param = $this->input->get('q');
	// 	if ($param!=NULL) {
	// 		$param = $this->input->get('q');
	// 	} else {
	// 		$param = "";
	// 	}
	// 	$select = '*';
	// 	$where['data'][] = array(
	// 		'column' => 'ketidaksesuaian_spesifikasi_status <',
	// 		'param'	 => 3
	// 	);
	// 	$where_like['data'][] = array(
	// 		'column' => 'ketidaksesuaian_spesifikasi_nomor',
	// 		'param'	 => $this->input->get('q')
	// 	);
	// 	$order['data'][] = array(
	// 		'column' => 'ketidaksesuaian_spesifikasi_nomor',
	// 		'type'	 => 'ASC'
	// 	);
	// 	$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
	// 	$response['items'] = array();
	// 	if ($query<>false) {
	// 		foreach ($query->result() as $val) {
	// 			$response['items'][] = array(
	// 				'id'	=> $val->ketidaksesuaian_spesifikasi_id,
	// 				'text'	=> $val->ketidaksesuaian_spesifikasi_nomor
	// 			);
	// 		}
	// 		$response['status'] = '200';
	// 	}

	// 	echo json_encode($response);
	// }

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['test'] = $type;
		if (strlen($id)>0) {
			if ($type == 2) {
				//UPDATE
				$data = $this->general_post_data(4, $id);
				$where['data'][] = array(
					'column' => 'serah_terima_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					// CARI DETAIL
					$join['data'][] = array(
						'table' => 't_pengubahan_bahanakhir c',
						'join'	=> 'c.pengubahan_bahanakhir_id = a.t_pengubahan_bahan_akhir_id',
						'type' 	=> 'left'
					);
					$join['data'][] = array(
						'table' => 'm_barang b',
						'join'	=> 'b.barang_id = c.m_barang_id',
						'type' 	=> 'left'
					);
					$join['data'][] = array(
						'table' => 't_pengubahan_bahan d',
						'join'	=> 'd.pengubahan_bahan_id = c.t_pengubahan_bahan_id',
						'type' 	=> 'left'
					);
					$join['data'][] = array(
						'table' => 't_perolehan_produksi e',
						'join'	=> 'e.perolehan_produksi_id = d.t_perolehan_produksi_id',
						'type' 	=> 'left'
					);
					$where_det['data'][] = array(
						'column' => 't_serah_terima_id',
						'param'	 => $id
					);
					$query_det = $this->mod->select('a.*, c.*, b.*, d.*, e.*', 't_serah_terimadet a', $join, $where_det);
					
					if ($query_det<>false) {
						foreach ($query_det->result() as $val2) {

							// PENAMBAHAN STOK GUDANG
							if (@$where_gudang2['data']) {
								unset($where_gudang2['data']);
							}
							$where_gudang2['data'][] = array(
								'column' => 'm_barang_id',
								'param'	 => $val2->m_barang_id
							);
							$where_gudang2['data'][] = array(
								'column' => 'm_gudang_id',
								'param'	 => $val2->pengubahan_bahanakhir_gudang
							);
							$query_gudang2 = $this->mod->select('*', 't_stok_gudang', NULL, $where_gudang2);
							if($query_gudang2)
							{
								// $response['val2'] = 'masuk update';
								foreach ($query_gudang2->result() as $rowStok) {
									// PENAMBAHAN KARTU STOK
									$dataKStok2 = array(
										'm_gudang_id' 				=> $val2->m_gudang_id,
										'm_barang_id' 				=> $val2->m_barang_id,
										'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),
										'kartu_stok_referensi' 		=> $this->input->post('serah_terima_nomor', TRUE),
										'kartu_stok_saldo' 			=> $rowStok->stok_gudang_jumlah,
										'kartu_stok_masuk' 			=> $val2->pengubahan_bahanakhir_qty,
										'kartu_stok_keluar' 		=> 0,
										'kartu_stok_penyesuaian'	=> 0,
										'kartu_stok_keterangan' 	=> "Serah Terima Produksi",
										'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
										'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),
										'kartu_stok_revised' 		=> 0,
									);
									$response['kartustok'][] = $dataKStok2;
									// END PENAMBAHAN KARTU STOK
									$insertKStok2 = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok2);
									if (@$whereStok2['data']) {
										unset($whereStok2['data']);
									}
									if (@$dataStok2['data']) {
										unset($dataStok2['data']);
									}
									$whereStok2['data'][] = array(
										'column' => 'stok_gudang_id',
										'param'	 => $rowStok->stok_gudang_id
									);
									$dataStok2 = array(
										'stok_gudang_jumlah' 		=> $rowStok->stok_gudang_jumlah + $val2->pengubahan_bahanakhir_qty,
										'stok_gudang_update_date'	=> date('Y-m-d H:i:s'),
										'stok_gudang_update_by'		=> $this->session->userdata('user_username'),
										'stok_gudang_revised' 		=> $rowStok->stok_gudang_revised + 1,
									);
									$response['stok'][] = $dataStok2;
									$updateStok2 = $this->mod->update_data_table('t_stok_gudang', $whereStok2, $dataStok2);
								}
							}
							else
							{
								if (@$dataStok2['data']) {
									unset($dataStok2['data']);
								}
								// $response['val2'] = 'masuk insert';
								$dataStok2 = array(
									'm_gudang_id'				=> $val2->m_gudang_id,
									'm_barang_id'				=> $val2->m_barang_id,
									'stok_gudang_jumlah' 		=> $val2->pengubahan_bahanakhir_qty,
									'stok_gudang_created_date'	=> date('Y-m-d H:i:s'),
									'stok_gudang_created_by'	=> $this->session->userdata('user_username'),
									'stok_gudang_revised' 		=> 0,
								);
								$response['stok2'][] = $dataStok2;
								$insertStok2 = $this->mod->insert_data_table('t_stok_gudang', NULL, $dataStok2);
								if (@$dataKStok2['data']) {
									unset($dataKStok2['data']);
								}
								$dataKStok2 = array(
									'm_gudang_id' 				=> $val2->m_gudang_id,
									'm_barang_id' 				=> $val2->m_barang_id,
									'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),
									'kartu_stok_referensi' 		=> $this->input->post('serah_terima_nomor', TRUE),
									'kartu_stok_saldo' 			=> 0,
									'kartu_stok_masuk' 			=> $val2->pengubahan_bahanakhir_qty,
									'kartu_stok_keluar' 		=> 0,
									'kartu_stok_penyesuaian'	=> 0,
									'kartu_stok_keterangan' 	=> "Serah Terima Produksi",
									'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
									'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),
									'kartu_stok_revised' 		=> 0,
								);
								$response['kartustok2'][] = $dataKStok2;
								// END PENAMBAHAN KARTU STOK
								$insertKStok2 = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok2);
									
							}
							// END PENAMBAHAN STOK GUDANG
						}
					}
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
				for ($i = 0; $i < sizeof($this->input->post('barang_id', TRUE)); $i++) {
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_serah_terimadet', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
						// UPDATE STATUS PEROLEHAN_PRODUKSIDET_STATUS
						$data_produksi = array(
							'perolehan_produksi_akhirdet_status' 			=> 1,
							'perolehan_produksi_akhirdet_update_date' 	=> date('Y-m-d H:i:s'),
							'perolehan_produksi_akhirdet_update_by'	 	=> $this->session->userdata('user_username'),
						);
						if (@$where_produksi['data']) {
							unset($where_produksi['data']);
						}
						$where_produksi['data'][] = array(
							'column' => 't_perolehan_produksi_id',
							'param'	 => $this->input->post('t_perolehan_produksi_id')
						);
						
						// // INSERT t_permintaan_pembelianlog
						// $query_produksi = $this->mod->select('*', 't_perolehan_produksidet', NULL, $where_produksi);
						// if ($query_produksi) {
						// 	foreach ($query_produksi->result() as $row) {
						// 		$data_log = array(
						// 			'referensi_id' 									=> $row->perolehan_pr_id,
						// 			'permintaan_pembelianlog_status_dari' 			=> $row->permintaan_pembelian_status,
						// 			'permintaan_pembelianlog_status_ke' 			=> 3,
						// 			'permintaan_pembelianlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						// 			'permintaan_pembelianlog_status_update_by'		=> $this->session->userdata('user_username'),
						// 		);
						// 		$insert_log = $this->mod->insert_data_table('t_permintaan_pembelianlog', NULL, $data_log);
						// 	}
						// }
						// // END INSERT t_permintaan_pembelianlog
						// UPDATE STATUS t_perolehan_produksidet
						$update_produksi = $this->mod->update_data_table('t_perolehan_produksi_akhirdet', $where_produksi, $data_produksi);
						// END UPDATE STATUS t_perolehan_produksidet
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

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = 't_serah_terima.*, b.serah_terimalog_status_update_by';
		$join_log['data'][] = array(
			'table' => 't_serah_terimalog b',
			'join'	=> 'b.referensi_id = t_serah_terima.serah_terima_id',
			'type' 	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'serah_terima_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, $join_log, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join['data'][] = array(
					'table' => 't_pengubahan_bahanakhir c',
					'join'	=> 'c.pengubahan_bahanakhir_id = a.t_pengubahan_bahan_akhir_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = c.m_barang_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 't_pengubahan_bahan d',
					'join'	=> 'd.pengubahan_bahan_id = c.t_pengubahan_bahan_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_satuan e',
					'join'	=> 'e.satuan_id = b.m_satuan_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_jenis_barang f',
					'join'	=> 'f.jenis_barang_id = b.m_jenis_barang_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 't_perolehan_produksi g',
					'join'	=> 'g.perolehan_produksi_id = d.t_perolehan_produksi_id',
					'type' 	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 't_serah_terima_id',
					'param'	 => $val->serah_terima_id
				);
				$query_det = $this->mod->select('a.*, c.*, b.*, d.*, e.*, f.*, g.*', 't_serah_terimadet a', $join, $where_det);
				$response['val2'] = array();
				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$where_detail['data'][] = array(
							'column'	=> 't_perolehan_produksi_id',
							'param'		=> $val2->perolehan_produksi_id
						);
						$where_detail['data'][] = array(
							'column'	=> 'm_barang_id',
							'param'		=> $val2->barang_id
						);
						$query_detail = $this->mod->select('a.*', 't_perolehan_produksi_akhirdet a', null, $where_detail);
						$hasil = array();
						if($query_detail)
						{
							// $response['masuk'] = 'masuk';
							foreach ($query_detail->result() as $val4) {
								$hasil['val2'][] = array(
									'perolehan_produksi_akhirdet_berat'	=> $val4->perolehan_produksi_akhirdet_berat,
									'perolehan_produksi_akhirdet_panjang'	=> $val4->perolehan_produksi_akhirdet_panjang,
									'perolehan_produksi_akhirdet_tebal'	=> $val4->perolehan_produksi_akhirdet_tebal,
									'perolehan_produksi_akhirdet_qty'	=> $val4->perolehan_produksi_akhirdet_qty,
								);
							}
						}
						$response['val2'][] = array(
							'serah_terimadet_id'					=> $val2->serah_terimadet_id,
							't_serah_terima_id'						=> $val2->t_serah_terima_id,
							'barang_id'								=> $val2->barang_id,
							'barang_kode'							=> $val2->barang_kode,
							'barang_nama'							=> $val2->barang_nama,
							'barang_uraian'							=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'pengubahan_bahan_id'					=> $val2->pengubahan_bahan_id,
							'pengubahan_bahan_nomor'				=> $val2->pengubahan_bahan_nomor,
							'perolehan_produksi_akhirdet'			=> $hasil,
							'pengubahan_bahanakhir_qty'				=> $val2->pengubahan_bahanakhir_qty,
							'satuan_nama'							=> $val2->satuan_nama,
							'serah_terimadet_keterangan'			=> $val2->serah_terimadet_keterangan,
						);
					}
				}

				// NO ORDER
				// $where1['data'][] = array(
				// 	'column' => 'jadwal_produksi_id',
				// 	'param'	 => $val->t_jadwal_produksi_id
				// );
				// $query1 = $this->mod->select('*', 't_jadwal_produksi', NULL, $where1);
				// $hasil1['val2'] = array();
				// $hasil2 = '';
				// $hasil3 = '';
				// if ($query1) {
				// 	foreach ($query1->result() as $val2) {
				// 		$hasil1['val2'][] = array(
				// 			'id' 	=> $val2->jadwal_produksi_id,
				// 			'text' 	=> $val2->jadwal_produksi_nomor
				// 		);
				// 		$hasil2 = $val2->jadwal_produksi_shift;
				// 		$hasil3 = $val2->jadwal_produksi_jenis;
				// 	}
				// }

				$where_dari['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->serah_terima_daribagian
				);
				$query_dari = $this->mod->select('*', 'm_gudang', NULL, $where_dari);
				$hasil1['val2'] = array();
				if ($query_dari) {
					foreach ($query_dari->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->gudang_id,
							'text' 	=> $val2->gudang_nama
						);
					}
				}
				$where_ke['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->serah_terima_kebagian
				);
				$query_ke = $this->mod->select('*', 'm_gudang', NULL, $where_ke);
				$hasil2['val2'] = array();
				if ($query_ke) {
					foreach ($query_ke->result() as $val2) {
						$hasil2['val2'][] = array(
							'id' 	=> $val2->gudang_id,
							'text' 	=> $val2->gudang_nama
						);
					}
				}
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*', 'm_cabang', NULL, $where_cabang);
				$hasil3['val2'] = array();
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI KOTA
						$hasil4['val2'] = array();
						$where_kota['data'][] = array(
							'column' => 'id',
							'param'	 => $val2->cabang_kota
						);
						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
						if ($query_kota) {
							foreach ($query_kota->result() as $val3) {
								$hasil4['val3'][] = array(
									'id' 		=> $val3->id,
									'text' 		=> $val3->name,
								);
							}
						}
						// END CARI KOTA
						$hasil3['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil4,
							'telp'	=> json_decode($val2->cabang_telepon)
						);
					}
				}
				$name = $val->serah_terima_nomor;
				$response['val'][] = array(
					'kode' 								=> $val->serah_terima_id,
					'cabang'							=> $hasil3,
					'serah_terima_nomor' 				=> $val->serah_terima_nomor,
					'serah_terima_daribagian' 			=> $hasil1,
					'serah_terima_darishift' 			=> $val->serah_terima_darishift,
					'serah_terima_kebagian' 			=> $hasil2,
					'serah_terima_keshift' 				=> $val->serah_terima_keshift,
					'serah_terima_status' 				=> $val->serah_terima_status,
					'serah_terima_created_date'			=> date('d/m/Y', strtotime($val->serah_terima_created_date)),
					'serah_terima_created_by'			=> $val->serah_terima_created_by,
					'serah_terimalog_status_update_by'	=> $val->serah_terimalog_status_update_by,
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Perolehan Produksi',
			'title_page2' 	=> 'Print Perolehan Produksi',
		);
		// echo json_encode($response);
		// $this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_serah_terima', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		// $arrDate = explode('/', $this->input->post('serah_terima_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'serah_terima_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('serah_terima_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['serah_terima_revised'] + 1;
		}
		if ($type == 1) {
			$serah_terima_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 						=> $this->session->userdata('cabang_id'),
				'serah_terima_nomor' 				=> $serah_terima_nomor,
				't_pengubahan_bahan_id' 			=> $this->input->post('t_pengubahan_bahan_id', TRUE),
				// 'serah_terima_tanggal' 			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'serah_terima_daribagian' 			=> $this->input->post('m_gudang_id_produksi', TRUE),
				'serah_terima_darishift'			=> $this->input->post('serah_terima_darishift', TRUE),
				'serah_terima_kebagian'				=> $this->input->post('m_gudang_id_tujuan', TRUE),
				'serah_terima_keshift'				=> $this->input->post('serah_terima_keshift', TRUE),
				'serah_terima_status'				=> 1,
				'serah_terima_created_date'			=> date('Y-m-d H:i:s'),
				'serah_terima_update_date'			=> date('Y-m-d H:i:s'),
				'serah_terima_created_by'			=> $this->session->userdata('user_username'),
				'serah_terima_revised' 				=> 0,
			);
		} else if ($type == 2) {
			// $data = array(
			// 	'ketidaksesuaian_spesifikasi_status' 		=> 3,
			// 	'ketidaksesuaian_spesifikasi_subtotal'	=> $this->input->post('ketidaksesuaian_spesifikasi_subtotal', TRUE),
			// 	'ketidaksesuaian_spesifikasi_ppn' 		=> $this->input->post('ketidaksesuaian_spesifikasi_ppn', TRUE),
			// 	'ketidaksesuaian_spesifikasi_total' 		=> $this->input->post('ketidaksesuaian_spesifikasi_total', TRUE),
			// 	'ketidaksesuaian_spesifikasi_update_date'	=> date('Y-m-d H:i:s'),
			// 	'ketidaksesuaian_spesifikasi_update_by'	=> $this->session->userdata('user_username'),
			// 	'ketidaksesuaian_spesifikasi_revised' 	=> $rev,
			// );
		} else if ($type == 3) {
			$data = array(
				'serah_terima_status'			=> 2,
				// 'serah_terima_status_date'		=> date('Y-m-d H:i:s'),
				'serah_terima_update_date'		=> date('Y-m-d H:i:s'),
				'serah_terima_update_by'		=> $this->session->userdata('user_username'),
				'serah_terima_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'serah_terima_status'			=> $this->input->post('serah_terima_status', TRUE),
				// 'serah_terima_status_date'		=> date('Y-m-d H:i:s'),
				'serah_terima_update_date'		=> date('Y-m-d H:i:s'),
				'serah_terima_update_by'		=> $this->session->userdata('user_username'),
				'serah_terima_revised' 			=> $rev,
			);
		}

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if ($type == 1) {
			$data = array(
				't_serah_terima_id' 					=> $idHdr,
				't_pengubahan_bahan_akhir_id'			=> $this->input->post('t_pengubahan_bahan_akhir_id', TRUE)[$seq],
				'serah_terimadet_keterangan' 			=> $this->input->post('serah_terimadet_keterangan', TRUE)[$seq],
			);	
		} else if ($type == 2) {
			// $data = array(
			// 	't_ketidaksesuaian_spesifikasi_id' 			=> $idHdr,
			// 	'm_barang_id' 						=> $this->input->post('m_barang_id', TRUE)[$seq],
			// 	'ketidaksesuaian_spesifikasidet_harga_satuan' => $this->input->post('ketidaksesuaian_spesifikasidet_harga_satuan', TRUE)[$seq],
			// 	'ketidaksesuaian_spesifikasidet_potongan' 	=> $this->input->post('ketidaksesuaian_spesifikasidet_potongan', TRUE)[$seq],
			// 	'ketidaksesuaian_spesifikasidet_total'		=> $this->input->post('ketidaksesuaian_spesifikasidet_total', TRUE)[$seq],
			// 	'ketidaksesuaian_spesifikasidet_keterangan'	=> $this->input->post('ketidaksesuaian_spesifikasidet_keterangan', TRUE)[$seq],
			// 	'ketidaksesuaian_spesifikasidet_update_by'	=> $this->session->userdata('user_username'),
			// 	'ketidaksesuaian_spesifikasidet_update_date'	=> date('Y-m-d H:i:s'),
			// 	'ketidaksesuaian_spesifikasidet_revised' 		=> $rev,
			// );
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(serah_terima_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(serah_terima_nomor,1,9)',
			'param'	 => 'ST'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'serah_terima_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('ST',$query,$bln);
		return $kode_baru;
	}
	/* end Function */

}
