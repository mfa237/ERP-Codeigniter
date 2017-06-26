<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pengubahan_bahan extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_pengubahan_bahan';

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
				'title_page2' 	=> 'Pengubahan Bahan',
				// 'priv_add'		=> $priv['create']
				);
			// if($priv['read'] == 1)
			// {
				$this->open_page('pengubahan-bahan/V_pengubahan_bahan', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Accounting',
				'title_page2' 	=> 'Pengubahan Bahan',
				// 'priv_add'		=> ''
				);

			$this->open_page('pengubahan-bahan/V_pengubahan_bahan2', $data);
		} else if ($type == 3) {
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Persetujuan',
				'title_page2' 	=> 'Pengubahan Bahan',
				// 'priv_add'		=> ''
				);

			$this->open_page('pengubahan-bahan/V_pengubahan_bahan3', $data);
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
			'column' => 'cabang_nama, pengubahan_bahan_nomor, pengubahan_bahan_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_pengubahan_bahan');
		$query_filter = $this->mod->select($select, 'v_pengubahan_bahan', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_pengubahan_bahan', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Produksi/Pengubahan-Bahan/Form/'.$val->pengubahan_bahan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Pengubahan Bahan">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Produksi/Pengubahan-Bahan/print-Pengubahan-Bahan/'.$val->pengubahan_bahan_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Accounting/Pengubahan-Bahan/Form/'.$val->pengubahan_bahan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Pengubahan Bahan">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Accounting/Pengubahan-Bahan/print-Pengubahan-Bahan/'.$val->pengubahan_bahan_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 3) {
					$button = '
					<a href="'.base_url().'Persetujuan/Pengubahan-Bahan/Form/'.$val->pengubahan_bahan_id.'">
					<button class="btn blue-ebonyclay" type="button" onclick="checkStatusPB('.$val->pengubahan_bahan_id.')"  title="Lihat Pengubahan Bahan">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Persetujuan/Pengubahan-Bahan/print-Pengubahan-Bahan/'.$val->pengubahan_bahan_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->pengubahan_bahan_nomor,
					$val->pengubahan_bahan_status_nama,
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
			'title_page2' 	=> 'Pengubahan Bahan',
			'id'			=> $id
		);
		$this->open_page('pengubahan-bahan/V_form_pengubahan_bahan', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Accounting',
			'title_page2' 	=> 'Pengubahan Bahan',
			'id'			=> $id
		);
		$this->open_page('pengubahan-bahan/V_form_pengubahan_bahan2', $data);
	}

	public function getForm3($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Persetujuan',
			'title_page2' 	=> 'Pengubahan Bahan',
			'id'			=> $id
		);
		$this->open_page('pengubahan-bahan/V_form_pengubahan_bahan3', $data);
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'pengubahan_bahan_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join['data'][] = array(
					'table' => 'm_barang d',
					'join'	=> 'd.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_gudang b',
					'join'	=> 'b.gudang_id = a.pengubahan_bahanawal_gudang',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = d.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_satuan e',
					'join'	=> 'e.satuan_id = d.m_satuan_id',
					'type'	=> 'left'
				);
				$join['data'][] = array(
					'table' => 't_perolehan_produksi_awaldet f',
					'join'	=> 'f.perolehan_produksi_awaldet_id = a.t_perolehan_produksi_awaldet_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 't_jadwal_produksi_awaldet g',
					'join'	=> 'g.jadwal_produksi_awaldet_id = f.t_jadwal_produksi_awaldet_id',
					'type' 	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 'a.t_pengubahan_bahan_id',
					'param'	 => $val->pengubahan_bahan_id
				);
				$query_det = $this->mod->select('a.*, b.*, d.*, c.*, e.*, g.*', 't_pengubahan_bahanawal a', $join, $where_det);
				$response['val2'] = array();
				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						// JOIN KE JADWAL DAN AMBIL NO SERI!!!
						$selectNoSeri = '*';
						$whereNoSeri['data'][] = array(
							'' => '',
						);
						$response['val2'][] = array(
							'barang_id'								=> $val2->m_barang_id,
							'barang_kode'							=> $val2->barang_kode,
							'barang_nama'							=> $val2->barang_nama,
							'satuan_nama'							=> $val2->satuan_nama,
							'barang_uraian'							=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'pengubahan_bahanawal_qty'				=> $val2->pengubahan_bahanawal_qty,
							'pengubahan_bahanawal_no_seri'			=> $val2->jadwal_produksi_awaldet_no_seri,
							't_perolehan_produksi_awaldet_id'		=> $val2->t_perolehan_produksi_awaldet_id,
							'pengubahan_bahanawal_gudang_id'		=> $val2->pengubahan_bahanawal_gudang,
							'pengubahan_bahanawal_gudang_nama'		=> $val2->gudang_nama,
						);
					}
				}

				$join_akhir['data'][] = array(
					'table' => 'm_barang d',
					'join'	=> 'd.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$join_akhir['data'][] = array(
					'table' => 'm_gudang b',
					'join'	=> 'b.gudang_id = a.pengubahan_bahanakhir_gudang',
					'type' 	=> 'left'
				);
				$join_akhir['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = d.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_akhir['data'][] = array(
					'table' => 'm_satuan e',
					'join'	=> 'e.satuan_id = d.m_satuan_id',
					'type'	=> 'left'
				);
				$join_akhir['data'][] = array(
					'table' => 't_pengubahan_bahan f',
					'join'	=> 'f.pengubahan_bahan_id = a.t_pengubahan_bahan_id',
					'type'	=> 'left'
				);
				$where_akhir['data'][] = array(
					'column' => 'a.t_pengubahan_bahan_id',
					'param'	 => $val->pengubahan_bahan_id
				);
				$query_akhir = $this->mod->select('a.*, b.*, d.*, c.*, e.*, f.t_perolehan_produksi_id', 't_pengubahan_bahanakhir a', $join_akhir, $where_akhir);
				// $response['query'] = $query_akhir;
				$response['val3'] = array();
				if ($query_akhir) {
					foreach ($query_akhir->result() as $val3) {
						$where_detail['data'][] = array(
							'column'	=> 't_perolehan_produksi_id',
							'param'		=> $val3->t_perolehan_produksi_id
						);
						$where_detail['data'][] = array(
							'column'	=> 'm_barang_id',
							'param'		=> $val3->m_barang_id
						);
						$query_detail = $this->mod->select('a.*', 't_perolehan_produksi_akhirdet a', null, $where_detail);
						$hasil = array();
						if($query_detail)
						{
							$response['masuk'] = 'masuk';
							foreach ($query_detail->result() as $val4) {
								$hasil['val2'][] = array(
									'perolehan_produksi_akhirdet_berat'		=> $val4->perolehan_produksi_akhirdet_berat,
									'perolehan_produksi_akhirdet_panjang'	=> $val4->perolehan_produksi_akhirdet_panjang,
									'perolehan_produksi_akhirdet_tebal'		=> $val4->perolehan_produksi_akhirdet_tebal,
									'perolehan_produksi_akhirdet_qty'		=> $val4->perolehan_produksi_akhirdet_qty,
								);
							}
						}
						$response['val3'][] = array(
							'barang_id'								=> $val3->m_barang_id,
							'barang_kode'							=> $val3->barang_kode,
							'barang_nama'							=> $val3->barang_nama,
							'satuan_nama'							=> $val3->satuan_nama,
							'barang_uraian'							=> $val3->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'pengubahan_bahanakhir_qty'				=> $val3->pengubahan_bahanakhir_qty,
							'pengubahan_bahanakhir_deskripsi'		=> $val3->pengubahan_bahanakhir_deskripsi,
							'pengubahan_bahanakhir_id'				=> $val3->pengubahan_bahanakhir_id,
							'pengubahan_bahanakhir_gudang_id'		=> $val3->pengubahan_bahanakhir_gudang,
							'pengubahan_bahanakhir_gudang_nama'		=> $val3->gudang_nama,
							't_perolehan_produksi_id'				=> $val3->t_perolehan_produksi_id,
							'perolehan_produksi_akhirdet'			=> $hasil,
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

				// $where2['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->ketidaksesuaian_spesifikasi_operator
				// );
				// $query2 = $this->mod->select('*', 'm_karyawan', NULL, $where2);
				// $hasil5['val2'] = array();
				// if ($query2) {
				// 	foreach ($query2->result() as $val2) {
				// 		$hasil5['val2'][] = array(
				// 			'id' 	=> $val2->karyawan_id,
				// 			'text' 	=> $val2->karyawan_nama
				// 		);
				// 	}
				// }

				$response['val'][] = array(
					'kode' 								=> $val->pengubahan_bahan_id,
					'pengubahan_bahan_nomor' 			=> $val->pengubahan_bahan_nomor,
					'pengubahan_bahan_tanggal' 			=> date('d/m/Y', strtotime($val->pengubahan_bahan_tanggal)),
					'pengubahan_bahan_konversi'			=> $val->pengubahan_bahan_konversi,
					'pengubahan_bahan_keterangan'		=> $val->pengubahan_bahan_keterangan,
					'pengubahan_bahan_jenis'			=> $val->pengubahan_bahan_jenis,
					'pengubahan_bahan_status' 			=> $val->pengubahan_bahan_status,
				);
			}

			echo json_encode($response);
		}
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'pengubahan_bahan_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->pengubahan_bahan_status == 2) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'pengubahan_bahan_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 								=> $id,
						'pengubahan_bahanlog_status_dari' 			=> 2,
						'pengubahan_bahanlog_status_ke' 			=> 3,
						'pengubahan_bahanlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'pengubahan_bahanlog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_pengubahan_bahanlog', NULL, $data_log);
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
		$where['data'][] = array(
			'column' => 'pengubahan_bahan_status',
			'param'	 => 4
		);
		$where_like['data'][] = array(
			'column' => 'pengubahan_bahan_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'pengubahan_bahan_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->pengubahan_bahan_id,
					'text'	=> $val->pengubahan_bahan_nomor
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['test'] = $type;
		if (strlen($id)>0) {
			if($type == 1)
			{
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'pengubahan_bahan_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					$data_log = array(
						'referensi_id' 								=> $id,
						'pengubahan_bahanlog_status_dari' 			=> 1,
						'pengubahan_bahanlog_status_ke' 			=> 2,
						'pengubahan_bahanlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'pengubahan_bahanlog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_pengubahan_bahanlog', NULL, $data_log);
					for ($i = 0; $i < sizeof($this->input->post('barang_id_awal', TRUE)); $i++) {
						// $data_det = $this->general_post_data2(1, $insert->output, $i);
						// $insert_det = $this->mod->insert_data_table('t_pengubahan_bahanawal', NULL, $data_det);
						// if($insert_det->status) {
						// 	$response['status'] = '200';
							if($this->input->post('pengubahan_bahan_status', TRUE) == 2)
							{
								if (@$wheregudang['data']) {
									unset($wheregudang['data']);
								}
								$wheregudang['data'][] = array(
									'column' => 'stok_gudang_no_seri',
									'param'	 => $this->input->post('no_seri', TRUE)[$i]
								);
								$wheregudang['data'][] = array(
									'column' => 'm_gudang_id',
									'param'	 => $this->input->post('pengubahan_bahanawal_gudang', TRUE)[$i]
								);
								$querygudang = $this->mod->select('*', 't_stok_gudang', NULL, $wheregudang);
								if ($querygudang) {
									foreach ($querygudang->result() as $rowgudang) {
										// PENGURANGAN STOK BAHAN MENTAH GUDANG
										$datagudang = array(
											'stok_gudang_jumlah' 		=> $rowgudang->stok_gudang_jumlah - $this->input->post('pengubahan_bahanawal_qty', TRUE)[$i],
											'stok_gudang_update_date' 	=> date('Y-m-d H:i:s'),
											'stok_gudang_update_by'		=> $this->session->userdata('user_username'),
											'stok_gudang_revised' 		=> $rowgudang->stok_gudang_revised + 1,
										);
										$updategudang = $this->mod->update_data_table('t_stok_gudang', $wheregudang, $datagudang);
										// END PENGURANGAN STOK BAHAN MENTAH GUDANG
									}
								}
								if (@$whereJmlStok['data']) {
									unset($whereJmlStok['data']);
								}
								$whereJmlStok['data'][] = array(
									'column' => 'm_barang_id',
									'param'	 => $this->input->post('barang_id_awal', TRUE)[$i]
								);
								$whereJmlStok['data'][] = array(
									'column' => 'm_gudang_id',
									'param'	 => $this->input->post('pengubahan_bahanawal_gudang', TRUE)[$i]
								);
								$order['data'][] = array(
									'column' => 'kartu_stok_id',
									'type'	 => 'DESC'
								);
								$limit = array(
									'start'  => 0,
									'finish' => 1
								);
								$queryJmlStok = $this->mod->select('*', 't_kartu_stok', NULL, $whereJmlStok, null, null, $order, $limit);
 								if($queryJmlStok)
								{
									foreach ($queryJmlStok->result() as $rowStok) {
										// KARTU STOK
										$datastok = array(
											'm_gudang_id' 				=> $this->input->post('pengubahan_bahanawal_gudang', TRUE)[$i],
											'm_barang_id' 				=> $this->input->post('barang_id_awal', TRUE)[$i],
											'kartu_stok_tanggal'		=> date('Y-m-d H:i:s'),
											'kartu_stok_referensi'		=> $this->input->Post('pengubahan_bahan_nomor', TRUE),
											'kartu_stok_saldo'			=> $rowStok->kartu_stok_saldo+$rowStok->kartu_stok_masuk-$rowStok->kartu_stok_keluar,
											'kartu_stok_masuk'			=> 0,
											'kartu_stok_keluar'			=> $this->input->post('pengubahan_bahanawal_qty', TRUE)[$i],
											'kartu_stok_penyesuaian'	=> 0,
											'kartu_stok_keterangan'		=> "Pengubahan Bahan",
											'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
											'kartu_stok_created_by'		=> $this->session->userdata('user_username'),
											'kartu_stok_revised' 		=> 0,
										);
										$insertstok = $this->mod->insert_data_table('t_kartu_stok', NULL, $datastok);
										// END KARTU STOK
									}
								}
								if (@$wherePP['data']) {
									unset($wherePP['data']);
								}
								$wherePP['data'][] = array(
									'column'	=> 'perolehan_produksi_awaldet_id',
									'param'		=> $this->input->post('t_perolehan_produksi_awaldet_id', TRUE)[$i]
								);
								$rev = $this->mod->select('perolehan_produksi_awaldet_revised', 't_perolehan_produksi_awaldet', null, $wherePP);
								if($rev)
								{
									foreach ($rev->result() as $val) {
										$dataStatus = array(
											'perolehan_produksi_awaldet_status'			=> 1,
											'perolehan_produksi_awaldet_update_date'	=> date('Y-m-d H:i:s'),
											'perolehan_produksi_awaldet_update_by'		=> $this->session->userdata('user_username'),
											'perolehan_produksi_awaldet_revised'		=> $val->perolehan_produksi_awaldet_revised+1,
										);
										$updatePP = $this->mod->update_data_table('t_perolehan_produksi_awaldet', $wherePP, $dataStatus);
									}
								}
								
							}
							
						// } else {
						// 	$response['status'] = '204';
						// }
					}
				} else {
					$response['status'] = '204';
				}
			}
			if ($type == 2) {
				//UPDATE
				$data = $this->general_post_data(4, $id);
				$where['data'][] = array(
					'column' => 'pengubahan_bahan_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
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
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('barang_id_awal', TRUE)); $i++) {
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_pengubahan_bahanawal', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
						$data_log = array(
							'referensi_id' 								=> $id,
							'pengubahan_bahanlog_status_dari' 			=> 1,
							'pengubahan_bahanlog_status_ke' 			=> 2,
							'pengubahan_bahanlog_status_update_date' 	=> date('Y-m-d H:i:s'),
							'pengubahan_bahanlog_status_update_by'		=> $this->session->userdata('user_username'),
						);
						$insert_log = $this->mod->insert_data_table('t_pengubahan_bahanlog', NULL, $data_log);
						if($data['pengubahan_bahan_status'] == 2)
						{
							if (@$wheregudang['data']) {
								unset($wheregudang['data']);
							}
							$wheregudang['data'][] = array(
								'column' => 'stok_gudang_no_seri',
								'param'	 => $this->input->post('no_seri', TRUE)[$i]
							);
							$wheregudang['data'][] = array(
								'column' => 'm_gudang_id',
								'param'	 => $data_det['pengubahan_bahanawal_gudang']
							);
							$querygudang = $this->mod->select('*', 't_stok_gudang', NULL, $wheregudang);
							if ($querygudang) {
								foreach ($querygudang->result() as $rowgudang) {
									// PENGURANGAN STOK BAHAN MENTAH GUDANG
									$datagudang = array(
										'stok_gudang_jumlah' 		=> $rowgudang->stok_gudang_jumlah - $data_det['pengubahan_bahanawal_qty'],
										'stok_gudang_update_date' 	=> date('Y-m-d H:i:s'),
										'stok_gudang_update_by'		=> $this->session->userdata('user_username'),
										'stok_gudang_revised' 		=> $rowgudang->stok_gudang_revised + 1,
									);
									$updategudang = $this->mod->update_data_table('t_stok_gudang', $wheregudang, $datagudang);
									// END PENGURANGAN STOK BAHAN MENTAH GUDANG
								}
							}
							if (@$whereJmlStok['data']) {
								unset($whereJmlStok['data']);
							}
							$whereJmlStok['data'][] = array(
								'column' => 'm_barang_id',
								'param'	 => $data_det['m_barang_id']
							);
							$whereJmlStok['data'][] = array(
								'column' => 'm_gudang_id',
								'param'	 => $data_det['pengubahan_bahanawal_gudang']
							);
							$order['data'][] = array(
								'column' => 'kartu_stok_id',
								'type'	 => 'DESC'
							);
							$limit = array(
								'start'  => 0,
								'finish' => 1
							);
							$queryJmlStok = $this->mod->select('*', 't_kartu_stok', NULL, $whereJmlStok, null, null, $order, $limit);
							if($queryJmlStok)
							{
								foreach ($queryJmlStok->result() as $rowStok) {
									// KARTU STOK
									$datastok = array(
										'm_gudang_id' 				=> $data_det['pengubahan_bahanawal_gudang'],
										'm_barang_id' 				=> $data_det['m_barang_id'],
										'kartu_stok_tanggal'		=> date('Y-m-d H:i:s'),
										'kartu_stok_referensi'		=> $data['pengubahan_bahan_nomor'],
										'kartu_stok_saldo'			=> $rowStok->kartu_stok_saldo+$rowStok->kartu_stok_masuk-$rowStok->kartu_stok_keluar,
										'kartu_stok_masuk'			=> 0,
										'kartu_stok_keluar'			=> $data_det['pengubahan_bahanawal_qty'],
										'kartu_stok_penyesuaian'	=> 0,
										'kartu_stok_keterangan'		=> "Pengubahan Bahan",
										'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
										'kartu_stok_created_by'		=> $this->session->userdata('user_username'),
										'kartu_stok_revised' 		=> 0,
									);
									$insertstok = $this->mod->insert_data_table('t_kartu_stok', NULL, $datastok);
									// END KARTU STOK
								}
							}
						}
					} else {
						$response['status'] = '204';
					}
				}
				for ($i = 0; $i < sizeof($this->input->post('barang_id_hasil', TRUE)); $i++) {
					$data_det = $this->general_post_data3(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_pengubahan_bahanakhir', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
				for ($i = 0; $i < sizeof($this->input->post('perolehan_produksi_akhirdet_id', TRUE)); $i++) {
					if (@$wherePP['data']) {
						unset($wherePP['data']);
					}
					if (@$dataPP['data']) {
						unset($dataPP['data']);
					}
					$wherePP['data'][] = array(
						'column' => 'perolehan_produksi_akhirdet_id',
						'param'	 => $this->input->post('perolehan_produksi_akhirdet_id', TRUE)[$i]
					);
					$queryRevised = $this->mod->select('perolehan_produksi_akhirdet_revised', 't_perolehan_produksi_akhirdet', NULL, $wherePP);
					if ($queryRevised) {
						$revised = $queryRevised->row_array();
						$rev = $revised['perolehan_produksi_akhirdet_revised'] + 1;
					}
					$dataPP = array(
						'perolehan_produksi_akhirdet_status'	 	=> 1,
						'perolehan_produksi_akhirdet_revised'		=> $rev,
						'perolehan_produksi_akhirdet_update_date' 	=> date('Y-m-d H:i:s'),
						'perolehan_produksi_akhirdet_update_by'		=> $this->session->userdata('user_username'),
					);
					$updatePP = $this->mod->update_data_table('t_perolehan_produksi_akhirdet', $wherePP, $dataPP);
					if($updatePP->status) {
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

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'pengubahan_bahan_id',
			'param'	 => $id
		);
		// $response['id'] = $this->input->get('id');
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join['data'][] = array(
					'table' => 'm_barang d',
					'join'	=> 'd.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_gudang b',
					'join'	=> 'b.gudang_id = a.pengubahan_bahanawal_gudang',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = d.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_satuan e',
					'join'	=> 'e.satuan_id = d.m_satuan_id',
					'type'	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 't_pengubahan_bahan_id',
					'param'	 => $val->pengubahan_bahan_id
				);
				$query_det = $this->mod->select('a.*, b.*, d.*, c.*, e.*', 't_pengubahan_bahanawal a', $join, $where_det);
				$response['val2'] = array();
				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'barang_id'								=> $val2->m_barang_id,
							'barang_kode'							=> $val2->barang_kode,
							'barang_nama'							=> $val2->barang_nama,
							'satuan_nama'							=> $val2->satuan_nama,
							'barang_uraian'							=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'pengubahan_bahanawal_qty'				=> $val2->pengubahan_bahanawal_qty,
							'pengubahan_bahanawal_gudang_id'		=> $val2->pengubahan_bahanawal_gudang,
							'pengubahan_bahanawal_gudang_nama'		=> $val2->gudang_nama,
						);
					}
				}

				$join_akhir['data'][] = array(
					'table' => 'm_barang d',
					'join'	=> 'd.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$join_akhir['data'][] = array(
					'table' => 'm_gudang b',
					'join'	=> 'b.gudang_id = a.pengubahan_bahanakhir_gudang',
					'type' 	=> 'left'
				);
				$join_akhir['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = d.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_akhir['data'][] = array(
					'table' => 'm_satuan e',
					'join'	=> 'e.satuan_id = d.m_satuan_id',
					'type'	=> 'left'
				);
				$where_akhir['data'][] = array(
					'column' => 't_pengubahan_bahan_id',
					'param'	 => $val->pengubahan_bahan_id
				);
				$query_akhir = $this->mod->select('a.*, b.*, d.*, c.*, e.*', 't_pengubahan_bahanakhir a', $join_akhir, $where_akhir);
				$response['val3'] = array();
				if ($query_akhir) {
					foreach ($query_akhir->result() as $val2) {
						$response['val3'][] = array(
							'barang_id'								=> $val2->m_barang_id,
							'barang_kode'							=> $val2->barang_kode,
							'barang_nama'							=> $val2->barang_nama,
							'satuan_nama'							=> $val2->satuan_nama,
							'barang_uraian'							=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'pengubahan_bahanakhir_qty'				=> $val2->pengubahan_bahanakhir_qty,
							'pengubahan_bahanakhir_gudang_id'		=> $val2->pengubahan_bahanakhir_gudang,
							'pengubahan_bahanakhir_gudang_nama'		=> $val2->gudang_nama,
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

				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*', 'm_cabang', NULL, $where_cabang);
				$hasil1['val2'] = array();
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI KOTA
						$hasil2['val2'] = array();
						$where_kota['data'][] = array(
							'column' => 'id',
							'param'	 => $val2->cabang_kota
						);
						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
						if ($query_kota) {
							foreach ($query_kota->result() as $val3) {
								$hasil2['val3'][] = array(
									'id' 		=> $val3->id,
									'text' 		=> $val3->name,
								);
							}
						}
						// END CARI KOTA
						$hasil1['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil2,
							'telp'	=> json_decode($val2->cabang_telepon)
						);
					}
				}

				$response['val'][] = array(
					'kode' 								=> $val->pengubahan_bahan_id,
					'cabang'							=> $hasil1,
					'pengubahan_bahan_nomor' 			=> $val->pengubahan_bahan_nomor,
					'pengubahan_bahan_tanggal' 			=> date('d/m/Y', strtotime($val->pengubahan_bahan_tanggal)),
					'pengubahan_bahan_pembuat'			=> $val->pengubahan_bahan_created_by,
					'pengubahan_bahan_status' 			=> $val->pengubahan_bahan_status,
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Pengubahan Bahan',
			'title_page2' 	=> 'Print Pengubahan Bahan',
		);
		// echo json_encode($response);
		// $this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_pengubahan_bahan', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('pengubahan_bahan_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'pengubahan_bahan_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('pengubahan_bahan_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['pengubahan_bahan_revised'] + 1;
		}
		if ($type == 1) {
			$pengubahan_bahan_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 						=> $this->session->userdata('cabang_id'),
				'pengubahan_bahan_nomor' 			=> $pengubahan_bahan_nomor,
				'pengubahan_bahan_tanggal' 			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				't_perolehan_produksi_id' 			=> $this->input->post('t_perolehan_produksi_id', TRUE),
				'pengubahan_bahan_jenis' 			=> $this->input->post('pengubahan_bahan_jenis', TRUE),
				'pengubahan_bahan_konversi' 		=> $this->input->post('hasil_rumus', TRUE),
				'pengubahan_bahan_keterangan' 		=> $this->input->post('pengubahan_bahan_keterangan', TRUE),
				'pengubahan_bahan_status' 			=> $this->input->post('pengubahan_bahan_status', TRUE),
				'pengubahan_bahan_created_date'		=> date('Y-m-d H:i:s'),
				'pengubahan_bahan_update_date'		=> date('Y-m-d H:i:s'),
				'pengubahan_bahan_created_by'		=> $this->session->userdata('user_username'),
				'pengubahan_bahan_revised' 			=> 0,
			);	
		} else if ($type == 2) {
			$data = array(
				'pengubahan_bahan_tanggal' 			=> date('Y-m-d', strtotime($this->input->post('pengubahan_bahan_tanggal'))),
				'pengubahan_bahan_keterangan' 		=> $this->input->post('pengubahan_bahan_keterangan', TRUE),
				'pengubahan_bahan_status' 			=> $this->input->post('pengubahan_bahan_status', TRUE),
				'pengubahan_bahan_update_date'		=> date('Y-m-d H:i:s'),
				'pengubahan_bahan_update_by'		=> $this->session->userdata('user_username'),
				'pengubahan_bahan_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'pengubahan_bahan_status'			=> 3,
				// 'pengubahan_bahan_status_date'		=> date('Y-m-d H:i:s'),
				'pengubahan_bahan_update_date'		=> date('Y-m-d H:i:s'),
				'pengubahan_bahan_update_by'		=> $this->session->userdata('user_username'),
				'pengubahan_bahan_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'pengubahan_bahan_status'			=> $this->input->post('pengubahan_bahan_status', TRUE),
				// 'pengubahan_bahan_status_date'		=> date('Y-m-d H:i:s'),
				'pengubahan_bahan_update_date'		=> date('Y-m-d H:i:s'),
				'pengubahan_bahan_update_by'		=> $this->session->userdata('user_username'),
				'pengubahan_bahan_revised' 			=> $rev,
			);
		}

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if ($type == 1) {
			$data = array(
				't_pengubahan_bahan_id' 				=> $idHdr,
				'm_barang_id'							=> $this->input->post('barang_id_awal', TRUE)[$seq],
				't_perolehan_produksi_awaldet_id'		=> $this->input->post('t_perolehan_produksi_awaldet_id', TRUE)[$seq],
				'pengubahan_bahanawal_qty' 				=> $this->input->post('pengubahan_bahanawal_qty', TRUE)[$seq],
				'pengubahan_bahanawal_gudang' 			=> $this->input->post('pengubahan_bahanawal_gudang', TRUE)[$seq],
				'pengubahan_bahanawal_status' 			=> 0,
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

	function general_post_data3($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if ($type == 1) {
			$data = array(
				't_pengubahan_bahan_id' 				=> $idHdr,
				'm_barang_id'							=> $this->input->post('barang_id_hasil', TRUE)[$seq],
				'pengubahan_bahanakhir_deskripsi' 		=> $this->input->post('deskripsi_hasil', TRUE)[$seq],
				'pengubahan_bahanakhir_qty' 			=> $this->input->post('pengubahan_bahanakhir_qty', TRUE)[$seq],
				'pengubahan_bahanakhir_gudang' 			=> $this->input->post('pengubahan_bahanakhir_gudang', TRUE)[$seq],
				'pengubahan_bahanakhir_status' 			=> 0,
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
		$select = 'MID(pengubahan_bahan_nomor,9,5) as id';
		$where['data'][] = array(
			'column' => 'MID(pengubahan_bahan_nomor,1,8)',
			'param'	 => 'PB'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'pengubahan_bahan_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('PB',$query,$bln);
		return $kode_baru;
	}
	/* end Function */

}
