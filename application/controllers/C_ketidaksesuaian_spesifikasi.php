<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_ketidaksesuaian_spesifikasi extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_ketidaksesuaian_spesifikasi';

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
				'title_page2' 	=> 'Ketidaksesuaian Spesifikasi',
				// 'priv_add'		=> $priv['create']
				);
			// if($priv['read'] == 1)
			// {
				$this->open_page('ketidaksesuaian-spesifikasi/V_ketidaksesuaian_spesifikasi', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			// $data = array(
			// 	'aplikasi'		=> $this->app_name,
			// 	'title_page' 	=> 'Pembelian',
			// 	'title_page2' 	=> 'Ketidaksesuaian Spesifikasi',
			// 	'priv_add'		=> ''
			// 	);

			// $this->open_page('ketidaksesuaian-spesifikasi/V_ketidaksesuaian_spesifikasi2', $data);
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
			'column' => 'cabang_nama, ketidaksesuaian_spesifikasi_nomor, perolehan_produksi_nomor, ketidaksesuaian_spesifikasi_tanggal',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_ketidaksesuaian_spesifikasi');
		$query_filter = $this->mod->select($select, 'v_ketidaksesuaian_spesifikasi', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_ketidaksesuaian_spesifikasi', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Produksi/Ketidaksesuaian-Spesifikasi/Form/'.$val->ketidaksesuaian_spesifikasi_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat FKS">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Produksi/Ketidaksesuaian-Spesifikasi/print-Ketidaksesuaian-Spesifikasi/'.$val->ketidaksesuaian_spesifikasi_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					// $button = '
					// <a href="'.base_url().'Pembelian/ketidaksesuaian-spesifikasi/Form/'.$val->ketidaksesuaian_spesifikasi_id.'">
					// <button class="btn blue-ebonyclay" type="button" onclick="checkStatusBPB('.$val->ketidaksesuaian_spesifikasi_id.')"  title="Lihat FKS">
					// 	<i class="icon-eye text-center"></i>
					// </button>
					// </a>
					// <a href="'.base_url().'Produksi/Ketidaksesuaian-Spesifikasi/print-BPB/'.$val->ketidaksesuaian_spesifikasi_id.'">
					// <button class="btn green-jungle" type="button" title="Print PDF">
					// 	<i class="icon-printer text-center"></i>
					// </button>
					// </a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->ketidaksesuaian_spesifikasi_nomor,
					$val->perolehan_produksi_nomor,
					date("d/m/Y",strtotime($val->ketidaksesuaian_spesifikasi_tanggal)),
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
			'title_page2' 	=> 'Ketidaksesuaian Spesifikasi',
			'id'			=> $id
		);
		$this->open_page('ketidaksesuaian-spesifikasi/V_form_ketidaksesuaian_spesifikasi', $data);
	}

	// public function getForm2($id = null){
	// 	$data = array(
	// 		'aplikasi'		=> $this->app_name,
	// 		'title_page' 	=> 'Pembelian',
	// 		'title_page2' 	=> 'Ketidaksesuaian Spesifikasi',
	// 		'id'			=> $id
	// 	);
	// 	$this->open_page('ketidaksesuaian-spesifikasi/V_form_ketidaksesuaian_spesifikasi2', $data);
	// }

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'ketidaksesuaian_spesifikasi_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join_brg['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 'a.t_ketidaksesuaian_spesifikasi_id',
					'param'	 => $val->ketidaksesuaian_spesifikasi_id
				);
				$query_det = $this->mod->select('a.*, b.*', 't_ketidaksesuaian_spesifikasidet a', $join_brg, $where_det);
				$response['val2'] = array();
				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'ketidaksesuaian_spesifikasidet_id'				=> $val2->ketidaksesuaian_spesifikasidet_id,
							't_ketidaksesuaian_spesifikasi'					=> $val2->t_ketidaksesuaian_spesifikasi_id,
							'barang_nama'									=> $val2->barang_nama,
							'barang_id'										=> $val2->barang_id,
							'ketidaksesuaian_spesifikasidet_time'			=> $val2->ketidaksesuaian_spesifikasidet_time,
							'ketidaksesuaian_spesifikasidet_qty'			=> $val2->ketidaksesuaian_spesifikasidet_qty,
							'ketidaksesuaian_spesifikasidet_keterangan'		=> $val2->ketidaksesuaian_spesifikasidet_keterangan,
							'ketidaksesuaian_spesifikasidet_komplain'		=> $val2->ketidaksesuaian_spesifikasidet_komplain,
							'ketidaksesuaian_spesifikasidet_tindakan'		=> $val2->ketidaksesuaian_spesifikasidet_tindakan,
						);
					}
				}

				// NO ORDER
				$join1['data'][] = array(
					'table' => 't_jadwal_produksi b',
					'join'	=> 'b.jadwal_produksi_id = a.t_jadwal_produksi_id',
					'type' 	=> 'left'
				);
				// $join1['data'][] = array(
				// 	'table' => 'm_barang c',
				// 	'join'	=> 'c.barang_id = a.m_barang_id',
				// 	'type' 	=> 'left'
				// );
				$where1['data'][] = array(
					'column' => 'perolehan_produksi_id',
					'param'	 => $val->t_jadwal_produksi_id
				);
				$query1 = $this->mod->select('a.*, b.*', 't_perolehan_produksi a', $join1, $where1);
				$hasil1['val2'] = array();
				$hasil2 = '';
				if ($query1) {
					foreach ($query1->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->perolehan_produksi_id,
							'text' 	=> $val2->perolehan_produksi_nomor
						);
						$hasil2 = $val2->jadwal_produksi_shift;
						$where3['data'][] = array(
							'column' => 'jenis_produksi_id',
							'param'	 => $val2->jadwal_produksi_jenis
						);
						$query3 = $this->mod->select('*', 'm_jenis_produksi', NULL, $where3);
						$hasil3['val2'] = array();
						if ($query3) {
							foreach ($query3->result() as $val2) {
								$hasil3['val2'][] = array(
									'id' 	=> $val2->jenis_produksi_id,
									'text' 	=> $val2->jenis_produksi_nama
								);
							}
						}
					}
				}

				$where2['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->ketidaksesuaian_spesifikasi_operator
				);
				$query2 = $this->mod->select('*', 'm_karyawan', NULL, $where2);
				$hasil5['val2'] = array();
				if ($query2) {
					foreach ($query2->result() as $val2) {
						$hasil5['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama
						);
					}
				}

				$response['val'][] = array(
					'kode' 									=> $val->ketidaksesuaian_spesifikasi_id,
					'ketidaksesuaian_spesifikasi_nomor' 	=> $val->ketidaksesuaian_spesifikasi_nomor,
					'ketidaksesuaian_spesifikasi_tanggal' 	=> date("d/m/Y",strtotime($val->ketidaksesuaian_spesifikasi_tanggal)),
					'ketidaksesuaian_spesifikasi_mesin' 	=> $val->ketidaksesuaian_spesifikasi_mesin,
					'ketidaksesuaian_spesifikasi_operator' 	=> $hasil5,
					'jadwal_produksi_shift' 				=> $hasil2,
					'jadwal_produksi_jenis' 				=> $hasil3,
					't_jadwal_produksi_id'					=> $hasil1,
				);
			}

			echo json_encode($response);
		}
	}

	// public function checkStatus(){
	// 	$id = $this->input->get('id');
	// 	$select = '*';
	// 	$where['data'][] = array(
	// 		'column' => 'ketidaksesuaian_spesifikasi_id',
	// 		'param'	 => $id
	// 	);
	// 	$query = $this->mod->select($select, $this->tbl, NULL, $where);
	// 	if ($query<>false) {
	// 		foreach ($query->result() as $row) {
	// 			if ($row->ketidaksesuaian_spesifikasi_status == 1) {
	// 				$data = $this->general_post_data(3, $id);
	// 				$where['data'][] = array(
	// 					'column' => 'ketidaksesuaian_spesifikasi_id',
	// 					'param'	 => $id
	// 				);
	// 				$update = $this->mod->update_data_table($this->tbl, $where, $data);
	// 				// INSERT LOG);
	// 				$data_log = array(
	// 					'referensi_id' 								=> $id,
	// 					'ketidaksesuaian_spesifikasilog_status_dari' 			=> 1,
	// 					'ketidaksesuaian_spesifikasilog_status_ke' 				=> 2,
	// 					'ketidaksesuaian_spesifikasilog_status_update_date' 	=> date('Y-m-d H:i:s'),
	// 					'ketidaksesuaian_spesifikasilog_status_update_by'		=> $this->session->userdata('user_username'),
	// 				);
	// 				$insert_log = $this->mod->insert_data_table('t_ketidaksesuaian_spesifikasilog', NULL, $data_log);
	// 				$response['status'] = '200';
	// 			} else {
	// 				$response['status'] = '204';
	// 			}
	// 		}
	// 	} else {
	// 		$response['status'] = '204';
	// 	}
	// 	echo json_encode($response);
	// }

	public function loadData_select(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'ketidaksesuaian_spesifikasi_status <',
			'param'	 => 3
		);
		$where_like['data'][] = array(
			'column' => 'ketidaksesuaian_spesifikasi_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'ketidaksesuaian_spesifikasi_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->ketidaksesuaian_spesifikasi_id,
					'text'	=> $val->ketidaksesuaian_spesifikasi_nomor
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
			// if ($type == 2) {
			// 	//UPDATE
			// 	$data = $this->general_post_data(2, $id);
			// 	$where['data'][] = array(
			// 		'column' => 'ketidaksesuaian_spesifikasi_id',
			// 		'param'	 => $id
			// 	);
			// 	$update = $this->mod->update_data_table($this->tbl, $where, $data);
			// 	if($update->status) {
			// 		$response['status'] = '200';
			// 		// INSERT DETAIL
			// 		for ($i = 0; $i < sizeof($this->input->post('ketidaksesuaian_spesifikasidet_id', TRUE)); $i++) {
			// 			$data_det = $this->general_post_data2(2, $id, $i, $this->input->post('ketidaksesuaian_spesifikasidet_id', TRUE)[$i]);
			// 			if (@$where_det['data']) {
			// 				unset($where_det['data']);
			// 			}
			// 			$where_det['data'][] = array(
			// 				'column' => 'ketidaksesuaian_spesifikasidet_id',
			// 				'param'	 => $this->input->post('ketidaksesuaian_spesifikasidet_id', TRUE)[$i]
			// 			);
			// 			$update_det = $this->mod->update_data_table('t_ketidaksesuaian_spesifikasidet', $where_det, $data_det);
			// 			if($update_det->status) {
			// 				$response['status'] = '200';
			// 			} else {
			// 				$response['status'] = '204';
			// 			}
			// 		}
			// 	} else {
			// 		$response['status'] = '204';
			// 	}
			// }
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('ketidaksesuaian_spesifikasidet_time', TRUE)); $i++) {
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_ketidaksesuaian_spesifikasidet', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
						$data_pp = $this->general_post_data(4);
						$where_pp['data'][] = array(
							'column' => 'perolehan_produksi_id',
							'param'	 => $data['t_jadwal_produksi_id']
						);
						$update_pp = $this->mod->update_data_table('t_perolehan_produksi', $where_pp, $data_pp);
						if($update_pp->status)
						{
							$response['status'] = '200';
							// INSERT LOG);
							$data_log = array(
								'referensi_id' 								=> $data['t_jadwal_produksi_id'],
								'perolehan_produksilog_status_dari' 		=> 1,
								'perolehan_produksilog_status_ke' 			=> 2,
								'perolehan_produksilog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'perolehan_produksilog_status_update_by'	=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_perolehan_produksilog', NULL, $data_log);
						}
						else{
							$response['status'] = '204';
						}
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
			'column' => 'ketidaksesuaian_spesifikasi_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join_brg['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 'a.t_ketidaksesuaian_spesifikasi_id',
					'param'	 => $val->ketidaksesuaian_spesifikasi_id
				);
				$query_det = $this->mod->select('a.*, b.*', 't_ketidaksesuaian_spesifikasidet a', $join_brg, $where_det);
				$response['val2'] = array();
				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'ketidaksesuaian_spesifikasidet_id'				=> $val2->ketidaksesuaian_spesifikasidet_id,
							't_ketidaksesuaian_spesifikasi'					=> $val2->t_ketidaksesuaian_spesifikasi_id,
							'barang_nama'									=> $val2->barang_nama,
							'barang_id'										=> $val2->barang_id,
							'ketidaksesuaian_spesifikasidet_time'			=> $val2->ketidaksesuaian_spesifikasidet_time,
							'ketidaksesuaian_spesifikasidet_qty'			=> $val2->ketidaksesuaian_spesifikasidet_qty,
							'ketidaksesuaian_spesifikasidet_keterangan'		=> $val2->ketidaksesuaian_spesifikasidet_keterangan,
							'ketidaksesuaian_spesifikasidet_komplain'		=> $val2->ketidaksesuaian_spesifikasidet_komplain,
							'ketidaksesuaian_spesifikasidet_tindakan'		=> $val2->ketidaksesuaian_spesifikasidet_tindakan,
						);
					}
				}
				// END CARI DETAIL
				// CARI PENYETUJU
				// $hasil4['val2'] = array();
				// $where_penyetuju['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->ketidaksesuaian_spesifikasi_penyetuju
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
				// CARI PENERIMA
				// $hasil5['val2'] = array();
				// $where_penerima['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->ketidaksesuaian_spesifikasi_pemeriksa
				// );
				// $query_penerima = $this->mod->select('*','m_karyawan',NULL,$where_penerima);
				// if ($query_penerima) {
				// 	foreach ($query_penerima->result() as $val2) {
				// 		$hasil5['val2'][] = array(
				// 			'id' 	=> $val2->karyawan_id,
				// 			'text' 	=> $val2->karyawan_nama
				// 		);
				// 	}
				// }
				// END CARI PENERIMA
				// CARI OPERATOR
				$hasil6['val2'] = array();
				$where_operator['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->ketidaksesuaian_spesifikasi_operator
				);
				$query_operator = $this->mod->select('*','m_karyawan',null,$where_operator);
				if ($query_operator) {
					foreach ($query_operator->result() as $val3) {
						$hasil6['val2'][] = array(
							'id' 		=> $val3->karyawan_id,
							'text' 		=> $val3->karyawan_nama
						);
					}
				}
				// END CARI OPERATOR
				// NO ORDER
				$join1['data'][] = array(
					'table' => 't_jadwal_produksi b',
					'join'	=> 'b.jadwal_produksi_id = a.t_jadwal_produksi_id',
					'type' 	=> 'left'
				);
				$where1['data'][] = array(
					'column' => 'perolehan_produksi_id',
					'param'	 => $val->t_jadwal_produksi_id
				);
				$query1 = $this->mod->select('a.*, b.*', 't_perolehan_produksi a', $join1, $where1);
				$hasil1['val2'] = array();
				$hasil2 = '';
				if ($query1) {
					foreach ($query1->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->perolehan_produksi_id,
							'text' 	=> $val2->perolehan_produksi_nomor
						);
						$hasil2 = $val2->jadwal_produksi_shift;
						$where3['data'][] = array(
							'column' => 'jenis_produksi_id',
							'param'	 => $val2->jadwal_produksi_jenis
						);
						$query3 = $this->mod->select('*', 'm_jenis_produksi', NULL, $where3);
						$hasil3['val2'] = array();
						if ($query3) {
							foreach ($query3->result() as $val2) {
								$hasil3['val2'][] = array(
									'id' 	=> $val2->jenis_produksi_id,
									'text' 	=> $val2->jenis_produksi_nama
								);
							}
						}
					}
				}

				// CARI CABANG
				$hasil7['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI KOTA
						$hasil8['val2'] = array();
						$where_kota['data'][] = array(
							'column' => 'id',
							'param'	 => $val2->cabang_kota
						);
						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
						if ($query_kota) {
							foreach ($query_kota->result() as $val3) {
								$hasil8['val3'][] = array(
									'id' 		=> $val3->id,
									'text' 		=> $val3->name,
								);
							}
						}
						// END CARI KOTA
						$hasil7['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil8,
							'telp'  => json_decode($val2->cabang_telepon)
						);
					}
				}
				// END CARI CABANG
				$response['val'][] = array(
					'kode' 									=> $val->ketidaksesuaian_spesifikasi_id,
					'ketidaksesuaian_spesifikasi_nomor' 	=> $val->ketidaksesuaian_spesifikasi_nomor,
					'ketidaksesuaian_spesifikasi_tanggal' 	=> date("d/m/Y",strtotime($val->ketidaksesuaian_spesifikasi_tanggal)),
					'ketidaksesuaian_spesifikasi_mesin' 	=> $val->ketidaksesuaian_spesifikasi_mesin,
					'ketidaksesuaian_spesifikasi_operator' 	=> $hasil6,
					'jadwal_produksi_shift' 				=> $hasil2,
					'jadwal_produksi_jenis' 				=> $hasil3,
					't_jadwal_produksi_id'					=> $hasil1,
					// 'kode' 									=> $val->ketidaksesuaian_spesifikasi_id,
					// 'ketidaksesuaian_spesifikasi_nomor' 	=> $val->ketidaksesuaian_spesifikasi_nomor,
					// 'ketidaksesuaian_spesifikasi_tanggal'	=> $val->ketidaksesuaian_spesifikasi_tanggal,
					// 'ketidaksesuaian_spesifikasi_mesin' 	=> $val->ketidaksesuaian_spesifikasi_mesin,
					// 'ketidaksesuaian_spesifikasi_ppn' 		=> $val->ketidaksesuaian_spesifikasi_ppn,
					// 'ketidaksesuaian_spesifikasi_tanggal'	=> date("d/m/Y",strtotime($val->ketidaksesuaian_spesifikasi_tanggal)),
					// 'ketidaksesuaian_spesifikasi_catatan' 	=> $val->ketidaksesuaian_spesifikasi_catatan,
					// 'ketidaksesuaian_spesifikasi_status' 	=> $val->ketidaksesuaian_spesifikasi_status,
					// 'ketidaksesuaian_spesifikasi_penyetuju' 				=> $hasil4,
					// 'ketidaksesuaian_spesifikasi_produksi'	=> $hasil5,
					'ketidaksesuaian_spesifikasi_pembuat' 	=> $val->ketidaksesuaian_spesifikasi_created_by,
					// 'ketidaksesuaian_spesifikasi_operator' 	=> $hasil6,
					'cabang'								=> $hasil7
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Ketidaksesuaian Spesifikasi',
			'title_page2' 	=> 'Print Ketidaksesuaian Spesifikasi Bahan',
		);
		// echo json_encode($response);
		$this->pdf->load_view('print/P_ketidaksesuaian_spesifikasi', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('ketidaksesuaian_spesifikasi_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'ketidaksesuaian_spesifikasi_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('ketidaksesuaian_spesifikasi_revised', $this->tbl, NULL, $where);
		$where_pp['data'][] = array(
			'column' => 'perolehan_produksi_id',
			'param'	 => $this->input->post('t_perolehan_produksi_id', TRUE)
		);
		$queryRevised_pp = $this->mod->select('perolehan_produksi_revised', 't_perolehan_produksi', NULL, $where_pp);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['ketidaksesuaian_spesifikasi_revised'] + 1;
		}
		if ($queryRevised_pp) {
			$revised = $queryRevised_pp->row_array();
			$rev_pp = $revised['perolehan_produksi_revised'] + 1;
		}
		if ($type == 1) {
			$ketidaksesuaian_spesifikasi_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 								=> $this->session->userdata('cabang_id'),
				'ketidaksesuaian_spesifikasi_nomor' 		=> $ketidaksesuaian_spesifikasi_nomor,
				'ketidaksesuaian_spesifikasi_tanggal' 		=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				't_jadwal_produksi_id'						=> $this->input->post('t_perolehan_produksi_id', TRUE),
				'ketidaksesuaian_spesifikasi_mesin' 		=> $this->input->post('ketidaksesuaian_spesifikasi_mesin', TRUE),
				'ketidaksesuaian_spesifikasi_operator'		=> $this->input->post('ketidaksesuaian_spesifikasi_operator', TRUE),
				'ketidaksesuaian_spesifikasi_created_date'	=> date('Y-m-d H:i:s'),
				'ketidaksesuaian_spesifikasi_update_date'	=> date('Y-m-d H:i:s'),
				'ketidaksesuaian_spesifikasi_created_by'	=> $this->session->userdata('user_username'),
				'ketidaksesuaian_spesifikasi_revised' 		=> 0,
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
				'ketidaksesuaian_spesifikasi_status'		=> 2,
				'ketidaksesuaian_spesifikasi_status_date'	=> date('Y-m-d H:i:s'),
				'ketidaksesuaian_spesifikasi_update_date'	=> date('Y-m-d H:i:s'),
				'ketidaksesuaian_spesifikasi_update_by'		=> $this->session->userdata('user_username'),
				'ketidaksesuaian_spesifikasi_revised' 		=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'perolehan_produksi_status'			=> 2,
				// 'perolehan_produksi_status_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_update_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_update_by'		=> $this->session->userdata('user_username'),
				'perolehan_produksi_revised' 		=> $rev_pp,
			);
		} 

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if ($type == 1) {
			$data = array(
				't_ketidaksesuaian_spesifikasi_id' 				=> $idHdr,
				'm_barang_id' 									=> $this->input->post('m_barang_id', TRUE)[$seq],
				't_jadwal_produksidet_id' 						=> $this->input->post('t_perolehan_produksi_akhirdet_id', TRUE)[$seq],
				'ketidaksesuaian_spesifikasidet_time'			=> $this->input->post('ketidaksesuaian_spesifikasidet_time', TRUE)[$seq],
				'ketidaksesuaian_spesifikasidet_qty' 			=> $this->input->post('ketidaksesuaian_spesifikasidet_qty', TRUE)[$seq],
				'ketidaksesuaian_spesifikasidet_komplain' 		=> $this->input->post('ketidaksesuaian_spesifikasidet_komplain', TRUE)[$seq],
				'ketidaksesuaian_spesifikasidet_tindakan' 		=> $this->input->post('ketidaksesuaian_spesifikasidet_tindakan', TRUE)[$seq],
				'ketidaksesuaian_spesifikasidet_keterangan' 	=> $this->input->post('ketidaksesuaian_spesifikasidet_keterangan', TRUE)[$seq],
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
		$select = 'MID(ketidaksesuaian_spesifikasi_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(ketidaksesuaian_spesifikasi_nomor,1,9)',
			'param'	 => 'FKS'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'ketidaksesuaian_spesifikasi_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('FKS',$query,$bln);
		return $kode_baru;
	}
	/* end Function */

}
