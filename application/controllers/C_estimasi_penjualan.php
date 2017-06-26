<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_estimasi_penjualan extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_estimasi_penjualan';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		// $this->view();
	}

	public function view($type){
		$this->check_session();

		if ($type == 1) {
			// $priv = $this->cekUser(20);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Penjualan',
				'title_page2' 	=> 'Estimasi Penjualan',
				);
			$this->open_page('estimasi-penjualan/V_estimasi_penjualan', $data);
			// if($priv['read'] == 1)
			// {
			// 	$this->open_page('nota-debet/V_nota_debet', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			// $priv = $this->cekUser(22);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Persetujuan',
				'title_page2' 	=> 'Estimasi Penjualan',
				);
			$this->open_page('estimasi-penjualan/V_estimasi_penjualan2', $data);
			// if($priv['read'] == 1)
			// {
			// 	$this->open_page('nota-debet/V_nota_debet2', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
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
			'column' => 'estimasi_penjualan_nomor, estimasi_penjualan_periode, estimasi_penjualan_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_estimasi_penjualan');
		$query_filter = $this->mod->select($select, 'v_estimasi_penjualan', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_estimasi_penjualan', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$status = '';
				$button2 = '';

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Penjualan/Estimasi-Penjualan/Form/'.$val->estimasi_penjualan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Estimasi Penjualan">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Penjualan/Estimasi-Penjualan/print-Estimasi/'.$val->estimasi_penjualan_id.'">
						<button class="btn green-jungle" type="button" title="PDF">
							<i class="icon-printer text-center"></i>
						</button>
						</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Persetujuan/Estimasi-Penjualan/Form/'.$val->estimasi_penjualan_id.'">
					<button class="btn blue-ebonyclay" type="button" onclick="checkStatusEstimasiPenjualan('.$val->estimasi_penjualan_id.')" title="Lihat Estimasi Penjualan">
						<i class="icon-eye text-center"></i>
					</button>
					<a href="'.base_url().'Persetujuan/Estimasi-Penjualan/print-Estimasi/'.$val->estimasi_penjualan_id.'">
						<button class="btn green-jungle" type="button" title="PDF">
							<i class="icon-printer text-center"></i>
						</button>
						</a>';
				}

				$response['data'][] = array(
					$no,
					$val->estimasi_penjualan_nomor,
					$val->estimasi_penjualan_periode,
					$val->estimasi_penjualan_status_nama,
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
			'title_page' 	=> 'Penjualan',
			'title_page2' 	=> 'Estimasi Penjualan',
			'id'			=> $id
		);
		$this->open_page('estimasi-penjualan/V_form_estimasi_penjualan', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Persetujuan',
			'title_page2' 	=> 'Estimasi Penjualan',
			'id'			=> $id
		);
		$this->open_page('estimasi-penjualan/V_form_estimasi_penjualan2', $data);
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'estimasi_penjualan_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join_det['data'][] = array(
					'table' => 't_estimasi_penjualan b',
					'join'	=> 'b.estimasi_penjualan_id = a.t_estimasi_penjualan_id',
					'type'	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 'a.t_estimasi_penjualan_id',
					'param'	 => $val->estimasi_penjualan_id
				);
				$query_det = $this->mod->select('a.*, b.*','t_estimasi_penjualandet a',$join_det,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						// CARI BARANG
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
									'estimasi_penjualandet_id'		=> $val2->estimasi_penjualandet_id,
									'barang_kode'					=> $val3->barang_kode,
									'barang_nama'					=> $val3->barang_nama,
									'barang_nomor'					=> $val3->barang_nomor,
									'jenis_barang_nama'				=> $val3->jenis_barang_nama,
									'satuan_nama'					=> $val3->satuan_nama,
									'estimasi_penjualandet_jumlah'	=> $val2->estimasi_penjualandet_jumlah,
									'm_barang_id'					=> $val2->m_barang_id,
									'estimasi_penjualandet_status'	=> $val2->estimasi_penjualandet_status,
								);
							}
						}
						// CARI BARANG
					}
				}
				// END CARI DETAIL

				$response['val'][] = array(
					'kode' 						=> $val->estimasi_penjualan_id,
					'estimasi_penjualan_nomor' 			=> $val->estimasi_penjualan_nomor,
					'estimasi_penjualan_periode'		=> $val->estimasi_penjualan_periode
				);
			}

			echo json_encode($response);
		}
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'estimasi_penjualan_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->estimasi_penjualan_status == 1) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'estimasi_penjualan_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 								=> $id,
						'estimasi_penjualanlog_status_dari' 		=> 1,
						'estimasi_penjualanlog_status_ke' 			=> 2,
						'estimasi_penjualanlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'estimasi_penjualanlog_status_update_by'	=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_estimasi_penjualanlog', NULL, $data_log);
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
			'column' => 'estimasi_penjualan_status >= ',
			'param'	 => 3
		);
		$where['data'][] = array(
			'column' => 'estimasi_penjualan_status <= ',
			'param'	 => 4
		);
		$where_like['data'][] = array(
			'column' => 'estimasi_penjualan_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'estimasi_penjualan_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->estimasi_penjualan_id,
					'text'	=> $val->estimasi_penjualan_nomor
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
			'column' => 'estimasi_penjualan_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$where_det['data'][] = array(
					'column' => 't_estimasi_penjualan_id',
					'param'	 => $val->estimasi_penjualan_id
				);
				$query_det = $this->mod->select('*','t_estimasi_penjualandet',NULL,$where_det);
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
									'estimasi_penjualandet_id'		=> $val2->estimasi_penjualandet_id,
									'barang_kode'					=> $val3->barang_kode,
									'barang_nama'					=> $val3->barang_nama,
									'barang_nomor'					=> $val3->barang_nomor,
									'jenis_barang_nama'				=> $val3->jenis_barang_nama,
									'satuan_nama'					=> $val3->satuan_nama,
									'estimasi_penjualandet_jumlah'	=> $val2->estimasi_penjualandet_jumlah,
									'm_barang_id'					=> $val2->m_barang_id,
									'estimasi_penjualandet_status'	=> $val2->estimasi_penjualandet_status,
								);
							}
						}
						// CARI BARANG DAN STOK
					}
				}
				// END CARI DETAIL
				// CARI GUDANG retur
				// $hasil2['val2'] = array();
				// $where_gudang['data'][] = array(
				// 	'column' => 'gudang_id',
				// 	'param'	 => $val->m_gudang_id
				// );
				// $query_gudang = $this->mod->select('*','m_gudang',NULL,$where_gudang);
				// foreach ($query_gudang->result() as $val2) {
				// 	$hasil2['val2'][] = array(
				// 		'id' 	=> $val2->gudang_id,
				// 		'text' 	=> $val2->gudang_nama
				// 	);
				// }
				// END CARI GUDANG retur
				// CARI CABANG
				$hasil3['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
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
							'telp'  => json_decode($val2->cabang_telepon)
						);
					}
				}
				// CARI SUPPLIER
				// $hasil5['val2'] = array();
				// $where_partner['data'][] = array(
				// 	'column' => 'partner_id',
				// 	'param'	 => $val->m_partner_id
				// );
				// $query_partner = $this->mod->select('*','m_partner',NULL,$where_partner);
				// foreach ($query_partner->result() as $val2) {
				// 	$hasil5['val2'][] = array(
				// 		'id' 	=> $val2->partner_id,
				// 		'text' 	=> $val2->partner_nama,
				// 		'alamat'=> $val2->partner_alamat,
				// 		'telp' 	=> json_decode($val2->partner_telepon)
				// 	);
				// }
				// END CARI SUPPLIER
				// END CARI CABANG
				// CARI PENYETUJU
				// $hasil4['val2'] = array();
				// $where_penyetuju['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->nota_debet_penyetuju
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
				// 	'param'	 => $val->nota_debet_penerima
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
				$name = $val->estimasi_penjualan_id;
				$response['val'][] = array(
					'kode' 								=> $val->estimasi_penjualan_id,
					'estimasi_penjualan_nomor' 					=> $val->estimasi_penjualan_nomor,
					'estimasi_penjualan_periode'				=> $val->estimasi_penjualan_periode,
					// 'nota_debet_tanggal_dibutuhkan'	=> date("d/m/Y",strtotime($val->nota_debet_tanggal_dibutuhkan)),
					// 'nota_debet_jenis' 				=> $val->nota_debet_jenis,
					'cabang'							=> $hasil3,
					'estimasi_penjualan_created_by'		=> $val->estimasi_penjualan_created_by,
					// 'nota_debet_penyetuju' 			=> $hasil4,
					// 'nota_debet_penerima' 				=> $hasil5,
					// 'nota_debet_alasan' 				=> $val->nota_debet_alasan,
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Estimasi Penjualan',
			'title_page2' 	=> 'Print Estimasi Penjualan',
		);
		// echo json_encode($response);
		$this->pdf->load_view('print/P_estimasi', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	public function terbilang($x)
    {
      $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
      if ($x < 12)
      return " " . $abil[$x];
      elseif ($x < 20)
      return $this->terbilang($x - 10) . "belas";
      elseif ($x < 100)
      return $this->terbilang($x / 10) . " puluh" . $this->terbilang($x % 10);
      elseif ($x < 200)
      return " seratus" . $this->terbilang($x - 100);
      elseif ($x < 1000)
      return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
      elseif ($x < 2000)
      return " seribu" . $this->terbilang($x - 1000);
      elseif ($x < 1000000)
      return $this->terbilang($x / 1000) . " ribu" . $this->terbilang($x % 1000);
      elseif ($x < 1000000000)
      return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);
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
			//UPDATE
			$data = $this->general_post_data(2, $id);
			$where['data'][] = array(
				'column' => 'estimasi_penjualan_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($update->status) {
				$response['status'] = '200';
				// INSERT LOG 
				if (@$data['estimasi_penjualan_status']) {
					if ($data['estimasi_penjualan_status'] == 3){
						$data_log = array(
							'referensi_id' 								=> $id,
							'estimasi_penjualanlog_status_dari' 		=> 2,
							'estimasi_penjualanlog_status_ke' 			=> 3,
							'estimasi_penjualanlog_status_update_date'  => date('Y-m-d H:i:s'),
							'estimasi_penjualanlog_status_update_by' 	=> $this->session->userdata('user_username'),
						);
						$insert_log = $this->mod->insert_data_table('t_estimasi_penjualanlog', NULL, $data_log);
					}
				}
			} else {
				$response['status'] = '204';
			}
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('estimasi_penjualan_barang_id', TRUE)); $i++) { 
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_estimasi_penjualandet', NULL, $data_det);
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

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'estimasi_penjualan_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('estimasi_penjualan_status, estimasi_penjualan_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['estimasi_penjualan_revised'] + 1;
			$status = $revised['estimasi_penjualan_status'];
		}
		if ($type == 1) {
			$estimasi_penjualan_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 						=> $this->session->userdata('cabang_id'),
				'estimasi_penjualan_nomor' 			=> $estimasi_penjualan_nomor,
				'estimasi_penjualan_periode'		=> $this->input->post('estimasi_penjualan_periode', TRUE),
				'estimasi_penjualan_status' 		=> 1,
				// 'estimasi_penjualan_status_date'	=> date('Y-m-d H:i:s'),
				'estimasi_penjualan_created_date'	=> date('Y-m-d H:i:s'),
				'estimasi_penjualan_update_date'	=> date('Y-m-d H:i:s'),
				'estimasi_penjualan_created_by'		=> $this->session->userdata('user_username'),
				'estimasi_penjualan_revised' 		=> 0,
			);
		} else if ($type == 2) {
			if ($status == $this->input->post('estimasi_penjualan_status', TRUE)) {
				$data = array(
					'estimasi_penjualan_update_date'	=> date('Y-m-d H:i:s'),
					'estimasi_penjualan_update_by'		=> $this->session->userdata('user_username'),
					'estimasi_penjualan_revised' 		=> $rev,
				);	
			} else {
				$data = array(
					'estimasi_penjualan_status' 		=> $this->input->post('estimasi_penjualan_status', TRUE),
					// 'estimasi_penjualan_status_date'	=> date('Y-m-d H:i:s'),
					'estimasi_penjualan_update_date'	=> date('Y-m-d H:i:s'),
					'estimasi_penjualan_update_by'		=> $this->session->userdata('user_username'),
					'estimasi_penjualan_revised' 		=> $rev,
				);	
			}
		} else if ($type == 3) {
			$data = array(
				'estimasi_penjualan_status'			=> 2,
				// 'estimasi_penjualan_status_date'	=> date('Y-m-d H:i:s'),
				'estimasi_penjualan_update_date'	=> date('Y-m-d H:i:s'),
				'estimasi_penjualan_update_by'		=> $this->session->userdata('user_username'),
				'estimasi_penjualan_revised' 		=> $rev,
			);
		} 

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		// $where['data'][] = array(
		// 	'column' => 'estimasi_penjualandet_id',
		// 	'param'	 => $id
		// );
		// $queryRevised = $this->mod->select('estimasi_penjualandet_revised', 't_estimasi_penjualandet', NULL, $where);
		// if ($queryRevised) {
		// 	$revised = $queryRevised->row_array();
		// 	$rev = $revised['estimasi_penjualandet_revised'] + 1;
		// }
		if ($type == 1) {
			$data = array(
				't_estimasi_penjualan_id' 				=> $idHdr,
				'm_barang_id' 							=> $this->input->post('estimasi_penjualan_barang_id', TRUE)[$seq],
				'estimasi_penjualandet_jumlah' 			=> $this->input->post('estimasi_penjualandet_jumlah', TRUE)[$seq],
				// 'estimasi_penjualandet_status' 			=> 1,
				// 'estimasi_penjualandet_status_date'		=> date('Y-m-d H:i:s'),
				// 'estimasi_penjualandet_created_date'	=> date('Y-m-d H:i:s'),
				// 'estimasi_penjualandet_created_by'		=> $this->session->userdata('user_username'),
				// 'estimasi_penjualandet_update_date'		=> date('Y-m-d H:i:s'),
				// 'estimasi_penjualandet_revised' 		=> 0,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(estimasi_penjualan_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(estimasi_penjualan_nomor,1,9)',
			'param'	 => 'EST'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'estimasi_penjualan_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('EST',$query);
		return $kode_baru;
	}
	/* end Function */

}
