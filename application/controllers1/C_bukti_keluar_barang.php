<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_bukti_keluar_barang extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_keluar_barang';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		// $this->view();
	}

	public function viewBkb($type){
		$this->check_session();

		if ($type == 1) {
			$priv = $this->cekUser(13);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Produksi',
				'title_page2' 	=> 'Bukti Keluar Barang',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('barang-keluar/V_bukti_keluar_barang', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		} else if ($type == 2) {
			$priv = $this->cekUser(19);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Gudang',
				'title_page2' 	=> 'Bukti Keluar Barang',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('barang-keluar/V_bukti_keluar_barang2', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		}
	}

	public function loadDataBkb($type){
		$priv = $this->cekUser(13);
		$privGudang = $this->cekUser(19);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, keluar_barang_nomor, keluar_barang_jenis_nama, keluar_barang_tanggal, departemen_nama, keluar_barang_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_keluar_barang');
		$query_filter = $this->mod->select($select, 'v_keluar_barang', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_keluar_barang', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$status = '';
				$button2 = '';
				$button = '';
				if ($val->keluar_barang_status >= 4) {
					$status = 'disabled';
					if($privGudang['read'] == 1)
					{
						$button2 = $button2.'<a href="'.base_url().'Gudang/Bukti-Keluar-Barang/Form/'.$val->keluar_barang_id.'">
						<button class="btn blue-ebonyclay" type="button" onclick="openFormBKB(2,'.$val->keluar_barang_id.')" title="Lihat BKB">
							<i class="icon-eye text-center"></i>
						</button>
						</a>
						<a href="'.base_url().'Gudang/Bukti-Keluar-Barang/print-BKB/'.$val->keluar_barang_id.'">
						<button class="btn green-jungle" type="button" title="Print PDF">
							<i class="icon-printer text-center"></i>
						</button>
						</a>';
					}
					
				}

				if ($type == 1) {
					if($priv['read'] == 1)
					{
						$button = '
						<a href="'.base_url().'Produksi/Bukti-Keluar-Barang/Form/'.$val->keluar_barang_id.'">
						<button class="btn blue-ebonyclay" type="button" title="Lihat BKB">
							<i class="icon-eye text-center"></i>
						</button>
						</a>
						<a href="'.base_url().'Produksi/Bukti-Keluar-Barang/print-BKB/'.$val->keluar_barang_id.'">
						<button class="btn green-jungle" type="button" title="PDF">
							<i class="icon-printer text-center"></i>
						</button>
						</a>';
					}
				} else if ($type == 2) {
					if($privGudang['update'] == 1)
					{
						$button = $button.'<a href="'.base_url().'Gudang/Bukti-Keluar-Barang/Form/'.$val->keluar_barang_id.'">
						<button class="btn blue-ebonyclay" type="button" onclick="checkStatusBkb('.$val->keluar_barang_id.')" title="Edit" '.$status.'>
							<i class="icon-pencil text-center"></i>
						</button>
						</a>';
					}
					$button = $button.$button2;
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->keluar_barang_nomor,
					$val->keluar_barang_jenis_nama,
					date("d/m/Y",strtotime($val->keluar_barang_tanggal)),
					$val->departemen_nama,
					$val->keluar_barang_status_nama,
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
			'title_page2' 	=> 'Bukti Keluar Barang',
			'id'			=> $id
		);
		$this->open_page('barang-keluar/V_form_bukti_keluar_barang', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Gudang',
			'title_page2' 	=> 'Bukti Keluar Barang',
			'id'			=> $id
		);
		$this->open_page('barang-keluar/V_form_bukti_keluar_barang2', $data);
	}

	public function loadDataBkbWhere($type){
		$select = '*';
		$where['data'][] = array(
			'column' => 'keluar_barang_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$where_det['data'][] = array(
					'column' => 't_keluar_barang_id',
					'param'	 => $val->keluar_barang_id
				);
				$query_det = $this->mod->select('*','t_keluar_barangdet',NULL,$where_det);
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
							'table' => 't_stok_gudang b',
							'join'	=> 'b.m_barang_id = a.barang_id and b.m_gudang_id = '.$val->m_gudang_id_tujuan,
							'type'	=> 'left'
						);
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
						$query_brg = $this->mod->select('a.*, b.stok_gudang_jumlah, c.jenis_barang_nama, d.satuan_nama','m_barang a',$join_brg,$where_brg);
						if ($query_brg) {
							foreach ($query_brg->result() as $val3) {
								if ($val2->keluar_barangdet_status == 0) {
									$status = '<span class="label bg-yellow-lemon bg-font-yellow-lemon"> Pending </span>';
								} else if ($val2->keluar_barangdet_status == 1) {
									$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Terkirim </span>';
								}
								$response['val2'][] = array(
									'keluar_barangdet_id'				=> $val2->keluar_barangdet_id,
									'barang_kode'						=> $val3->barang_kode,
									'barang_nama'						=> $val3->barang_nama,
									'jenis_barang_nama'					=> $val3->jenis_barang_nama,
									'barang_nomor'						=> $val3->barang_nomor,
									'satuan_nama'						=> $val3->satuan_nama,
									'keluar_barangdet_qty'				=> $val2->keluar_barangdet_qty,
									'keluar_barangdet_qty_realisasi'	=> $val2->keluar_barangdet_qty_realisasi,
									'stok_gudang_jumlah'				=> intval(($val3->stok_gudang_jumlah - $val3->barang_minimum_stok)),
									'm_barang_id'						=> $val2->m_barang_id,
									'keluar_barangdet_keterangan'		=> $val2->keluar_barangdet_keterangan,
									'keluar_barangdet_status_real'		=> $val2->keluar_barangdet_status,
									'keluar_barangdet_status'			=> $status,
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
				// CARI GUDANG PERMINTAAN
				$hasil2['val2'] = array();
				$where_gudang['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->m_gudang_id_permintaan
				);
				$query_gudang = $this->mod->select('*','m_gudang',NULL,$where_gudang);
				foreach ($query_gudang->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->gudang_id,
						'text' 	=> $val2->gudang_nama
					);
				}
				// END CARI GUDANG PERMINTAAN
				// CARI GUDANG TUJUAN
				$hasil3['val2'] = array();
				$where_gudang2['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->m_gudang_id_tujuan
				);
				$query_gudang2 = $this->mod->select('*','m_gudang',NULL,$where_gudang2);
				foreach ($query_gudang2->result() as $val2) {
					$hasil3['val2'][] = array(
						'id' 	=> $val2->gudang_id,
						'text' 	=> $val2->gudang_nama
					);
				}
				// END CARI GUDANG TUJUAN
				// CARI PENYERAH
				$hasil4['val2'] = array();
				$where_penyerah['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->keluar_barang_penyerah
				);
				$query_penyerah = $this->mod->select('*','m_karyawan',NULL,$where_penyerah);
				if ($query_penyerah) {
					foreach ($query_penyerah->result() as $val2) {
						$hasil4['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama
						);
					}
				}
				// END CARI PENYERAH
				// CARI PENERIMA
				$hasil5['val2'] = array();
				$where_penerima['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->keluar_barang_penerima
				);
				$query_penerima = $this->mod->select('*','m_karyawan',NULL,$where_penerima);
				if ($query_penerima) {
					foreach ($query_penerima->result() as $val2) {
						$hasil5['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama
						);
					}
				}
				// END CARI PENERIMA

				$response['val'][] = array(
					'kode' 							=> $val->keluar_barang_id,
					'keluar_barang_nomor' 			=> $val->keluar_barang_nomor,
					'keluar_barang_tanggal'			=> date("d/m/Y",strtotime($val->keluar_barang_tanggal)),
					'keluar_barang_jenis' 			=> $val->keluar_barang_jenis,
					'm_departemen_id' 				=> $hasil1,
					'm_gudang_id_permintaan'		=> $hasil2,
					'm_gudang_id_tujuan'			=> $hasil3,
					'keluar_barang_status' 			=> $val->keluar_barang_status,
					'keluar_barang_penyerah' 		=> $hasil4,
					'keluar_barang_penerima' 		=> $hasil5,
				);
			}

			echo json_encode($response);
		}
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'keluar_barang_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->keluar_barang_status == 1) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'keluar_barang_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 							=> $id,
						'keluar_baranglog_status_dari' 			=> 1,
						'keluar_baranglog_status_ke' 			=> 2,
						'keluar_baranglog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'keluar_baranglog_status_update_by' 	=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_keluar_baranglog', NULL, $data_log);
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

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'keluar_barang_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$where_det['data'][] = array(
					'column' => 't_keluar_barang_id',
					'param'	 => $val->keluar_barang_id
				);
				$query_det = $this->mod->select('*','t_keluar_barangdet',NULL,$where_det);
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
							'table' => 't_stok_gudang b',
							'join'	=> 'b.m_barang_id = a.barang_id and b.m_gudang_id = '.$val->m_gudang_id_tujuan,
							'type'	=> 'left'
						);
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
						$query_brg = $this->mod->select('a.*, b.stok_gudang_jumlah, c.jenis_barang_nama, d.satuan_nama','m_barang a',$join_brg,$where_brg);
						if ($query_brg) {
							foreach ($query_brg->result() as $val3) {
								if ($val2->keluar_barangdet_status == 0) {
									$status = '<span class="label bg-yellow-lemon bg-font-yellow-lemon"> Pending </span>';
								} else if ($val2->keluar_barangdet_status == 1) {
									$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Terkirim </span>';
								}
								$response['val2'][] = array(
									'keluar_barangdet_id'				=> $val2->keluar_barangdet_id,
									'barang_kode'						=> $val3->barang_kode,
									'jenis_barang_nama'					=> $val3->jenis_barang_nama,
									'satuan_nama'						=> $val3->satuan_nama,
									'barang_nomor'						=> $val3->barang_nomor,
									'keluar_barangdet_qty'				=> $val2->keluar_barangdet_qty,
									'keluar_barangdet_qty_realisasi'	=> $val2->keluar_barangdet_qty_realisasi,
									'stok_gudang_jumlah'				=> intval(($val3->stok_gudang_jumlah - $val3->barang_minimum_stok)),
									'm_barang_id'						=> $val2->m_barang_id,
									'keluar_barangdet_keterangan'		=> $val2->keluar_barangdet_keterangan,
									'keluar_barangdet_status_real'		=> $val2->keluar_barangdet_status,
									'keluar_barangdet_status'			=> $status,
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
				// CARI GUDANG PERMINTAAN
				$hasil2['val2'] = array();
				$where_gudang['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->m_gudang_id_permintaan
				);
				$query_gudang = $this->mod->select('*','m_gudang',NULL,$where_gudang);
				foreach ($query_gudang->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->gudang_id,
						'text' 	=> $val2->gudang_nama
					);
				}
				// END CARI GUDANG PERMINTAAN
				// CARI GUDANG TUJUAN
				$hasil3['val2'] = array();
				$where_gudang2['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->m_gudang_id_tujuan
				);
				$query_gudang2 = $this->mod->select('*','m_gudang',NULL,$where_gudang2);
				foreach ($query_gudang2->result() as $val2) {
					$hasil3['val2'][] = array(
						'id' 	=> $val2->gudang_id,
						'text' 	=> $val2->gudang_nama
					);
				}
				// END CARI GUDANG TUJUAN
				// CARI PENYERAH
				$hasil4['val2'] = array();
				$where_penyerah['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->keluar_barang_penyerah
				);
				$query_penyerah = $this->mod->select('*','m_karyawan',NULL,$where_penyerah);
				if ($query_penyerah) {
					foreach ($query_penyerah->result() as $val2) {
						$hasil4['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama
						);
					}
				}
				// END CARI PENYERAH
				// CARI PENERIMA
				$hasil5['val2'] = array();
				$where_penerima['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->keluar_barang_penerima
				);
				$query_penerima = $this->mod->select('*','m_karyawan',NULL,$where_penerima);
				if ($query_penerima) {
					foreach ($query_penerima->result() as $val2) {
						$hasil5['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama
						);
					}
				}
				// END CARI PENERIMA
				// CARI CABANG
				$hasil6['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI KOTA
						$hasil7['val2'] = array();
						$where_kota['data'][] = array(
							'column' => 'id',
							'param'	 => $val2->cabang_kota
						);
						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
						if ($query_kota) {
							foreach ($query_kota->result() as $val3) {
								$hasil7['val3'][] = array(
									'id' 		=> $val3->id,
									'text' 		=> $val3->name,
								);
							}
						}
						// END CARI KOTA
						$hasil6['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil7,
							'telp'  => json_decode($val2->cabang_telepon)
						);
					}
				}
				// END CARI CABANG
				$name = $name . $val->keluar_barang_nomor;
				$response['val'][] = array(
					'kode' 							=> $val->keluar_barang_id,
					'keluar_barang_nomor' 			=> $val->keluar_barang_nomor,
					'keluar_barang_tanggal'			=> date("d/m/Y",strtotime($val->keluar_barang_tanggal)),
					'keluar_barang_jenis' 			=> $val->keluar_barang_jenis,
					'm_departemen_id' 				=> $hasil1,
					'm_gudang_id_permintaan'		=> $hasil2,
					'm_gudang_id_tujuan'			=> $hasil3,
					'cabang'						=> $hasil6,
					'keluar_barang_status' 			=> $val->keluar_barang_status,
					// 'keluar_barang_status_date' 	=> $val->keluar_barang_status_date,
					'keluar_barang_penyerah' 		=> $hasil4,
					'keluar_barang_penerima' 		=> $hasil5,
					'keluar_barang_created_by' 		=> $val->keluar_barang_created_by
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Produksi',
			'title_page2' 	=> 'Bukti Keluar Barang',
		);
		// $this->load->view('barang-keluar/V_pdf', $response);
		
		$this->pdf->load_view('print/P_bkb', $response);
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

	// 	echo json_encode($response);
	// }

	// Function Insert & Update
	public function postDataBkb($type){
		$id = $this->input->post('kode');
		$response['test'] = $id;
		if (strlen($id)>0) {
			if ($type == 2) {
				//UPDATE
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'keluar_barang_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					// INSERT LOG 
					if (@$data['keluar_barang_status']) {
						if ($data['keluar_barang_status'] == 4){
							$data_log = array(
								'referensi_id' 							=> $id,
								'keluar_baranglog_status_dari' 			=> 2,
								'keluar_baranglog_status_ke' 			=> 4,
								'keluar_baranglog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'keluar_baranglog_status_update_by' 	=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_keluar_baranglog', NULL, $data_log);
						} else if ($data['keluar_barang_status'] == 5){
							$data_log = array(
								'referensi_id' 							=> $id,
								'keluar_baranglog_status_dari' 			=> 4,
								'keluar_baranglog_status_ke' 			=> 5,
								'keluar_baranglog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'keluar_baranglog_status_update_by' 	=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_keluar_baranglog', NULL, $data_log);
						}
					}
					// UPDATE DETAIL
					for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 
						if (@$where_det['data']) {
							unset($where_det['data']);
						}
						$where_det['data'][] = array(
							'column' => 'keluar_barangdet_id',
							'param'	 => $this->input->post('keluar_barangdet_id', TRUE)[$i]
						);
						$data_det = $this->general_post_data2(2, $update->output, $i, $this->input->post('keluar_barangdet_id', TRUE)[$i]);
						$update_det = $this->mod->update_data_table('t_keluar_barangdet', $where_det, $data_det);
						if($update_det->status) {
							$response['status'] = '200';
							if ($this->input->post('keluar_barangdet_qty_kirim', TRUE)[$i] > 0) {
								if (@$where_check['data']) {
									unset($where_check['data']);
								}
								$where_check['data'][] = array(
									'column' => 'keluar_barang_id',
									'param'	 => $id
								);
								$query_check = $this->mod->select('*', $this->tbl, NULL, $where_check);
								foreach ($query_check->result() as $row) {
									// PENGURANGAN STOK GUDANG
									if (@$where_gudang['data']) {
										unset($where_gudang['data']);
									}
									$where_gudang['data'][] = array(
										'column' => 'm_barang_id',
										'param'	 => $this->input->post('m_barang_id', TRUE)[$i]
									);
									$where_gudang['data'][] = array(
										'column' => 'm_gudang_id',
										'param'	 => $row->m_gudang_id_tujuan
									);
									$query_gudang = $this->mod->select('*', 't_stok_gudang', NULL, $where_gudang);
									foreach ($query_gudang->result() as $rowStok) {
										// PENGURANGAN KARTU STOK
										$dataKStok = array(
											'm_gudang_id' 				=> $row->m_gudang_id_tujuan,
											'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$i],
											'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),
											'kartu_stok_referensi' 		=> $row->keluar_barang_nomor,
											'kartu_stok_saldo' 			=> $rowStok->stok_gudang_jumlah,
											'kartu_stok_masuk' 			=> 0,
											'kartu_stok_keluar' 		=> $this->input->post('keluar_barangdet_qty_kirim', TRUE)[$i],
											'kartu_stok_penyesuaian'	=> 0,
											'kartu_stok_keterangan' 	=> "Permintaan BKB",
											'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
											'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),
											'kartu_stok_revised' 		=> 0,
										);
										// END PENGURANGAN KARTU STOK
										$insertKStok = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok);
										if (@$whereStok['data']) {
											unset($whereStok['data']);
										}
										$whereStok['data'][] = array(
											'column' => 'stok_gudang_id',
											'param'	 => $rowStok->stok_gudang_id
										);
										$dataStok = array(
											'stok_gudang_jumlah' 		=> $rowStok->stok_gudang_jumlah - $this->input->post('keluar_barangdet_qty_kirim', TRUE)[$i],
											'stok_gudang_update_date'	=> date('Y-m-d H:i:s'),
											'stok_gudang_update_by'		=> $this->session->userdata('user_username'),
											'stok_gudang_revised' 		=> $rowStok->stok_gudang_revised + 1,
										);
										$updateStok = $this->mod->update_data_table('t_stok_gudang', $whereStok, $dataStok);
									}
									// END PENGURANGAN STOK GUDANG

									// PENAMBAHAN STOK GUDANG
									if (@$where_gudang2['data']) {
										unset($where_gudang2['data']);
									}
									$where_gudang2['data'][] = array(
										'column' => 'm_barang_id',
										'param'	 => $this->input->post('m_barang_id', TRUE)[$i]
									);
									$where_gudang2['data'][] = array(
										'column' => 'm_gudang_id',
										'param'	 => $row->m_gudang_id_permintaan
									);
									$query_gudang2 = $this->mod->select('*', 't_stok_gudang', NULL, $where_gudang2);
									foreach ($query_gudang2->result() as $rowStok) {
										// PENAMBAHAN KARTU STOK
										$dataKStok2 = array(
											'm_gudang_id' 				=> $row->m_gudang_id_permintaan,
											'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$i],
											'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),
											'kartu_stok_referensi' 		=> $row->keluar_barang_nomor,
											'kartu_stok_saldo' 			=> $rowStok->stok_gudang_jumlah,
											'kartu_stok_masuk' 			=> $this->input->post('keluar_barangdet_qty_kirim', TRUE)[$i],
											'kartu_stok_keluar' 		=> 0,
											'kartu_stok_penyesuaian'	=> 0,
											'kartu_stok_keterangan' 	=> "Permintaan BKB",
											'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
											'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),
											'kartu_stok_revised' 		=> 0,
										);
										// END PENAMBAHAN KARTU STOK
										$insertKStok2 = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok2);
										if (@$whereStok2['data']) {
											unset($whereStok2['data']);
										}
										$whereStok2['data'][] = array(
											'column' => 'stok_gudang_id',
											'param'	 => $rowStok->stok_gudang_id
										);
										$dataStok2 = array(
											'stok_gudang_jumlah' 		=> $rowStok->stok_gudang_jumlah + $this->input->post('keluar_barangdet_qty_kirim', TRUE)[$i],
											'stok_gudang_update_date'	=> date('Y-m-d H:i:s'),
											'stok_gudang_update_by'		=> $this->session->userdata('user_username'),
											'stok_gudang_revised' 		=> $rowStok->stok_gudang_revised + 1,
										);
										$updateStok2 = $this->mod->update_data_table('t_stok_gudang', $whereStok2, $dataStok2);
									}
									// END PENAMBAHAN STOK GUDANG
								}
							}
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
					'column' => 'keluar_barang_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					// INSERT LOG 
					if (@$data['keluar_barang_status']) {
						if ($data['keluar_barang_status'] == 4){
							$data_log = array(
								'referensi_id' 							=> $id,
								'keluar_baranglog_status_dari' 			=> 2,
								'keluar_baranglog_status_ke' 			=> 4,
								'keluar_baranglog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'keluar_baranglog_status_update_by' 	=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_keluar_baranglog', NULL, $data_log);
						} else if ($data['keluar_barang_status'] == 5){
							$data_log = array(
								'referensi_id' 							=> $id,
								'keluar_baranglog_status_dari' 			=> 4,
								'keluar_baranglog_status_ke' 			=> 5,
								'keluar_baranglog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'keluar_baranglog_status_update_by' 	=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_keluar_baranglog', NULL, $data_log);
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
				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_keluar_barangdet', NULL, $data_det);
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

	public function postData(){
		$id = $this->input->post('m_barang_id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'barang_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		$response['items'] = array();
		if ($query<>false) {
			// $response = $query->result();
			foreach ($query->result() as $val) {
				// echo $val;
				$response['items'][] = array(
					'id'	=> $val->barang_id,
					'text'	=> $val->barang_nama
				);
			}
			$response['status'] = '200';
		}
		
		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('keluar_barang_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'keluar_barang_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('keluar_barang_status, keluar_barang_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['keluar_barang_revised'] + 1;
			$status = $revised['keluar_barang_status'];
		}
		if ($type == 1) {
			$keluar_barang_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 					=> $this->session->userdata('cabang_id'),
				'keluar_barang_pembuat'			=> $this->session->userdata('karyawan_id'),
				'keluar_barang_nomor' 			=> $keluar_barang_nomor,
				'keluar_barang_tanggal'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'keluar_barang_jenis' 			=> $this->input->post('keluar_barang_jenis', TRUE),
				'm_departemen_id' 				=> $this->input->post('m_departemen_id', TRUE),
				'm_gudang_id_permintaan' 		=> $this->input->post('m_gudang_id_permintaan', TRUE),
				'm_gudang_id_tujuan'			=> $this->input->post('m_gudang_id_tujuan', TRUE),
				'keluar_barang_status' 			=> 1,
				'keluar_barang_status_date'		=> date('Y-m-d H:i:s'),
				'keluar_barang_created_date'	=> date('Y-m-d H:i:s'),
				'keluar_barang_update_date'		=> date('Y-m-d H:i:s'),
				'keluar_barang_created_by'		=> $this->session->userdata('user_username'),
				'keluar_barang_revised' 		=> 0,
			);
		} else if ($type == 2) {
			if ($status == $this->input->post('keluar_barang_status', TRUE)) {
				if ($this->input->post('m_karyawan_id_penyerah', TRUE)) {
					$data = array(
						'keluar_barang_penyerah' 		=> $this->input->post('m_karyawan_id_penyerah', TRUE),
						'keluar_barang_update_date'		=> date('Y-m-d H:i:s'),
						'keluar_barang_update_by'		=> $this->session->userdata('user_username'),
						'keluar_barang_revised' 		=> $rev,
					);
				} else if ($this->input->post('m_karyawan_id_penerima', TRUE)) {
					$data = array(
						'keluar_barang_penerima' 		=> $this->input->post('m_karyawan_id_penerima', TRUE),
						'keluar_barang_update_date'		=> date('Y-m-d H:i:s'),
						'keluar_barang_update_by'		=> $this->session->userdata('user_username'),
						'keluar_barang_revised' 		=> $rev,
					);
				} else {
					$data = array(
						'keluar_barang_update_date'		=> date('Y-m-d H:i:s'),
						'keluar_barang_update_by'		=> $this->session->userdata('user_username'),
						'keluar_barang_revised' 		=> $rev,
					);	
				}
			} else {
				if ($this->input->post('m_karyawan_id_penyerah', TRUE)) {
					$data = array(
						'keluar_barang_penyerah' 		=> $this->input->post('m_karyawan_id_penyerah', TRUE),
						'keluar_barang_status' 			=> $this->input->post('keluar_barang_status', TRUE),
						'keluar_barang_update_date'		=> date('Y-m-d H:i:s'),
						'keluar_barang_update_by'		=> $this->session->userdata('user_username'),
						'keluar_barang_revised' 		=> $rev,
					);
				} else if ($this->input->post('m_karyawan_id_penerima', TRUE)) {
					$data = array(
						'keluar_barang_status' 			=> $this->input->post('keluar_barang_status', TRUE),
						'keluar_barang_penerima' 		=> $this->input->post('m_karyawan_id_penerima', TRUE),
						'keluar_barang_update_date'		=> date('Y-m-d H:i:s'),
						'keluar_barang_update_by'		=> $this->session->userdata('user_username'),
						'keluar_barang_revised' 		=> $rev,
					);
				} else {
					$data = array(
						'keluar_barang_status' 			=> $this->input->post('keluar_barang_status', TRUE),
						'keluar_barang_status_date'		=> date('Y-m-d H:i:s'),
						'keluar_barang_update_date'		=> date('Y-m-d H:i:s'),
						'keluar_barang_update_by'		=> $this->session->userdata('user_username'),
						'keluar_barang_revised' 		=> $rev,
					);	
				}
			}
		} else if ($type == 3) {
			$data = array(
				'keluar_barang_status'		=> 2,
				'keluar_barang_status_date'	=> date('Y-m-d H:i:s'),
				'keluar_barang_update_date'	=> date('Y-m-d H:i:s'),
				'keluar_barang_update_by'	=> $this->session->userdata('user_username'),
				'keluar_barang_revised'		=> $rev,
			);
		} 

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'keluar_barangdet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('keluar_barangdet_status, keluar_barangdet_revised', 't_keluar_barangdet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['keluar_barangdet_revised'] + 1;
			$status = $revised['keluar_barangdet_status'];
		}
		if ($type == 1) {
			$data = array(
				't_keluar_barang_id' 			=> $idHdr,
				'm_barang_id' 					=> $this->input->post('m_barang_id', TRUE)[$seq],
				'keluar_barangdet_qty' 			=> $this->input->post('keluar_barangdet_qty', TRUE)[$seq],
				'keluar_barangdet_keterangan'	=> $this->input->post('keluar_barangdet_keterangan', TRUE)[$seq],
				'keluar_barangdet_status'		=> 0,
				'keluar_barangdet_status_date'	=> date('Y-m-d H:i:s'),
				'keluar_barangdet_create_date'	=> date('Y-m-d H:i:s'),
				'keluar_barangdet_create_by'	=> $this->session->userdata('user_username'),
				'keluar_barangdet_update_date'	=> date('Y-m-d H:i:s'),
				'keluar_barangdet_revised' 		=> 0,
			);
		} else if ($type == 2) {
			if ($status == $this->input->post('keluar_barangdet_status', TRUE)[$seq]) {
				$data = array(
					'keluar_barangdet_qty_realisasi'	=> ($this->input->post('keluar_barangdet_qty_realisasi', TRUE)[$seq] + $this->input->post('keluar_barangdet_qty_kirim', TRUE)[$seq]),
					'keluar_barangdet_update_date'		=> date('Y-m-d H:i:s'),
					'keluar_barangdet_update_by'		=> $this->session->userdata('user_username'),
					'keluar_barangdet_revised' 			=> $rev,
				);	
			} else {
				$data = array(
					'keluar_barangdet_qty_realisasi'	=> ($this->input->post('keluar_barangdet_qty_realisasi', TRUE)[$seq] + $this->input->post('keluar_barangdet_qty_kirim', TRUE)[$seq]),
					'keluar_barangdet_status' 			=> $this->input->post('keluar_barangdet_status', TRUE)[$seq],
					'keluar_barangdet_status_date'		=> date('Y-m-d H:i:s'),
					'keluar_barangdet_update_date'		=> date('Y-m-d H:i:s'),
					'keluar_barangdet_update_by'		=> $this->session->userdata('user_username'),
					'keluar_barangdet_revised' 			=> $rev,
				);	
			}
		}

		return $data;
	}


	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(keluar_barang_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(keluar_barang_nomor,1,9)',
			'param'	 => 'BKB'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'keluar_barang_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('BKB',$query);
		return $kode_baru;
	}
	/* end Function */

}
