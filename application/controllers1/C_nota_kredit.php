<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_nota_kredit extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_nota_kredit';

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
				'title_page' 	=> 'Penjualan',
				'title_page2' 	=> 'Nota Kredit',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('nota-kredit/V_nota_kredit', $data);
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
			// 	'title_page2' 	=> 'Nota Kredit',
			// 	'priv_add'		=> $priv['create']
			// 	);
			// if($priv['read'] == 1)
			// {
			// 	$this->open_page('nota-kredit/V_nota_kredit2', $data);
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
			'column' => 'cabang_nama, nota_kredit_nomor, nomor_refrensi, nota_kredit_tanggal',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_nota_kredit');
		$query_filter = $this->mod->select($select, 'v_nota_kredit', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_nota_kredit', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				// $button = '';
				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Penjualan/Nota-Kredit/Form/'.$val->nota_kredit_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat SO Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Penjualan/Nota-Kredit/print-Nota-Kredit/'.$val->nota_kredit_id.'">
					<button class="btn green-jungle" type="button" title="Print PS Customer">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Persetujuan/Nota-Kredit/Form/'.$val->nota_kredit_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PS Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>';
					// <a href="'.base_url().'Marketing/Nota-Kredit/print-Penawaran/'.$val->nota_kredit_id.'">
					// <button class="btn green-jungle" type="button" title="Print PS Customer">
					// 	<i class="icon-printer text-center"></i>
					// </button>
					// </a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->nota_kredit_nomor,
					$val->nomor_refrensi,
					date("d/m/Y",strtotime($val->nota_kredit_tanggal)),
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
			'title_page2' 	=> 'Nota Kredit',
			'id'			=> $id
		);
		$this->open_page('nota-kredit/V_form_nota_kredit', $data);
	}

	// public function getForm2($id = null){
	// 	$data = array(
	// 		'aplikasi'		=> $this->app_name,
	// 		'title_page' 	=> 'Persetujuan',
	// 		'title_page2' 	=> 'Nota Kredit',
	// 		'id'			=> $id
	// 	);
	// 	$this->open_page('nota-kredit/V_form_nota_kredit2', $data);
	// }

	public function loadDataWhere($type){
		$select = '*';
		$where['data'][] = array(
			'column' => 'nota_kredit_id',
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
					'column' => 'a.t_nota_kredit_id',
					'param'	 => $val->nota_kredit_id
				);
				$query_det = $this->mod->select('a.*, b.*, c.*, d.*','t_nota_kreditdet a',$join_det,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'nota_kreditdet_id'				=> $val2->nota_kreditdet_id,
							't_nota_kredit_id'				=> $val2->t_nota_kredit_id,
							'm_barang_id'					=> $val2->m_barang_id,
							'barang_kode'					=> $val2->barang_kode,
							'barang_nama'					=> $val2->barang_nama,
							'barang_uraian'					=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'nota_kreditdet_qty'			=> $val2->nota_kreditdet_qty,	
							'nota_kreditdet_harga_satuan'	=> $val2->nota_kreditdet_harga_satuan,
							'nota_kreditdet_discount'		=> $val2->nota_kreditdet_discount,
							'satuan_nama'					=> $val2->satuan_nama,
						);
					}
				}
				// END CARI DETAIL

				$hasil['val2'] = array();
				if ($val->nota_kredit_jenis == 0) {
					// CARI SJ
					$where_socustomer['data'][] = array(
						'column' => 'sj_retur_id',
						'param'	 => $val->referensi_id
					);
					$query_socustomer = $this->mod->select('*','t_sj_retur',NULL,$where_socustomer);
					foreach ($query_socustomer->result() as $val2) {
						$hasil['val2'][] = array(
							'id' 	=> $val2->sj_retur_id,
							'text' 	=> $val2->sj_retur_nomor
						);
					}
					// END CARI SJ
				}
				
				$response['val'][] = array(
					'kode' 						=> $val->nota_kredit_id,
					'm_cabang_id'				=> $val->m_cabang_id,
					'nota_kredit_nomor' 		=> $val->nota_kredit_nomor,
					'nota_kredit_jenis'			=> $val->nota_kredit_jenis,
					'nota_kredit_tanggal'		=> date("d/m/Y",strtotime($val->nota_kredit_tanggal)),
					'referensi_id'				=> $hasil,
					'nota_kredit_netto'			=> $val->nota_kredit_netto,
					'nota_kredit_ppn'			=> $val->nota_kredit_ppn,
					'nota_kredit_potongan_harga'=> $val->nota_kredit_potongan_harga,
					'nota_kredit_uang_muka'		=> $val->nota_kredit_uang_muka,
					'nota_kredit_total'			=> $val->nota_kredit_total,
					'nota_kredit_catatan'		=> $val->nota_kredit_catatan,
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
				'column' => 'nota_kredit_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'nota_kredit_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->nota_kredit_id,
						'text'	=> $val->nota_kredit_nomor
					);
				}
				$response['status'] = '200';
			}
		}

		echo json_encode($response);
	}

	public function loadData_pembayaran(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'nota_kredit_status_pembayaran',
			'param'	 => 1
		);
		$order['data'][] = array(
			'column' => 'nota_kredit_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, 't_nota_kredit', NULL, $where, NULL, NULL, $order);
		$response['val'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				if (@$join_dtl['data']) {
					unset($join_dtl['data']);
				}
				if (@$where_dtl['data']) {
					unset($where_dtl['data']);
				}
				if ($val->nota_kredit_jenis == 0) {
					$select_dtl = 'a.*, b.*, c.*';
					$join_dtl['data'][] = array(
						'table' => 't_sj_retur b',
						'join'	=> 'b.sj_retur_id = a.t_sj_retur_id',
						'type'	=> 'left'
					);
					$join_dtl['data'][] = array(
						'table' => 't_surat_jalan c',
						'join'	=> 'c.surat_jalan_id = b.t_surat_jalan_id',
						'type'	=> 'left'
					);
					$where_dtl['data'][] = array(
						'column' => 'a.retur_penjualan_id',
						'param'	 => $val->referensi_id
					);
					$where_dtl['data'][] = array(
						'column' => 'c.m_partner_id',
						'param'	 => $this->input->get('id')
					);
					$query_dtl = $this->mod->select($select_dtl, 't_retur_penjualan a', $join_dtl, $where_dtl);
					if ($query_dtl) {
						foreach ($query_dtl as $valdtl) {
							$response['val'][] = array(
								'id'		=> $val->nota_kredit_id,
								'nomor'		=> $val->nota_kredit_nomor,
								'jumlah'	=> floatval(floatval($val->nota_kredit_total) - floatval($val->nota_kredit_nominal_pembayaran))
							);
						}
					}
				} else if ($val->nota_kredit_jenis == 1) {
					$select_dtl = 'a.*, b.*, c.*';
					$join_dtl['data'][] = array(
						'table' => 't_retur_penjualan b',
						'join'	=> 'b.retur_penjualan_id = a.t_retur_penjualan_id',
						'type'	=> 'left'
					);
					$join_dtl['data'][] = array(
						'table' => 't_sj_retur c',
						'join'	=> 'c.sj_retur_id = b.t_sj_retur_id',
						'type'	=> 'left'
					);
					$join_dtl['data'][] = array(
						'table' => 't_surat_jalan d',
						'join'	=> 'd.surat_jalan_id = c.t_surat_jalan_id',
						'type'	=> 'left'
					);
					$where_dtl['data'][] = array(
						'column' => 'a.bpbr_id',
						'param'	 => $val->referensi_id
					);
					$where_dtl['data'][] = array(
						'column' => 'd.m_partner_id',
						'param'	 => $this->input->get('id')
					);
					$query_dtl = $this->mod->select($select_dtl, 't_bpbr a', $join_dtl, $where_dtl);
					if ($query_dtl) {
						foreach ($query_dtl as $valdtl) {
							$response['val'][] = array(
								'id'		=> $val->nota_kredit_id,
								'nomor'		=> $val->nota_kredit_nomor,
								'jumlah'	=> floatval(floatval($val->nota_kredit_total) - floatval($val->nota_kredit_nominal_pembayaran))
							);
						}
					}
				}
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function cetakPDF($id){
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'nota_kredit_id',
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
					'column' => 'a.t_nota_kredit_id',
					'param'	 => $val->nota_kredit_id
				);
				$query_det = $this->mod->select('a.*, b.*, c.*, d.*','t_nota_kreditdet a',$join_det,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'nota_kreditdet_id'				=> $val2->nota_kreditdet_id,
							't_nota_kredit_id'				=> $val2->t_nota_kredit_id,
							'm_barang_id'					=> $val2->m_barang_id,
							'barang_kode'					=> $val2->barang_kode,
							'barang_nama'					=> $val2->barang_nama,
							'barang_uraian'					=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'nota_kreditdet_qty'			=> $val2->nota_kreditdet_qty,	
							'nota_kreditdet_harga_satuan'	=> $val2->nota_kreditdet_harga_satuan,
							'nota_kreditdet_discount'		=> $val2->nota_kreditdet_discount,
							'satuan_nama'					=> $val2->satuan_nama,
						);
					}
				}
				// END CARI DETAIL
				$hasil['val2'] = array();
				$hasil2['val2'] = array();
				if ($val->nota_kredit_jenis == 0) {
					// CARI SJ
					$where_socustomer['data'][] = array(
						'column' => 'sj_retur_id',
						'param'	 => $val->referensi_id
					);
					$query_socustomer = $this->mod->select('*','t_sj_retur',NULL,$where_socustomer);
					if($query_socustomer){
						foreach ($query_socustomer->result() as $val2) {
							// CARI FAKTUR
							$join_faktur['data'][] = array(
								'table'	=> 't_surat_jalan b',
								'join'	=> 'b.surat_jalan_id = a.t_surat_jalan_id',
								'type'	=> 'left'	
							);
							$where_faktur['data'][] = array(
								'column' => 'a.t_surat_jalan_id',
								'param'	 => $val2->t_surat_jalan_id
							);
							$query_faktur = $this->mod->select('a.*, b.*','t_faktur_penjualan a',$join_faktur,$where_faktur);
							if ($query_faktur) {
								foreach ($query_faktur->result() as $val3) {
									if(@$where_partner['data'])
									{
										unset($where_partner['data']);
									}
									$where_partner['data'][] = array(
										'column' => 'partner_id',
										'param'	 => $val3->m_partner_id
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
												'npwp'		=> $val4->partner_nomor_npwp,	
											);
										}
									}
									$hasil2['val2'][] = array(
										'id' 			=> $val3->faktur_penjualan_id,
										'text' 			=> $val3->faktur_penjualan_nomor,
										'tanggal'		=> date('d/m/Y', strtotime($val3->faktur_penjualan_tanggal)),
										'ekspedisi'		=> $val3->surat_jalan_ekspedisi,
										'm_partner_id'	=> $hasil3,
									);
								}
							}
							// END CARI FAKTUR
							$hasil['val2'][] = array(
								'id' 		=> $val2->sj_retur_id,
								'text' 		=> $val2->sj_retur_nomor,
							);
						}
						// END CARI SJ
						
					}
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
						$hasil7['val3'] = array();
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
				$name = $val->nota_kredit_nomor;
				$response['val'][] = array(
					'kode' 						=> $val->nota_kredit_id,
					'm_cabang_id'				=> $val->m_cabang_id,
					'nota_kredit_nomor' 		=> $val->nota_kredit_nomor,
					'nota_kredit_jenis'			=> $val->nota_kredit_jenis,
					'nota_kredit_tanggal'		=> date("d/m/Y",strtotime($val->nota_kredit_tanggal)),
					'referensi_id'				=> $hasil,
					't_faktur_penjualan_id'		=> $hasil2,
					'nota_kredit_netto'			=> $val->nota_kredit_netto,
					'nota_kredit_ppn'			=> $val->nota_kredit_ppn,
					'nota_kredit_potongan_harga'=> $val->nota_kredit_potongan_harga,
					'nota_kredit_uang_muka'		=> $val->nota_kredit_uang_muka,
					'nota_kredit_total'			=> $val->nota_kredit_total,
					'nota_kredit_catatan'		=> $val->nota_kredit_catatan,
					'cabang'					=> $hasil6,
				);
			}
		}
		$response['title'][] = array(
		'aplikasi'		=> $this->app_name,
		'title_page' 	=> 'Nota Kredit',
		'title_page2' 	=> 'Print Nota Kredit',
		);
		// echo json_encode($response);
		// $this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_nota_kredit', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
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
					$insert_det = $this->mod->insert_data_table('t_nota_kreditdet', NULL, $data_det);
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
		$arrDate = explode('/', $this->input->post('nota_kredit_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'nota_kredit_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('nota_kredit_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['nota_kredit_revised'] + 1;
		}
		if ($type == 1) {
			$nota_kredit_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 						=> $this->session->userdata('cabang_id'),
				'nota_kredit_nomor' 			=> $nota_kredit_nomor,
				'nota_kredit_tanggal'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'nota_kredit_jenis'					=> $this->input->post('nota_kredit_jenis', TRUE),
				'referensi_id'					=> $this->input->post('referensi_id', TRUE),
				'nota_kredit_netto'				=> $this->input->post('nota_kredit_netto', TRUE),
				'nota_kredit_potongan_harga'	=> $this->input->post('nota_kredit_potongan_harga', TRUE),
				'nota_kredit_uang_muka'			=> $this->input->post('nota_kredit_uang_muka', TRUE),
				'nota_kredit_ppn'				=> $this->input->post('nota_kredit_ppn', TRUE),
				'nota_kredit_total'				=> $this->input->post('nota_kredit_total', TRUE),
				'nota_kredit_catatan'			=> $this->input->post('nota_kredit_catatan', TRUE),
				'nota_kredit_created_date'		=> date('Y-m-d H:i:s'),
				'nota_kredit_updated_date'		=> date('Y-m-d H:i:s'),
				'nota_kredit_created_by'		=> $this->session->userdata('user_username'),
				'nota_kredit_revised' 			=> 0,
			);
		// } else if ($type == 2) {
		// 	$data = array(
		// 		'so_customer_status' 		=> $this->input->post('so_customer_status', TRUE),
		// 		'so_customer_updated_date'	=> date('Y-m-d H:i:s'),
		// 		'so_customer_updated_by'	=> $this->session->userdata('user_username'),
		// 		'so_customer_revised' 		=> $rev,
		// 	);
		}

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if (@$where['data']) {
			unset($where['data']);
		}
		$where['data'][] = array(
			'column' => 'nota_kreditdet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('nota_kreditdet_revised', 't_nota_kreditdet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['nota_kreditdet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_nota_kredit_id' 				=> $idHdr,
				'm_barang_id'					=> $this->input->post('m_barang_id', TRUE)[$seq],
				'nota_kreditdet_qty'			=> $this->input->post('nota_kreditdet_qty', TRUE)[$seq],
				'nota_kreditdet_harga_satuan'	=> $this->input->post('nota_kreditdet_harga_satuan', TRUE)[$seq],
				'nota_kreditdet_discount'		=> $this->input->post('nota_kreditdet_discount', TRUE)[$seq],
				'nota_kreditdet_created_date'	=> date('Y-m-d H:i:s'),
				'nota_kreditdet_created_by'		=> $this->session->userdata('user_username'),
				'nota_kreditdet_updated_date'	=> date('Y-m-d H:i:s'),
				'nota_kreditdet_revised' 		=> 0,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(nota_kredit_nomor,14,5) as id';
		$where['data'][] = array(
			'column' => 'MID(nota_kredit_nomor,1,13)',
			'param'	 => 'NOTARET'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'nota_kredit_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('NOTARET',$query);
		return $kode_baru;
	}
	/* end Function */

}