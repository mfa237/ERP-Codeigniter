<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_work_order extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_order';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		// $this->view();
	}

	public function view($type){
		$this->check_session();

		if ($type == 1) {
			$priv = $this->cekUser(28);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Pembelian',
				'title_page2' 	=> 'Work Order',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('work-order/V_work_order', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		} else if ($type == 2) {
			$priv = $this->cekUser(30);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Persetujuan',
				'title_page2' 	=> 'Work Order',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('work-order/V_work_order2', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		}		
	}

	public function loadData($type){
		$privPembelian = $this->cekUser(28);
		$priv = $this->cekUser(30);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, order_nomor, penawaran_nomor, order_tanggal, order_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		$where['data'][] = array(
			'column' => 'order_type',
			'param'	 => 1
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_order');
		$query_filter = $this->mod->select($select, 'v_order', NULL, $where, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_order', NULL, $where, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($type == 1) {
					if($privPembelian['update'] == 1)
					{
						if(($val->order_status_nama == 'WO Baru') || ($val->order_status_nama == 'WO Diterima ') || ($val->order_status_nama == 'WO Tidak Disetujui'))
						{
							$button = $button.'<a href="'.base_url().'Pembelian/Work-Order/EditForm/'.$val->order_id.'">
							<button class="btn blue-ebonyclay" type="button" title="Edit WO">
								<i class="icon-pencil text-center"></i>
							</button>
							</a>';
						}
					}
					
					$button = $button.'
					<a href="'.base_url().'Pembelian/Work-Order/Form/'.$val->order_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat WO">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Pembelian/Work-Order/print-WO/'.$val->order_id.'">
					<button class="btn green-jungle" type="button" title="Print WO">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					if($val->order_status_nama == 'WO Disetujui')
					{
						$button = $button.'
						<button class="btn red-thunderbird" type="button" title="Batalkan Persetujuan WO" onclick="batalkanWO('.$val->order_id.')">
							<i class="icon-power text-center"></i>
						</button>';
					}
					$button = $button.'
					<a href="'.base_url().'Persetujuan/Work-Order/Form/'.$val->order_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat WO" onclick="checkStatusWO('.$val->order_id.')">
						<i class="icon-eye text-center"></i>
					</button>
					<a href="'.base_url().'Persetujuan/Work-Order/print-WO/'.$val->order_id.'">
					<button class="btn green-jungle" type="button" title="Print WO">
						<i class="icon-printer text-center"></i>
					</button>
					</a>
					';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->order_nomor,
					$val->penawaran_nomor,
					date("d/m/Y",strtotime($val->order_tanggal)),
					$val->order_status_nama,
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
			'title_page2' 	=> 'Work Order',
			'id'			=> $id
		);
		$this->open_page('work-order/V_form_work_order', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Persetujuan',
			'title_page2' 	=> 'Work Order',
			'id'			=> $id
		);
		$this->open_page('work-order/V_form_work_order2', $data);
	}

	public function getForm3($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Pembelian',
			'title_page2' 	=> 'Work Order',
			'id'			=> $id,
			'edit'			=> 1
		);
		$this->open_page('work-order/V_form_work_order', $data);
	}

	public function loadDataWhere($type){
		$select = '*';
		$where['data'][] = array(
			'column' => 'order_id',
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
					'column' => 'a.t_order_id',
					'param'	 => $val->order_id
				);
				$query_det = $this->mod->select('a.*, b.*, c.*, d.*','t_orderdet a',$join_det,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'orderdet_id'				=> $val2->orderdet_id,
							't_order_id'				=> $val2->t_order_id,
							'm_barang_id'				=> $val2->m_barang_id,
							'barang_kode'				=> $val2->barang_kode,
							'barang_nama'				=> $val2->barang_nama,
							'barang_uraian'				=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'orderdet_qty'				=> $val2->orderdet_qty,
							'orderdet_qty_realisasi'	=> $val2->orderdet_qty_realisasi,
							'orderdet_status'			=> $val2->orderdet_status,
							'satuan_nama'				=> $val2->satuan_nama,
							'orderdet_harga_satuan'		=> $val2->orderdet_harga_satuan,
							'orderdet_total'			=> $val2->orderdet_total,
						);
					}
				}
				// END CARI DETAIL
				// CARI PENYETUJU
				$hasil1['val2'] = array();
				$where_partner['data'][] = array(
					'column' => 'partner_id',
					'param'	 => $val->m_supplier_id
				);
				$query_partner = $this->mod->select('*','m_partner',NULL,$where_partner);
				if ($query_partner) {
					foreach ($query_partner->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->partner_id,
							'text' 	=> $val2->partner_nama
						);
					}
				}
				// END CARI PENYETUJU
				// CARI PENERIMA
				$hasil2['val2'] = array();
				$where_penawaran['data'][] = array(
					'column' => 'penawaran_id',
					'param'	 => $val->order_referensi_id
				);
				$query_penawaran = $this->mod->select('*','t_penawaran',NULL,$where_penawaran);
				if ($query_penawaran) {
					foreach ($query_penawaran->result() as $val2) {
						$hasil2['val2'][] = array(
							'id' 	=> $val2->penawaran_id,
							'text' 	=> $val2->penawaran_nomor
						);
					}
				}
				// END CARI PENERIMA

				$response['val'][] = array(
					'kode' 						=> $val->order_id,
					'order_nomor' 				=> $val->order_nomor,
					'order_tanggal'				=> date("d/m/Y",strtotime($val->order_tanggal)),
					'order_type' 				=> $val->order_type,
					'order_status' 				=> $val->order_status,
					'm_supplier_id' 			=> $hasil1,
					'order_referensi_id' 		=> $hasil2,
					'order_nama_dikirim' 		=> $val->order_nama_dikirim,
					'order_alamat_dikirim' 		=> $val->order_alamat_dikirim,
					'order_hp_fax' 				=> $val->order_hp_fax,
					'order_subtotal' 			=> $val->order_subtotal,
					'order_ppn' 				=> $val->order_ppn,
					'order_total' 				=> $val->order_total,
					'order_tanggal_kirim'		=> date("d/m/Y",strtotime($val->order_tanggal_kirim)),
					'order_pembayaran'			=> $val->order_pembayaran,
				);
			}

			echo json_encode($response);
		}
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

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'order_id',
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
					'column' => 'a.t_order_id',
					'param'	 => $val->order_id
				);
				$query_det = $this->mod->select('a.*, b.*, c.*, d.*','t_orderdet a',$join_det,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {

						$response['val2'][] = array(
							'orderdet_id'				=> $val2->orderdet_id,
							't_order_id'				=> $val2->t_order_id,
							'm_barang_id'				=> $val2->m_barang_id,
							'barang_kode'				=> $val2->barang_kode,
							'barang_uraian'				=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'orderdet_qty'				=> $val2->orderdet_qty,
							'satuan_nama'				=> $val2->satuan_nama,
							'orderdet_harga_satuan'		=> $val2->orderdet_harga_satuan,
							'orderdet_total'			=> $val2->orderdet_total,
						);
					}
				}
				// END CARI DETAIL
				// CARI PENYETUJU
				$hasil1['val2'] = array();
				$where_partner['data'][] = array(
					'column' => 'partner_id',
					'param'	 => $val->m_supplier_id
				);
				$query_partner = $this->mod->select('*','m_partner',NULL,$where_partner);
				if ($query_partner) {
					foreach ($query_partner->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 		=> $val2->partner_id,
							'text' 		=> $val2->partner_nama,
							'alamat'	=> $val2->partner_alamat,
							'telp'		=> implode(', ', json_decode($val2->partner_telepon))
						);
					}
				}
				// END CARI PENYETUJU
				// CARI PENERIMA
				$hasil2['val2'] = array();
				$where_penawaran['data'][] = array(
					'column' => 'penawaran_id',
					'param'	 => $val->order_referensi_id
				);
				$query_penawaran = $this->mod->select('*','t_penawaran',NULL,$where_penawaran);
				if ($query_penawaran) {
					foreach ($query_penawaran->result() as $val2) {
						$hasil2['val2'][] = array(
							'id' 	=> $val2->penawaran_id,
							'text' 	=> $val2->penawaran_nomor
						);
					}
				}
				// END CARI PENERIMA
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
				// END CARI CABANG
				$name = $val->order_nomor;
				$response['val'][] = array(
					'kode' 						=> $val->order_id,
					'order_nomor' 				=> $val->order_nomor,
					'order_tanggal'				=> date("d/m/Y",strtotime($val->order_tanggal)),
					'order_type' 				=> $val->order_type,
					'order_status' 				=> $val->order_status,
					'm_supplier_id' 			=> $hasil1,
					'order_referensi_id' 		=> $hasil2,
					'cabang' 					=> $hasil3,
					'order_nama_dikirim' 		=> $val->order_nama_dikirim,
					'order_alamat_dikirim' 		=> $val->order_alamat_dikirim,
					'order_hp_fax' 				=> $val->order_hp_fax,
					'order_subtotal' 			=> $val->order_subtotal,
					'order_ppn' 				=> $val->order_ppn,
					'order_total' 				=> $val->order_total,
					'order_terbilang' 			=> $this->terbilang($val->order_total),
					'order_tanggal_kirim'		=> date("d/m/Y",strtotime($val->order_tanggal_kirim)),
					'order_pembayaran'			=> $val->order_pembayaran,
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Work Order',
			'title_page2' 	=> 'Print WO',
		);
		
		$this->pdf->load_view('print/P_wo', $response);
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
	public function loadData_select(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'order_status >= ',
			'param'	 => 3
		);
		$where['data'][] = array(
			'column' => 'order_status <= ',
			'param'	 => 4
		);
		$where['data'][] = array(
			'column' => 'order_type',
			'param'	 => 1
		);
		$where_like['data'][] = array(
			'column' => 'order_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'order_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->order_id,
					'text'	=> $val->order_nomor
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
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
		$response['test'] = $type;
		if (strlen($id)>0) {
			if ($type == 2) {
				//UPDATE
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'order_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}
			} else if ($type == 3) {
				//UPDATE
				$data = $this->general_post_data(4, $id);
				$where['data'][] = array(
					'column' => 'order_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 

						$iddet = $this->input->post('orderdet_id', TRUE)[$i];
						$response['id'] = $iddet;
						$data_det = $this->general_post_data2(3, null, $i, $iddet);
						$where_det['data'][] = array(
							'column' => 'orderdet_id',
							'param'	 => $iddet
						); 
						// $insert_det = $this->mod->insert_data_table('t_orderdet', NULL, $data_det);
						$update_det = $this->mod->update_data_table('t_orderdet', $where_det, $data_det);
						if($update_det->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
				} else {
					$response['status'] = '204';
				}
			} else if ($type == 4) {
				if (@$where_po['data']) {
					unset($where_po['data']);
				}
				$where_po['data'][] = array(
					'column' => 'order_id',
					'param'	 => $id
				);
				
				// INSERT t_orderlog
				$query_po = $this->mod->select('*', 't_order', NULL, $where_po);
				if ($query_po) {
					foreach ($query_po->result() as $row) {
						$data_log = array(
							'referensi_id' 									=> $row->order_id,
							'orderlog_status_dari' 			=> $row->order_status,
							'orderlog_status_ke' 			=> 3,
							'orderlog_status_update_date' 	=> date('Y-m-d H:i:s'),
							'orderlog_status_update_by'		=> $this->session->userdata('user_username'),
						);
						$insert_log = $this->mod->insert_data_table('t_orderlog', NULL, $data_log);
					}
				}
				// END INSERT t_orderlog

				//UPDATE
				$data = array(
					'order_status' => 2,
				);
				$where['data'][] = array(
					'column' => 'order_id',
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
				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_orderdet', NULL, $data_det);
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
		$arrDate = explode('/', $this->input->post('order_tanggal', TRUE));
		$arrDate2 = explode('/', $this->input->post('order_tanggal_kirim', TRUE));
		$where['data'][] = array(
			'column' => 'order_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('order_status, order_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['order_revised'] + 1;
			$status = $revised['order_status'];
		}
		if ($type == 1) {
			$order_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 				=> $this->session->userdata('cabang_id'),
				'order_nomor' 				=> $order_nomor,
				'order_tanggal'				=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'order_referensi_id'		=> $this->input->post('order_referensi_id', TRUE),
				'order_type' 				=> $this->input->post('order_type', TRUE),
				'm_supplier_id'				=> $this->input->post('m_supplier_id', TRUE),
				'order_nama_dikirim'		=> $this->input->post('order_nama_dikirim', TRUE),
				'order_alamat_dikirim'		=> $this->input->post('order_alamat_dikirim', TRUE),
				'order_hp_fax'				=> $this->input->post('order_hp_fax', TRUE),
				'order_subtotal'			=> $this->input->post('order_subtotal', TRUE),
				'order_ppn'					=> $this->input->post('order_ppn', TRUE),
				'order_total'				=> $this->input->post('order_total', TRUE),
				'order_tanggal_kirim'		=> $arrDate2[2]."-".$arrDate2[1]."-".$arrDate2[0],
				'order_pembayaran'			=> $this->input->post('order_pembayaran', TRUE),
				'order_status' 				=> 1,
				'order_status_date'			=> date('Y-m-d H:i:s'),
				'order_created_date'		=> date('Y-m-d H:i:s'),
				'order_update_date'			=> date('Y-m-d H:i:s'),
				'order_created_by'			=> $this->session->userdata('user_username'),
				'order_revised' 			=> 0,
			);
		} else if ($type == 2) {
			if ($status == $this->input->post('order_status', TRUE)) {
				$data = array(
					'order_update_date'	=> date('Y-m-d H:i:s'),
					'order_update_by'	=> $this->session->userdata('user_username'),
					'order_revised' 	=> $rev,
				);
			} else {
				$data = array(
					'order_status' 		=> $this->input->post('order_status', TRUE),
					'order_update_date'	=> date('Y-m-d H:i:s'),
					'order_update_by'	=> $this->session->userdata('user_username'),
					'order_revised' 	=> $rev,
				);
			}
		} else if ($type == 3) {
			$data = array(
				'order_status'		=> 2,
				'order_status_date'	=> date('Y-m-d H:i:s'),
				'order_update_date'	=> date('Y-m-d H:i:s'),
				'order_update_by'	=> $this->session->userdata('user_username'),
				'order_revised' 		=> $rev,
			);
		} else if ($type == 4) {
			// $arrDate2 = explode('/', );
			$data = array(
				'm_cabang_id' 				=> $this->session->userdata('cabang_id'),
				// 'order_nomor' 				=> $order_nomor,
				// 'order_tanggal'				=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'order_referensi_id'		=> $this->input->post('order_referensi_id', TRUE),
				'order_type' 				=> $this->input->post('order_type', TRUE),
				'm_supplier_id'				=> $this->input->post('m_supplier_id', TRUE),
				'order_nama_dikirim'		=> $this->input->post('order_nama_dikirim', TRUE),
				'order_alamat_dikirim'		=> $this->input->post('order_alamat_dikirim', TRUE),
				'order_hp_fax'				=> $this->input->post('order_hp_fax', TRUE),
				'order_subtotal'			=> $this->input->post('order_subtotal', TRUE),
				'order_ppn'					=> $this->input->post('order_ppn', TRUE),
				'order_total'				=> $this->input->post('order_total', TRUE),
				'order_tanggal_kirim'		=> date('Y-m-d', $this->input->post('order_tanggal_kirim', TRUE)),
				'order_pembayaran'			=> $this->input->post('order_pembayaran', TRUE),
				'order_status' 				=> 6,
				'order_status_date'			=> date('Y-m-d H:i:s'),
				// 'order_created_date'		=> date('Y-m-d H:i:s'),
				'order_update_date'			=> date('Y-m-d H:i:s'),
				'order_update_by'			=> $this->session->userdata('user_username'),
				// 'order_created_by'			=> $this->session->userdata('user_username'),
				'order_revised' 			=> $rev,
			);
		} else if ($type == 5) {
			$data = array(
				'order_status'		=> -1,
				'order_status_date'	=> date('Y-m-d H:i:s'),
				'order_update_date'	=> date('Y-m-d H:i:s'),
				'order_update_by'	=> $this->session->userdata('user_username'),
				'order_revised' 	=> $rev,
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
			'column' => 'orderdet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('orderdet_revised', 't_orderdet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['orderdet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_order_id' 			=> $idHdr,
				'm_barang_id' 			=> $this->input->post('m_barang_id', TRUE)[$seq],
				'orderdet_qty' 			=> $this->input->post('orderdet_qty', TRUE)[$seq],
				'orderdet_harga_satuan'	=> $this->input->post('orderdet_harga_satuan', TRUE)[$seq],
				'orderdet_total'		=> $this->input->post('orderdet_total', TRUE)[$seq],
				'orderdet_created_date'	=> date('Y-m-d H:i:s'),
				'orderdet_created_by'	=> $this->session->userdata('user_username'),
				'orderdet_update_date'	=> date('Y-m-d H:i:s'),
				'orderdet_revised' 		=> 0,
			);
		} else if ($type == 2) {
			// if ($status == $this->input->post('orderdet_status', TRUE)[$seq]) {
			// 	$data = array(
			// 		'orderdet_qty_realisasi'	=> ($this->input->post('orderdet_qty_realisasi', TRUE)[$seq] + $this->input->post('orderdet_qty_kirim', TRUE)[$seq]),
			// 		'orderdet_update_date'		=> date('Y-m-d H:i:s'),
			// 		'orderdet_update_by'		=> $this->session->userdata('user_username'),
			// 		'orderdet_revised' 			=> $rev,
			// 	);	
			// } else {
			// 	$data = array(
			// 		'orderdet_qty_realisasi'	=> ($this->input->post('orderdet_qty_realisasi', TRUE)[$seq] + $this->input->post('orderdet_qty_kirim', TRUE)[$seq]),
			// 		'orderdet_status' 			=> $this->input->post('orderdet_status', TRUE)[$seq],
			// 		'orderdet_status_date'		=> date('Y-m-d H:i:s'),
			// 		'orderdet_update_date'		=> date('Y-m-d H:i:s'),
			// 		'orderdet_update_by'		=> $this->session->userdata('user_username'),
			// 		'orderdet_revised' 			=> $rev,
			// 	);	
			// }
		} else if($type == 3) {
			$data = array(
				'm_barang_id' 			=> $this->input->post('m_barang_id', TRUE)[$seq],
				'orderdet_qty' 			=> $this->input->post('orderdet_qty', TRUE)[$seq],
				'orderdet_harga_satuan'	=> $this->input->post('orderdet_harga_satuan', TRUE)[$seq],
				'orderdet_total'		=> $this->input->post('orderdet_total', TRUE)[$seq],
				'orderdet_update_by'	=> $this->session->userdata('user_username'),
				'orderdet_update_date'	=> date('Y-m-d H:i:s'),
				'orderdet_revised' 		=> $rev,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(order_nomor,9,5) as id';
		$where['data'][] = array(
			'column' => 'MID(order_nomor,1,8)',
			'param'	 => 'WO'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'order_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('WO',$query);
		return $kode_baru;
	}
	/* end Function */

}
