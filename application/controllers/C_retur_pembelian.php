<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_retur_pembelian extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_retur_pembelian';

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
				'title_page' 	=> 'Gudang',
				'title_page2' 	=> 'Retur Pembelian',
				);
			$this->open_page('retur-pembelian/V_retur_pembelian', $data);
			// if($priv['read'] == 1)
			// {
			// 	$this->open_page('retur-pembelian/V_retur_pembelian', $data);
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
				'title_page2' 	=> 'Retur Pembelian',
				);
			$this->open_page('retur-pembelian/V_retur_pembelian2', $data);
			// if($priv['read'] == 1)
			// {
			// 	$this->open_page('retur-pembelian/V_retur_pembelian2', $data);
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
			'column' => 'cabang_nama, retur_pembelian_nomor, penerimaan_barang_nomor, retur_pembelian_tanggal, retur_pembelian_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_retur_pembelian');
		$query_filter = $this->mod->select($select, 'v_retur_pembelian', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_retur_pembelian', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$status = '';
				$button2 = '';
				if ($val->retur_pembelian_status >= 4) {
					$status = 'disabled';
				}

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Gudang/Retur-Pembelian/Form/'.$val->retur_pembelian_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Retur Pembelian">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Gudang/Retur-Pembelian/print-Nota-Retur/'.$val->retur_pembelian_id.'">
						<button class="btn green-jungle" type="button" title="PDF">
							<i class="icon-printer text-center"></i>
						</button>
						</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Pembelian/Retur-Pembelian/Form/'.$val->retur_pembelian_id.'">
					<button class="btn blue-ebonyclay" type="button" onclick="checkStatusRetur('.$val->retur_pembelian_id.')" title="Lihat Retur Pembelian">
						<i class="icon-eye text-center"></i>
					</button></a>
					<a href="'.base_url().'Pembelian/Retur-Pembelian/print-Nota-Retur/'.$val->retur_pembelian_id.'">
						<button class="btn green-jungle" type="button" title="PDF">
							<i class="icon-printer text-center"></i>
						</button>
						</a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->retur_pembelian_nomor,
					$val->penerimaan_barang_nomor,
					date("d/m/Y",strtotime($val->retur_pembelian_tanggal)),
					$val->retur_pembelian_status_nama,
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
			'title_page' 	=> 'Gudang',
			'title_page2' 	=> 'Retur Pembelian',
			'id'			=> $id
		);
		$this->open_page('retur-pembelian/V_form_retur_pembelian', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Pembelian',
			'title_page2' 	=> 'Retur Pembelian',
			'id'			=> $id
		);
		$this->open_page('retur-pembelian/V_form_retur_pembelian2', $data);
	}

	public function loadDataWhere($type){
		$select = '*';
		$where['data'][] = array(
			'column' => 'retur_pembelian_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, 'v_retur_pembelian', NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				if (@$join_det['data']) {
					unset($join_det['data']);
				}
				if (@$where_det['data']) {
					unset($where_det['data']);
				}
				$join_det['data'][] = array(
					'table' => 't_retur_pembelian b',
					'join'	=> 'b.retur_pembelian_id = a.t_retur_pembelian_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table' => 't_penerimaan_barang c',
					'join'	=> 'c.penerimaan_barang_id = b.t_penerimaan_barang_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table' => 't_penerimaan_barangdet d',
					'join'	=> 'd.t_penerimaan_barang_id = c.penerimaan_barang_id and d.m_barang_id = a.m_barang_id',
					'type'	=> 'inner'
				);
				$where_det['data'][] = array(
					'column' => 'a.t_retur_pembelian_id',
					'param'	 => $val->retur_pembelian_id
				);
				$query_det = $this->mod->select('*','t_retur_pembeliandet a', $join_det, $where_det);
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
									'retur_pembeliandet_id'				=> $val2->retur_pembeliandet_id,
									'barang_kode'						=> $val3->barang_kode,
									'barang_nama'						=> $val3->barang_nama,
									'barang_nomor'						=> $val3->barang_nomor,
									'jenis_barang_nama'					=> $val3->jenis_barang_nama,
									'satuan_nama'						=> $val3->satuan_nama,
									'retur_pembeliandet_qty'			=> $val2->retur_pembeliandet_qty,
									'retur_pembeliandet_qty_terima'		=> $val2->retur_pembeliandet_qty_terima,
									'retur_pembeliandet_keterangan'		=> $val2->retur_pembeliandet_keterangan,
									'retur_pembeliandet_status'			=> $val2->retur_pembeliandet_status,
									'm_barang_id'						=> $val2->m_barang_id,
									'penerimaan_barangdet_harga_satuan'	=> $val2->penerimaan_barangdet_harga_satuan,
									'penerimaan_barangdet_potongan'		=> $val2->penerimaan_barangdet_potongan,
									'penerimaan_barangdet_total'		=> $val2->penerimaan_barangdet_total,
									'penerimaan_barang_ppn'				=> $val2->penerimaan_barang_ppn,
								);
							}
						}
						// CARI BARANG
					}
				}
				// END CARI DETAIL

				$hasil0['val2'][] = array(
					'id' 	=> $val->penerimaan_barang_id,
					'text' 	=> $val->penerimaan_barang_nomor
				);
				$where1['data'][] = array(
					'column' => 'penerimaan_barang_id',
					'param'	 => $val->penerimaan_barang_id
				);
				$query1 = $this->mod->select('*', 't_penerimaan_barang', NULL, $where1);
				$hasil1['val2'] = array();
				$hasil2 = '';
				if ($query1) {
					foreach ($query1->result() as $val2) {
						// GUDANG
						$where2['data'][] = array(
							'column' => 'gudang_id',
							'param'	 => $val2->m_gudang_id
						);
						$query2 = $this->mod->select('*', 'm_gudang', NULL, $where2);
						if ($query2) {
							foreach ($query2->result() as $val3) {
								$hasil1['val2'][] = array(
									'id' 	=> $val3->gudang_id,
									'text' 	=> $val3->gudang_nama
								);
							}
						}
						$hasil2 = date("d/m/Y",strtotime($val2->penerimaan_barang_tanggal));
					}
				}

				$response['val'][] = array(
					'kode' 							=> $val->retur_pembelian_id,
					'retur_pembelian_nomor' 		=> $val->retur_pembelian_nomor,
					'retur_pembelian_tanggal'		=> date("d/m/Y",strtotime($val->retur_pembelian_tanggal)),
					'retur_pembelian_status' 		=> $val->retur_pembelian_status,
					'penerimaan_barang_nomor' 		=> $hasil0,
					'm_gudang_id'					=> $hasil1,
					'penerimaan_barang_tanggal'		=> $hasil2,
				);
			}

			echo json_encode($response);
		}
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'retur_pembelian_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->retur_pembelian_status == 1) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'retur_pembelian_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 								=> $id,
						'retur_pembelianlog_status_dari' 			=> 1,
						'retur_pembelianlog_status_ke' 				=> 2,
						'retur_pembelianlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'retur_pembelianlog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_retur_pembelianlog', NULL, $data_log);
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
			'column' => 'retur_pembelian_status',
			'param'	 => 3
		);
		$where_like['data'][] = array(
			'column' => 'retur_pembelian_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'retur_pembelian_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->retur_pembelian_id,
					'text'	=> $val->retur_pembelian_nomor
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
		$select = 'a.*, b.t_order_id, b.penerimaan_barang_nomor, b.penerimaan_barang_tanggal';
		$join['data'][] = array(
			'table' => 't_penerimaan_barang b',
			'join'	=> 'b.penerimaan_barang_id = a.t_penerimaan_barang_id',
			'type'	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'retur_pembelian_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, 't_retur_pembelian a', $join, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$where_det['data'][] = array(
					'column' => 't_retur_pembelian_id',
					'param'	 => $val->retur_pembelian_id
				);
				$query_det = $this->mod->select('*','t_retur_pembeliandet',NULL,$where_det);
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
									'retur_pembeliandet_id'			=> $val2->retur_pembeliandet_id,
									'barang_kode'					=> $val3->barang_kode,
									'barang_nama'					=> $val3->barang_nama,
									'barang_nomor'					=> $val3->barang_nomor,
									'jenis_barang_nama'				=> $val3->jenis_barang_nama,
									'satuan_nama'					=> $val3->satuan_nama,
									'retur_pembeliandet_qty'		=> $val2->retur_pembeliandet_qty,
									'retur_pembeliandet_keterangan'	=> $val2->retur_pembeliandet_keterangan,
									'm_barang_id'					=> $val2->m_barang_id,
								);
							}
						}
						// CARI BARANG DAN STOK
					}
				}
				// CARI CABANG
				$hasil1['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
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
							'telp'  => json_decode($val2->cabang_telepon)
						);
					}
				}
				// END CARI CABANG
				// END CARI DETAIL
				// CARI SUPPLIER
				$hasil2['val2'] = array();
				$where_order['data'][] = array(
					'column' => 'order_id',
					'param'	 => $val->t_order_id
				);
				$query_order = $this->mod->select('*','t_order',NULL,$where_order);
				foreach ($query_order->result() as $val2) {
					$where_supplier['data'][] = array(
						'column' => 'partner_id',
						'param'	 => $val2->m_supplier_id
					); 
					$query_supplier = $this->mod->select('*','m_partner',NULL,$where_supplier);
					foreach ($query_supplier->result() as $val3) {
						$hasil2['val2'][] = array(
							'id' 	=> $val3->partner_id,
							'text' 	=> $val3->partner_nama
						);
					}
					
				}
				// END CARI SUPPLIER
				// CARI PENYETUJU
				// $hasil4['val2'] = array();
				// $where_penyetuju['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->retur_pembelian_penyetuju
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
				// 	'param'	 => $val->retur_pembelian_penerima
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
				$name = $val->retur_pembelian_nomor;
				$response['val'][] = array(
					'kode' 									=> $val->retur_pembelian_id,
					'retur_pembelian_nomor' 				=> $val->retur_pembelian_nomor,
					'retur_pembelian_tanggal'				=> date("d/m/Y",strtotime($val->retur_pembelian_tanggal)),
					'cabang'								=> $hasil1,
					'supplier'								=> $hasil2,
					'nomor_bpb' 							=> $val->penerimaan_barang_nomor,
					'tanggal_bpb' 							=> date("d/m/Y",strtotime($val->penerimaan_barang_tanggal)),
					// 'retur_pembelian_tanggal_dibutuhkan'	=> date("d/m/Y",strtotime($val->retur_pembelian_tanggal_dibutuhkan)),
					// 'retur_pembelian_jenis' 				=> $val->retur_pembelian_jenis,
					// 'm_gudang_id_retur'						=> $hasil2,
					'retur_pembelian_status' 				=> $val->retur_pembelian_status,
					'retur_pembelian_created_by'			=> $val->retur_pembelian_created_by,
					// 'retur_pembelian_penyetuju' 			=> $hasil4,
					// 'retur_pembelian_penerima' 				=> $hasil5,
					// 'retur_pembelian_alasan' 				=> $val->retur_pembelian_alasan,
					// 'retur_pembelian_catatan' 				=> $val->retur_pembelian_catatan,
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Pembelian',
			'title_page2' 	=> 'Retur Pembelian',
		);
		// echo json_encode($response);
		$this->pdf->load_view('print/P_nota_retur_pembelian', $response);
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
			//UPDATE
			$data = $this->general_post_data(2, $id);
			$where['data'][] = array(
				'column' => 'retur_pembelian_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($update->status) {
				$response['status'] = '200';
				// INSERT LOG 
				if (@$data['retur_pembelian_status']) {
					if ($data['retur_pembelian_status'] == 3){
						$data_log = array(
							'referensi_id' 							=> $id,
							'retur_pembelianlog_status_dari' 		=> 2,
							'retur_pembelianlog_status_ke' 			=> 3,
							'retur_pembelianlog_status_update_date' => date('Y-m-d H:i:s'),
							'retur_pembelianlog_status_update_by' 	=> $this->session->userdata('user_username'),
						);
						$insert_log = $this->mod->insert_data_table('t_retur_pembelianlog', NULL, $data_log);
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
				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_retur_pembeliandet', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
						// UPDATE PENERIMAAN 
						if (@$where_bpbdet['data']) {
							unset($where_bpbdet['data']);
						}
						$where_bpbdet['data'][] = array(
							'column' => 'penerimaan_barangdet_id',
							'param'	 => $this->input->post('t_penerimaan_barangdet_id', TRUE)[$i]
						);
						$query_bpbdet = $this->mod->select('*', 't_penerimaan_barangdet', NULL, $where_bpbdet);
						if ($query_bpbdet) {
							foreach ($query_bpbdet->result() as $row) {
								$data_bpbdet = array(
									'penerimaan_barangdet_qty_retur' => $row->penerimaan_barangdet_qty_retur + $this->input->post('retur_pembeliandet_qty', TRUE)[$i],
								);
								$update_bpbdet = $this->mod->update_data_table('t_penerimaan_barangdet', $where_bpbdet, $data_bpbdet);
							}
						}
						// END UPDATE PENERIMAAN
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
		$arrDate = explode('/', $this->input->post('retur_pembelian_tanggal', TRUE));
		$arrDate2 = explode('/', $this->input->post('retur_pembelian_tanggal_dibutuhkan', TRUE));
		$where['data'][] = array(
			'column' => 'retur_pembelian_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('retur_pembelian_status, retur_pembelian_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['retur_pembelian_revised'] + 1;
			$status = $revised['retur_pembelian_status'];
		}
		if ($type == 1) {
			$retur_pembelian_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 							=> $this->session->userdata('cabang_id'),
				'retur_pembelian_nomor' 				=> $retur_pembelian_nomor,
				'retur_pembelian_tanggal'				=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				't_penerimaan_barang_id'				=> $this->input->post('t_penerimaan_barang_id', TRUE),
				'retur_pembelian_status' 				=> 1,
				'retur_pembelian_status_date'			=> date('Y-m-d H:i:s'),
				'retur_pembelian_created_date'			=> date('Y-m-d H:i:s'),
				'retur_pembelian_update_date'			=> date('Y-m-d H:i:s'),
				'retur_pembelian_created_by'			=> $this->session->userdata('user_username'),
				'retur_pembelian_revised' 				=> 0,
			);
		} else if ($type == 2) {
			if ($status == $this->input->post('retur_pembelian_status', TRUE)) {
				$data = array(
					'retur_pembelian_update_date'	=> date('Y-m-d H:i:s'),
					'retur_pembelian_update_by'		=> $this->session->userdata('user_username'),
					'retur_pembelian_revised' 		=> $rev,
				);	
			} else {
				$data = array(
					'retur_pembelian_status' 		=> $this->input->post('retur_pembelian_status', TRUE),
					'retur_pembelian_status_date'	=> date('Y-m-d H:i:s'),
					'retur_pembelian_update_date'	=> date('Y-m-d H:i:s'),
					'retur_pembelian_update_by'		=> $this->session->userdata('user_username'),
					'retur_pembelian_revised' 		=> $rev,
				);	
			}
		} else if ($type == 3) {
			$data = array(
				'retur_pembelian_status'		=> 2,
				'retur_pembelian_status_date'	=> date('Y-m-d H:i:s'),
				'retur_pembelian_update_date'	=> date('Y-m-d H:i:s'),
				'retur_pembelian_update_by'		=> $this->session->userdata('user_username'),
				'retur_pembelian_revised' 		=> $rev,
			);
		} 

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'retur_pembeliandet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('retur_pembeliandet_revised', 't_retur_pembeliandet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['retur_pembeliandet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_retur_pembelian_id' 				=> $idHdr,
				'm_barang_id' 						=> $this->input->post('m_barang_id', TRUE)[$seq],
				'retur_pembeliandet_qty' 			=> $this->input->post('retur_pembeliandet_qty', TRUE)[$seq],
				'retur_pembeliandet_qty_terima'		=> $this->input->post('retur_pembeliandet_qty_terima', TRUE)[$seq],
				'retur_pembeliandet_keterangan'		=> $this->input->post('retur_pembeliandet_keterangan', TRUE)[$seq],
				'retur_pembeliandet_status' 		=> 1,
				'retur_pembeliandet_status_date'	=> date('Y-m-d H:i:s'),
				'retur_pembeliandet_created_date'	=> date('Y-m-d H:i:s'),
				'retur_pembeliandet_created_by'		=> $this->session->userdata('user_username'),
				'retur_pembeliandet_update_date'	=> date('Y-m-d H:i:s'),
				'retur_pembeliandet_revised' 		=> 0,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(retur_pembelian_nomor,11,5) as id';
		$where['data'][] = array(
			'column' => 'MID(retur_pembelian_nomor,1,10)',
			'param'	 => 'REPO'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'retur_pembelian_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('REPO',$query);
		return $kode_baru;
	}
	/* end Function */

}
