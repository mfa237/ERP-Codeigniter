<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_sales_order_customer extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_so_customer';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view($type){
		$this->check_session();

		if ($type == 1) {
			$priv = $this->cekUser(64);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Penjualan',
				'title_page2' 	=> 'Sales Order Customer',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('sales-order-customer/V_sales_order_customer', $data);
			}
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			$priv = $this->cekUser(65);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Persetujuan',
				'title_page2' 	=> 'Sales Order Customer',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('sales-order-customer/V_sales_order_customer2', $data);
			}
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 3) {
			$priv = $this->cekUser(77);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Produksi',
				'title_page2' 	=> 'Sales Order Customer',
				);
			if($priv['read'] == 1)
			{
				$this->open_page('sales-order-customer/V_sales_order_customer3', $data);
			}
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		}		
	}

	public function loadData($type){
		$priv = $this->cekUser(64);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, so_customer_nomor, po_customer_nomor, so_customer_tanggal, so_customer_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_so_customer');
		$query_filter = $this->mod->select($select, 'v_so_customer', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_so_customer', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				// $button = '';
				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Penjualan/Sales-Order-Customer/Form/'.$val->so_customer_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PO Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Penjualan/Sales-Order-Customer/print-SO-Customer/'.$val->so_customer_id.'">
					<button class="btn green-jungle" type="button" title="Print PS Customer">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Persetujuan/Sales-Order-Customer/Form/'.$val->so_customer_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PO Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>';
					// <a href="'.base_url().'Marketing/Sales-Order-Customer/print-Penawaran/'.$val->so_customer_id.'">
					// <button class="btn green-jungle" type="button" title="Print PS Customer">
					// 	<i class="icon-printer text-center"></i>
					// </button>
					// </a>';
				} else if ($type == 3) {
					$button = '
					<a href="'.base_url().'Produksi/Sales-Order-Customer/Form/'.$val->so_customer_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PO Customer">
						<i class="icon-eye text-center"></i>
					</button>
					</a>';
					// <a href="'.base_url().'Marketing/Sales-Order-Customer/print-Penawaran/'.$val->so_customer_id.'">
					// <button class="btn green-jungle" type="button" title="Print PS Customer">
					// 	<i class="icon-printer text-center"></i>
					// </button>
					// </a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->so_customer_nomor,
					$val->po_customer_nomor,
					date("d/m/Y",strtotime($val->so_customer_tanggal)),
					$val->so_customer_status_nama,
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
			'title_page2' 	=> 'Sales Order Customer',
			'id'			=> $id
		);
		$this->open_page('sales-order-customer/V_form_sales_order_customer', $data);
	}

	public function getForm2($id = null){
		$this->check_session();
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Persetujuan',
			'title_page2' 	=> 'Sales Order Customer',
			'id'			=> $id
		);
		$this->open_page('sales-order-customer/V_form_sales_order_customer2', $data);
	}

	public function getForm3($id = null){
		$this->check_session();
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Produksi',
			'title_page2' 	=> 'Sales Order Customer',
			'id'			=> $id
		);
		$this->open_page('sales-order-customer/V_form_sales_order_customer3', $data);
	}

	public function loadDataWhere($type){
		$response['type'] = $type;
		$response['ppn'] = $this->input->get('ppn');
		if($type == 2)
		{
			$select = 'a.*, b.*';
			$join['data'][]	=array(
				'table'	=> 't_po_customer b',
				'join'	=> 'b.po_customer_id = a.t_po_customer_id',
				'type'	=> 'left'
			);
			$where['data'][] = array(
				'column' => 'b.m_partner_id',
				'param'	 => $this->input->get('id')
			);
			$where['data'][] = array(
				'column' => 'a.so_customer_status',
				'param'	 => 2
			);
			$where['data'][] = array(
				'column' => 'b.po_customer_ppn',
				'param'	 => $this->input->get('ppn')
			);
			$query = $this->mod->select($select, 't_so_customer a', $join, $where);
			// $response['query'] = $query;
			if ($query<>false) {

					foreach ($query->result() as $val) {

					// CARI PO CUSTOMER
					// $hasil['val2'] = array();
					// $where_pocustomer['data'][] = array(
					// 	'column' => 'po_customer_id',
					// 	'param'	 => $val->t_po_customer_id
					// );
					// $query_pocustomer = $this->mod->select('*','t_po_customer',NULL,$where_pocustomer);
					// foreach ($query_pocustomer->result() as $val2) {
						$hasil['val2'][] = array(
							'id' 	=> $val->po_customer_id,
							'text' 	=> $val->po_customer_nomor
						);
					// }
					// END CARI PO CUSTOMER
					
					$response['val'][] = array(
						'kode' 							=> $val->so_customer_id,
						'm_cabang_id'					=> $val->m_cabang_id,
						'so_customer_nomor' 			=> $val->so_customer_nomor,
						'so_customer_tanggal'			=> date("d/m/Y",strtotime($val->so_customer_tanggal)),
						't_po_customer_id'				=> $hasil,
						'so_customer_catatan'			=> $val->so_customer_catatan,
						'so_customer_nama_cetak'		=> $val->so_customer_nama_cetak,
						'so_customer_status'			=> $val->so_customer_status,
						'so_customer_dp'				=> $val->so_customer_dp,
						'so_customer_sisa_dp'			=> $val->so_customer_sisa_dp,
					);
				}

				// echo json_encode($response);
			}
		} else {
			$select = '*';
			$where['data'][] = array(
				'column' => 'so_customer_id',
				'param'	 => $this->input->get('id')
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where);
			if ($query<>false) {

				foreach ($query->result() as $val) {

					// CARI PO CUSTOMER
					$hasil['val2'] = array();
					$where_pocustomer['data'][] = array(
						'column' => 'po_customer_id',
						'param'	 => $val->t_po_customer_id
					);
					$query_pocustomer = $this->mod->select('*','t_po_customer',NULL,$where_pocustomer);
					foreach ($query_pocustomer->result() as $val2) {
						$hasil['val2'][] = array(
							'id' 				=> $val2->po_customer_id,
							'text' 				=> $val2->po_customer_nomor,
							'po_customer_ppn'	=> $val2->po_customer_ppn,
						);
					}
					// END CARI PO CUSTOMER
					
					$response['val'][] = array(
						'kode' 							=> $val->so_customer_id,
						'm_cabang_id'					=> $val->m_cabang_id,
						'so_customer_nomor' 			=> $val->so_customer_nomor,
						'so_customer_tanggal'			=> date("d/m/Y",strtotime($val->so_customer_tanggal)),
						't_po_customer_id'				=> $hasil,
						'so_customer_catatan'			=> $val->so_customer_catatan,
						'so_customer_nama_cetak'		=> $val->so_customer_nama_cetak,
						'so_customer_status'			=> $val->so_customer_status,
						// 'so_customer_dp'				=> $val->so_customer_dp,
						// 'so_customer_sisa_dp'			=> $val->so_customer_sisa_dp,
					);
				}

				// echo json_encode($response);
			}
		}
		echo json_encode($response);
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
				'column' => 'so_customer_status',
				'param'	 => 2
			);
			$where_like['data'][] = array(
				'column' => 'so_customer_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'so_customer_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->so_customer_id,
						'text'	=> $val->so_customer_nomor
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
				'column' => 'so_customer_status',
				'param'	 => 3
			);
			$where_like['data'][] = array(
				'column' => 'so_customer_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'so_customer_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->so_customer_id,
						'text'	=> $val->so_customer_nomor
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
		$join['data'][] = array(
			'table'	=> 't_po_customer b',
			'join'	=> 'b.po_customer_id = a.t_po_customer_id',
			'type'	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'a.so_customer_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, 't_so_customer a', $join, $where);
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
					'column' => 't_po_customer_id',
					'param'	 => $val->po_customer_id
				);
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_po_customerdet a', $join_brg, $where_brg);
				$response['step1'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val2) {

						$response['val2'][] = array(
							'po_customerdet_id'					=> $val2->po_customerdet_id,
							'm_barang_id'						=> $val2->m_barang_id,
							'po_customerdet_qty'				=> $val2->po_customerdet_qty,
							'po_customerdet_harga_satuan'		=> $val2->po_customerdet_harga_satuan,
							'po_customerdet_keterangan'			=> $val2->po_customerdet_keterangan,
							'barang_kode'						=> $val2->barang_kode,
							'barang_nama'						=> $val2->barang_nama,
							'jenis_barang_nama'					=> $val2->jenis_barang_nama,
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
					$hasil7['val3'] = array();
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
						$hasil7['val3'] = array();
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
				$where_Sales['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->m_karyawan_id
				);
				$query_sales = $this->mod->select('*','m_karyawan',NULL,$where_Sales);
				if ($query_sales) {
					foreach ($query_sales->result() as $val2) {
						$hasil2['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama,
						);
					}
				}
				// END CARI Sales
				$name = $val->so_customer_nomor;
				$queryheader = $this->mod->select('*', 'm_header');
				$header = '';
				if($queryheader)
				{
					foreach ($queryheader->result() as $val3) {
						$header = $val3->header_text;
					}
				}
				$response['val'][] = array(
					'cabang'						=> $hasil6,
					'kode' 							=> $val->so_customer_id,
					'm_cabang_id'					=> $val->m_cabang_id,
					'so_customer_nomor' 			=> $val->so_customer_nomor,
					'so_customer_tanggal'			=> date("d/m/Y",strtotime($val->so_customer_tanggal)),
					't_po_customer_id'				=> $val->po_customer_id,
					'po_customer_nomor'				=> $val->po_customer_nomor,
					'po_customer_perjanjian_bayar'	=> $val->po_customer_perjanjian_bayar,
					'po_customer_alamat_kirim'		=> $val->po_customer_alamat_kirim,
					'po_customer_jasaangkut_jenis'	=> $val->po_customer_jasaangkut_jenis,
					'po_customer_ekspedisi'			=> $val->po_customer_ekspedisi,
					'po_customer_jasaangkut_bayar'	=> $val->po_customer_jasaangkut_bayar,
					'm_partner_id' 					=> $hasil,
					'header'						=> $header,
					'sales'							=> $hasil2,
					'po_customer_sejarah'			=> $val->po_customer_sejarah,
					'po_customer_ppn'				=> $val->po_customer_ppn,
					'so_customer_catatan'			=> $val->so_customer_catatan,
					'so_customer_nama_cetak'		=> $val->so_customer_nama_cetak,
					'so_customer_status'			=> $val->so_customer_status,
					'so_customer_created_by'		=> $val->so_customer_created_by,
				);
			}
		}
		$response['title'][] = array(
		'aplikasi'		=> $this->app_name,
		'title_page' 	=> 'Sales Order Customer',
		'title_page2' 	=> 'Print Sales Order',
		);
		// echo json_encode($response);
		$this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_sales_order_customer', $response);
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
			} else {
				$data = $this->general_post_data(3, $id);
				$where['data'][] = array(
					'column' => 'so_customer_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					for($i = 0; $i < sizeof($this->input->post('po_customerdet_id', TRUE)); $i++)
					{
						$data_det = $this->general_post_data2(1, $i, $this->input->post('po_customerdet_id', TRUE)[$i]);
						if(@$where_det['data'])
						{
							unset($where_det['data']);
						}
						$where_det['data'][] = array(
							'column' => 'po_customerdet_id',
							'param'  => $this->input->post('po_customerdet_id', TRUE)[$i]
						);
						// $response['det'][] = $where_det;
						$update_det = $this->mod->update_data_table('t_po_customerdet', $where_det, $data_det);
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
				//UPDATE
				$data_pocustomer = array(
					'po_customer_status' => 11,
				);
				$where_pocustomer['data'][] = array(
					'column' => 'po_customer_id',
					'param'	 => $data['t_po_customer_id']
				);
				$update_pocustomer = $this->mod->update_data_table('t_po_customer', $where_pocustomer, $data_pocustomer);
				for($i = 0; $i < sizeof($this->input->post('po_customerdet_id', TRUE)); $i++)
				{
					$data_det = $this->general_post_data2(1, $i, $this->input->post('po_customerdet_id', TRUE)[$i]);
					if(@$where_det['data'])
					{
						unset($where_det['data']);
					}
					$where_det['data'][] = array(
						'column' => 'po_customerdet_id',
						'param'  => $this->input->post('po_customerdet_id', TRUE)[$i]
					);
					// $response['det'][] = $where_det;
					$update_det = $this->mod->update_data_table('t_po_customerdet', $where_det, $data_det);
				}
			} else {
				$response['status'] = '204';
			}
			// $response['id'] = $insert->output;
		}
		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('so_customer_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'so_customer_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('so_customer_status, so_customer_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['so_customer_revised'] + 1;
			$status = $revised['so_customer_status'];
		}
		if ($type == 1) {
			$so_customer_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 					=> $this->session->userdata('cabang_id'),
				'so_customer_nomor' 			=> $so_customer_nomor,
				'so_customer_tanggal'			=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				't_po_customer_id'				=> $this->input->post('t_po_customer_id', TRUE),
				'so_customer_catatan'			=> $this->input->post('so_customer_catatan', TRUE),
				'so_customer_nama_cetak'		=> $this->input->post('nama_cetak', TRUE),
				'so_customer_dp'				=> $this->input->post('so_customer_dp', TRUE),
				'so_customer_sisa_dp'			=> $this->input->post('so_customer_dp', TRUE),
				'so_customer_total'				=> $this->input->post('so_customer_total', TRUE),
				'so_customer_status' 			=> 1,
				'so_customer_created_date'		=> date('Y-m-d H:i:s'),
				'so_customer_updated_date'		=> date('Y-m-d H:i:s'),
				'so_customer_created_by'		=> $this->session->userdata('user_username'),
				'so_customer_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'so_customer_status' 			=> $this->input->post('so_customer_status', TRUE),
				'so_customer_updated_date'		=> date('Y-m-d H:i:s'),
				'so_customer_updated_by'		=> $this->session->userdata('user_username'),
				'so_customer_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'so_customer_dp'				=> $this->input->post('so_customer_dp', TRUE),
				'so_customer_sisa_dp'			=> $this->input->post('so_customer_dp', TRUE),
				'so_customer_total'				=> $this->input->post('so_customer_total', TRUE),
				'so_customer_catatan'			=> $this->input->post('so_customer_catatan', TRUE),
				'so_customer_nama_cetak'		=> $this->input->post('nama_cetak', TRUE),
				'so_customer_updated_date'		=> date('Y-m-d H:i:s'),
				'so_customer_updated_by'		=> $this->session->userdata('user_username'),
				'so_customer_revised' 			=> $rev,
			);
		}

		return $data;
	}

	function general_post_data2($type, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		// $arrDate = explode('/', $this->input->post('so_customer_tanggal', TRUE));
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
				'm_barang_id' 					=> $this->input->post('m_barang_id', TRUE)[$seq],
				'po_customerdet_updated_date' 	=> date('Y-m-d H:i:s'),
				'po_customerdet_updated_by'		=> $this->session->userdata('user_username'),
				'po_customerdet_revised'		=> $rev,
			);
		} 
		// else if ($type == 2) {
		// 	$data = array(
		// 		'so_customer_status' 		=> $this->input->post('so_customer_status', TRUE),
		// 		'so_customer_updated_date'	=> date('Y-m-d H:i:s'),
		// 		'so_customer_updated_by'	=> $this->session->userdata('user_username'),
		// 		'so_customer_revised' 		=> $rev,
		// 	);
		// }

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(so_customer_nomor,9,5) as id';
		$where['data'][] = array(
			'column' => 'MID(so_customer_nomor,1,8)',
			'param'	 => 'SO'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'so_customer_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('SO',$query);
		return $kode_baru;
	}
	/* end Function */

}