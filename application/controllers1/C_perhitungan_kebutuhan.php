<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_perhitungan_kebutuhan extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_perhitungan_kebutuhan';

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
				'title_page2' 	=> 'Perhitungan Kebutuhan',
				// 'priv_add'		=> $priv['create']
				);
			// if($priv['read'] == 1)
			// {
				$this->open_page('perhitungan-kebutuhan/V_perhitungan_kebutuhan', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Gudang',
				'title_page2' 	=> 'Perhitungan Kebutuhan',
				// 'priv_add'		=> ''
				);

			$this->open_page('perhitungan-kebutuhan/V_perhitungan_kebutuhan2', $data);
		} else if ($type == 3) {
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Persetujuan',
				'title_page2' 	=> 'Perhitungan Kebutuhan',
				// 'priv_add'		=> ''
				);

			$this->open_page('perhitungan-kebutuhan/V_perhitungan_kebutuhan3', $data);
		}		
	}

	public function loadData($type){
		// $priv = $this->cekUser(31);
		$select = 'a.*, b.cabang_nama';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		$join['data'][] = array(
			'table'	=> 'm_cabang b',
			'join'	=> 'b.cabang_id = a.m_cabang_id',
			'type'	=> 'left'  
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'b.cabang_nama, a.perhitungan_kebutuhan_nomor, a.perhitungan_kebutuhan_tanggal',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 't_perhitungan_kebutuhan a', $join);
		$query_filter = $this->mod->select($select, 't_perhitungan_kebutuhan a', $join, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 't_perhitungan_kebutuhan a', $join, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				if($val->perhitungan_kebutuhan_status == 1)
				{
					$status_nama = 'Perhitungan Kebutuhan Baru';
				} else if($val->perhitungan_kebutuhan_status == 2)
				{
					$status_nama = 'Perhitungan Kebutuhan Diterima';
				} else
				{
					$status_nama = 'Perhitungan Kebutuhan Direalisasi';
				}
				$id = json_decode($val->t_jadwal_produksi_id);
				$jadwal_produksi_nomor = '';
				for($i=0; $i < sizeof($id); $i++)
				{
					if (@$whereJadwal['data']) {
						unset($whereJadwal['data']);
					}
					$whereJadwal['data'][] = array(
						'column' => 'jadwal_produksi_id',
						'param'	 => $id[$i]
					);
					$queryJadwal = $this->mod->select('*', 't_jadwal_produksi', NULL, $whereJadwal);
					if($queryJadwal)
					{
						foreach ($queryJadwal->result() as $val2) {
							if($jadwal_produksi_nomor == '')
							{
								$jadwal_produksi_nomor = $val2->jadwal_produksi_nomor;
							}
							else
							{
								$jadwal_produksi_nomor = $jadwal_produksi_nomor.'<br>'.$val2->jadwal_produksi_nomor; 
							}
							
						}
					}
				}
				if($val->perhitungan_kebutuhan_jenis == 1)
				{
					$jenis = 'Produksi';
				}
				else
				{
					$jenis = '<span class="label bg-red-thunderbird bg-font-red-thunderbird">Permintaan Pembelian</span>';
				}
				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Produksi/Perhitungan-Kebutuhan-Bahan/Form/'.$val->perhitungan_kebutuhan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PKB">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Produksi/Perhitungan-Kebutuhan-Bahan/print-Perhitungan/'.$val->perhitungan_kebutuhan_id.'">
					<button class="btn green-jungle" type="button" title="PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Gudang/Perhitungan-Kebutuhan-Bahan/Form/'.$val->perhitungan_kebutuhan_id.'">
					<button class="btn blue-ebonyclay" type="button" onclick="checkStatusPKB('.$val->perhitungan_kebutuhan_id.')"  title="Lihat PKB">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Gudang/Perhitungan-Kebutuhan-Bahan/print-Perhitungan/'.$val->perhitungan_kebutuhan_id.'">
					<button class="btn green-jungle" type="button" title="PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 3) {
					$button = '
					<a href="'.base_url().'Persetujuan/Perhitungan-Kebutuhan-Bahan/Form/'.$val->perhitungan_kebutuhan_id.'">
					<button class="btn blue-ebonyclay" type="button"  title="Lihat PKB">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Persetujuan/Perhitungan-Kebutuhan-Bahan/print-Perhitungan/'.$val->perhitungan_kebutuhan_id.'">
					<button class="btn green-jungle" type="button" title="PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->perhitungan_kebutuhan_nomor,
					$jenis,
					$jadwal_produksi_nomor,
					date("d/m/Y",strtotime($val->perhitungan_kebutuhan_tanggal)),
					$status_nama,
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
			'title_page2' 	=> 'Perhitungan Kebutuhan',
			'id'			=> $id
		);
		$this->open_page('perhitungan-kebutuhan/V_form_perhitungan_kebutuhan', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Gudang',
			'title_page2' 	=> 'Perhitungan Kebutuhan',
			'id'			=> $id
		);
		$this->open_page('perhitungan-kebutuhan/V_form_perhitungan_kebutuhan2', $data);
	}

	public function getForm3($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Persetujuan',
			'title_page2' 	=> 'Perhitungan Kebutuhan',
			'id'			=> $id
		);
		$this->open_page('perhitungan-kebutuhan/V_form_perhitungan_kebutuhan3', $data);
	}

	public function loadDataWhere($type){
		$select = '*';
		if($type == '1')
		{
			$where['data'][] = array(
				'column' => 'perhitungan_kebutuhan_id',
				'param'	 => $this->input->get('id')
			);
		}
		else if($type == '2')
		{
			$where['data'][] = array(
				'column' => 't_jadwal_produksi_id',
				'param'	 => $this->input->get('id')
			);
		}
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
					'column' => 't_perhitungan_kebutuhan_id',
					'param'	 => $val->perhitungan_kebutuhan_id
				);
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_perhitungan_kebutuhandet a', $join_brg, $where_brg);
				$response['val2'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val2) {
						if($val->perhitungan_kebutuhan_jenis == 2)
						{
							if (@$where_brgJadi['data']) {
								unset($where_brgJadi['data']);
							}
							$where_brgJadi['data'][] = array(
								'column'	=> 'barang_id',
								'param'		=> $val2->barang_jadi_id
							);
							$query_brgJadi = $this->mod->select('*', 'm_barang', null, $where_brgJadi);
							if($query_brgJadi)
							{
								foreach ($query_brgJadi->result() as $val3) {
									$hasil2['val2'] = array(
										'id'	=> $val3->barang_id,
										'text'	=> $val3->barang_nama
									);
									
								}
							}
						}
						else
						{
							$hasil2 = $val2->barang_jadi_id;
						}
						
						$response['val2'][] = array(
							'perhitungan_kebutuhandet_id'			=> $val2->perhitungan_kebutuhandet_id,
							't_perhitungan_kebutuhan'				=> $val2->t_perhitungan_kebutuhan_id,
							'barang_jadi_id'						=> $hasil2,
							'm_barang_id'							=> $val2->m_barang_id,
							'barang_kode'							=> $val2->barang_kode,
							'barang_nama'							=> $val2->barang_nama,
							'barang_uraian'							=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'jenis_barang_nama'						=> $val2->jenis_barang_nama,
							'satuan_nama'							=> $val2->satuan_nama,
							'perhitungan_kebutuhandet_qty'			=> $val2->perhitungan_kebutuhandet_qty,
							'perhitungan_kebutuhandet_berat'		=> $val2->perhitungan_kebutuhandet_berat,
							'perhitungan_kebutuhandet_total'		=> $val2->perhitungan_kebutuhandet_total,
							'perhitungan_kebutuhandet_ukuran'		=> $val2->perhitungan_kebutuhandet_ukuran,
							'perhitungan_kebutuhandet_lebar'		=> $val2->perhitungan_kebutuhandet_lebar,
							'perhitungan_kebutuhandet_slitingan'	=> $val2->perhitungan_kebutuhandet_slitingan,
							'perhitungan_kebutuhandet_keterangan'	=> $val2->perhitungan_kebutuhandet_keterangan,
							'perhitungan_kebutuhandet_status'		=> $val2->perhitungan_kebutuhandet_status,
						);
					}
				}

				// NO ORDER
				// $id = json_decode($val->t_jadwal_produksi_id);
				// for($j=0; $j<sizeof($id); $j++)
				// {
				// 	$where1['data'][] = array(
				// 		'column' => 'jadwal_produksi_id',
				// 		'param'	 => $val->t_jadwal_produksi_id
				// 	);
				// 	$query1 = $this->mod->select('*', 't_jadwal_produksi', NULL, $where1);
				// 	$hasil1['val2'] = array();
				// 	if ($query1) {
				// 		foreach ($query1->result() as $val2) {
				// 			$hasil1['val2'][] = array(
				// 				'id' 	=> $val2->jadwal_produksi_id,
				// 				'text' 	=> $val2->jadwal_produksi_nomor
				// 			);
				// 		}
				// 	}
				// }
				

				$where4['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->m_gudang_id
				);
				$query4 = $this->mod->select('*', 'm_gudang', NULL, $where4);
				$hasil4['val2'] = array();
				if ($query4) {
					foreach ($query4->result() as $val2) {
						$hasil4['val2'][] = array(
							'id' 	=> $val2->gudang_id,
							'text' 	=> $val2->gudang_nama
						);
					}
				}

				$response['val'][] = array(
					'kode' 							=> $val->perhitungan_kebutuhan_id,
					'perhitungan_kebutuhan_nomor' 	=> $val->perhitungan_kebutuhan_nomor,
					'perhitungan_kebutuhan_tanggal' => date("d/m/Y",strtotime($val->perhitungan_kebutuhan_tanggal)),
					't_jadwal_produksi_id'			=> $val->t_jadwal_produksi_id,
					'm_gudang_id'					=> $hasil4,
					'perhitungan_kebutuhan_status' 	=> $val->perhitungan_kebutuhan_status,
					'perhitungan_kebutuhan_jenis' 	=> $val->perhitungan_kebutuhan_jenis,
				);
			}

			echo json_encode($response);
		}
	}

	public function loadDataDetailWhere(){
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
			'column' => 'a.t_perhitungan_kebutuhan_id',
			'param'	 => $this->input->get('id')
		);
		$where_brg['data'][] = array(
			'column' => 'a.t_jadwal_produksidet_id',
			'param'	 => $this->input->get('id_jadwal')
		);
		$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_perhitungan_kebutuhandet a', $join_brg, $where_brg);
		$response['val2'] = array();
		if ($query_brg) {
			foreach ($query_brg->result() as $val2) {
				$response['val2'][] = array(
					'perhitungan_kebutuhandet_id'			=> $val2->perhitungan_kebutuhandet_id,
					't_perhitungan_kebutuhan'				=> $val2->t_perhitungan_kebutuhan_id,
					'm_barang_id'							=> $val2->m_barang_id,
					'barang_kode'							=> $val2->barang_kode,
					'barang_nama'							=> $val2->barang_nama,
					'barang_uraian'							=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
					'jenis_barang_nama'						=> $val2->jenis_barang_nama,
					'satuan_nama'							=> $val2->satuan_nama,
					'perhitungan_kebutuhandet_qty'			=> $val2->perhitungan_kebutuhandet_qty,
					'perhitungan_kebutuhandet_berat'		=> $val2->perhitungan_kebutuhandet_berat,
					'perhitungan_kebutuhandet_total'		=> $val2->perhitungan_kebutuhandet_total,
					'perhitungan_kebutuhandet_ukuran'		=> $val2->perhitungan_kebutuhandet_ukuran,
					'perhitungan_kebutuhandet_lebar'		=> $val2->perhitungan_kebutuhandet_lebar,
					'perhitungan_kebutuhandet_slitingan'	=> $val2->perhitungan_kebutuhandet_slitingan,
					'perhitungan_kebutuhandet_keterangan'	=> $val2->perhitungan_kebutuhandet_keterangan,
					'perhitungan_kebutuhandet_status'		=> $val2->perhitungan_kebutuhandet_status,
				);
			}
		}

		echo json_encode($response);
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
			'table' => 't_perhitungan_kebutuhan e',
			'join'	=> 'e.perhitungan_kebutuhan_id = a.t_perhitungan_kebutuhan_id',
			'type'	=> 'left'
		);
		$where_brg['data'][] = array(
			'column' => 'a.perhitungan_kebutuhandet_id',
			'param'	 => $this->input->get('id')
		);
		$query_brg = $this->mod->select('a.*, b.*, c.*, d.*, e.*', 't_perhitungan_kebutuhandet a', $join_brg, $where_brg);
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
					'perhitungan_kebutuhandet_id'			=> $val2->perhitungan_kebutuhandet_id,
					't_perhitungan_kebutuhan'				=> $val2->t_perhitungan_kebutuhan_id,
					'm_barang_id'							=> $val2->m_barang_id,
					'm_gudang_id'							=> $hasil4,
					'barang_kode'							=> $val2->barang_kode,
					'barang_nama'							=> $val2->barang_nama,
					'barang_uraian'							=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
					'jenis_barang_nama'						=> $val2->jenis_barang_nama,
					'satuan_nama'							=> $val2->satuan_nama,
					'perhitungan_kebutuhandet_qty'			=> $val2->perhitungan_kebutuhandet_qty,
					'perhitungan_kebutuhandet_berat'		=> $val2->perhitungan_kebutuhandet_berat,
					'perhitungan_kebutuhandet_total'		=> $val2->perhitungan_kebutuhandet_total,
					'perhitungan_kebutuhandet_ukuran'		=> $val2->perhitungan_kebutuhandet_ukuran,
					'perhitungan_kebutuhandet_lebar'		=> $val2->perhitungan_kebutuhandet_lebar,
					'perhitungan_kebutuhandet_slitingan'	=> $val2->perhitungan_kebutuhandet_slitingan,
					'perhitungan_kebutuhandet_keterangan'	=> $val2->perhitungan_kebutuhandet_keterangan,
					'perhitungan_kebutuhandet_status'		=> $val2->perhitungan_kebutuhandet_status,
				);
			}
		}

		echo json_encode($response);
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'perhitungan_kebutuhan_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->perhitungan_kebutuhan_status == 1) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'perhitungan_kebutuhan_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 									=> $id,
						'perhitungan_kebutuhanlog_status_dari' 			=> 1,
						'perhitungan_kebutuhanlog_status_ke' 			=> 2,
						'perhitungan_kebutuhanlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'perhitungan_kebutuhanlog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_perhitungan_kebutuhanlog', NULL, $data_log);
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
			'column' => 'perhitungan_kebutuhan_status',
			'param'	 => 3
		);
		$where_like['data'][] = array(
			'column' => 'perhitungan_kebutuhan_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'perhitungan_kebutuhan_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->perhitungan_kebutuhan_id,
					'text'	=> $val->perhitungan_kebutuhan_nomor
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	// public function loadData_selectBarang(){
	// 	$param = $this->input->get('q');
	// 	if ($param!=NULL) {
	// 		$param = $this->input->get('q');
	// 	} else {
	// 		$param = "";
	// 	}
	// 	$select = '*';
	// 	$join_brg['data'][] = array(
	// 		'table' => 'm_barang b',
	// 		'join'	=> 'b.barang_id = a.m_barang_id',
	// 		'type'	=> 'left'
	// 	);
	// 	$join_brg['data'][] = array(
	// 		'table' => 't_perhitungan_kebutuhan c',
	// 		'join'	=> 'c.perhitungan_kebutuhan_id = a.t_perhitungan_kebutuhan_id',
	// 		'type'	=> 'left'
	// 	);
	// 	$where['data'][] = array(
	// 		'column' => 't_perhitungan_kebutuhan_id',
	// 		'param'	 => $param
	// 	);
	// 	$where_like['data'][] = array(
	// 		'column' => 'perhitungan_kebutuhan_nomor',
	// 		'param'	 => $this->input->get('q')
	// 	);
	// 	$order['data'][] = array(
	// 		'column' => 'perhitungan_kebutuhan_nomor',
	// 		'type'	 => 'ASC'
	// 	);
	// 	$query = $this->mod->select($select, '', NULL, $where, NULL, $where_like, $order);
	// 	$response['items'] = array();
	// 	if ($query<>false) {
	// 		foreach ($query->result() as $val) {
	// 			$response['items'][] = array(
	// 				'id'	=> $val->perhitungan_kebutuhan_id,
	// 				'text'	=> $val->perhitungan_kebutuhan_nomor
	// 			);
	// 		}
	// 		$response['status'] = '200';
	// 	}

	// 	echo json_encode($response);
	// }

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['test'] = $type;
		if (strlen($id)>0) {
			if ($type == 2) {
				//UPDATE
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'perhitungan_kebutuhan_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}
			}
			else if ($type == 3) {
				//UPDATE
				$data = $this->general_post_data(4, $id);
				$where['data'][] = array(
					'column' => 'perhitungan_kebutuhan_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 									=> $id,
						'perhitungan_kebutuhanlog_status_dari' 			=> $this->input->post('status_awal', TRUE),
						'perhitungan_kebutuhanlog_status_ke' 			=> $this->input->post('perhitungan_kebutuhan_status', TRUE),
						'perhitungan_kebutuhanlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'perhitungan_kebutuhanlog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_perhitungan_kebutuhanlog', NULL, $data_log);
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
				if($this->input->post('perhitungan_kebutuhan_jenis', TRUE) == 1)
				{
					for ($i = 0; $i < sizeof($this->input->post('jadwal_produksidet_id', TRUE)); $i++) {
						for ($j = 0; $j < sizeof($this->input->post('m_barang_id'.($i+1), TRUE)); $j++) {
							$data_det = array(
								't_perhitungan_kebutuhan_id' 			=> $insert->output,
								't_jadwal_produksidet_id' 				=> $this->input->post('jadwal_produksidet_id', TRUE)[$i],
								'm_barang_id' 							=> $this->input->post('m_barang_id'.($i+1), TRUE)[$j],
								'perhitungan_kebutuhandet_qty' 			=> $this->input->post('jadwal_produksi_qty', TRUE)[$i],
								'perhitungan_kebutuhandet_berat' 		=> $this->input->post('perhitungan_kebutuhandet_berat', TRUE)[$i],
								'perhitungan_kebutuhandet_total' 		=> $this->input->post('perhitungan_kebutuhandet_total', TRUE)[$i],
								'perhitungan_kebutuhandet_ukuran' 		=> $this->input->post('perhitungan_kebutuhandet_ukuran'.($i+1), TRUE)[$j],
								'perhitungan_kebutuhandet_lebar' 		=> $this->input->post('perhitungan_kebutuhandet_lebar'.($i+1), TRUE)[$j],
								'perhitungan_kebutuhandet_slitingan' 	=> $this->input->post('perhitungan_kebutuhandet_slitingan'.($i+1), TRUE)[$j],
								'perhitungan_kebutuhandet_keterangan' 	=> $this->input->post('perhitungan_kebutuhandet_keterangan'.($i+1), TRUE)[$j],
								'perhitungan_kebutuhandet_status'		=> 1,
								'perhitungan_kebutuhandet_created_date'	=> date('Y-m-d H:i:s'),
								'perhitungan_kebutuhandet_created_by'	=> $this->session->userdata('user_username'),
								'perhitungan_kebutuhandet_update_date'	=> date('Y-m-d H:i:s'),
								'perhitungan_kebutuhandet_revised' 		=> 0,
							);
							$response['detail'][] = $data_det;
							$insert_det = $this->mod->insert_data_table('t_perhitungan_kebutuhandet', NULL, $data_det);
						}
					}
					// $response['id'] = $data['t_jadwal_produksi_id'];
					// CHECK DATA JADWAL PRODUKSI
					$id = json_decode($data['t_jadwal_produksi_id']);
					// $response['id2'] = $id[0];
					for($i=0; $i<sizeof($id); $i++)
					{
						if (@$whereJadwal['data']) {
							unset($whereJadwal['data']);
						}
						$whereJadwal['data'][] = array(
							'column' => 'jadwal_produksi_id',
							'param'	 => $id[$i]
						);
						$queryJadwal = $this->mod->select('*', 't_jadwal_produksi', NULL, $whereJadwal);
						if ($queryJadwal) {
							foreach ($queryJadwal->result() as $row) {
								$datahdr = array(
									'jadwal_produksi_status' 		=> 3,
									'jadwal_produksi_status_date'	=> date('Y-m-d H:i:s'),
									'jadwal_produksi_update_date'	=> date('Y-m-d H:i:s'),
									'jadwal_produksi_update_by'		=> $this->session->userdata('user_username'),
									'jadwal_produksi_revised' 		=> $row->jadwal_produksi_revised + 1,
								);
								$update = $this->mod->update_data_table('t_jadwal_produksi', $whereJadwal, $datahdr);
								// INSERT LOG);
								$data_log = array(
									'referensi_id' 							=> $row->jadwal_produksi_id,
									'jadwal_produksilog_status_dari' 		=> $row->jadwal_produksi_status,
									'jadwal_produksilog_status_ke' 			=> 3,
									'jadwal_produksilog_status_update_date' => date('Y-m-d H:i:s'),
									'jadwal_produksilog_status_update_by'	=> $this->session->userdata('user_username'),
								);
								$insert_log = $this->mod->insert_data_table('t_jadwal_produksilog', NULL, $data_log);
							}
						}
					}
					
					// END CHECK DATA JADWAL PRODUKSI
				}
				else
				{
					for ($i = 0; $i < sizeof($this->input->post('barang_id', TRUE)); $i++) {
						for ($j = 0; $j < sizeof($this->input->post('m_barang_id'.($i+1), TRUE)); $j++) {
							$data_det = array(
								't_perhitungan_kebutuhan_id' 			=> $insert->output,
								'barang_jadi_id' 						=> $this->input->post('barang_id', TRUE)[$i],
								'm_barang_id' 							=> $this->input->post('m_barang_id'.($i+1), TRUE)[$j],
								'perhitungan_kebutuhandet_qty' 			=> $this->input->post('jadwal_produksi_qty', TRUE)[$i],
								'perhitungan_kebutuhandet_berat' 		=> $this->input->post('perhitungan_kebutuhandet_berat', TRUE)[$i],
								'perhitungan_kebutuhandet_total' 		=> $this->input->post('perhitungan_kebutuhandet_total', TRUE)[$i],
								'perhitungan_kebutuhandet_ukuran' 		=> $this->input->post('perhitungan_kebutuhandet_ukuran'.($i+1), TRUE)[$j],
								'perhitungan_kebutuhandet_lebar' 		=> $this->input->post('perhitungan_kebutuhandet_lebar'.($i+1), TRUE)[$j],
								'perhitungan_kebutuhandet_slitingan' 	=> $this->input->post('perhitungan_kebutuhandet_slitingan'.($i+1), TRUE)[$j],
								'perhitungan_kebutuhandet_keterangan' 	=> $this->input->post('perhitungan_kebutuhandet_keterangan'.($i+1), TRUE)[$j],
								'perhitungan_kebutuhandet_status'		=> 1,
								'perhitungan_kebutuhandet_created_date'	=> date('Y-m-d H:i:s'),
								'perhitungan_kebutuhandet_created_by'	=> $this->session->userdata('user_username'),
								'perhitungan_kebutuhandet_update_date'	=> date('Y-m-d H:i:s'),
								'perhitungan_kebutuhandet_revised' 		=> 0,
							);
							$response['detail'][] = $data_det;
							$insert_det = $this->mod->insert_data_table('t_perhitungan_kebutuhandet', NULL, $data_det);
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
			'column' => 'perhitungan_kebutuhan_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join_det['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = a.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 't_perhitungan_kebutuhan_id',
					'param'	 => $val->perhitungan_kebutuhan_id
				);
				$query_det = $this->mod->select('*','t_perhitungan_kebutuhandet',NULL,$where_det);
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
									'perhitungan_kebutuhan_id'				=> $val2->perhitungan_kebutuhandet_id,
									'barang_kode'							=> $val3->barang_kode,
									'barang_nama'							=> $val3->barang_nama,
									'barang_nomor'							=> $val3->barang_nomor,
									'jenis_barang_nama'						=> $val3->jenis_barang_nama,
									'satuan_nama'							=> $val3->satuan_nama,
									'perhitungan_kebutuhandet_qty'			=> $val2->perhitungan_kebutuhandet_qty,
									'perhitungan_kebutuhandet_berat'		=> $val2->perhitungan_kebutuhandet_berat,
									'perhitungan_kebutuhandet_total'		=> $val2->perhitungan_kebutuhandet_total,
									'perhitungan_kebutuhandet_ukuran'		=> $val2->perhitungan_kebutuhandet_ukuran,
									'perhitungan_kebutuhandet_lebar'		=> $val2->perhitungan_kebutuhandet_lebar,
									'perhitungan_kebutuhandet_slitingan'	=> $val2->perhitungan_kebutuhandet_slitingan,
									'perhitungan_kebutuhandet_keterangan'	=> $val2->perhitungan_kebutuhandet_keterangan,
									'm_barang_id'							=> $val2->m_barang_id,
								);
							}
						}
						// CARI BARANG DAN STOK
					}
				}
				// END CARI DETAIL
				// CARI PENYETUJU
				// $hasil4['val2'] = array();
				// $where_penyetuju['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->perhitungan_kebutuhan_penyetuju
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
				// CARI JADWAL PRODUKSI
				$id = json_decode($val->t_jadwal_produksi_id);
				$hasil5['val2'] = array();
				$where_penerima['data'][] = array(
					'column' => 'jadwal_produksi_id',
					'param'	 => $id[0]
				);
				$query_penerima = $this->mod->select('*','t_jadwal_produksi',NULL,$where_penerima);
				if ($query_penerima) {
					foreach ($query_penerima->result() as $val2) {
						$hasil5['val2'][] = array(
							'periode' 	=> $val2->jadwal_produksi_periode,
							'shift' 	=> $val2->jadwal_produksi_shift
						);
					}
				}
				// END CARI JADWAL PRODUKSI
				// CARI SUPPLIER
				// $hasil6['val2'] = array();
				// $join_supp['data'][] = array(
				// 	'table' => 'm_partner c',
				// 	'join'	=> 'c.partner_id = a.m_supplier_id',
				// 	'type'	=> 'left'
				// );
				// $where_supp['data'][] = array(
				// 	'column' => 'a.order_id',
				// 	'param'	 => $val->t_order_id
				// );
				// $query_supp = $this->mod->select('a.*, c.partner_nama','t_order a',$join_supp,$where_supp);
				// if ($query_supp) {
				// 	foreach ($query_supp->result() as $val3) {
				// 		$hasil6['val2'][] = array(
				// 			'id' 	=> $val3->order_nomor,
				// 			'supplier' 	=> $val3->partner_nama
				// 		);
				// 	}
				// }
				// END CARI SUPLLIER
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
					'kode' 											=> $val->perhitungan_kebutuhan_id,
					'perhitungan_kebutuhan_nomor' 					=> $val->perhitungan_kebutuhan_nomor,
					// 'perhitungan_kebutuhan_jenis' 					=> $val->perhitungan_kebutuhan_jenis,
					// 'perhitungan_kebutuhan_sj' 						=> $val->perhitungan_kebutuhan_sj,
					// 'perhitungan_kebutuhan_ppn' 					=> $val->perhitungan_kebutuhan_ppn,
					// 'perhitungan_kebutuhan_tanggal'					=> date("d/m/Y",strtotime($val->perhitungan_kebutuhan_tanggal)),
					// 'perhitungan_kebutuhan_tanggal_terima'			=> date("d/m/Y",strtotime($val->perhitungan_kebutuhan_tanggal_terima)),
					// 'perhitungan_kebutuhan_catatan' 				=> $val->perhitungan_kebutuhan_catatan,
					'perhitungan_kebutuhan_status' 					=> $val->perhitungan_kebutuhan_status,
					// 'perhitungan_kebutuhan_penyetuju' 				=> $hasil4,
					'perhitungan_kebutuhan_periode' 				=> $hasil5,
					'perhitungan_kebutuhan_pembuat' 				=> $val->perhitungan_kebutuhan_created_by,
					// 'perhitungan_kebutuhan_supplier' 				=> $hasil6,
					'cabang'										=> $hasil7
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Perhitungan Kebutuhan',
			'title_page2' 	=> 'Print Perhitungan Kebutuhan',
		);
		// echo json_encode($response);
		$this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_perhitungan_kebutuhan', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('perhitungan_kebutuhan_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'perhitungan_kebutuhan_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('perhitungan_kebutuhan_status, perhitungan_kebutuhan_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['perhitungan_kebutuhan_revised'] + 1;
			$status = $revised['perhitungan_kebutuhan_status'];
		}
		if ($type == 1) {
			$perhitungan_kebutuhan_nomor = $this->get_kode_transaksi();
			if($this->input->post('perhitungan_kebutuhan_jenis', TRUE) == 1)
			{
				$data = array(
					'm_cabang_id' 							=> $this->session->userdata('cabang_id'),
					'perhitungan_kebutuhan_nomor' 			=> $perhitungan_kebutuhan_nomor,
					'perhitungan_kebutuhan_jenis' 			=> $this->input->post('perhitungan_kebutuhan_jenis', TRUE),
					'perhitungan_kebutuhan_tanggal' 		=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
					't_jadwal_produksi_id'					=> json_encode($this->input->post('id', TRUE)),
					'perhitungan_kebutuhan_status' 			=> 1,
					'perhitungan_kebutuhan_status_date'		=> date('Y-m-d H:i:s'),
					'perhitungan_kebutuhan_created_date'	=> date('Y-m-d H:i:s'),
					'perhitungan_kebutuhan_update_date'		=> date('Y-m-d H:i:s'),
					'perhitungan_kebutuhan_created_by'		=> $this->session->userdata('user_username'),
					'perhitungan_kebutuhan_revised' 		=> 0,
				);
			}
			else
			{
				$data = array(
					'm_cabang_id' 							=> $this->session->userdata('cabang_id'),
					'perhitungan_kebutuhan_nomor' 			=> $perhitungan_kebutuhan_nomor,
					'perhitungan_kebutuhan_jenis' 			=> $this->input->post('perhitungan_kebutuhan_jenis', TRUE),
					'perhitungan_kebutuhan_tanggal' 		=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
					'perhitungan_kebutuhan_status' 			=> 1,
					'perhitungan_kebutuhan_status_date'		=> date('Y-m-d H:i:s'),
					'perhitungan_kebutuhan_created_date'	=> date('Y-m-d H:i:s'),
					'perhitungan_kebutuhan_update_date'		=> date('Y-m-d H:i:s'),
					'perhitungan_kebutuhan_created_by'		=> $this->session->userdata('user_username'),
					'perhitungan_kebutuhan_revised' 		=> 0,
				);
			}
		} else if ($type == 2) {
			$data = array(
				'm_gudang_id' 							=> $this->input->post('m_gudang_id'),
				'perhitungan_kebutuhan_update_date'		=> date('Y-m-d H:i:s'),
				'perhitungan_kebutuhan_update_by'		=> $this->session->userdata('user_username'),
				'perhitungan_kebutuhan_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'perhitungan_kebutuhan_status'			=> 2,
				'perhitungan_kebutuhan_status_date'		=> date('Y-m-d H:i:s'),
				'perhitungan_kebutuhan_update_date'		=> date('Y-m-d H:i:s'),
				'perhitungan_kebutuhan_update_by'		=> $this->session->userdata('user_username'),
				'perhitungan_kebutuhan_revised' 		=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'perhitungan_kebutuhan_status'			=> $this->input->post('perhitungan_kebutuhan_status', TRUE),
				'perhitungan_kebutuhan_status_date'		=> date('Y-m-d H:i:s'),
				'perhitungan_kebutuhan_update_date'		=> date('Y-m-d H:i:s'),
				'perhitungan_kebutuhan_update_by'		=> $this->session->userdata('user_username'),
				'perhitungan_kebutuhan_revised' 		=> $rev,
			);
		} 

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(perhitungan_kebutuhan_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(perhitungan_kebutuhan_nomor,1,9)',
			'param'	 => 'PKB'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'perhitungan_kebutuhan_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('PKB',$query,$bln);
		return $kode_baru;
	}
	/* end Function */

}
