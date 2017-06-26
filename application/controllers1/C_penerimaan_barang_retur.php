<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_penerimaan_barang_retur extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_bpbr';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view($type){
		$this->check_session();

		if ($type == 1) {
			$priv = $this->cekUser(67);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Gudang',
				'title_page2' 	=> 'Penerimaan Barang Retur',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('penerimaan-barang-retur/V_penerimaan_barang_retur', $data);
			}
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			// $priv = $this->cekUser(65);
			// $data = array(
			// 	'aplikasi'		=> $this->app_name,
			// 	'title_page' 	=> 'Persetujuan',
			// 	'title_page2' 	=> 'Penerimaan Barang Retur',
			// 	'priv_add'		=> $priv['create']
			// 	);
			// if($priv['read'] == 1)
			// {
			// 	$this->open_page('penerimaan-barang-retur/V_penerimaan_barang_retur2', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		}		
	}

	public function loadData($type){
		$priv = $this->cekUser(67);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, bpbr_nomor, retur_penjualan_nomor, bpbr_tanggal',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_penerimaan_barang_retur');
		$query_filter = $this->mod->select($select, 'v_penerimaan_barang_retur', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_penerimaan_barang_retur', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				// $button = '';
				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Penjualan/Faktur-Penjualan/Form/'.$val->bpbr_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat SO Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>';
					// <a href="'.base_url().'Penjualan/Faktur-Penjualan/print-Penawaran/'.$val->bpbr_id.'">
					// <button class="btn green-jungle" type="button" title="Print PS Customer">
					// 	<i class="icon-printer text-center"></i>
					// </button>
					// </a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Persetujuan/Faktur-Penjualan/Form/'.$val->bpbr_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PS Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>';
					// <a href="'.base_url().'Marketing/Faktur-Penjualan/print-Penawaran/'.$val->bpbr_id.'">
					// <button class="btn green-jungle" type="button" title="Print PS Customer">
					// 	<i class="icon-printer text-center"></i>
					// </button>
					// </a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->bpbr_nomor,
					$val->retur_penjualan_nomor,
					date("d/m/Y",strtotime($val->bpbr_tanggal)),
					// $button
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
			'title_page2' 	=> 'Penerimaan Barang Retur',
			'id'			=> $id
		);
		$this->open_page('penerimaan-barang-retur/V_form_penerimaan_barang_retur', $data);
	}

	// public function getForm2($id = null){
	// 	$data = array(
	// 		'aplikasi'		=> $this->app_name,
	// 		'title_page' 	=> 'Persetujuan',
	// 		'title_page2' 	=> 'Penerimaan Barang Retur',
	// 		'id'			=> $id
	// 	);
	// 	$this->open_page('penerimaan-barang-retur/V_form_penerimaan_barang_retur2', $data);
	// }

	public function loadDataWhere($type){
		$select = '*';
		$where['data'][] = array(
			'column' => 'bpbr_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				// $where_det['data'][] = array(
				// 	'column' => 't_penerimaan_barang_retur_id',
				// 	'param'	 => $val->penerimaan_barang_retur_id
				// );
				// $query_det = $this->mod->select('*','t_penerimaan_barang_returdet',NULL,$where_det);
				// $response['val2'] = array();

				// if ($query_det) {
				// 	foreach ($query_det->result() as $val2) {
				// 		$response['val2'][] = array(
				// 			'penerimaan_barang_returdet_id'		=> $val2->penerimaan_barang_returdet_id,
				// 			't_penerimaan_barang_retur_id'			=> $val2->t_penerimaan_barang_retur_id,
				// 			'penerimaan_barang_returdet_discount'	=> $val2->penerimaan_barang_returdet_discount,
				// 		);
				// 	}
				// }
				// // END CARI DETAIL

				// CARI PO CUSTOMER
				$hasil['val2'] = array();
				$where_socustomer['data'][] = array(
					'column' => 'retur_penjualan_id',
					'param'	 => $val->t_retur_penjualan_id
				);
				$query_socustomer = $this->mod->select('*','t_retur_penjualan',NULL,$where_socustomer);
				foreach ($query_socustomer->result() as $val2) {
					$hasil['val2'][] = array(
						'id' 	=> $val2->retur_penjualan_id,
						'text' 	=> $val2->retur_penjualan_nomor
					);
				}
				// END CARI PO CUSTOMER
				
				$response['val'][] = array(
					'kode' 								=> $val->bpbr_id,
					// 'm_cabang_id'						=> $val->m_cabang_id,
					// 'bpbr_nomor' 			=> $val->bpbr_nomor,
					// 'bpbr_tanggal'			=> date("d/m/Y",strtotime($val->bpbr_tanggal)),
					// 'bpbr_jatuh_tempo'		=> date("d/m/Y",strtotime($val->bpbr_jatuh_tempo)),
					't_retur_penjualan_id'	=> $hasil,
					// 'bpbr_potongan'			=> $val->bpbr_potongan,
					// 'bpbr_uang_muka'		=> $val->bpbr_uang_muka,
					// 'bpbr_tujuan_transfer'	=> $val->penerimaan_barang_retur_tujuan_transfer,
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
			$where_like['data'][] = array(
				'column' => 'bpbr_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'bpbr_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->bpbr_id,
						'text'	=> $val->bpbr_nomor
					);
				}
				$response['status'] = '200';
			}
		}

		echo json_encode($response);
	}

	// public function cetakPDF($id){
	// 	$this->load->library('pdf');
	// 	$name = '';
	// 	$select = '*';
	// 	$where['data'][] = array(
	// 		'column' => 'penawaran_id',
	// 		'param'	 => $id
	// 	);
	// 	$query = $this->mod->select($select, $this->tbl, NULL, $where);
	// 	if ($query<>false) {

	// 		foreach ($query->result() as $val) {
	// 			// CARI DETAIL
	// 			// BARANG
	// 			$join_brg['data'][] = array(
	// 				'table' => 'm_barang b',
	// 				'join'	=> 'b.barang_id = a.m_barang_id',
	// 				'type'	=> 'left'
	// 			);
	// 			$join_brg['data'][] = array(
	// 				'table' => 'm_jenis_barang c',
	// 				'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
	// 				'type'	=> 'left'
	// 			);
	// 			$join_brg['data'][] = array(
	// 				'table' => 'm_satuan d',
	// 				'join'	=> 'd.satuan_id = b.m_satuan_id',
	// 				'type'	=> 'left'
	// 			);
	// 			$where_brg['data'][] = array(
	// 				'column' => 't_penawaran_id',
	// 				'param'	 => $val->penawaran_id
	// 			);
	// 			$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_penawaran_barang a', $join_brg, $where_brg);
	// 			$response['step1'] = array();
	// 			if ($query_brg) {
	// 				foreach ($query_brg->result() as $val2) {

	// 					$response['step1'][] = array(
	// 						'penawaran_barang_id'		=> $val2->penawaran_barang_id,
	// 						't_permintaan_pembelian'	=> $val2->t_permintaan_pembelian,
	// 						'm_barang_id'				=> $val2->m_barang_id,
	// 						'barang_kode'				=> $val2->barang_kode,
	// 						'barang_uraian'				=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
	// 						'penawaran_barang_qty'		=> $val2->penawaran_barang_qty,
	// 						'satuan_nama'				=> $val2->satuan_nama,
	// 					);
	// 				}
	// 			}

	// 			// SUPPLIER
	// 			$join_sup['data'][] = array(
	// 				'table' => 'm_partner b',
	// 				'join'	=> 'b.partner_id = a.m_partner_id',
	// 				'type'	=> 'left'
	// 			);
	// 			$where_sup['data'][] = array(
	// 				'column' => 't_penawaran_id',
	// 				'param'	 => $val->penawaran_id
	// 			);
	// 			$query_sup = $this->mod->select('a.*, b.*', 't_penawaran_supplier a', $join_sup, $where_sup);
	// 			$response['step2'] = array();
	// 			$response['step4'] = 0;
	// 			if ($query_sup) {
	// 				foreach ($query_sup->result() as $val2) {
	// 					$response['step4'] += $val2->penawaran_supplier_pemenang;
	// 					$response['step2'][] = array(
	// 						'penawaran_supplier_id'				=> $val2->penawaran_supplier_id,
	// 						'm_partner_id'						=> $val2->m_partner_id,
	// 						'partner_nama'						=> $val2->partner_nama,
	// 						'penawaran_supplier_kontak'			=> $val2->penawaran_supplier_kontak,
	// 						'partner_alamat'					=> $val2->partner_alamat,
	// 						'penawaran_supplier_pemenang'		=> $val2->penawaran_supplier_pemenang,
	// 						'penawaran_supplier_alasan'			=> $val2->penawaran_supplier_alasan,
	// 						'penawaran_supplier_tanggal_kirim'	=> $val2->penawaran_supplier_tanggal_kirim,
	// 						'penawaran_supplier_diskon'			=> $val2->penawaran_supplier_diskon,
	// 						'partner_telepon' 					=> implode(', ', json_decode($val2->partner_telepon)),
	// 					);
	// 				}
	// 			}
				
	// 			// HARGA
	// 			$where_hrg['data'][] = array(
	// 				'column' => 't_penawaran_id',
	// 				'param'	 => $val->penawaran_id
	// 			);
	// 			$query_hrg = $this->mod->select('*', 't_penawaran_harga', NULL, $where_hrg);
	// 			if ($query_hrg) {
	// 				// $response['step3'] = 1;
	// 				foreach ($query_hrg->result() as $val4) {
	// 					$response['step3'][] = array(
	// 						'supplier_kode'				=> $val4->t_penawaran_supplier_id,
	// 						'barang_kode'				=> $val4->t_penawaran_barang_id,
	// 						'harga'						=> $val4->penawaran_harga_nominal
	// 					);
	// 				}
	// 			}
	// 			//END CARI HARGA
	// 			// CARI CABANG
	// 			$hasil6['val2'] = array();
	// 			$where_cabang['data'][] = array(
	// 				'column' => 'cabang_id',
	// 				'param'	 => $val->m_cabang_id
	// 			);
	// 			$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
	// 			if ($query_cabang) {
	// 				foreach ($query_cabang->result() as $val2) {
	// 					// CARI KOTA
	// 					$hasil7['val2'] = array();
	// 					$where_kota['data'][] = array(
	// 						'column' => 'id',
	// 						'param'	 => $val2->cabang_kota
	// 					);
	// 					$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
	// 					if ($query_kota) {
	// 						foreach ($query_kota->result() as $val3) {
	// 							$hasil7['val3'][] = array(
	// 								'id' 		=> $val3->id,
	// 								'text' 		=> $val3->name,
	// 							);
	// 						}
	// 					}
	// 					// END CARI KOTA
	// 					$hasil6['val2'][] = array(
	// 						'id' 	=> $val2->cabang_id,
	// 						'text' 	=> $val2->cabang_nama,
	// 						'alamat'=> $val2->cabang_alamat,
	// 						'kota'	=> $hasil7,
	// 						'telp'  => json_decode($val2->cabang_telepon)
	// 					);
	// 				}
	// 			}
	// 			// END CARI CABANG
	// 			$name = $val->penawaran_nomor;
	// 			$response['val'][] = array(
	// 				'kode' 							=> $val->penawaran_id,
	// 				'penawaran_nomor' 				=> $val->penawaran_nomor,
	// 				'penawaran_tanggal'				=> date("d/m/Y",strtotime($val->penawaran_tanggal)),
	// 				'cabang'						=> $hasil6,
	// 				'penawaran_jenis' 				=> $val->penawaran_jenis,
	// 				'penawaran_status' 				=> $val->penawaran_status,
	// 				'penawaran_step' 				=> $val->penawaran_step,
	// 				'penawaran_create_by' 			=> $val->penawaran_create_by
	// 			);
	// 		}
	// 	}
	// 	$response['title'][] = array(
	// 	'aplikasi'		=> $this->app_name,
	// 	'title_page' 	=> 'Penawaran Harga',
	// 	'title_page2' 	=> 'Print Penawaran',
	// 	);
	// 	// echo json_encode($response);
	// 	$this->pdf->set_paper('A4', 'landscape');
	// 	$this->pdf->load_view('print/P_penawaran_harga', $response);
	// 	$this->pdf->render();
	// 	$this->pdf->stream($name,array("Attachment"=>false));
	// }

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['id'] 	= $id;
		$response['test'] 	= $type;
		if (strlen($id)>0) {
			// if ($type == 2) {
			// 	//UPDATE
			// 	$data = $this->general_post_data(2, $id);
			// 	$where['data'][] = array(
			// 		'column' => 'so_customer_id',
			// 		'param'	 => $id
			// 	);
			// 	$update = $this->mod->update_data_table($this->tbl, $where, $data);
			// 	if($update->status) {
			// 		$response['status'] = '200';
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
				for ($i = 0; $i < sizeof($this->input->post('t_retur_penjualandet_id', TRUE)); $i++) { 
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_bpbrdet', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
			} else {
				$response['status'] = '204';
			}
			$response['id'] = $insert->output;
		}
		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('bpbr_tanggal', TRUE));
		$arrDate2 = explode('/', $this->input->post('bpbr_pengecekan', TRUE));
		$where['data'][] = array(
			'column' => 'bpbr_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('bpbr_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['bpbr_revised'] + 1;
		}
		if ($type == 1) {
			$bpbr_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 			=> $this->session->userdata('cabang_id'),
				'bpbr_nomor' 			=> $bpbr_nomor,
				'bpbr_tanggal'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'bpbr_pengecekan'		=> $arrDate2[2]."-".$arrDate2[1]."-".$arrDate2[0],
				't_retur_penjualan_id'	=> $this->input->post('t_retur_penjualan_id', TRUE),
				'bpbr_catatan'			=> $this->input->post('bpbr_catatan', TRUE),
				'bpbr_created_date'		=> date('Y-m-d H:i:s'),
				'bpbr_updated_date'		=> date('Y-m-d H:i:s'),
				'bpbr_created_by'		=> $this->session->userdata('user_username'),
				'bpbr_revised' 			=> 0,
			);
		} else if ($type == 2) {
			// $data = array(
			// 	'so_customer_status' 		=> $this->input->post('so_customer_status', TRUE),
			// 	'so_customer_updated_date'	=> date('Y-m-d H:i:s'),
			// 	'so_customer_updated_by'	=> $this->session->userdata('user_username'),
			// 	'so_customer_revised' 		=> $rev,
			// );
		}

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if (@$where['data']) {
			unset($where['data']);
		}
		$where['data'][] = array(
			'column' => 'bpbrdet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('bpbrdet_revised', 't_bpbrdet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['bpbrdet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_bpbr_id' 				=> $idHdr,
				't_retur_penjualandet_id' 	=> $this->input->post('t_retur_penjualandet_id', TRUE)[$seq],
				'bpbrdet_qty'				=> $this->input->post('bpbrdet_qty', TRUE)[$seq],
				'bpbrdet_created_date'		=> date('Y-m-d H:i:s'),
				'bpbrdet_created_by'		=> $this->session->userdata('user_username'),
				'bpbrdet_updated_date'		=> date('Y-m-d H:i:s'),
				'bpbrdet_revised' 			=> 0,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(bpbr_nomor,11,5) as id';
		$where['data'][] = array(
			'column' => 'MID(bpbr_nomor,1,10)',
			'param'	 => 'BPBR'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'bpbr_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('BPBR',$query);
		return $kode_baru;
	}
	/* end Function */

}
