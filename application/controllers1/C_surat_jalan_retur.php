<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_surat_jalan_retur extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_sj_retur';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		// $this->view();
	}

	public function view($type){
		$this->check_session();

		if ($type == 1) {
			$priv = $this->cekUser(68);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Penjualan',
				'title_page2' 	=> 'Surat Jalan Retur',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('surat-jalan-retur/V_surat_jalan_retur', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		// } else if ($type == 2) {
		// 	$priv = $this->cekUser(66);
		// 	$data = array(
		// 		'aplikasi'		=> $this->app_name,
		// 		'title_page' 	=> 'Gudang',
		// 		'title_page2' 	=> 'Surat Jalan Retur',
		// 		'priv_add'		=> $priv['create']
		// 		);
		// 	if($priv['read'] == 1)
		// 	{
		// 		$this->open_page('surat-jalan-retur/V_surat_jalan_retur2', $data);
		// 	}
		// 	else
		// 	{
		// 		$this->load->view('layout/V_404', $data);
		// 	}
		}		
	}

	public function loadData($type){
		// $privPembelian = $this->cekUser(68);
		$priv = $this->cekUser(68);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, sj_retur_nomor, sj_retur_tanggal, surat_jalan_nomor',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_sj_retur');
		$query_filter = $this->mod->select($select, 'v_sj_retur', NULL, null, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_sj_retur', NULL, null, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($type == 1) {
					$button = $button.'
					<a href="'.base_url().'Penjualan/Surat-Jalan-Retur/Form/'.$val->sj_retur_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Surat Jalan Retur">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Penjualan/Surat-Jalan-Retur/print-SJ/'.$val->sj_retur_id.'">
					<button class="btn green-jungle" type="button" title="Print Surat Jalan Retur">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					// if($val->order_status_nama == 'WO Disetujui')
					// {
					// 	$button = $button.'
					// 	<button class="btn red-thunderbird" type="button" title="Batalkan Persetujuan WO" onclick="batalkanWO('.$val->order_id.')">
					// 		<i class="icon-power text-center"></i>
					// 	</button>';
					// }
					// $button = $button.'
					// <a href="'.base_url().'Persetujuan/Work-Order/Form/'.$val->order_id.'">
					// <button class="btn blue-ebonyclay" type="button" title="Lihat WO" onclick="checkStatusWO('.$val->order_id.')">
					// 	<i class="icon-eye text-center"></i>
					// </button>
					// <a href="'.base_url().'Persetujuan/Work-Order/print-WO/'.$val->order_id.'">
					// <button class="btn green-jungle" type="button" title="Print WO">
					// 	<i class="icon-printer text-center"></i>
					// </button>
					// </a>
					// ';
				}
				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->sj_retur_nomor,
					$val->surat_jalan_nomor,
					date("d/m/Y",strtotime($val->sj_retur_tanggal)),
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
			'title_page' 	=> 'Penjualan',
			'title_page2' 	=> 'Surat Jalan Retur',
			'id'			=> $id
		);
		$this->open_page('surat-jalan-retur/V_form_surat_jalan_retur', $data);
	}

	// public function getForm2($id = null){
	// 	$data = array(
	// 		'aplikasi'		=> $this->app_name,
	// 		'title_page' 	=> 'Penjualan',
	// 		'title_page2' 	=> 'Surat Jalan Retur',
	// 		'id'			=> $id
	// 	);
	// 	$this->open_page('surat-jalan-retur/V_surat_jalan_retur2', $data);
	// }

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'sj_retur_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join_det['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table' => 'm_satuan d',
					'join'	=> 'd.satuan_id = b.m_satuan_id',
					'type'	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 'a.t_sj_retur_id',
					'param'	 => $val->sj_retur_id
				);
				$query_det = $this->mod->select('a.*, b.*, c.*, d.*','t_sj_returdet a',$join_det,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'sj_returdet_id'			=> $val2->sj_returdet_id,
							't_sj_retur_id'				=> $val2->t_sj_retur_id,
							'm_barang_id'				=> $val2->m_barang_id,
							'barang_kode'				=> $val2->barang_kode,
							'barang_nama'				=> $val2->barang_nama,
							'barang_uraian'				=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'sj_returdet_qty'			=> $val2->sj_returdet_qty,
							'sj_returdet_qty_retur'		=> $val2->sj_returdet_qty_retur,
							'satuan_nama'				=> $val2->satuan_nama,
							't_po_customerdet_id'		=> $val2->t_po_customerdet_id,
						);
					}
				}
				// END CARI DETAIL

				// CARI SURAT JALAN
				$hasil1['val2'] = array();
				$where_surat_jalan['data'][] = array(
					'column' => 'surat_jalan_id',
					'param'	 => $val->t_surat_jalan_id
				);
				$query_surat_jalan = $this->mod->select('*','t_surat_jalan',NULL,$where_surat_jalan);
				if ($query_surat_jalan) {
					foreach ($query_surat_jalan->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->surat_jalan_id,
							'text' 	=> $val2->surat_jalan_nomor
						);
					}
				}
				// END SURAT JALAN
				// CARI FAKTUR
				$hasil4['val2'] = array();
				$where_faktur['data'][] = array(
					'column' => 't_surat_jalan_id',
					'param'	 => $val->t_surat_jalan_id
				);
				$query_faktur = $this->mod->select('*','t_faktur_penjualan',NULL,$where_faktur);
				if ($query_faktur) {
					foreach ($query_faktur->result() as $val2) {
						$hasil4['val2'][] = array(
							'id' 			=> $val2->faktur_penjualan_id,
							'text' 			=> $val2->faktur_penjualan_nomor
						);
					}
				}
				// END CARI FAKTUR
				$response['val'][] = array(
					'kode' 					=> $val->sj_retur_id,
					'sj_retur_nomor' 		=> $val->sj_retur_nomor,
					'sj_retur_tanggal'		=> date("d/m/Y",strtotime($val->sj_retur_tanggal)),
					't_surat_jalan_id' 		=> $hasil1,
					't_faktur_penjualan_id'	=> $hasil4,
					'sj_retur_alasan' 		=> $val->sj_retur_alasan,
					'sj_retur_catatan' 		=> $val->sj_retur_catatan,
				);
			}

			echo json_encode($response);
		}
	}

	// public function terbilang($x)
 //    {
 //      $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
 //      if ($x < 12)
 //      return " " . $abil[$x];
 //      elseif ($x < 20)
 //      return $this->terbilang($x - 10) . "belas";
 //      elseif ($x < 100)
 //      return $this->terbilang($x / 10) . " puluh" . $this->terbilang($x % 10);
 //      elseif ($x < 200)
 //      return " seratus" . $this->terbilang($x - 100);
 //      elseif ($x < 1000)
 //      return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
 //      elseif ($x < 2000)
 //      return " seribu" . $this->terbilang($x - 1000);
 //      elseif ($x < 1000000)
 //      return $this->terbilang($x / 1000) . " ribu" . $this->terbilang($x % 1000);
 //      elseif ($x < 1000000000)
 //      return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);
 //    }

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'sj_retur_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join_det['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table' => 'm_satuan d',
					'join'	=> 'd.satuan_id = b.m_satuan_id',
					'type'	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 'a.t_sj_retur_id',
					'param'	 => $val->sj_retur_id
				);
				$query_det = $this->mod->select('a.*, b.*, c.*, d.*','t_sj_returdet a',$join_det,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						if(@$where_podet['data'])
						{
							unset($where_podet['data']);
						}
						$where_podet['data'][] = array(
							'column'	=> 'po_customerdet_id',
							'param'		=> $val2->t_po_customerdet_id
						);
						$query_podet = $this->mod->select('*', 't_po_customerdet', null, $where_podet);
						if($query_podet)
						{
							foreach ($query_podet->result() as $val3) {
								$keterangan = $val3->po_customerdet_keterangan;
							}
						}
						$response['val2'][] = array(
							'sj_returdet_id'			=> $val2->sj_returdet_id,
							't_sj_retur_id'				=> $val2->t_sj_retur_id,
							'm_barang_id'				=> $val2->m_barang_id,
							'barang_kode'				=> $val2->barang_kode,
							'barang_nama'				=> $val2->barang_nama,
							'barang_uraian'				=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'sj_returdet_qty'			=> $val2->sj_returdet_qty,
							'sj_returdet_qty_retur'		=> $val2->sj_returdet_qty_retur,
							'satuan_nama'				=> $val2->satuan_nama,
							't_po_customerdet_id'		=> $val2->t_po_customerdet_id,
							'po_customerdet_keterangan'	=> $keterangan,
						);
					}
				}
				// END CARI DETAIL

				// CARI SURAT JALAN
				$hasil1['val2'] = array();
				$where_surat_jalan['data'][] = array(
					'column' => 'surat_jalan_id',
					'param'	 => $val->t_surat_jalan_id
				);
				$query_surat_jalan = $this->mod->select('*','t_surat_jalan',NULL,$where_surat_jalan);
				if ($query_surat_jalan) {
					foreach ($query_surat_jalan->result() as $val2) {
						if(@$where_partner['data'])
						{
							unset($where_partner['data']);
						}
						$where_partner['data'][] = array(
							'column' => 'partner_id',
							'param'	 => $val2->m_partner_id
						);
						$query_partner = $this->mod->select('*', 'm_partner', null, $where_partner);
						if($query_partner)
						{
							foreach ($query_partner->result() as $val5) {
								$hasil6['val2'][] = array(
									'id'		=> $val5->partner_id,
									'text'		=> $val5->partner_nama,
									'alamat'	=> $val5->partner_alamat,
									'telp'		=> json_decode($val5->partner_telepon)
									// KURANG KOTA!
								);
							}
						}
						$hasil1['val2'][] = array(
							'id' 			=> $val2->surat_jalan_id,
							'text' 			=> $val2->surat_jalan_nomor,
							'ekspedisi' 	=> $val2->surat_jalan_ekspedisi,
							'm_partner_id'	=> $hasil6,
						);
					}
				}
				// END CARI SURAT JALAN
				// CARI CABANG
				$hasil2['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI kota
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
						// END CARI kota
						$hasil2['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil3,
							'telp'	=> json_decode($val2->cabang_telepon)
						);
					}
				}
				// END CARI CABANG
				// CARI FAKTUR
				$hasil4['val2'] = array();
				$where_faktur['data'][] = array(
					'column' => 't_surat_jalan_id',
					'param'	 => $val->t_surat_jalan_id
				);
				$query_faktur = $this->mod->select('*','t_faktur_penjualan',NULL,$where_faktur);
				if ($query_faktur) {
					foreach ($query_faktur->result() as $val2) {
						$hasil4['val2'][] = array(
							'id' 			=> $val2->faktur_penjualan_id,
							'text' 			=> $val2->faktur_penjualan_nomor
						);
					}
				}
				// END CARI FAKTUR
				$name = $val->sj_retur_nomor;
				$response['val'][] = array(
					'kode' 					=> $val->sj_retur_id,
					'sj_retur_nomor' 		=> $val->sj_retur_nomor,
					'cabang'				=> $hasil2	,
					'sj_retur_tanggal'		=> date("d/m/Y",strtotime($val->sj_retur_tanggal)),
					't_surat_jalan_id' 		=> $hasil1,
					'sj_retur_alasan' 		=> $val->sj_retur_alasan,
					'sj_retur_catatan' 		=> $val->sj_retur_catatan,
					't_faktur_penjualan_id'	=> $hasil4,
					// 't_po_customer_id'		=> $hasil5,
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Surat Jalan Retur',
			'title_page2' 	=> 'Print Surat Jalan Retur',
		);
		// echo json_encode($response);
		$this->pdf->load_view('print/P_surat_jalan_retur_jual', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
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
				'column' => 'sj_retur_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'sj_retur_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->sj_retur_id,
						'text'	=> $val->sj_retur_nomor
					);
				}
				$response['status'] = '200';
			}

			echo json_encode($response);
		}
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'order_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->order_status == 1) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'order_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG
					$data_log = array(
						'referensi_id' 					=> $id,
						'orderlog_status_dari' 			=> 1,
						'orderlog_status_ke' 			=> 2,
						'orderlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'orderlog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_orderlog', NULL, $data_log);
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

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['id'] 	= $id;
		$response['test'] 	= $type;
		if (strlen($id)>0) {
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_sj_returdet', NULL, $data_det);
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
		$arrDate = explode('/', $this->input->post('sj_retur_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'sj_retur_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('sj_retur_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['sj_retur_revised'] + 1;
		}
		if ($type == 1) {
			$sj_retur_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 			=> $this->session->userdata('cabang_id'),
				'sj_retur_nomor' 		=> $sj_retur_nomor,
				'sj_retur_tanggal'		=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				't_surat_jalan_id'	=> $this->input->post('t_surat_jalan_id', TRUE),
				'sj_retur_alasan'		=> $this->input->post('sj_retur_alasan', TRUE),
				'sj_retur_catatan'		=> $this->input->post('sj_retur_catatan', TRUE),
				'sj_retur_created_date'	=> date('Y-m-d H:i:s'),
				'sj_retur_updated_date'	=> date('Y-m-d H:i:s'),
				'sj_retur_created_by'	=> $this->session->userdata('user_username'),
				'sj_retur_revised' 		=> 0,
			);
		}
		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if (@$where['data']) {
			unset($where['data']);
		}
		$where['data'][] = array(
			'column' => 'sj_returdet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('sj_returdet_revised', 't_sj_returdet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['sj_returdet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_sj_retur_id' 			=> $idHdr,
				't_po_customerdet_id'		=> $this->input->post('t_po_customerdet_id', TRUE)[$seq],
				'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$seq],
				'sj_returdet_qty'			=> $this->input->post('sj_returdet_qty', TRUE)[$seq],
				'sj_returdet_qty_retur'		=> $this->input->post('sj_returdet_qty_retur', TRUE)[$seq],
				'sj_returdet_created_date'	=> date('Y-m-d H:i:s'),
				'sj_returdet_created_by'	=> $this->session->userdata('user_username'),
				'sj_returdet_updated_date'	=> date('Y-m-d H:i:s'),
				'sj_returdet_revised' 		=> 0,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(sj_retur_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(sj_retur_nomor,1,9)',
			'param'	 => 'SJR'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'sj_retur_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('SJR',$query);
		return $kode_baru;
	}
	/* end Function */

}