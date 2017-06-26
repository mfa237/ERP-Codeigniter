<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_faktur_penjualan extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_faktur_penjualan';

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
				'title_page2' 	=> 'Faktur Penjualan',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('faktur-penjualan/V_faktur_penjualan', $data);
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
			// 	'title_page2' 	=> 'Faktur Penjualan',
			// 	'priv_add'		=> $priv['create']
			// 	);
			// if($priv['read'] == 1)
			// {
			// 	$this->open_page('faktur-penjualan/V_faktur_penjualan2', $data);
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
			'column' => 'cabang_nama, faktur_penjualan_nomor, faktur_penjualan_tanggal',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_faktur_penjualan');
		$query_filter = $this->mod->select($select, 'v_faktur_penjualan', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_faktur_penjualan', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				// $button = '';
				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Penjualan/Faktur-Penjualan/Form/'.$val->faktur_penjualan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat SO Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Penjualan/Faktur-Penjualan/print-Faktur-Penjualan/'.$val->faktur_penjualan_id.'">
					<button class="btn green-jungle" type="button" title="Print PS Customer">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Persetujuan/Faktur-Penjualan/Form/'.$val->faktur_penjualan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PS Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>';
					// <a href="'.base_url().'Marketing/Faktur-Penjualan/print-Penawaran/'.$val->faktur_penjualan_id.'">
					// <button class="btn green-jungle" type="button" title="Print PS Customer">
					// 	<i class="icon-printer text-center"></i>
					// </button>
					// </a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->faktur_penjualan_nomor,
					$val->so_customer_nomor,
					date("d/m/Y",strtotime($val->faktur_penjualan_tanggal)),
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
			'title_page2' 	=> 'Faktur Penjualan',
			'id'			=> $id
		);
		$this->open_page('faktur-penjualan/V_form_faktur_penjualan', $data);
	}

	// public function getForm2($id = null){
	// 	$data = array(
	// 		'aplikasi'		=> $this->app_name,
	// 		'title_page' 	=> 'Persetujuan',
	// 		'title_page2' 	=> 'Faktur Penjualan',
	// 		'id'			=> $id
	// 	);
	// 	$this->open_page('faktur-penjualan/V_form_faktur_penjualan2', $data);
	// }

	public function loadDataWhere($type){
		$select = '*';
		$where['data'][] = array(
			'column' => 'faktur_penjualan_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$where_det['data'][] = array(
					'column' => 't_faktur_penjualan_id',
					'param'	 => $val->faktur_penjualan_id
				);
				$query_det = $this->mod->select('*','t_faktur_penjualandet',NULL,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'faktur_penjualandet_id'		=> $val2->faktur_penjualandet_id,
							't_faktur_penjualan_id'			=> $val2->t_faktur_penjualan_id,
							'faktur_penjualandet_discount'	=> $val2->faktur_penjualandet_discount,
						);
					}
				}
				// END CARI DETAIL

				// CARI PO CUSTOMER
				$hasil['val2'] = array();
				$hasil2['val2'] = array();
				$where_sj['data'][] = array(
					'column' => 'surat_jalan_id',
					'param'	 => $val->t_surat_jalan_id
				);
				$query_sj = $this->mod->select('*','t_surat_jalan',NULL,$where_sj);
				foreach ($query_sj->result() as $val2) {
					$hasil['val2'][] = array(
						'id' 	=> $val2->surat_jalan_id,
						'text' 	=> $val2->surat_jalan_nomor
					);
					$idSO = json_decode($val2->t_so_customer_id);
					for($k = 0; $k < sizeof($idSO); $k++)
					{
						if(@$where_socustomer['data'])
						{
							unset($where_socustomer['data']);
						}
						$where_socustomer['data'][] = array(
							'column' => 'so_customer_id',
							'param'	 => $idSO[$k]
						);
						$query_socustomer = $this->mod->select('*', 't_so_customer', null, $where_socustomer);
						if($query_socustomer)
						{
							foreach ($query_socustomer->result() as $val3) {
								$hasil2['val2'][] = array(
									'id' 	=> $val3->so_customer_id,
									'text' 	=> $val3->so_customer_nomor
								);
							}
						}
					}
					
					
				}
				// END CARI PO CUSTOMER
				
				$response['val'][] = array(
					'kode' 								=> $val->faktur_penjualan_id,
					'm_cabang_id'						=> $val->m_cabang_id,
					'faktur_penjualan_nomor' 			=> $val->faktur_penjualan_nomor,
					'faktur_penjualan_tanggal'			=> date("d/m/Y",strtotime($val->faktur_penjualan_tanggal)),
					'faktur_penjualan_jatuh_tempo'		=> date("d/m/Y",strtotime($val->faktur_penjualan_jatuh_tempo)),
					't_so_customer_id'					=> $hasil2,
					't_surat_jalan_id'					=> $hasil,
					'faktur_penjualan_potongan'			=> $val->faktur_penjualan_potongan,
					'faktur_penjualan_uang_muka'		=> $val->faktur_penjualan_uang_muka,
					'faktur_penjualan_tujuan_transfer'	=> $val->faktur_penjualan_tujuan_transfer,
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
				'column' => 'faktur_penjualan_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'faktur_penjualan_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->faktur_penjualan_id,
						'text'	=> $val->faktur_penjualan_nomor
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
			'column' => 'faktur_penjualan_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join_det['data'][] = array(
					'table'	=> 't_po_customerdet b',
					'join'	=> 'b.po_customerdet_id = a.t_po_customerdet_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table'	=> 'm_barang c',
					'join'	=> 'c.barang_id = b.m_barang_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table'	=> 'm_jenis_barang d',
					'join'	=> 'd.jenis_barang_id = c.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table'	=> 'm_satuan e',
					'join'	=> 'e.satuan_id = c.m_satuan_id',
					'type'	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 'a.t_faktur_penjualan_id',
					'param'	 => $val->faktur_penjualan_id
				);
				$query_det = $this->mod->select('a.*, b.*, c.*, d.*, e.*','t_faktur_penjualandet a', $join_det, $where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'faktur_penjualandet_id'		=> $val2->faktur_penjualandet_id,
							't_faktur_penjualan_id'			=> $val2->t_faktur_penjualan_id,
							'm_barang_id'					=> $val2->m_barang_id,
							'barang_kode'					=> $val2->barang_kode,
							'barang_uraian'					=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'barang_nama'					=> $val2->barang_nama,
							'satuan_nama'					=> $val2->satuan_nama,
							'po_customerdet_qty'			=> $val2->po_customerdet_qty,
							'po_customerdet_harga_satuan'	=> $val2->po_customerdet_harga_satuan,
							'po_customerdet_keterangan'		=> $val2->po_customerdet_keterangan,
							'faktur_penjualandet_discount'	=> $val2->faktur_penjualandet_discount,
						);
					}
				}
				// END CARI DETAIL

				// CARI PO CUSTOMER
				$hasil['val2'] = array();
				$hasil4['val2'] = array();
				$where_sj['data'][] = array(
					'column' => 'surat_jalan_id',
					'param'	 => $val->t_surat_jalan_id
				);
				$query_sj = $this->mod->select('*','t_surat_jalan',NULL,$where_sj);
				foreach ($query_sj->result() as $val2) {
					$hasil['val2'][] = array(
						'id' 	=> $val2->surat_jalan_id,
						'text' 	=> $val2->surat_jalan_nomor
					);
					$idSO = json_decode($val2->t_so_customer_id);
					for($k = 0; $k < sizeof($idSO); $k++)
					{
						if(@$where_socustomer['data'])
						{
							unset($where_socustomer['data']);
						}
						$where_socustomer['data'][] = array(
							'column' => 'so_customer_id',
							'param'	 => $idSO[$k]
						);
						$query_socustomer = $this->mod->select('*', 't_so_customer', null, $where_socustomer);
						if($query_socustomer)
						{
							foreach ($query_socustomer->result() as $val3) {
								if(@$where_po['data'])
								{
									unset($where_po['data']);
								}
								$where_po['data'][] = array(
									'column' => 'po_customer_id',
									'param'	 => $val3->t_po_customer_id
								);
								$query_po = $this->mod->select('*', 't_po_customer', null, $where_po);
								if($query_po)
								{
									foreach ($query_po->result() as $val4) {
										$hasil3['val2'] = array();
										if(@$where_partner['data'])
										{
											unset($where_partner['data']);
										}
										$where_partner['data'][] = array(
											'column' => 'partner_id',
											'param'	 => $val4->m_partner_id
										);
										$query_partner = $this->mod->select('*', 'm_partner', null, $where_partner);
										if($query_partner)
										{
											foreach ($query_partner->result() as $val5) {
												$hasil5['val2'][] = array(
													'id'	=> $val5->partner_id,
													'text'	=> $val5->partner_nama,
													'alamat'	=> $val5->partner_alamat,
													// KURANG KOTA!
												);
											}
										}
										$hasil4['val2'][] = array(
											'id' 			=> $val4->po_customer_id,
											'text' 			=> $val4->po_customer_nomor,
											'm_partner_id'	=> $hasil5,
										);
									}
								}
								
							}
						}
					}
				}
				//END PO CUSTOMER
				$idBank = json_decode($val->faktur_penjualan_tujuan_transfer);
				for($j = 0; $j < sizeof($idBank); $j++)
				{
					if(@$where_det['data'])
					{
						unset($where_det['data']);
					}
					$where_det['data'][] = array(
						'column' => 'bank_id',
						'param'	 => $idBank[$j]
					);
					$query_bank = $this->mod->select('*','m_bank',null,$where_det);
					if ($query_bank) {
						foreach ($query_bank->result() as $val2) {
							$hasil3['val2'][] = array(
								'id' 		=> $val2->bank_id,
								'nama' 		=> $val2->bank_nama,
								'atasnama' 	=> $val2->bank_atas_nama,
								'norek' 	=> $val2->bank_no_rek,
							);
						}
					}
				}
					
				// }
				// END CARI PO CUSTOMER
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
				$name = $val->faktur_penjualan_nomor;
				$response['val'][] = array(
					'kode' 								=> $val->faktur_penjualan_id,
					'faktur_penjualan_nomor' 			=> $val->faktur_penjualan_nomor,
					'faktur_penjualan_tanggal'			=> date("d/m/Y",strtotime($val->faktur_penjualan_tanggal)),
					'cabang'							=> $hasil6,
					'faktur_penjualan_jatuh_tempo' 		=> date("d/m/Y",strtotime($val->faktur_penjualan_jatuh_tempo)),
					'faktur_penjualan_potongan' 		=> $val->faktur_penjualan_potongan,
					'faktur_penjualan_uang_muka' 		=> $val->faktur_penjualan_uang_muka,
					'faktur_penjualan_total' 			=> $val->faktur_penjualan_total,
					'faktur_penjualan_tujuan_transfer'	=> $hasil3,
					't_po_customer'						=> $hasil4,
					't_surat_jalan'						=> $hasil,
				);
			}
		}
		$response['title'][] = array(
		'aplikasi'		=> $this->app_name,
		'title_page' 	=> 'Faktur Penjualan',
		'title_page2' 	=> 'Print Faktur Penjualan',
		);
		// echo json_encode($response);
		$this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_faktur_penjualan', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['id'] 	= $id;
		$response['test'] 	= $type;
		if (strlen($id)>0) {
			if ($type == 2) {
				//UPDATE
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'so_customer_id',
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
				//UPDATE
				$where_sj['data'][] = array(
					'column' => 'surat_jalan_id',
					'param'	 => $data['t_surat_jalan_id']
				);
				$select_sj = $this->mod->select('surat_jalan_revised', 't_surat_jalan', null, $where_sj);
				if($select_sj)
				{
					$revised = $select_sj->row_array();
					$rev = $revised['surat_jalan_revised'] + 1;
				}
				$data_sj = array(
					'surat_jalan_status' 		=> 2,
					'surat_jalan_update_date' 	=> date('Y-m-d H:i:s'),
					'surat_jalan_update_by' 	=> $this->session->userdata('user_username'),
					'surat_jalan_revised' 		=> $rev,
				);
				$update_sj = $this->mod->update_data_table('t_surat_jalan', $where_sj, $data_sj);

				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('t_po_customerdet_id', TRUE)); $i++) { 
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_faktur_penjualandet', NULL, $data_det);
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
		$arrDate = explode('/', $this->input->post('faktur_penjualan_tanggal', TRUE));
		$arrDate2 = explode('/', $this->input->post('faktur_penjualan_jatuh_tempo', TRUE));
		$where['data'][] = array(
			'column' => 'faktur_penjualan_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('faktur_penjualan_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['faktur_penjualan_revised'] + 1;
		}
		if ($type == 1) {
			$faktur_penjualan_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 						=> $this->session->userdata('cabang_id'),
				'faktur_penjualan_nomor' 			=> $faktur_penjualan_nomor,
				'faktur_penjualan_tanggal'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'faktur_penjualan_jatuh_tempo'		=> $arrDate2[2]."-".$arrDate2[1]."-".$arrDate2[0],
				't_surat_jalan_id'					=> $this->input->post('t_surat_jalan_id', TRUE),
				'faktur_penjualan_sub_total'		=> $this->input->post('faktur_penjualan_sub_total', TRUE),
				'faktur_penjualan_potongan'			=> $this->input->post('faktur_penjualan_potongan', TRUE),
				'faktur_penjualan_uang_muka'		=> $this->input->post('faktur_penjualan_uang_muka', TRUE),
				'faktur_penjualan_total'			=> $this->input->post('faktur_penjualan_total', TRUE),
				'faktur_penjualan_tujuan_transfer'	=> json_encode($this->input->post('faktur_penjualan_tujuan_transfer', TRUE)),
				'faktur_penjualan_created_date'		=> date('Y-m-d H:i:s'),
				'faktur_penjualan_updated_date'		=> date('Y-m-d H:i:s'),
				'faktur_penjualan_created_by'		=> $this->session->userdata('user_username'),
				'faktur_penjualan_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'so_customer_status' 		=> $this->input->post('so_customer_status', TRUE),
				'so_customer_updated_date'	=> date('Y-m-d H:i:s'),
				'so_customer_updated_by'	=> $this->session->userdata('user_username'),
				'so_customer_revised' 		=> $rev,
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
			'column' => 'faktur_penjualandet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('faktur_penjualandet_revised', 't_faktur_penjualandet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['faktur_penjualandet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_faktur_penjualan_id' 			=> $idHdr,
				't_po_customerdet_id' 				=> $this->input->post('t_po_customerdet_id', TRUE)[$seq],
				'faktur_penjualandet_discount'		=> $this->input->post('faktur_penjualandet_discount', TRUE)[$seq],
				'faktur_penjualandet_created_date'	=> date('Y-m-d H:i:s'),
				'faktur_penjualandet_created_by'	=> $this->session->userdata('user_username'),
				'faktur_penjualandet_updated_date'	=> date('Y-m-d H:i:s'),
				'faktur_penjualandet_revised' 		=> 0,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(faktur_penjualan_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(faktur_penjualan_nomor,1,9)',
			'param'	 => 'INV'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'faktur_penjualan_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('INV',$query);
		return $kode_baru;
	}
	/* end Function */

}
