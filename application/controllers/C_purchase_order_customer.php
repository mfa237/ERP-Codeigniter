<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_purchase_order_customer extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_po_customer';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view($type){
		$this->check_session();

		if ($type == 1) {
			$priv = $this->cekUser(61);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Marketing',
				'title_page2' 	=> 'Purchase Order Customer',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('purchase-order-customer/V_purchase_order_customer', $data);
			}
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			$priv = $this->cekUser(63);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Persetujuan',
				'title_page2' 	=> 'Purchase Order Customer',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('purchase-order-customer/V_purchase_order_customer2', $data);
			}
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 3) {
			$priv = $this->cekUser(79);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Penjualan',
				'title_page2' 	=> 'Purchase Order Customer',
				// 'priv_add'		=> $priv['create']
				);
			// if($priv['read'] == 1)
			// {
				$this->open_page('purchase-order-customer/V_purchase_order_customer3', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		}
	}

	public function loadData($type){
		$priv = $this->cekUser(61);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		if($type == 2)
		{
			$where['data'][] = array(
				'column' => 'po_customer_status >=',
				'param'  => 6
			);
		}
		else if($type == 3)
		{
			$where['data'][] = array(
				'column' => 'po_customer_status >=',
				'param'  => 4
			);
		}
		else
		{
			$where['data'][] = array(
				'column' => 'po_customer_status >=',
				'param'  => 1
			);
		}
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, po_customer_nomor, po_customer_tanggal, po_customer_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_po_customer');
		$query_filter = $this->mod->select($select, 'v_po_customer', NULL, $where, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_po_customer', NULL, $where, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				// $button = '';
				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Marketing/Purchase-Order-Customer/Form/'.$val->po_customer_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PO Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Marketing/Purchase-Order-Customer/print-PO-Customer/'.$val->po_customer_id.'">
					<button class="btn green-jungle" type="button" title="Print PO Customer">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Persetujuan/Purchase-Order-Customer/Form/'.$val->po_customer_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PO Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Persetujuan/Purchase-Order-Customer/print-PO-Customer/'.$val->po_customer_id.'">
					<button class="btn green-jungle" type="button" title="Print PO Customer">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 3) {
					$button = '
					<a href="'.base_url().'Penjualan/Purchase-Order-Customer/Form/'.$val->po_customer_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PO Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Penjualan/Purchase-Order-Customer/print-PO-Customer/'.$val->po_customer_id.'">
					<button class="btn green-jungle" type="button" title="Print PO Customer">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->po_customer_nomor,
					date("d/m/Y",strtotime($val->po_customer_tanggal)),
					$val->po_customer_status_nama,
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
		$this->check_session();
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Marketing',
			'title_page2' 	=> 'Purchase Order Customer',
			'id'			=> $id
		);
		$this->open_page('purchase-order-customer/V_form_purchase_order_customer', $data);
	}

	public function getForm2($id = null){
		$this->check_session();
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Persetujuan',
			'title_page2' 	=> 'Purchase Order Customer',
			'id'			=> $id
		);
		$this->open_page('purchase-order-customer/V_form_purchase_order_customer2', $data);
	}

	public function getForm3($id = null){
		$this->check_session();
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Penjualan',
			'title_page2' 	=> 'Purchase Order Customer',
			'id'			=> $id
		);
		$this->open_page('purchase-order-customer/V_form_purchase_order_customer3', $data);
	}

	public function loadDataWhere($type){
		$select = '*';
		$where['data'][] = array(
			'column' => 'po_customer_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				// BARANG
				$join_brg['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type'	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_satuan d',
					'join'	=> 'd.satuan_id = b.m_satuan_id',
					'type'	=> 'left'
				);
				$where_brg['data'][] = array(
					'column' => 'a.t_po_customer_id',
					'param'	 => $val->po_customer_id
				);
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_po_customerdet a', $join_brg, $where_brg);
				$response['val2'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val2) {

						if (@$join_stok['data']) {
							unset($join_stok['data']);
						}
						if (@$where_stok['data']) {
							unset($where_stok['data']);
						}
						// STOK
						$join_stok['data'][] = array(
							'table' => 'm_gudang b',
							'join'	=> 'b.gudang_id = a.m_gudang_id',
							'type'	=> 'left'
						);
						$where_stok['data'][] = array(
							'column' => 'a.m_barang_id',
							'param'	 => $val2->m_barang_id
						);
						$where_stok['data'][] = array(
							'column' => 'b.m_jenis_gudang_id',
							'param'	 => 1
						);
						$where_stok['data'][] = array(
							'column' => 'b.gudang_status_aktif',
							'param'	 => 'y'
						);
						$query_stok = $this->mod->select('a.*, b.*', 't_stok_gudang a', $join_stok, $where_stok);
						$stok_gudang = 0;
						if ($query_stok) {
							foreach ($query_stok->result() as $val3) {
								$stok_gudang = $val3->stok_gudang_jumlah;
							}
						}
						$satuan_konversi = '';
						$konversi = "0.00";
						$konversi = (float) $konversi;
						if (@$where_konversi['data']) {
							unset($where_konversi['data']);
						}
						if (@$join_satuan['data']) {
							unset($join_satuan['data']);
						}
						$join_satuan['data'][] = array(
							'table' => 'm_satuan b',
							'join'	=> 'b.satuan_id = a.konversi_akhirsatuan',
							'type'	=> 'left'
						);
						$where_konversi['data'][] = array(
							'column' => 'barang_id',
							'param'	 => $val2->m_barang_id
						);
						$queryKonversi = $this->mod->select('a.*, b.*', 'm_konversi a', $join_satuan, $where_konversi);
						if($queryKonversi)
						{
							foreach ($queryKonversi->result() as $val3) {
								$konversi = $val3->konversi_akhir;
								$satuan_konversi = $val3->satuan_nama;
							}
						}

						$response['val2'][] = array(
							'po_customerdet_id'					=> $val2->po_customerdet_id,
							't_po_customer_id'					=> $val2->t_po_customer_id,
							'm_barang_id'						=> $val2->m_barang_id,
							'po_customerdet_qty'				=> $val2->po_customerdet_qty,
							'po_customerdet_barang_uraian'		=> $val2->po_customerdet_barang_uraian,
							// 'stok_gudang_qty'					=> $stok_gudang,
							'po_customerdet_harga_satuan'		=> $val2->po_customerdet_harga_satuan,
							'po_customerdet_status'				=> $val2->po_customerdet_status,
							'po_customerdet_keterangan'			=> $val2->po_customerdet_keterangan,
							'barang_kode'						=> $val2->barang_kode,
							'barang_nama'						=> $val2->barang_nama,
							'barang_uraian'						=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'satuan_nama'						=> $val2->satuan_nama,
							'satuan_konversi'					=> $satuan_konversi,
							'konversi'							=> $konversi
						);
					}
				}

				// CARI PARTNER
				$hasil['val2'] = array();
				$where_partner['data'][] = array(
					'column' => 'partner_id',
					'param'	 => $val->m_partner_id
				);
				$query_partner = $this->mod->select('*','m_partner',NULL,$where_partner);
				foreach ($query_partner->result() as $val2) {
					$hasil['val2'][] = array(
						'id' 	=> $val2->partner_id,
						'text' 	=> $val2->partner_nama
					);
				}
				// END CARI PARTNER

				// CARI KARYAWAN
				$hasil2['val2'] = array();
				$where_karyawan['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->m_karyawan_id
				);
				$query_karyawan = $this->mod->select('*','m_karyawan',NULL,$where_karyawan);
				foreach ($query_karyawan->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->karyawan_id,
						'text' 	=> $val2->karyawan_nama
					);
				}
				// END CARI KARYAWAN

				$response['val'][] = array(
					'kode' 							=> $val->po_customer_id,
					'm_cabang_id'					=> $val->m_cabang_id,
					'po_customer_nomor' 			=> $val->po_customer_nomor,
					'po_customer_tanggal'			=> date("d/m/Y",strtotime($val->po_customer_tanggal)),
					'm_partner_id' 					=> $hasil,
					'po_customer_kontak_person' 	=> $val->po_customer_kontak_person,
					'po_customer_nama_pelanggan'	=> $val->po_customer_nama_pelanggan,
					'po_customer_alamat_kirim'		=> $val->po_customer_alamat_kirim,
					'm_karyawan_id' 				=> $hasil2,
					'po_customer_perjanjian_bayar'	=> $val->po_customer_perjanjian_bayar,
					'po_customer_jasaangkut_jenis'	=> $val->po_customer_jasaangkut_jenis,
					'po_customer_ekspedisi'			=> $val->po_customer_ekspedisi,
					'po_customer_jasaangkut_bayar'	=> $val->po_customer_jasaangkut_bayar,
					'po_customer_file'				=> $val->po_customer_file,
					'po_customer_catatan'			=> $val->po_customer_catatan,
					'po_customer_step'				=> $val->po_customer_step,
					'po_customer_status'			=> $val->po_customer_status,
					'po_customer_sejarah'			=> $val->po_customer_sejarah,
					'po_customer_ppn'				=> $val->po_customer_ppn,
					'po_customer_nama_kontak'		=> $val->po_customer_nama_kontak,
					'po_customer_tanggal_persetujuan'	=> date("d/m/Y H:i", strtotime($val->po_customer_tanggal_persetujuan))
				);
			}

			echo json_encode($response);
		}
	}

	public function loadData_select($type){
		if ($type == 1) {
			$param = $this->input->get('q');
			if ($param!=NULL) {
				$param = $this->input->get('q');
			} else {
				$param = "";
			}
			$select = '*';
			$where['data'][] = array(
				'column' => 'po_customer_status',
				'param'	 => 10
			);
			$where_like['data'][] = array(
				'column' => 'po_customer_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'po_customer_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->po_customer_id,
						'text'	=> $val->po_customer_nomor
					);
				}
				$response['status'] = '200';
			}
		// } else if ($type == 2) {
		// 	$select = '*';
		// 	$join['data'][] = array(
		// 		'table' => 't_penawaran_supplier b',
		// 		'join'	=> 'b.t_penawaran_id = a.penawaran_id',
		// 		'type'	=> 'inner'
		// 	);
		// 	$where['data'][] = array(
		// 		'column' => 'a.penawaran_status',
		// 		'param'	 => 4
		// 	);
		// 	$where['data'][] = array(
		// 		'column' => 'a.penawaran_jenis',
		// 		'param'	 => 1
		// 	);
		// 	$where['data'][] = array(
		// 		'column' => 'b.m_partner_id',
		// 		'param'	 => $this->input->get('id')
		// 	);
		// 	$where['data'][] = array(
		// 		'column' => 'b.penawaran_supplier_pemenang',
		// 		'param'	 => 1
		// 	);
		// 	$order['data'][] = array(
		// 		'column' => 'penawaran_nomor',
		// 		'type'	 => 'ASC'
		// 	);
		// 	$query = $this->mod->select('a.*, b.*', 't_penawaran a', $join, $where, NULL, NULL, $order);
		// 	$response['items'] = array();
		// 	if ($query<>false) {
		// 		foreach ($query->result() as $val) {
		// 			$response['items'][] = array(
		// 				'id'	=> $val->penawaran_id,
		// 				'text'	=> $val->penawaran_nomor
		// 			);
		// 		}
		// 		$response['status'] = '200';
		// 	}
		// } else if ($type == 3) {
		// 	$select = '*';
		// 	$join['data'][] = array(
		// 		'table' => 't_penawaran_supplier b',
		// 		'join'	=> 'b.t_penawaran_id = a.penawaran_id',
		// 		'type'	=> 'inner'
		// 	);
		// 	$where['data'][] = array(
		// 		'column' => 'a.penawaran_status',
		// 		'param'	 => 4
		// 	);
		// 	$where['data'][] = array(
		// 		'column' => 'a.penawaran_jenis',
		// 		'param'	 => 2
		// 	);
		// 	$where['data'][] = array(
		// 		'column' => 'b.m_partner_id',
		// 		'param'	 => $this->input->get('id')
		// 	);
		// 	$where['data'][] = array(
		// 		'column' => 'b.penawaran_supplier_pemenang',
		// 		'param'	 => 1
		// 	);
		// 	$order['data'][] = array(
		// 		'column' => 'penawaran_nomor',
		// 		'type'	 => 'ASC'
		// 	);
		// 	$query = $this->mod->select('a.*, b.*', 't_penawaran a', $join, $where, NULL, NULL, $order);
		// 	$response['items'] = array();
		// 	if ($query<>false) {
		// 		foreach ($query->result() as $val) {
		// 			$response['items'][] = array(
		// 				'id'	=> $val->penawaran_id,
		// 				'text'	=> $val->penawaran_nomor
		// 			);
		// 		}
		// 		$response['status'] = '200';
		// 	}
		}

		echo json_encode($response);
	}

	public function cetakPDF($id){
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'po_customer_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				// BARANG
				$join_brg['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type'	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_satuan d',
					'join'	=> 'd.satuan_id = b.m_satuan_id',
					'type'	=> 'left'
				);
				$where_brg['data'][] = array(
					'column' => 'a.t_po_customer_id',
					'param'	 => $val->po_customer_id
				);
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_po_customerdet a', $join_brg, $where_brg);
				$response['val2'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val2) {

						if (@$join_stok['data']) {
							unset($join_stok['data']);
						}
						if (@$where_stok['data']) {
							unset($where_stok['data']);
						}
						// STOK
						$join_stok['data'][] = array(
							'table' => 'm_gudang b',
							'join'	=> 'b.gudang_id = a.m_gudang_id',
							'type'	=> 'left'
						);
						$where_stok['data'][] = array(
							'column' => 'a.m_barang_id',
							'param'	 => $val2->m_barang_id
						);
						$where_stok['data'][] = array(
							'column' => 'b.m_jenis_gudang_id',
							'param'	 => 1
						);
						$where_stok['data'][] = array(
							'column' => 'b.gudang_status_aktif',
							'param'	 => 'y'
						);
						$query_stok = $this->mod->select('a.*, b.*', 't_stok_gudang a', $join_stok, $where_stok);
						$stok_gudang = 0;
						if ($query_stok) {
							foreach ($query_stok->result() as $val3) {
								$stok_gudang = $val3->stok_gudang_jumlah;
							}
						}

						$response['val2'][] = array(
							'po_customerdet_id'					=> $val2->po_customerdet_id,
							't_po_customer_id'					=> $val2->t_po_customer_id,
							'm_barang_id'						=> $val2->m_barang_id,
							'po_customerdet_qty'				=> $val2->po_customerdet_qty,
							'po_customerdet_barang_uraian'		=> $val2->po_customerdet_barang_uraian,
							'stok_gudang_qty'					=> $stok_gudang,
							'po_customerdet_harga_satuan'		=> $val2->po_customerdet_harga_satuan,
							'po_customerdet_barang_uraian'		=> $val2->po_customerdet_barang_uraian,
							'po_customerdet_keterangan'			=> $val2->po_customerdet_keterangan,
							'barang_kode'						=> $val2->barang_kode,
							'barang_nama'						=> $val2->barang_nama,
							'barang_uraian'						=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'satuan_nama'						=> $val2->satuan_nama,
						);
					}
				}

				// CARI PARTNER
				$hasil['val2'] = array();
				$where_partner['data'][] = array(
					'column' => 'partner_id',
					'param'	 => $val->m_partner_id
				);
				$query_partner = $this->mod->select('*','m_partner',NULL,$where_partner);
				foreach ($query_partner->result() as $val2) {
					// CARI KOTA
					$hasil7['val2'] = array();
					if(@$where_kota['data'])
					{
						unset($where_kota['data']);
					}
					$where_kota['data'][] = array(
						'column' => 'id',
						'param'	 => $val2->partner_kota
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
					$hasil['val2'][] = array(
						'id' 			=> $val2->partner_id,
						'text' 			=> $val2->partner_nama,
						'alamat' 		=> $val2->partner_alamat,
						'telp' 			=> json_decode($val2->partner_telepon),
						'kota'			=> $hasil7,
					);
				}
				// END CARI PARTNER

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
						if(@$where_kota['data'])
						{
							unset($where_kota['data']);
						}
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
				// CARI Sales
				$hasil2['val2'] = array();
				$where_sales['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->m_karyawan_id
				);
				$query_sales = $this->mod->select('*','m_karyawan',NULL,$where_sales);
				if ($query_sales) {
					foreach ($query_sales->result() as $val2) {
						$hasil2['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama,
						);
					}
				}
				// END CARI Sales
				$name = $val->po_customer_nomor;
				$queryheader = $this->mod->select('*', 'm_header');
				$header = '';
				if($queryheader)
				{
					foreach ($queryheader->result() as $val3) {
						$header = $val3->header_text;
					}
				}
				$response['val'][] = array(
					'kode' 							=> $val->po_customer_id,
					'cabang'						=> $hasil6,
					'po_customer_nomor' 			=> $val->po_customer_nomor,
					'po_customer_tanggal'			=> date("d/m/Y",strtotime($val->po_customer_tanggal)),
					'm_partner_id' 					=> $hasil,
					'po_customer_kontak_person' 	=> $val->po_customer_kontak_person,
					'po_customer_nama_pelanggan'	=> $val->po_customer_nama_pelanggan,
					'po_customer_perjanjian_bayar'	=> $val->po_customer_perjanjian_bayar,
					'po_customer_jasaangkut_jenis'	=> $val->po_customer_jasaangkut_jenis,
					'po_customer_ekspedisi'			=> $val->po_customer_ekspedisi,
					'po_customer_jasaangkut_bayar'	=> $val->po_customer_jasaangkut_bayar,
					'po_customer_catatan'			=> $val->po_customer_catatan,
					'po_customer_step'				=> $val->po_customer_step,
					'po_customer_status'			=> $val->po_customer_status,
					'po_customer_created_by'		=> $val->po_customer_created_by,
					'po_customer_ppn'				=> $val->po_customer_ppn,
					'po_customer_sejarah'			=> $val->po_customer_sejarah,
					'sales'							=> $hasil2,
					'header'						=> $header,
				);
			}
		}
		$response['title'][] = array(
		'aplikasi'		=> $this->app_name,
		'title_page' 	=> 'Purchase Order Customer',
		'title_page2' 	=> 'Print Purchase Order',
		);
		// echo json_encode($response);
		// $this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_po_customer', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$config['upload_path']          = './uploads/file_po_customer/';
        $config['allowed_types']        = 'gif|jpg|png|pdf|doc';
        $config['max_size']             = 30000;

		$this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('po_customer_file'))
        {
                $error = array('error' => $this->upload->display_errors());
                $response['check'] = $error;
        }
        else
        {
                $success = array('upload_data' => $this->upload->data());
                $response['check'] = $success;
        }
		$response['id'] 	= $id;
		$response['test'] 	= $type;
		$response['step'] 	= $this->input->post('step', TRUE);
		if (strlen($id)>0) {
			if ($type == 2) {
				if (@$this->input->post('step', TRUE) == 4) {
					//UPDATE
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'po_customer_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					for($i = 0; $i < sizeof($this->input->post('po_customerdet_status3', TRUE)); $i++)
					{
						$data_det = $this->general_post_data2(2, null, $i, $this->input->post('po_customerdet_id', TRUE)[$i]);
						if(@$where_det['data'])
						{
							unset($where_det['data']);
						}
						$where_det['data'][] = array(
							'column' => 'po_customerdet_id',
							'param'  => $this->input->post('po_customerdet_id', TRUE)[$i]
						);
						$response['data_det'][] = $data_det;
						$update_det = $this->mod->update_data_table('t_po_customerdet', $where_det, $data_det);
						if($update_det->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
				} else if (@$this->input->post('step', TRUE) == 3) {
					//UPDATE
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'po_customer_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
				}
				// $response['data'] 	= $data;
				$response['id'] 	= $id;
				$response['status'] = '200';
			} else if($type == 3) {
				if($this->input->post('po_customer_status', TRUE) == 6)
				{
					$data = $this->general_post_data(5, $id);
					$where['data'][] = array(
						'column' => 'po_customer_id',
						'param'	 => $id
					);
					$response['data'] = $data;
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
				}
				else
				{
					$data = $this->general_post_data(2, $id);
					$where['data'][] = array(
						'column' => 'po_customer_id',
						'param'	 => $id
					);
					$response['data'] = $data;
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
				}
				for($i = 0; $i < sizeof($this->input->post('po_customerdet_status', TRUE)); $i++)
				{
					$data_det = $this->general_post_data2(2, null, $i, $this->input->post('po_customerdet_id', TRUE)[$i]);
					if(@$where_det['data'])
					{
						unset($where_det['data']);
					}
					$where_det['data'][] = array(
						'column' => 'po_customerdet_id',
						'param'  => $this->input->post('po_customerdet_id', TRUE)[$i]
					);
					$response['data_det'][] = $data_det;
					$update_det = $this->mod->update_data_table('t_po_customerdet', $where_det, $data_det);
					if($update_det->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
			} else {
				if($this->input->post('po_customer_status', TRUE) <= 5)
				{
					if (@$this->input->post('step', TRUE) == 2) {
						//UPDATE
						$data = $this->general_post_data(4, $id);
						$where['data'][] = array(
							'column' => 'po_customer_id',
							'param'	 => $id
						);
						$update = $this->mod->update_data_table($this->tbl, $where, $data);
					} else if (@$this->input->post('step', TRUE) == 3) {
						//UPDATE
						$data = $this->general_post_data(3, $id);
						$where['data'][] = array(
							'column' => 'po_customer_id',
							'param'	 => $id
						);
						$update = $this->mod->update_data_table($this->tbl, $where, $data);
					} else {
						$data = $this->general_post_data(4, $id);
						$where['data'][] = array(
							'column' => 'po_customer_id',
							'param'	 => $id
						);
						$update = $this->mod->update_data_table($this->tbl, $where, $data);
						// print_r($data);
						for($i = 0; $i < sizeof($this->input->post('po_customerdet_id', TRUE)); $i++)
						{
							$data_det = $this->general_post_data2(3, null, $i, $this->input->post('po_customerdet_id', TRUE)[$i]);
							if(@$where_det['data'])
							{
								unset($where_det['data']);
							}
							$where_det['data'][] = array(
								'column' => 'po_customerdet_id',
								'param'  => $this->input->post('po_customerdet_id', TRUE)[$i]
							);
							$response['data_det'][] = $data_det;
							$update_det = $this->mod->update_data_table('t_po_customerdet', $where_det, $data_det);
							if($update_det->status) {
								$response['status'] = '200';
							} else {
								$response['status'] = '204';
							}
						}

					}
				}
				// $response['data'] 	= $data;
				$response['id'] 	= $id;
				$response['status'] = '200';
			}
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';

				// INSERT DETAIL BARANG
				for ($i = 0; $i < sizeof($this->input->post('po_customerdet_barang_uraian', TRUE)); $i++) {
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_po_customerdet', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
				// END INSERT DETAIL BARANG

			} else {
				$response['status'] = '204';
			}
			$response['nomor'] = $data['po_customer_nomor'];
			$response['id'] = $insert->output;
		}
		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('po_customer_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'po_customer_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('po_customer_status, po_customer_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['po_customer_revised'] + 1;
			$status = $revised['po_customer_status'];
		}
		if ($type == 1) {
			$po_customer_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 					=> $this->session->userdata('cabang_id'),
				'po_customer_nomor' 			=> $po_customer_nomor,
				'po_customer_tanggal'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'm_partner_id'					=> $this->input->post('m_partner_id', TRUE),
				'po_customer_kontak_person'		=> $this->input->post('po_customer_kontak_person', TRUE),
				'po_customer_nama_pelanggan'	=> $this->input->post('po_customer_nama_pelanggan', TRUE),
				'po_customer_alamat_kirim'		=> $this->input->post('po_customer_alamat_kirim', TRUE),
				'm_karyawan_id'					=> $this->input->post('m_karyawan_id', TRUE),
				'po_customer_perjanjian_bayar'	=> $this->input->post('po_customer_perjanjian_bayar', TRUE),
				'po_customer_jasaangkut_jenis'	=> $this->input->post('po_customer_jasaangkut_jenis', TRUE),
				'po_customer_ekspedisi'			=> $this->input->post('po_customer_ekspedisi', TRUE),
				'po_customer_jasaangkut_bayar'	=> $this->input->post('po_customer_jasaangkut_bayar', TRUE),
				'po_customer_file'				=> $this->upload->file_name,
				'po_customer_catatan'			=> $this->input->post('po_customer_catatan', TRUE),
				'po_customer_sejarah'			=> $this->input->post('po_customer_sejarah', TRUE),
				'po_customer_ppn'				=> $this->input->post('po_customer_ppn', TRUE),
				'po_customer_step' 				=> $this->input->post('step', TRUE),
				'po_customer_status' 			=> $this->input->post('po_customer_status', TRUE),
				'po_customer_created_date'		=> date('Y-m-d H:i:s'),
				'po_customer_updated_date'		=> date('Y-m-d H:i:s'),
				'po_customer_created_by'		=> $this->session->userdata('user_username'),
				'po_customer_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'po_customer_status' 		=> $this->input->post('po_customer_status', TRUE),
				'po_customer_step' 			=> $this->input->post('step', TRUE),
				'po_customer_updated_date'	=> date('Y-m-d H:i:s'),
				'po_customer_updated_by'	=> $this->session->userdata('user_username'),
				'po_customer_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'po_customer_status' 		=> $this->input->post('po_customer_status', TRUE),
				'po_customer_step' 			=> $this->input->post('step', TRUE),
				'po_customer_updated_date'	=> date('Y-m-d H:i:s'),
				'po_customer_updated_by'	=> $this->session->userdata('user_username'),
				'po_customer_revised' 		=> $rev,
			);
		} else if ($type == 4) {
			if(($namafile = $this->upload->file_name) != "")
			{
				$namafile = $this->upload->file_name;
			}
			else
			{
				$namafile = $this->input->post('po_customer_file_lama', TRUE);
			}
			$data = array(
				'm_partner_id'					=> $this->input->post('m_partner_id', TRUE),
				'po_customer_kontak_person'		=> $this->input->post('po_customer_kontak_person', TRUE),
				'po_customer_nama_pelanggan'	=> $this->input->post('po_customer_nama_pelanggan', TRUE),
				'po_customer_alamat_kirim'		=> $this->input->post('po_customer_alamat_kirim', TRUE),
				'm_karyawan_id'					=> $this->input->post('m_karyawan_id', TRUE),
				'po_customer_perjanjian_bayar'	=> $this->input->post('po_customer_perjanjian_bayar', TRUE),
				'po_customer_jasaangkut_jenis'	=> $this->input->post('po_customer_jasaangkut_jenis', TRUE),
				'po_customer_ekspedisi'			=> $this->input->post('po_customer_ekspedisi', TRUE),
				'po_customer_jasaangkut_bayar'	=> $this->input->post('po_customer_jasaangkut_bayar', TRUE),
				'po_customer_catatan'			=> $this->input->post('po_customer_catatan', TRUE),
				'po_customer_sejarah'			=> $this->input->post('po_customer_sejarah', TRUE),
				'po_customer_ppn'				=> $this->input->post('po_customer_ppn', TRUE),
				'po_customer_status' 		=> $this->input->post('po_customer_status', TRUE),
				'po_customer_file'			=> $namafile,
				'po_customer_updated_date'	=> date('Y-m-d H:i:s'),
				'po_customer_updated_by'	=> $this->session->userdata('user_username'),
				'po_customer_revised' 		=> $rev,
			);
		} else if ($type == 5) {
			if($this->input->post('po_customer_nama_kontak', TRUE) !== '')
			{
				$datetime = explode(' ', $this->input->post('po_customer_tanggal_persetujuan',TRUE));
				$arrDate = explode('/', $datetime[0]);
				$data = array(
					'po_customer_status' 				=> $this->input->post('po_customer_status',TRUE),
					'po_customer_nama_kontak' 			=> $this->input->post('po_customer_nama_kontak',TRUE),
					'po_customer_tanggal_persetujuan' 	=> date('Y-m-d H:i:s', strtotime($arrDate[2]."-".$arrDate[1]."-".$arrDate[0].$datetime[1])),
					'po_customer_updated_date'			=> date('Y-m-d H:i:s'),
					'po_customer_updated_by'			=> $this->session->userdata('user_username'),
					'po_customer_revised' 				=> $rev,
				);
			}
			else
			{
				$data = array(
					'po_customer_status' 				=> $this->input->post('po_customer_status',TRUE),
					'po_customer_updated_date'			=> date('Y-m-d H:i:s'),
					'po_customer_updated_by'			=> $this->session->userdata('user_username'),
					'po_customer_revised' 				=> $rev,
				);
			}
		}

		return $data;
	}

	// DATA BARANG
	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'po_customerdet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('po_customerdet_revised', 't_po_customerdet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['po_customerdet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_po_customer_id' 				=> $idHdr,
				// 'm_barang_id' 					=> $this->input->post('m_barang_id', TRUE)[$seq],
				'po_customerdet_barang_uraian' 	=> $this->input->post('po_customerdet_barang_uraian', TRUE)[$seq],
				'po_customerdet_qty' 			=> $this->replaceFormatNumber($this->input->post('po_customerdet_qty', TRUE)[$seq]),
				'po_customerdet_harga_satuan'	=> $this->replaceFormatNumber($this->input->post('po_customerdet_harga_satuan', TRUE)[$seq]),
				'po_customerdet_keterangan'		=> $this->input->post('po_customerdet_keterangan', TRUE)[$seq],
				'po_customerdet_created_date'	=> date('Y-m-d H:i:s'),
				'po_customerdet_created_by'		=> $this->session->userdata('user_username'),
				'po_customerdet_updated_date'	=> date('Y-m-d H:i:s'),
				'po_customerdet_revised' 		=> 0,
			);
		} else if($type == 2) {
			$data = array(
				'po_customerdet_keterangan'		=> $this->input->post('po_customerdet_keterangan', TRUE)[$seq],
				'po_customerdet_status'			=> $this->input->post('po_customerdet_status', TRUE)[$seq],
				'po_customerdet_updated_date'	=> date('Y-m-d H:i:s'),
				'po_customerdet_updated_by'		=> $this->session->userdata('user_username'),
				'po_customerdet_revised' 		=> $rev,
			);
		} else if($type == 3) {
			if($this->input->post('po_customerdet_status', TRUE)[$seq] == 4)
			{
				$status = 4; // untuk barang yang sudah disetujui
			}
			else
			{
				$status = 1; // untuk barang yang di cancel dan revisi (butuh persetujuan lebih lanjut)
			}
			$data = array(
				'po_customerdet_barang_uraian' 	=> $this->input->post('po_customerdet_barang_uraian', TRUE)[$seq],
				'po_customerdet_qty' 			=> $this->replaceFormatNumber($this->input->post('po_customerdet_qty', TRUE)[$seq]),
				'po_customerdet_harga_satuan'	=> $this->replaceFormatNumber($this->input->post('po_customerdet_harga_satuan', TRUE)[$seq]),
				'po_customerdet_keterangan'		=> $this->input->post('po_customerdet_keterangan', TRUE)[$seq],
				'po_customerdet_status'			=> $status,
				'po_customerdet_updated_date'	=> date('Y-m-d H:i:s'),
				'po_customerdet_updated_by'		=> $this->session->userdata('user_username'),
				'po_customerdet_revised' 		=> $rev,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(po_customer_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(po_customer_nomor,1,9)',
			'param'	 => 'POC'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'po_customer_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('POC',$query);
		return $kode_baru;
	}
	/* end Function */

}
