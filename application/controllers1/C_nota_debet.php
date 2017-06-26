<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_nota_debet extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_nota_debet';

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
				'title_page' 	=> 'Pembelian',
				'title_page2' 	=> 'Nota Debet',
				);
			$this->open_page('nota-debet/V_nota_debet', $data);
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
				'title_page' 	=> 'Pembelian',
				'title_page2' 	=> 'Nota Debet',
				);
			$this->open_page('nota-debet/V_nota_debet2', $data);
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
			'column' => 'cabang_nama, nota_debet_nomor, retur_pembelian_nomor, partner_nama, nota_debet_tanggal, nota_debet_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_nota_debet');
		$query_filter = $this->mod->select($select, 'v_nota_debet', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_nota_debet', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$status = '';
				$button2 = '';

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Pembelian/Nota-Debet/Form/'.$val->nota_debet_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Nota Debet">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Pembelian/Nota-Debet/print-Nota-Debet/'.$val->nota_debet_id.'">
						<button class="btn green-jungle" type="button" title="PDF">
							<i class="icon-printer text-center"></i>
						</button>
						</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Persetujuan/Nota-Debet/Form/'.$val->nota_debet_id.'">
					<button class="btn blue-ebonyclay" type="button" onclick="checkStatusNotaDebet('.$val->nota_debet_id.')" title="Lihat Nota Debet">
						<i class="icon-eye text-center"></i>
					</button>
					<a href="'.base_url().'Persetujuan/Nota-Debet/print-Nota-Debet/'.$val->nota_debet_id.'">
						<button class="btn green-jungle" type="button" title="PDF">
							<i class="icon-printer text-center"></i>
						</button>
						</a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->nota_debet_nomor,
					$val->retur_pembelian_nomor,
					$val->partner_nama,
					date("d/m/Y",strtotime($val->nota_debet_tanggal)),
					$val->nota_debet_status_nama,
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
			'title_page' 	=> 'Pembelian',
			'title_page2' 	=> 'Nota Debet',
			'id'			=> $id
		);
		$this->open_page('nota-debet/V_form_nota_debet', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Persetujuan',
			'title_page2' 	=> 'Nota Debet',
			'id'			=> $id
		);
		$this->open_page('nota-debet/V_form_nota_debet2', $data);
	}

	public function loadDataWhere($type){
		$select = '*';
		$where['data'][] = array(
			'column' => 'nota_debet_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, 'v_nota_debet', NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join_det['data'][] = array(
					'table' => 't_retur_pembeliandet b',
					'join'	=> 'b.t_retur_pembelian_id = a.t_retur_pembelian_id',
					'type'	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 't_nota_debet_id',
					'param'	 => $val->nota_debet_id
				);
				$query_det = $this->mod->select('a.*, b.retur_pembeliandet_keterangan','t_nota_debetdet a',$join_det,$where_det);
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
									'nota_debetdet_id'				=> $val2->nota_debetdet_id,
									'barang_kode'					=> $val3->barang_kode,
									'barang_nama'					=> $val3->barang_nama,
									'barang_nomor'					=> $val3->barang_nomor,
									'jenis_barang_nama'				=> $val3->jenis_barang_nama,
									'satuan_nama'					=> $val3->satuan_nama,
									'nota_debetdet_qty'				=> $val2->nota_debetdet_qty,
									'nota_debetdet_keterangan'		=> $val2->retur_pembeliandet_keterangan,
									'nota_debetdet_harga_satuan'	=> $val2->nota_debetdet_harga_satuan,
									'nota_debetdet_potongan'		=> $val2->nota_debetdet_potongan,
									'nota_debetdet_total'			=> $val2->nota_debetdet_total,
									'nota_debetdet_status'			=> $val2->nota_debetdet_status,
									'm_barang_id'					=> $val2->m_barang_id,
								);
							}
						}
						// CARI BARANG
					}
				}
				// END CARI DETAIL

				$response['val'][] = array(
					'kode' 						=> $val->nota_debet_id,
					'nota_debet_nomor' 			=> $val->nota_debet_nomor,
					'nota_debet_tanggal'		=> date("d/m/Y",strtotime($val->nota_debet_tanggal)),
					'nota_debet_subtotal' 		=> $val->nota_debet_subtotal,
					'nota_debet_ppn' 			=> $val->nota_debet_ppn,
					'nota_debet_total' 			=> $val->nota_debet_total,
					'nota_debet_catatan' 		=> $val->nota_debet_catatan,
					'nota_debet_metode_pembayaran' 		=> $val->nota_debet_metode_pembayaran,
					'nota_debet_status' 		=> $val->nota_debet_status,
					'retur_pembelian_id' 		=> $val->retur_pembelian_id,
					'retur_pembelian_nomor' 	=> $val->retur_pembelian_nomor,
					'retur_pembelian_tanggal' 	=> date("d/m/Y",strtotime($val->retur_pembelian_tanggal)),
					'gudang_id' 				=> $val->gudang_id,
					'gudang_nama' 				=> $val->gudang_nama,
					'gudang_id' 				=> $val->gudang_id,
					'gudang_nama' 				=> $val->gudang_nama,
					'partner_id' 				=> $val->partner_id,
					'partner_nama' 				=> $val->partner_nama,
				);
			}

			echo json_encode($response);
		}
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'nota_debet_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->nota_debet_status == 1) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'nota_debet_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 						=> $id,
						'nota_debetlog_status_dari' 		=> 1,
						'nota_debetlog_status_ke' 			=> 2,
						'nota_debetlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'nota_debetlog_status_update_by'	=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_nota_debetlog', NULL, $data_log);
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
			'column' => 'nota_debet_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'nota_debet_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->nota_debet_id,
					'text'	=> $val->nota_debet_nomor
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
			'column' => 'nota_debet_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$where_det['data'][] = array(
					'column' => 't_nota_debet_id',
					'param'	 => $val->nota_debet_id
				);
				$query_det = $this->mod->select('*','t_nota_debetdet',NULL,$where_det);
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
									'nota_debetdet_id'			=> $val2->nota_debetdet_id,
									'barang_kode'				=> $val3->barang_kode,
									'barang_nama'				=> $val3->barang_nama,
									'barang_nomor'				=> $val3->barang_nomor,
									'jenis_barang_nama'			=> $val3->jenis_barang_nama,
									'satuan_nama'				=> $val3->satuan_nama,
									'nota_debetdet_qty'			=> $val2->nota_debetdet_qty,
									'nota_debetdet_harga_satuan'=> $val2->nota_debetdet_harga_satuan,
									'nota_debetdet_total'		=> $val2->nota_debetdet_total,
									'm_barang_id'				=> $val2->m_barang_id,
								);
							}
						}
						// CARI BARANG DAN STOK
					}
				}
				// END CARI DETAIL
				// CARI GUDANG retur
				$hasil2['val2'] = array();
				$where_gudang['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->m_gudang_id
				);
				$query_gudang = $this->mod->select('*','m_gudang',NULL,$where_gudang);
				foreach ($query_gudang->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->gudang_id,
						'text' 	=> $val2->gudang_nama
					);
				}
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
				$hasil5['val2'] = array();
				$where_partner['data'][] = array(
					'column' => 'partner_id',
					'param'	 => $val->m_partner_id
				);
				$query_partner = $this->mod->select('*','m_partner',NULL,$where_partner);
				foreach ($query_partner->result() as $val2) {
					$hasil5['val2'][] = array(
						'id' 	=> $val2->partner_id,
						'text' 	=> $val2->partner_nama,
						'alamat'=> $val2->partner_alamat,
						'telp' 	=> json_decode($val2->partner_telepon)
					);
				}
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
				$name = $val->nota_debet_nomor;
				$response['val'][] = array(
					'kode' 								=> $val->nota_debet_id,
					'nota_debet_nomor' 					=> $val->nota_debet_nomor,
					'nota_debet_tanggal'				=> date("d/m/Y",strtotime($val->nota_debet_tanggal)),
					// 'nota_debet_tanggal_dibutuhkan'	=> date("d/m/Y",strtotime($val->nota_debet_tanggal_dibutuhkan)),
					// 'nota_debet_jenis' 				=> $val->nota_debet_jenis,
					'cabang'							=> $hasil3,
					'm_gudang_id'						=> $hasil2,
					'partner'							=> $hasil5,
					'nota_debet_status' 				=> $val->nota_debet_status,
					'nota_debet_subtotal' 				=> $val->nota_debet_subtotal,
					'nota_debet_terbilang'				=> $this->terbilang($val->nota_debet_subtotal),
					'nota_debet_ppn' 					=> $val->nota_debet_ppn,
					'nota_debet_total' 					=> $val->nota_debet_total,
					// 'nota_debet_penyetuju' 			=> $hasil4,
					// 'nota_debet_penerima' 				=> $hasil5,
					// 'nota_debet_alasan' 				=> $val->nota_debet_alasan,
					'nota_debet_catatan' 				=> $val->nota_debet_catatan,
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Nota Debet',
			'title_page2' 	=> 'Print Nota Debet',
		);
		// echo json_encode($response);
		$this->pdf->load_view('print/P_nota_debet', $response);
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
				'column' => 'nota_debet_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($update->status) {
				$response['status'] = '200';
				// INSERT LOG 
				if (@$data['nota_debet_status']) {
					if ($data['nota_debet_status'] == 3){
						$data_log = array(
							'referensi_id' 						=> $id,
							'nota_debetlog_status_dari' 		=> 2,
							'nota_debetlog_status_ke' 			=> 3,
							'nota_debetlog_status_update_date'  => date('Y-m-d H:i:s'),
							'nota_debetlog_status_update_by' 	=> $this->session->userdata('user_username'),
						);
						$insert_log = $this->mod->insert_data_table('t_nota_debetlog', NULL, $data_log);
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
				// UPDATE RETUR 
				if (@$where_returdet['data']) {
					unset($where_returdet['data']);
				}
				$data_returdet = array(
					'retur_pembelian_status' => 4,
				);
				$where_returdet['data'][] = array(
					'column' => 'retur_pembelian_id',
					'param'	 => $this->input->post('t_retur_pembelian_id', TRUE)
				);
				$update_returdet = $this->mod->update_data_table('t_retur_pembelian', $where_returdet, $data_returdet);
				// INSERT LOG);
				$data_log = array(
					'referensi_id' 								=> $this->input->post('t_retur_pembelian_id', TRUE),
					'retur_pembelianlog_status_dari' 			=> 3,
					'retur_pembelianlog_status_ke' 				=> 4,
					'retur_pembelianlog_status_update_date' 	=> date('Y-m-d H:i:s'),
					'retur_pembelianlog_status_update_by'		=> $this->session->userdata('user_username'),
				);
				$insert_log = $this->mod->insert_data_table('t_retur_pembelianlog', NULL, $data_log);
				// END UPDATE RETUR

				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_nota_debetdet', NULL, $data_det);
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
		$arrDate = explode('/', $this->input->post('nota_debet_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'nota_debet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('nota_debet_status, nota_debet_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['nota_debet_revised'] + 1;
			$status = $revised['nota_debet_status'];
		}
		if ($type == 1) {
			$nota_debet_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 				=> $this->session->userdata('cabang_id'),
				'nota_debet_nomor' 			=> $nota_debet_nomor,
				'nota_debet_tanggal'		=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				't_retur_pembelian_id'		=> $this->input->post('t_retur_pembelian_id', TRUE),
				'm_partner_id'				=> $this->input->post('m_partner_id', TRUE),
				'm_gudang_id'				=> $this->input->post('m_gudang_id', TRUE),
				'nota_debet_subtotal'		=> $this->input->post('nota_debet_subtotal', TRUE),
				'nota_debet_ppn'			=> $this->input->post('nota_debet_ppn', TRUE),
				'nota_debet_total'			=> $this->input->post('nota_debet_total', TRUE),
				'nota_debet_metode_pembayaran'		=> $this->input->post('nota_debet_metode_pembayaran', TRUE),
				'nota_debet_catatan'		=> $this->input->post('nota_debet_catatan', TRUE),
				'nota_debet_status' 		=> 1,
				'nota_debet_status_date'	=> date('Y-m-d H:i:s'),
				'nota_debet_created_date'	=> date('Y-m-d H:i:s'),
				'nota_debet_update_date'	=> date('Y-m-d H:i:s'),
				'nota_debet_created_by'		=> $this->session->userdata('user_username'),
				'nota_debet_revised' 		=> 0,
			);
		} else if ($type == 2) {
			if ($status == $this->input->post('nota_debet_status', TRUE)) {
				$data = array(
					'nota_debet_update_date'	=> date('Y-m-d H:i:s'),
					'nota_debet_update_by'		=> $this->session->userdata('user_username'),
					'nota_debet_revised' 		=> $rev,
				);	
			} else {
				$data = array(
					'nota_debet_status' 		=> $this->input->post('nota_debet_status', TRUE),
					'nota_debet_status_date'	=> date('Y-m-d H:i:s'),
					'nota_debet_update_date'	=> date('Y-m-d H:i:s'),
					'nota_debet_update_by'		=> $this->session->userdata('user_username'),
					'nota_debet_revised' 		=> $rev,
				);	
			}
		} else if ($type == 3) {
			$data = array(
				'nota_debet_status'			=> 2,
				'nota_debet_status_date'	=> date('Y-m-d H:i:s'),
				'nota_debet_update_date'	=> date('Y-m-d H:i:s'),
				'nota_debet_update_by'		=> $this->session->userdata('user_username'),
				'nota_debet_revised' 		=> $rev,
			);
		} 

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'nota_debetdet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('nota_debetdet_revised', 't_nota_debetdet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['nota_debetdet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_nota_debet_id' 				=> $idHdr,
				'm_barang_id' 					=> $this->input->post('m_barang_id', TRUE)[$seq],
				't_retur_pembelian_id'			=> $this->input->post('t_retur_pembelian_id', TRUE),
				'nota_debetdet_qty' 			=> $this->input->post('nota_debetdet_qty', TRUE)[$seq],
				'nota_debetdet_harga_satuan'	=> $this->input->post('nota_debetdet_harga_satuan', TRUE)[$seq],
				'nota_debetdet_potongan'		=> $this->input->post('nota_debetdet_potongan', TRUE)[$seq],
				'nota_debetdet_total'			=> $this->input->post('nota_debetdet_total', TRUE)[$seq],
				'nota_debetdet_status' 			=> 1,
				'nota_debetdet_status_date'		=> date('Y-m-d H:i:s'),
				'nota_debetdet_created_date'	=> date('Y-m-d H:i:s'),
				'nota_debetdet_created_by'		=> $this->session->userdata('user_username'),
				'nota_debetdet_update_date'		=> date('Y-m-d H:i:s'),
				'nota_debetdet_revised' 		=> 0,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(nota_debet_nomor,14,5) as id';
		$where['data'][] = array(
			'column' => 'MID(nota_debet_nomor,1,13)',
			'param'	 => 'NOTADEB'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'nota_debet_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('NOTADEB',$query);
		return $kode_baru;
	}
	/* end Function */

}
