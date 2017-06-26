<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_retur_penjualan extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_retur_penjualan';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view($type){
		$this->check_session();

		if ($type == 1) {
			$priv = $this->cekUser(72);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Marketing',
				'title_page2' 	=> 'Klaim/Retur Penjualan',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('retur-penjualan/V_retur_penjualan', $data);
			}
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			$priv = $this->cekUser(73);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Penjualan',
				'title_page2' 	=> 'Klaim/Retur Penjualan',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('retur-penjualan/V_retur_penjualan2', $data);
			}
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 3) {
			$priv = $this->cekUser(74);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Persetujuan',
				'title_page2' 	=> 'Klaim/Retur Penjualan',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('retur-penjualan/V_retur_penjualan3', $data);
			}
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		}		
	}

	public function loadData($type){
		$response['data'] = array();
		$response['recordsTotal'] = 0;
		$response['recordsFiltered'] = 0;
		// if ($type == 1) {
			$priv = $this->cekUser(72);
			$select = '*';
			//LIMIT
			$limit = array(
				'start'  => $this->input->get('start'),
				'finish' => $this->input->get('length')
			);
			//WHERE LIKE
			$where_like['data'][] = array(
				'column' => 'cabang_nama, retur_penjualan_nomor, retur_penjualan_tanggal, retur_penjualan_status_nama',
				'param'	 => $this->input->get('search[value]')
			);
			//ORDER
			$index_order = $this->input->get('order[0][column]');
			$order['data'][] = array(
				'column' => $this->input->get('columns['.$index_order.'][name]'),
				'type'	 => $this->input->get('order[0][dir]')
			);

			$query_total = $this->mod->select($select, 'v_retur_penjualan');
			$query_filter = $this->mod->select($select, 'v_retur_penjualan', NULL, NULL, NULL, $where_like, $order);
			$query = $this->mod->select($select, 'v_retur_penjualan', NULL, NULL, NULL, $where_like, $order, $limit);

			$response['data'] = array();
			if ($query<>false) {
				$no = $limit['start']+1;
				foreach ($query->result() as $val) {
					// $button = '';
					if ($type == 1) {
						$button = '
						<a href="'.base_url().'Marketing/Klaim-Retur-Penjualan/Form/'.$val->retur_penjualan_id.'">
						<button class="btn blue-ebonyclay" type="button" title="Lihat Klaim/Retur Penjualan">
							<i class="icon-eye text-center"></i>
						</button>
						</a>';
						// <a href="'.base_url().'Marketing/Klaim-Retur-Penjualan/print-Penawaran/'.$val->retur_penjualan_id.'">
						// <button class="btn green-jungle" type="button" title="Print PO Customer">
						// 	<i class="icon-printer text-center"></i>
						// </button>
						// </a>';
					} else if ($type == 2) {
						$button = '
						<a href="'.base_url().'Penjualan/Klaim-Retur-Penjualan/Form/'.$val->retur_penjualan_id.'">
						<button class="btn blue-ebonyclay" type="button" title="Lihat Klaim/Retur Penjualan">
							<i class="icon-eye text-center"></i>
						</button>
						</a>
						<a href="'.base_url().'Penjualan/Klaim-Retur-Penjualan/print-Klaim-Retur/'.$val->retur_penjualan_id.'">
						<button class="btn green-jungle" type="button" title="Print PO Customer">
							<i class="icon-printer text-center"></i>
						</button>
						</a>';
					} else if ($type == 3) {
						$button = '
						<a href="'.base_url().'Persetujuan/Klaim-Retur-Penjualan/Form/'.$val->retur_penjualan_id.'">
						<button class="btn blue-ebonyclay" type="button" title="Lihat Klaim/Retur Penjualan">
							<i class="icon-eye text-center"></i>
						</button>
						</a>';
						// <a href="'.base_url().'Marketing/Klaim-Retur-Penjualan/print-Penawaran/'.$val->retur_penjualan_id.'">
						// <button class="btn green-jungle" type="button" title="Print PO Customer">
						// 	<i class="icon-printer text-center"></i>
						// </button>
						// </a>';
					}

					$response['data'][] = array(
						$no,
						$val->cabang_nama,
						$val->retur_penjualan_nomor,
						date("d/m/Y",strtotime($val->retur_penjualan_tanggal)),
						$val->retur_penjualan_status_nama,
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
		// }

		echo json_encode($response);
	}

	public function getForm1($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Marketing',
			'title_page2' 	=> 'Klaim/Retur Penjualan',
			'id'			=> $id
		);
		$this->open_page('retur-penjualan/V_form_retur_penjualan', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Penjualan',
			'title_page2' 	=> 'Klaim/Retur Penjualan',
			'id'			=> $id
		);
		$this->open_page('retur-penjualan/V_form_retur_penjualan2', $data);
	}

	public function getForm3($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Persetujuan',
			'title_page2' 	=> 'Klaim/Retur Penjualan',
			'id'			=> $id
		);
		$this->open_page('retur-penjualan/V_form_retur_penjualan3', $data);
	}

	public function loadDataWhere($type){
		$select = '*';
		$where['data'][] = array(
			'column' => 'retur_penjualan_id',
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
					'column' => 'a.t_retur_penjualan_id',
					'param'	 => $val->retur_penjualan_id
				);
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_retur_penjualandet a', $join_brg, $where_brg);
				$response['val2'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val2) {						
						$response['val2'][] = array(
							'retur_penjualandet_id'				=> $val2->retur_penjualandet_id,
							't_retur_penjualan_id'				=> $val2->t_retur_penjualan_id,
							'm_barang_id'						=> $val2->m_barang_id,
							'retur_penjualandet_qty'			=> $val2->retur_penjualandet_qty,
							'retur_penjualandet_batch_no'		=> $val2->retur_penjualandet_batch_no,
							'barang_kode'						=> $val2->barang_kode,
							'barang_nama'						=> $val2->barang_nama,
							'barang_uraian'						=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'satuan_nama'						=> $val2->satuan_nama,
						);
					}
				}

				// CARI SJ
				$hasil['val2'] = array();
				$where_sj['data'][] = array(
					'column' => 'sj_retur_id',
					'param'	 => $val->t_sj_retur_id
				);
				$query_sj = $this->mod->select('*','t_sj_retur',NULL,$where_sj);
				foreach ($query_sj->result() as $val2) {
					$hasil['val2'][] = array(
						'id' 	=> $val2->sj_retur_id,
						'text' 	=> $val2->sj_retur_nomor
					);
				}
				// END CARI SJ
				
				$response['val'][] = array(
					'kode' 											=> $val->retur_penjualan_id,
					'm_cabang_id'									=> $val->m_cabang_id,
					'retur_penjualan_nomor' 						=> $val->retur_penjualan_nomor,
					'retur_penjualan_tanggal'						=> date("d/m/Y",strtotime($val->retur_penjualan_tanggal)),
					't_sj_retur_id' 								=> $hasil,
					'retur_penjualan_status_pengembalianbarang' 	=> $val->retur_penjualan_status_pengembalianbarang,
					'retur_penjualan_aksi_bayar'					=> $val->retur_penjualan_aksi_bayar,
					'retur_penjualan_alasan'						=> $val->retur_penjualan_alasan,
					'retur_penjualan_status'						=> $val->retur_penjualan_status,
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
				'column' => 'retur_penjualan_status',
				'param'	 => 4
			);
			$where_like['data'][] = array(
				'column' => 'retur_penjualan_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'retur_penjualan_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->retur_penjualan_id,
						'text'	=> $val->retur_penjualan_nomor
					);
				}
				$response['status'] = '200';
			}
		} else if ($type == 2) {
			$param = $this->input->get('q');
			if ($param!=NULL) {
				$param = $this->input->get('q');
			} else {
				$param = "";
			}
			$select = '*';
			$where['data'][] = array(
				'column' => 'retur_penjualan_status',
				'param'	 => 4
			);
			$where['data'][] = array(
				'column' => 'retur_penjualan_status_pengembalianbarang',
				'param'	 => 1
			);
			$where_like['data'][] = array(
				'column' => 'retur_penjualan_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'retur_penjualan_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->retur_penjualan_id,
						'text'	=> $val->retur_penjualan_nomor
					);
				}
				$response['status'] = '200';
			}
		}
		echo json_encode($response);
	}

	public function cetakPDF($id){
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'retur_penjualan_id',
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
					'column' => 'a.t_retur_penjualan_id',
					'param'	 => $val->retur_penjualan_id
				);
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_retur_penjualandet a', $join_brg, $where_brg);
				$response['val2'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val2) {						
						$response['val2'][] = array(
							'retur_penjualandet_id'				=> $val2->retur_penjualandet_id,
							't_retur_penjualan_id'				=> $val2->t_retur_penjualan_id,
							'm_barang_id'						=> $val2->m_barang_id,
							'retur_penjualandet_qty'			=> $val2->retur_penjualandet_qty,
							'retur_penjualandet_batch_no'		=> $val2->retur_penjualandet_batch_no,
							'barang_kode'						=> $val2->barang_kode,
							'barang_nama'						=> $val2->barang_nama,
							'barang_uraian'						=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'satuan_nama'						=> $val2->satuan_nama,
						);
					}
				}

				// CARI SJ
				$hasil['val2'] = array();
				$hasil2['val2'] = array();
				$where_sj['data'][] = array(
					'column' => 'sj_retur_id',
					'param'	 => $val->t_sj_retur_id
				);
				$query_sj = $this->mod->select('*','t_sj_retur',NULL,$where_sj);
				if($query_sj){
					foreach ($query_sj->result() as $val2) {
						$where_suratJalan['data'][] = array(
							'column'	=> 'surat_jalan_id',
							'param'		=> $val2->t_surat_jalan_id
						);
						$query_suratJalan = $this->mod->select('*', 't_surat_jalan', null, $where_suratJalan);
						if($query_suratJalan)
						{
							foreach ($query_suratJalan->result() as $val3) {
								$hasil3['val2'] = array();
								$where_partner['data'][] = array(
									'column'	=> 'partner_id',
									'param'		=> $val3->m_partner_id
								);
								$query_partner = $this->mod->select('*', 'm_partner', null, $where_partner);
								if($query_partner)
								{
									foreach ($query_partner->result() as $val4) {
										$hasil3['val2'][] = array(
											'id'		=> $val4->partner_id,
											'text'		=> $val4->partner_nama,
											'alamat'	=> $val4->partner_alamat,
											'telp'		=> json_decode($val4->partner_telepon),
										);
									}
								}
								$idRef = json_decode($val3->t_so_customer_id);
								for($j = 0; $j < sizeof($idRef); $j++)
								{
									if(@$where_det['data'])
									{
										unset($where_det['data']);
									}
									$where_det['data'][] = array(
										'column' => 'so_customer_id',
										'param'	 => $idRef[$j]
									);
									$query_order = $this->mod->select('*','t_so_customer',null,$where_det);
									if ($query_order) {
										foreach ($query_order->result() as $val5) {
											$hasil4['val2'][] = array(
												'id' 		=> $val5->so_customer_id,
												'text' 		=> $val5->so_customer_nomor,
												'tanggal'	=> date('d/m/Y', strtotime($val5->so_customer_tanggal)),
											);
										}
									}
								}
								$hasil2['val2'][] = array(
									'id'				=> $val3->surat_jalan_id,
									'text'				=> $val3->surat_jalan_nomor,
									'tanggal'			=> date('d/m/Y', strtotime($val3->surat_jalan_tanggal)),
									'so_customer_id'	=> $hasil4,
									'm_partner_id'		=> $hasil3
								);
							}
						}
						$hasil['val2'][] = array(
							'id' 	=> $val2->sj_retur_id,
							'text' 	=> $val2->sj_retur_nomor
						);
					}
					// END CARI SJ
				}

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
				$name = $val->retur_penjualan_nomor;
				$response['val'][] = array(
					'kode' 											=> $val->retur_penjualan_id,
					'cabang'										=> $hasil6,
					'retur_penjualan_nomor' 						=> $val->retur_penjualan_nomor,
					'retur_penjualan_tanggal'						=> date("d/m/Y",strtotime($val->retur_penjualan_tanggal)),
					't_sj_retur_id' 								=> $hasil,
					't_surat_jalan_id'								=> $hasil2,
					'retur_penjualan_status_pengembalianbarang' 	=> $val->retur_penjualan_status_pengembalianbarang,
					'retur_penjualan_aksi_bayar'					=> $val->retur_penjualan_aksi_bayar,
					'retur_penjualan_alasan'						=> $val->retur_penjualan_alasan,
					'retur_penjualan_status'						=> $val->retur_penjualan_status,
				);
			}
		}
		$response['title'][] = array(
		'aplikasi'		=> $this->app_name,
		'title_page' 	=> 'Klaim/Retur Customer',
		'title_page2' 	=> 'Print Klaim/Retur Customer',
		);
		// echo json_encode($response);
		// $this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_klaim_retur_customer', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['id'] 	= $id;
		$response['test'] 	= $type;
		$response['step'] 	= $this->input->post('step', TRUE);
		if (strlen($id)>0) {
			if ($type == 2) {
			} else {
				if (@$this->input->post('step', TRUE) == 2) {
					//UPDATE
					$data = $this->general_post_data(2, $id);
					$where['data'][] = array(
						'column' => 'retur_penjualan_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
				} else if (@$this->input->post('step', TRUE) == 3) {
					//UPDATE
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'retur_penjualan_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
				}
				$response['data'] 	= $data;
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
				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) { 
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_retur_penjualandet', NULL, $data_det);
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
			$response['nomor'] = $data['retur_penjualan_nomor'];
			$response['id'] = $insert->output;
		}
		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('retur_penjualan_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'retur_penjualan_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('retur_penjualan_status, retur_penjualan_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['retur_penjualan_revised'] + 1;
			$status = $revised['retur_penjualan_status'];
		}
		if ($type == 1) {
			$retur_penjualan_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 									=> $this->session->userdata('cabang_id'),
				'retur_penjualan_nomor' 						=> $retur_penjualan_nomor,
				'retur_penjualan_tanggal'						=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				't_sj_retur_id'									=> $this->input->post('t_sj_retur_id', TRUE),
				'retur_penjualan_status_pengembalianbarang'		=> $this->input->post('retur_penjualan_status_pengembalianbarang', TRUE),
				'retur_penjualan_aksi_bayar'					=> $this->input->post('retur_penjualan_aksi_bayar', TRUE),
				'retur_penjualan_alasan'						=> $this->input->post('retur_penjualan_alasan', TRUE),
				'retur_penjualan_status' 						=> $this->input->post('retur_penjualan_status', TRUE),
				'retur_penjualan_created_date'					=> date('Y-m-d H:i:s'),
				'retur_penjualan_updated_date'					=> date('Y-m-d H:i:s'),
				'retur_penjualan_created_by'					=> $this->session->userdata('user_username'),
				'retur_penjualan_revised' 						=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'retur_penjualan_status' 		=> $this->input->post('retur_penjualan_status', TRUE),
				'retur_penjualan_updated_date'	=> date('Y-m-d H:i:s'),
				'retur_penjualan_updated_by'	=> $this->session->userdata('user_username'),
				'retur_penjualan_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'retur_penjualan_status' 		=> $this->input->post('retur_penjualan_status', TRUE),
				'retur_penjualan_updated_date'	=> date('Y-m-d H:i:s'),
				'retur_penjualan_updated_by'	=> $this->session->userdata('user_username'),
				'retur_penjualan_revised' 		=> $rev,
			);
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
				't_retur_penjualan_id' 				=> $idHdr,
				'm_barang_id' 						=> $this->input->post('m_barang_id', TRUE)[$seq],
				'retur_penjualandet_qty' 			=> $this->input->post('retur_penjualandet_qty', TRUE)[$seq],
				'retur_penjualandet_batch_no'		=> $this->input->post('retur_penjualandet_batch_no', TRUE)[$seq],
				'retur_penjualandet_created_date'	=> date('Y-m-d H:i:s'),
				'retur_penjualandet_created_by'		=> $this->session->userdata('user_username'),
				'retur_penjualandet_updated_date'	=> date('Y-m-d H:i:s'),
				'retur_penjualandet_revised' 		=> 0,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(retur_penjualan_nomor,11,5) as id';
		$where['data'][] = array(
			'column' => 'MID(retur_penjualan_nomor,1,10)',
			'param'	 => 'RESO'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'retur_penjualan_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('RESO',$query);
		return $kode_baru;
	}
	/* end Function */

}
