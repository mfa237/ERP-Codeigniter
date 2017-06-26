<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jadwal_produksi extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_jadwal_produksi';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		// $this->view();
	}

	public function view($type){
		$this->check_session();
		if ($type == 1) {
			$priv = $this->cekUser(31);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Produksi',
				'title_page2' 	=> 'Jadwal Produksi',
				// 'priv_add'		=> $priv['create']
				);
			// if($priv['read'] == 1)
			// {
				$this->open_page('jadwal-produksi/V_jadwal_produksi', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Persetujuan',
				'title_page2' 	=> 'Jadwal Produksi',
			// 	'priv_add'		=> ''
				);

			$this->open_page('jadwal-produksi/V_jadwal_produksi2', $data);
		}		
	}

	public function loadData($type){
		// $priv = $this->cekUser(31);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, jadwal_produksi_nomor, jadwal_produksi_kebutuhan, estimasi_penjualan_nomor, jadwal_produksi_periode, jadwal_produksi_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_jadwal_produksi');
		$query_filter = $this->mod->select($select, 'v_jadwal_produksi', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_jadwal_produksi', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Produksi/Jadwal-Produksi/Form/'.$val->jadwal_produksi_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat BPB">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Produksi/Jadwal-Produksi/print-Jadwal/'.$val->jadwal_produksi_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Persetujuan/Jadwal-Produksi/Form/'.$val->jadwal_produksi_id.'">
					<button class="btn blue-ebonyclay" type="button"  title="Lihat Jadwal Produksi">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Persetujuan/Jadwal-Produksi/print-Jadwal/'.$val->jadwal_produksi_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				}
				if($val->jadwal_produksi_kebutuhan == 1)
				{
					$noRef = $val->estimasi_penjualan_nomor;
				}
				else if($val->jadwal_produksi_kebutuhan == 2)
				{
					$noRef = '';
				}
				else if($val->jadwal_produksi_kebutuhan == 3)
				{
					$noRef = $val->so_customer_nomor;
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->jadwal_produksi_nomor,
					// $val->estimasi_penjualan_nomor,
					$noRef,
					$val->jadwal_produksi_periode,
					$val->jadwal_produksi_status_nama,
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
			'title_page2' 	=> 'Jadwal Produksi',
			'id'			=> $id
		);
		$this->open_page('jadwal-produksi/V_form_jadwal_produksi', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Persetujuan',
			'title_page2' 	=> 'Jadwal Produksi',
			'id'			=> $id
		);
		$this->open_page('jadwal-produksi/V_form_jadwal_produksi2', $data);
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'jadwal_produksi_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL BAHAN
				$join_bahan['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type'	=> 'left'
				);
				$join_bahan['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_bahan['data'][] = array(
					'table' => 'm_satuan d',
					'join'	=> 'd.satuan_id = b.m_satuan_id',
					'type'	=> 'left'
				);
				$where_bahan['data'][] = array(
					'column' => 't_jadwal_produksi_id',
					'param'	 => $val->jadwal_produksi_id
				);
				$query_bahan = $this->mod->select('a.*, b.*, c.*, d.*', 't_jadwal_produksi_awaldet a', $join_bahan, $where_bahan);
				$response['val2'] = array();
				if ($query_bahan) {
					foreach ($query_bahan->result() as $val2) {
						$response['val2'][] = array(
							'jadwal_produksi_awaldet_id'		=> $val2->jadwal_produksi_awaldet_id,
							't_jadwal_produksi'					=> $val2->t_jadwal_produksi_id,
							'm_barang_id'						=> $val2->m_barang_id,
							'barang_kode'						=> $val2->barang_kode,
							'barang_nama'						=> $val2->barang_nama,
							'barang_uraian'						=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'jenis_barang_nama'					=> $val2->jenis_barang_nama,
							'satuan_nama'						=> $val2->satuan_nama,
							'jadwal_produksi_awaldet_qty'		=> $val2->jadwal_produksi_awaldet_qty,
							'jadwal_produksi_awaldet_no_seri'	=> $val2->jadwal_produksi_awaldet_no_seri,
						);
					}
				}

				// CARI DETAIL BARANG JADI
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
					'column' => 't_jadwal_produksi_id',
					'param'	 => $val->jadwal_produksi_id
				);
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_jadwal_produksi_akhirdet a', $join_brg, $where_brg);
				$response['val3'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val3) {
						$response['val3'][] = array(
							'jadwal_produksi_akhirdet_id'		=> $val3->jadwal_produksi_akhirdet_id,
							't_jadwal_produksi'					=> $val3->t_jadwal_produksi_id,
							'm_barang_id'						=> $val3->m_barang_id,
							't_estimasi_penjualandet_id'		=> $val3->t_estimasi_penjualandet_id,
							'barang_kode'						=> $val3->barang_kode,
							'barang_nama'						=> $val3->barang_nama,
							'barang_uraian'						=> $val3->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'jenis_barang_nama'					=> $val3->jenis_barang_nama,
							'satuan_nama'						=> $val3->satuan_nama,
							'jadwal_produksi_akhirdet_total'	=> $val3->jadwal_produksi_akhirdet_total,
							'jadwal_produksi_akhirdet_keterangan'	=> $val3->jadwal_produksi_akhirdet_keterangan,
						);
					}
				}

				// NO ORDER
				$where1['data'][] = array(
					'column' => 'estimasi_penjualan_id',
					'param'	 => $val->t_estimasi_penjualan_id
				);
				$query1 = $this->mod->select('*', 't_estimasi_penjualan', NULL, $where1);
				$hasil1['val2'] = array();
				if ($query1) {
					foreach ($query1->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->estimasi_penjualan_id,
							'text' 	=> $val2->estimasi_penjualan_nomor
						);
					}
				}

				$where2['data'][] = array(
					'column' => 'jenis_produksi_id',
					'param'	 => $val->jadwal_produksi_jenis
				);
				$query2 = $this->mod->select('*', 'm_jenis_produksi', NULL, $where2);
				$hasil2['val2'] = array();
				$response['query'] = $query2;
				if ($query2) {
					foreach ($query2->result() as $val2) {
						$hasil2['val2'][] = array(
							'id' 	=> $val2->jenis_produksi_id,
							'text' 	=> $val2->jenis_produksi_nama
						);
					}
				}

				$where3['data'][] = array(
					'column' => 'so_customer_id',
					'param'	 => $val->t_so_customer_id
				);
				$query3 = $this->mod->select('*', 't_so_customer', NULL, $where3);
				$hasil3['val2'] = array();
				if ($query3) {
					foreach ($query3->result() as $val2) {
						$hasil3['val2'][] = array(
							'id' 	=> $val2->so_customer_id,
							'text' 	=> $val2->so_customer_nomor
						);
					}
				}

				$response['val'][] = array(
					'kode' 							=> $val->jadwal_produksi_id,
					'jadwal_produksi_nomor' 		=> $val->jadwal_produksi_nomor,
					'jadwal_produksi_periode' 		=> $val->jadwal_produksi_periode,
					'jadwal_produksi_shift' 		=> $val->jadwal_produksi_shift,
					'jadwal_produksi_jenis' 		=> $hasil2,
					'jadwal_produksi_kebutuhan' 	=> $val->jadwal_produksi_kebutuhan,
					't_estimasi_penjualan_id'		=> $hasil1,
					't_so_customer_id'				=> $hasil3,
					'jadwal_produksi_status' 		=> $val->jadwal_produksi_status,
				);
			}

			echo json_encode($response);
		}
	}

	public function loadDataDetail1Where(){
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
		$join_brg['data'][] = array(
			'table' => 't_perolehan_produksidet e',
			'join'	=> 'e.t_jadwal_produksidet_id = a.jadwal_produksidet_id',
			'type'	=> 'left'
		);
		$join_brg['data'][] = array(
			'table' => 't_perolehan_produksi f',
			'join'	=> 'f.perolehan_produksi_id = e.t_perolehan_produksi_id',
			'type'	=> 'left'
		);
		$where_brg['data'][] = array(
			'column' => 'a.t_jadwal_produksi_id',
			'param'	 => $this->input->get('id')
		);
		$where_brg['data'][] = array(
			'column' => 'a.m_barang_id',
			'param'	 => $this->input->get('barang_id')
		);
		$query_brg = $this->mod->select('a.*, b.*, c.*, d.*, e.*, f.*', 't_jadwal_produksi_awaldet a', $join_brg, $where_brg);
		$response['val2'] = array();
		if ($query_brg) {
			foreach ($query_brg->result() as $val2) {
				$where4['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val2->m_gudang_id
				);
				$query4 = $this->mod->select('*', 'm_gudang', NULL, $where4);
				$hasil4['val2'] = array();
				if ($query4) {
					foreach ($query4->result() as $val3) {
						$hasil4['val2'][] = array(
							'id' 	=> $val3->gudang_id,
							'text' 	=> $val3->gudang_nama
						);
					}
				}
				$response['val2'][] = array(
					'jadwal_produksidet_id'			=> $val2->jadwal_produksidet_id,
					't_jadwal_produksi'				=> $val2->t_jadwal_produksi_id,
					'm_barang_id'							=> $val2->m_barang_id,
					'm_gudang_id'							=> $hasil4,
					'barang_kode'							=> $val2->barang_kode,
					'barang_nama'							=> $val2->barang_nama,
					'barang_uraian'							=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
					'jenis_barang_nama'						=> $val2->jenis_barang_nama,
					'satuan_nama'							=> $val2->satuan_nama,
					// 'perhitungan_kebutuhandet_qty'			=> $val2->perhitungan_kebutuhandet_qty,
					// 'perhitungan_kebutuhandet_berat'		=> $val2->perhitungan_kebutuhandet_berat,
					// 'perhitungan_kebutuhandet_total'		=> $val2->perhitungan_kebutuhandet_total,
					// 'perhitungan_kebutuhandet_ukuran'		=> $val2->perhitungan_kebutuhandet_ukuran,
					// 'perhitungan_kebutuhandet_lebar'		=> $val2->perhitungan_kebutuhandet_lebar,
					// 'perhitungan_kebutuhandet_slitingan'	=> $val2->perhitungan_kebutuhandet_slitingan,
					// 'perhitungan_kebutuhandet_keterangan'	=> $val2->perhitungan_kebutuhandet_keterangan,
					// 'perhitungan_kebutuhandet_status'		=> $val2->perhitungan_kebutuhandet_status,
				);
			}
		}

		echo json_encode($response);
	}

	public function loadDataQtyAwalWhere(){
		// CARI DETAIL
		// BARANG
		$join_brg['data'][] = array(
			'table' => 't_jadwal_produksi b',
			'join'	=> 'b.jadwal_produksi_id = a.t_jadwal_produksi_id',
			'type'	=> 'left'
		);
		$where_brg['data'][] = array(
			'column' => 'a.jadwal_produksi_awaldet_no_seri',
			'param'	 => $this->input->get('id')
		);
		$where_brg['data'][] = array(
			'column' => 'b.jadwal_produksi_status >',
			'param'	 => 1
		);
		$query_brg = $this->mod->select('*', 't_jadwal_produksi_awaldet a', $join_brg, $where_brg);
		$response['val'] = array();
		if ($query_brg) {
			foreach ($query_brg->result() as $val2) {
				$response['val'][] = array(
					'jadwal_produksi_awaldet_qty'	=> $val2->jadwal_produksi_awaldet_qty,
				);
			}
		}

		echo json_encode($response);
	}

	// public function checkStatus(){
	// 	$id = $this->input->get('id');
	// 	$select = '*';
	// 	$where['data'][] = array(
	// 		'column' => 'jadwal_produksi_id',
	// 		'param'	 => $id
	// 	);
	// 	$query = $this->mod->select($select, $this->tbl, NULL, $where);
	// 	if ($query<>false) {
	// 		foreach ($query->result() as $row) {
	// 			if ($row->jadwal_produksi_status == 1) {
	// 				$data = $this->general_post_data(3, $id);
	// 				$where['data'][] = array(
	// 					'column' => 'jadwal_produksi_id',
	// 					'param'	 => $id
	// 				);
	// 				$update = $this->mod->update_data_table($this->tbl, $where, $data);
	// 				// INSERT LOG);
	// 				$data_log = array(
	// 					'referensi_id' 								=> $id,
	// 					'jadwal_produksilog_status_dari' 			=> 1,
	// 					'jadwal_produksilog_status_ke' 				=> 2,
	// 					'jadwal_produksilog_status_update_date' 	=> date('Y-m-d H:i:s'),
	// 					'jadwal_produksilog_status_update_by'		=> $this->session->userdata('user_username'),
	// 				);
	// 				$insert_log = $this->mod->insert_data_table('t_jadwal_produksilog', NULL, $data_log);
	// 				$response['status'] = '200';
	// 			} else {
	// 				$response['status'] = '204';
	// 			}
	// 		}
	// 	} else {
	// 		$response['status'] = '204';
	// 	}
	// 	echo json_encode($response);
	// }

	public function loadData_select(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'jadwal_produksi_status',
			'param'	 => 2
		);
		$where_like['data'][] = array(
			'column' => 'jadwal_produksi_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'jadwal_produksi_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->jadwal_produksi_id,
					'text'	=> $val->jadwal_produksi_nomor
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function loadData_select2(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'jadwal_produksi_status >',
			'param'	 => 2
		);
		$where_like['data'][] = array(
			'column' => 'jadwal_produksi_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'jadwal_produksi_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->jadwal_produksi_id,
					'text'	=> $val->jadwal_produksi_nomor
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function loadData_selectBahanAwal(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$join['data'][] = array(
			'table'	=> 'm_barang b',
			'join'	=> 'b.barang_id = a.m_barang_id',
			'type'	=> 'left'
		);
		// $where['data'][] = array(
		// 	'column' => 'jadwal_produksi_akhirdet_status <',
		// 	'param'	 => 3
		// );
		$where['data'][] = array(
			'column' => 'a.t_jadwal_produksi_id',
			'param'	 => $this->input->get('id')
		);
		$where_like['data'][] = array(
			'column' => 'b.barang_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'b.barang_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, 't_jadwal_produksi_awaldet a', $join, $where, NULL, $where_like, $order);
		$response['items'] = array();		
		$response['id'] = $this->input->get('id');
		$response['q'] = $this->input->get('q');
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->m_barang_id,
					'text'	=> $val->barang_nama
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['test'] = $type;
		if (strlen($id)>0) {
			if ($type == 1)
			{
				// untuk update data status jadwal produksi
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'jadwal_produksi_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					for ($i = 0; $i < sizeof($this->input->post('kode_barang', TRUE)); $i++) {
						$data_det = $this->general_post_data2(4, null, $i, $this->input->post('jadwal_produksi_awaldet_id', TRUE)[$i]);
						if (@$where_det['data']) {
							unset($where_det['data']);
						}
						$where_det['data'][] = array(
							'column' => 'jadwal_produksi_awaldet_id',
							'param'	 => $this->input->post('jadwal_produksi_awaldet_id', TRUE)[$i]
						);
						$insert_det = $this->mod->update_data_table('t_jadwal_produksi_awaldet', $where_det, $data_det);
						if($insert_det->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
					for ($j = 0; $j < sizeof($this->input->post('kode_barang_jadi', TRUE)); $j++) {
						$data_det_akhir = $this->general_post_data2(5, null, $j, $this->input->post('jadwal_produksi_akhirdet_id', TRUE)[$j]);
						if (@$where_det_akhir['data']) {
							unset($where_det_akhir['data']);
						}
						$where_det_akhir['data'][] = array(
							'column' => 'jadwal_produksi_akhirdet_id',
							'param'	 => $this->input->post('jadwal_produksi_akhirdet_id', TRUE)[$j]
						);
						$update_det_akhir = $this->mod->update_data_table('t_jadwal_produksi_akhirdet', $where_det_akhir, $data_det_akhir);
						if($update_det_akhir->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
				} else {
					$response['status'] = '204';
				}
			}
			else if ($type == 2) {
				//UPDATE
				$data = $this->general_post_data(3, $id);
				$where['data'][] = array(
					'column' => 'jadwal_produksi_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					// INSERT LOG 
					if (@$data['jadwal_produksi_status']) {
						if ($data['jadwal_produksi_status'] == 2){
							$data_log = array(
								'referensi_id' 							=> $id,
								'jadwal_produksilog_status_dari' 		=> 1,
								'jadwal_produksilog_status_ke' 			=> 2,
								'jadwal_produksilog_status_update_date' => date('Y-m-d H:i:s'),
								'jadwal_produksilog_status_update_by' 	=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_jadwal_produksilog', NULL, $data_log);
						}
					}
					// INSERT DETAIL
					// for ($i = 0; $i < sizeof($this->input->post('jadwal_produksidet_id', TRUE)); $i++) {
					// 	$data_det = $this->general_post_data2(2, $id, $i, $this->input->post('jadwal_produksidet_id', TRUE)[$i]);
					// 	if (@$where_det['data']) {
					// 		unset($where_det['data']);
					// 	}
					// 	$where_det['data'][] = array(
					// 		'column' => 'jadwal_produksidet_id',
					// 		'param'	 => $this->input->post('jadwal_produksidet_id', TRUE)[$i]
					// 	);
					// 	$update_det = $this->mod->update_data_table('t_jadwal_produksidet', $where_det, $data_det);
					// 	if($update_det->status) {
					// 		$response['status'] = '200';
					// 	} else {
					// 		$response['status'] = '204';
					// 	}
					// }
				} else {
					$response['status'] = '204';
				}
			}
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$response['data'] = $data;
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
				// INSERT DETAIL BAHAN
				for ($i = 0; $i < sizeof($this->input->post('kode_barang', TRUE)); $i++) {
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_jadwal_produksi_awaldet', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
				// INSERT DETAIL BARANG JADI
				if($data['jadwal_produksi_kebutuhan'] == '1')
				{
					for ($i = 0; $i < sizeof($this->input->post('barang_id', TRUE)); $i++) {
						$data_det_akhir = $this->general_post_data2(2, $insert->output, $i); 
						$insert_det_akhir = $this->mod->insert_data_table('t_jadwal_produksi_akhirdet', NULL, $data_det_akhir);
						if($insert_det_akhir->status) {
							$response['status'] = '200';
							// ESTIMASI
							if (@$where_estimasi['data']) {
								unset($where_estimasi['data']);
							}
							$where_estimasi['data'][] = array(
								'column' => 'estimasi_penjualandet_id',
								'param'	 => $this->input->post('t_estimasi_penjualandet_id', TRUE)[$i]
							);
							$query_estimasi = $this->mod->select('*', 't_estimasi_penjualandet', NULL, $where_estimasi);
							if ($query_estimasi) {
								foreach ($query_estimasi->result() as $row) {
									$data_estimasi = array(
										'estimasi_penjualandet_status' => 1,
									);
									$update_estimasi = $this->mod->update_data_table('t_estimasi_penjualandet', $where_estimasi, $data_estimasi);
								}
							}
							// END ESTIMASI						
						} else {
							$response['status'] = '204';
						}
					}
					// CHECK DATA ESTIMASI
					$where_estimasidtl['data'][] = array(
						'column' => 't_estimasi_penjualan_id',
						'param'	 => $data['t_estimasi_penjualan_id']
					);
					$query_estimasidtl = $this->mod->select('*', 't_estimasi_penjualandet', NULL, $where_estimasidtl);
					$flag = 0;
					$jmldtl = 0;
					if ($query_estimasidtl) {
						foreach ($query_estimasidtl->result() as $row) {
							$jmldtl++;
							if ($row->estimasi_penjualandet_status == 1) {
								$flag++;
							}
						}
					}

					$whereRevised['data'][] = array(
						'column' => 'estimasi_penjualan_id',
						'param'	 => $data['t_estimasi_penjualan_id']
					);
					$queryRevised = $this->mod->select('estimasi_penjualan_status, estimasi_penjualan_revised', 't_estimasi_penjualan', NULL, $whereRevised);
					if ($queryRevised) {
						$revised = $queryRevised->row_array();
						$rev = $revised['estimasi_penjualan_revised'] + 1;
						$status = $revised['estimasi_penjualan_status'];
					}

					if ($flag > 0) {
						if ($flag == $jmldtl) {
							$datahdr = array(
								'estimasi_penjualan_status' 		=> 5,
								'estimasi_penjualan_status_date'	=> date('Y-m-d H:i:s'),
								'estimasi_penjualan_update_date'	=> date('Y-m-d H:i:s'),
								'estimasi_penjualan_update_by'		=> $this->session->userdata('user_username'),
								'estimasi_penjualan_revised' 		=> $rev,
							);
							$update = $this->mod->update_data_table('t_estimasi_penjualan', $whereRevised, $datahdr);
							// INSERT LOG);
							$data_log = array(
								'referensi_id' 								=> $data['t_estimasi_penjualan_id'],
								'estimasi_penjualanlog_status_dari' 		=> $status,
								'estimasi_penjualanlog_status_ke' 			=> 5,
								'estimasi_penjualanlog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'estimasi_penjualanlog_status_update_by'	=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_estimasi_penjualanlog', NULL, $data_log);
						} else {
							$datahdr = array(
								'estimasi_penjualan_status' 		=> 4,
								'estimasi_penjualan_status_date'	=> date('Y-m-d H:i:s'),
								'estimasi_penjualan_update_date'	=> date('Y-m-d H:i:s'),
								'estimasi_penjualan_update_by'		=> $this->session->userdata('user_username'),
								'estimasi_penjualan_revised' 		=> $rev,
							);
							$update = $this->mod->update_data_table('t_estimasi_penjualan', $whereRevised, $datahdr);
							// INSERT LOG);
							$data_log = array(
								'referensi_id' 								=> $data['t_estimasi_penjualan_id'],
								'estimasi_penjualanlog_status_dari' 		=> $status,
								'estimasi_penjualanlog_status_ke' 			=> 4,
								'estimasi_penjualanlog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'estimasi_penjualanlog_status_update_by'	=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_estimasi_penjualanlog', NULL, $data_log);
						}
					}
					// END CHECK DATA ESTIMASI
				}
				else if($data['jadwal_produksi_kebutuhan'] == '2')
				{
					for($i = 0; $i < sizeof($this->input->post('kode_barang_jadi', TRUE)); $i++)
					{
						$data_det_akhir = $this->general_post_data2(3, $insert->output, $i);
						$insert_det_akhir = $this->mod->insert_data_table('t_jadwal_produksi_akhirdet', NULL, $data_det_akhir);
						if($insert_det_akhir->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
				} else if($data['jadwal_produksi_kebutuhan'] == '3')
				{
					for ($i = 0; $i < sizeof($this->input->post('barang_id', TRUE)); $i++) {
						$data_det_akhir = $this->general_post_data2(2, $insert->output, $i);
						$insert_det_akhir = $this->mod->insert_data_table('t_jadwal_produksi_akhirdet', NULL, $data_det_akhir);
						if($insert_det_akhir->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}

					}
				}
			} else {
				$response['status'] = '204';
			}
		}
		
		echo json_encode($response);
	}

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'jadwal_produksi_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $val) {
				// CARI DETAIL BAHAN
				$join_bahan['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type'	=> 'left'
				);
				$join_bahan['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_bahan['data'][] = array(
					'table' => 'm_satuan d',
					'join'	=> 'd.satuan_id = b.m_satuan_id',
					'type'	=> 'left'
				);
				$where_bahan['data'][] = array(
					'column' => 't_jadwal_produksi_id',
					'param'	 => $val->jadwal_produksi_id
				);
				$query_bahan = $this->mod->select('a.*, b.*, c.*, d.*', 't_jadwal_produksi_awaldet a', $join_bahan, $where_bahan);
				$response['val2'] = array();
				if ($query_bahan) {
					foreach ($query_bahan->result() as $val2) {
						$response['val2'][] = array(
							'jadwal_produksi_awaldet_id'		=> $val2->jadwal_produksi_awaldet_id,
							't_jadwal_produksi'					=> $val2->t_jadwal_produksi_id,
							'm_barang_id'						=> $val2->m_barang_id,
							'barang_kode'						=> $val2->barang_kode,
							'barang_nama'						=> $val2->barang_nama,
							'barang_uraian'						=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'jenis_barang_nama'					=> $val2->jenis_barang_nama,
							'satuan_nama'						=> $val2->satuan_nama,
							'jadwal_produksi_awaldet_qty'		=> $val2->jadwal_produksi_awaldet_qty,
							'jadwal_produksi_awaldet_no_seri'	=> $val2->jadwal_produksi_awaldet_no_seri,
						);
					}
				}

				// CARI DETAIL BARANG JADI
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
					'column' => 't_jadwal_produksi_id',
					'param'	 => $val->jadwal_produksi_id
				);
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_jadwal_produksi_akhirdet a', $join_brg, $where_brg);
				$response['val3'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val3) {
						$response['val3'][] = array(
							'jadwal_produksi_akhirdet_id'		=> $val3->jadwal_produksi_akhirdet_id,
							't_jadwal_produksi'					=> $val3->t_jadwal_produksi_id,
							'm_barang_id'						=> $val3->m_barang_id,
							't_estimasi_penjualandet_id'		=> $val3->t_estimasi_penjualandet_id,
							'barang_kode'						=> $val3->barang_kode,
							'barang_nama'						=> $val3->barang_nama,
							'barang_uraian'						=> $val3->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'jenis_barang_nama'					=> $val3->jenis_barang_nama,
							'satuan_nama'						=> $val3->satuan_nama,
							'jadwal_produksi_akhirdet_total'	=> $val3->jadwal_produksi_akhirdet_total,
							'jadwal_produksi_akhirdet_keterangan'	=> $val3->jadwal_produksi_akhirdet_keterangan,
						);
					}
				}

				// NO ORDER
				$where1['data'][] = array(
					'column' => 'estimasi_penjualan_id',
					'param'	 => $val->t_estimasi_penjualan_id
				);
				$query1 = $this->mod->select('*', 't_estimasi_penjualan', NULL, $where1);
				$hasil1['val2'] = array();
				if ($query1) {
					foreach ($query1->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->estimasi_penjualan_id,
							'text' 	=> $val2->estimasi_penjualan_nomor
						);
					}
				}

				// CARI CABANG
				$hasil7['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI KOTA
						$hasil8['val2'] = array();
						$where_kota['data'][] = array(
							'column' => 'id',
							'param'	 => $val2->cabang_kota
						);
						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
						if ($query_kota) {
							foreach ($query_kota->result() as $val3) {
								$hasil8['val3'][] = array(
									'id' 		=> $val3->id,
									'text' 		=> $val3->name,
								);
							}
						}
						// END CARI KOTA
						$hasil7['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil8,
							'telp'  => json_decode($val2->cabang_telepon)
						);
					}
				}
				// END CARI CABANG

				$response['val'][] = array(
					'kode' 							=> $val->jadwal_produksi_id,
					'jadwal_produksi_nomor' 		=> $val->jadwal_produksi_nomor,
					'jadwal_produksi_periode' 		=> $val->jadwal_produksi_periode,
					'jadwal_produksi_shift' 		=> $val->jadwal_produksi_shift,
					'jadwal_produksi_jenis' 		=> $val->jadwal_produksi_jenis,
					'jadwal_produksi_kebutuhan' 	=> $val->jadwal_produksi_kebutuhan,
					't_estimasi_penjualan_id'		=> $hasil1,
					'jadwal_produksi_status' 		=> $val->jadwal_produksi_status,
					'cabang'						=> $hasil7,
					'jadwal_produksi_created_by'    => $val->jadwal_produksi_created_by,
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Jadwal Produksi',
			'title_page2' 	=> 'Print Jadwal Produksi',
		);
		// echo json_encode($response);
		$this->pdf->load_view('print/P_jadwal_produksi', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'jadwal_produksi_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('jadwal_produksi_status, jadwal_produksi_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['jadwal_produksi_revised'] + 1;
			$status = $revised['jadwal_produksi_status'];
		}
		if ($type == 1) {
			$jadwal_produksi_nomor = $this->get_kode_transaksi();
			if($this->input->post('jadwal_produksi_kebutuhan', TRUE) == 1)
			{
				$data = array(
					'm_cabang_id' 							=> $this->session->userdata('cabang_id'),
					'jadwal_produksi_nomor' 				=> $jadwal_produksi_nomor,
					'jadwal_produksi_periode' 				=> $this->input->post('jadwal_produksi_periode', TRUE),
					't_estimasi_penjualan_id'				=> $this->input->post('t_estimasi_penjualan_id', TRUE),
					'jadwal_produksi_shift' 				=> $this->input->post('jadwal_produksi_shift', TRUE),
					'jadwal_produksi_jenis'					=> $this->input->post('jadwal_produksi_jenis', TRUE),
					'jadwal_produksi_kebutuhan'				=> $this->input->post('jadwal_produksi_kebutuhan', TRUE),
					'jadwal_produksi_status' 				=> 1,
					'jadwal_produksi_status_date'			=> date('Y-m-d H:i:s'),
					'jadwal_produksi_created_date'			=> date('Y-m-d H:i:s'),
					'jadwal_produksi_update_date'			=> date('Y-m-d H:i:s'),
					'jadwal_produksi_created_by'			=> $this->session->userdata('user_username'),
					'jadwal_produksi_revised' 				=> 0,
				);
			} else if($this->input->post('jadwal_produksi_kebutuhan', TRUE) == 3)
			{
				$data = array(
					'm_cabang_id' 							=> $this->session->userdata('cabang_id'),
					'jadwal_produksi_nomor' 				=> $jadwal_produksi_nomor,
					'jadwal_produksi_periode' 				=> $this->input->post('jadwal_produksi_periode', TRUE),
					't_so_customer_id'						=> $this->input->post('t_estimasi_penjualan_id', TRUE),
					'jadwal_produksi_shift' 				=> $this->input->post('jadwal_produksi_shift', TRUE),
					'jadwal_produksi_jenis'					=> $this->input->post('jadwal_produksi_jenis', TRUE),
					'jadwal_produksi_kebutuhan'				=> $this->input->post('jadwal_produksi_kebutuhan', TRUE),
					'jadwal_produksi_status' 				=> 1,
					'jadwal_produksi_status_date'			=> date('Y-m-d H:i:s'),
					'jadwal_produksi_created_date'			=> date('Y-m-d H:i:s'),
					'jadwal_produksi_update_date'			=> date('Y-m-d H:i:s'),
					'jadwal_produksi_created_by'			=> $this->session->userdata('user_username'),
					'jadwal_produksi_revised' 				=> 0,
				);
			} else
			{
				$data = array(
					'm_cabang_id' 							=> $this->session->userdata('cabang_id'),
					'jadwal_produksi_nomor' 				=> $jadwal_produksi_nomor,
					'jadwal_produksi_periode' 				=> $this->input->post('jadwal_produksi_periode', TRUE),
					// 't_so_customer_id'						=> $this->input->post('t_estimasi_penjualan_id', TRUE),
					'jadwal_produksi_shift' 				=> $this->input->post('jadwal_produksi_shift', TRUE),
					'jadwal_produksi_jenis'					=> $this->input->post('jadwal_produksi_jenis', TRUE),
					'jadwal_produksi_kebutuhan'				=> $this->input->post('jadwal_produksi_kebutuhan', TRUE),
					'jadwal_produksi_status' 				=> 1,
					'jadwal_produksi_status_date'			=> date('Y-m-d H:i:s'),
					'jadwal_produksi_created_date'			=> date('Y-m-d H:i:s'),
					'jadwal_produksi_update_date'			=> date('Y-m-d H:i:s'),
					'jadwal_produksi_created_by'			=> $this->session->userdata('user_username'),
					'jadwal_produksi_revised' 				=> 0,
				);
			}
			
		} else if ($type == 2) {
			$data = array(
				'jadwal_produksi_periode' 		=> $this->input->post('jadwal_produksi_periode', TRUE),
				'jadwal_produksi_shift' 		=> $this->input->post('jadwal_produksi_shift', TRUE),
				'jadwal_produksi_jenis'			=> $this->input->post('jadwal_produksi_jenis', TRUE),
				'jadwal_produksi_update_date'	=> date('Y-m-d H:i:s'),
				'jadwal_produksi_update_by'		=> $this->session->userdata('user_username'),
				'jadwal_produksi_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'jadwal_produksi_status'		=> $this->input->post('jadwal_produksi_status', TRUE),
				'jadwal_produksi_status_date'	=> date('Y-m-d H:i:s'),
				'jadwal_produksi_update_date'	=> date('Y-m-d H:i:s'),
				'jadwal_produksi_update_by'		=> $this->session->userdata('user_username'),
				'jadwal_produksi_revised' 		=> $rev,
			);
		} 

		return $data;
	}

	// function general_post_data2($type, $idHdr, $seq, $id = null){
	// 	// 1 Insert, 2 Update, 3 Delete / Non Aktif
	// 	$where['data'][] = array(
	// 		'column' => 'jadwal_produksidet_id',
	// 		'param'	 => $id
	// 	);
	// 	$queryRevised = $this->mod->select('jadwal_produksidet_revised', 't_jadwal_produksidet', NULL, $where);
	// 	if ($queryRevised) {
	// 		$revised = $queryRevised->row_array();
	// 		$rev = $revised['jadwal_produksidet_revised'] + 1;
	// 	}
	// 	if ($type == 1) {
	// 		$data = array(
	// 			't_jadwal_produksi_id' 				=> $idHdr,
	// 			'm_barang_id' 						=> $this->input->post('m_barang_id', TRUE)[$seq],
	// 			't_estimasi_penjualandet_id'		=> $this->input->post('estimasi_penjualandet_id', TRUE)[$seq],
	// 			'jadwal_produksidet_qty' 			=> $this->input->post('jadwal_produksidet_qty', TRUE)[$seq],
	// 			'jadwal_produksidet_total' 			=> $this->input->post('jadwal_produksidet_total', TRUE)[$seq],
	// 			'jadwal_produksidet_keterangan' 	=> $this->input->post('jadwal_produksidet_keterangan', TRUE)[$seq],
	// 			'jadwal_produksidet_status'			=> 1,
	// 			'jadwal_produksidet_status_date'	=> date('Y-m-d H:i:s'),
	// 			'jadwal_produksidet_created_date'	=> date('Y-m-d H:i:s'),
	// 			'jadwal_produksidet_created_by'		=> $this->session->userdata('user_username'),
	// 			'jadwal_produksidet_update_date'	=> date('Y-m-d H:i:s'),
	// 			'jadwal_produksidet_revised' 		=> 0,
	// 		);
	// 	} else if ($type == 2) {
	// 		// $data = array(
	// 		// 	't_jadwal_produksi_id' 			=> $idHdr,
	// 		// 	'm_barang_id' 						=> $this->input->post('m_barang_id', TRUE)[$seq],
	// 		// 	'jadwal_produksidet_harga_satuan' => $this->input->post('jadwal_produksidet_harga_satuan', TRUE)[$seq],
	// 		// 	'jadwal_produksidet_potongan' 	=> $this->input->post('jadwal_produksidet_potongan', TRUE)[$seq],
	// 		// 	'jadwal_produksidet_total'		=> $this->input->post('jadwal_produksidet_total', TRUE)[$seq],
	// 		// 	'jadwal_produksidet_keterangan'	=> $this->input->post('jadwal_produksidet_keterangan', TRUE)[$seq],
	// 		// 	'jadwal_produksidet_update_by'	=> $this->session->userdata('user_username'),
	// 		// 	'jadwal_produksidet_update_date'	=> date('Y-m-d H:i:s'),
	// 		// 	'jadwal_produksidet_revised' 		=> $rev,
	// 		// );
	// 	}

	// 	return $data;
	// }

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if ($type == 1) {
			// insert into t_jadwal_produksi_awaldet
			$data = array(
				't_jadwal_produksi_id' 					=> $idHdr,
				'm_barang_id' 							=> $this->input->post('m_barang_id', TRUE)[$seq],
				'jadwal_produksi_awaldet_no_seri' 		=> $this->input->post('jadwal_produksi_awaldet_no_seri', TRUE)[$seq],
				'jadwal_produksi_awaldet_qty' 			=> $this->input->post('jadwal_produksi_awaldet_qty', TRUE)[$seq],
				'jadwal_produksi_awaldet_status' 		=> 1,
				'jadwal_produksi_awaldet_status_date'	=> date('Y-m-d H:i:s'),
				'jadwal_produksi_awaldet_created_date'	=> date('Y-m-d H:i:s'),
				'jadwal_produksi_awaldet_update_date'	=> date('Y-m-d H:i:s'),
				'jadwal_produksi_awaldet_created_by'	=> $this->session->userdata('user_username'),
				'jadwal_produksi_awaldet_revised' 		=> 0,
			);
		} else if ($type == 2) {
			// insert into t_jadwal_produksi_akhirdet untuk estimasi penjualan
			$data = array(
				't_jadwal_produksi_id' 						=> $idHdr,
				'm_barang_id' 								=> $this->input->post('barang_id', TRUE)[$seq],
				't_estimasi_penjualandet_id'				=> $this->input->post('t_estimasi_penjualandet_id', TRUE)[$seq],
				'jadwal_produksi_akhirdet_total' 			=> $this->input->post('jadwal_produksi_akhirdet_total', TRUE)[$seq],
				'jadwal_produksi_akhirdet_keterangan' 		=> $this->input->post('jadwal_produksi_akhirdet_keterangan', TRUE)[$seq],
				'jadwal_produksi_akhirdet_status' 			=> 1,
				'jadwal_produksi_akhirdet_status_date'		=> date('Y-m-d H:i:s'),
				'jadwal_produksi_akhirdet_created_date'		=> date('Y-m-d H:i:s'),
				'jadwal_produksi_akhirdet_update_date'		=> date('Y-m-d H:i:s'),
				'jadwal_produksi_akhirdet_created_by'		=> $this->session->userdata('user_username'),
				'jadwal_produksi_akhirdet_revised' 			=> 0,
			);
		} else if ($type == 3) {
			// insert into t_jadwal_produksi_akhirdet untuk kebutuhan stok
			$data = array(
				't_jadwal_produksi_id' 						=> $idHdr,
				'm_barang_id' 								=> $this->input->post('barang_id', TRUE)[$seq],
				't_estimasi_penjualandet_id'				=> "",
				'jadwal_produksi_akhirdet_total' 			=> $this->input->post('jadwal_produksi_akhirdet_total', TRUE)[$seq],
				'jadwal_produksi_akhirdet_keterangan' 		=> $this->input->post('jadwal_produksi_akhirdet_keterangan', TRUE)[$seq],
				'jadwal_produksi_akhirdet_status' 			=> 1,
				'jadwal_produksi_akhirdet_status_date'		=> date('Y-m-d H:i:s'),
				'jadwal_produksi_akhirdet_created_date'		=> date('Y-m-d H:i:s'),
				'jadwal_produksi_akhirdet_update_date'		=> date('Y-m-d H:i:s'),
				'jadwal_produksi_akhirdet_created_by'		=> $this->session->userdata('user_username'),
				'jadwal_produksi_akhirdet_revised' 			=> 0,
			);
		} else if ($type == 4) {
			// select jumlah revised
			$where['data'][] = array(
				'column' => 'jadwal_produksi_awaldet_id',
				'param'	 => $id
			);
			$queryRevised = $this->mod->select('jadwal_produksi_awaldet_revised', 't_jadwal_produksi_awaldet', NULL, $where);
			if ($queryRevised) {
				$revised = $queryRevised->row_array();
				$rev = $revised['jadwal_produksi_awaldet_revised'] + 1;
			}
			// update t_jadwal_produksi_awaldet
			$data = array(
				'm_barang_id' 								=> $this->input->post('m_barang_id', TRUE)[$seq],
				'jadwal_produksi_awaldet_no_seri' 			=> $this->input->post('jadwal_produksi_awaldet_no_seri', TRUE)[$seq],
				'jadwal_produksi_awaldet_qty' 				=> $this->input->post('jadwal_produksi_awaldet_qty', TRUE)[$seq],
				'jadwal_produksi_awaldet_status' 			=> 1,
				'jadwal_produksi_awaldet_status_date'		=> date('Y-m-d H:i:s'),
				'jadwal_produksi_awaldet_update_date'		=> date('Y-m-d H:i:s'),
				'jadwal_produksi_awaldet_update_by'			=> $this->session->userdata('user_username'),
				'jadwal_produksi_awaldet_revised' 			=> $rev,
			);
		} else if ($type == 5) {
			// select jumlah revised
			$where['data'][] = array(
				'column' => 'jadwal_produksi_akhirdet_id',
				'param'	 => $id
			);
			$queryRevised = $this->mod->select('jadwal_produksi_akhirdet_revised', 't_jadwal_produksi_akhirdet', NULL, $where);
			if ($queryRevised) {
				$revised = $queryRevised->row_array();
				$rev = $revised['jadwal_produksi_akhirdet_revised'] + 1;
			}
			// update t_jadwal_produksi_awaldet
			$data = array(
				'm_barang_id' 								=> $this->input->post('barang_id', TRUE)[$seq],
				'jadwal_produksi_akhirdet_total' 			=> $this->input->post('jadwal_produksi_akhirdet_total', TRUE)[$seq],
				'jadwal_produksi_akhirdet_keterangan' 		=> $this->input->post('jadwal_produksi_akhirdet_keterangan', TRUE)[$seq],
				'jadwal_produksi_akhirdet_status' 			=> 1,
				'jadwal_produksi_akhirdet_status_date'		=> date('Y-m-d H:i:s'),
				'jadwal_produksi_akhirdet_update_date'		=> date('Y-m-d H:i:s'),
				'jadwal_produksi_akhirdet_update_by'		=> $this->session->userdata('user_username'),
				'jadwal_produksi_akhirdet_revised' 			=> $rev,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(jadwal_produksi_nomor,9,5) as id';
		$where['data'][] = array(
			'column' => 'MID(jadwal_produksi_nomor,1,8)',
			'param'	 => 'JP'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'jadwal_produksi_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('JP',$query,$bln);
		return $kode_baru;
	}
	/* end Function */

}
