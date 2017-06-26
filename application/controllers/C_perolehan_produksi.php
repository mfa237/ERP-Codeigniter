<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_perolehan_produksi extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_perolehan_produksi';

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
				'title_page2' 	=> 'Perolehan Produksi',
				// 'priv_add'		=> $priv['create']
				);
			// if($priv['read'] == 1)
			// {
				$this->open_page('perolehan-produksi/V_perolehan_produksi', $data);
			// }
			// else
			// {
			// 	$this->load->view('layout/V_404', $data);
			// }
		} else if ($type == 2) {
			// $data = array(
			// 	'aplikasi'		=> $this->app_name,
			// 	'title_page' 	=> 'Pembelian',
			// 	'title_page2' 	=> 'Ketidaksesuaian Spesifikasi',
			// 	'priv_add'		=> ''
			// 	);

			// $this->open_page('ketidaksesuaian-spesifikasi/V_ketidaksesuaian_spesifikasi2', $data);
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
			'column' => 'cabang_nama, perolehan_produksi_nomor',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_perolehan_produksi');
		$query_filter = $this->mod->select($select, 'v_perolehan_produksi', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_perolehan_produksi', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Produksi/Perolehan-Produksi/Form/'.$val->perolehan_produksi_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Perolehan Produksi">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Produksi/Perolehan-Produksi/print-Perolehan-Produksi/'.$val->perolehan_produksi_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					// $button = '
					// <a href="'.base_url().'Pembelian/ketidaksesuaian-spesifikasi/Form/'.$val->ketidaksesuaian_spesifikasi_id.'">
					// <button class="btn blue-ebonyclay" type="button" onclick="checkStatusBPB('.$val->ketidaksesuaian_spesifikasi_id.')"  title="Lihat FKS">
					// 	<i class="icon-eye text-center"></i>
					// </button>
					// </a>
					// <a href="'.base_url().'Produksi/Ketidaksesuaian-Spesifikasi/print-BPB/'.$val->ketidaksesuaian_spesifikasi_id.'">
					// <button class="btn green-jungle" type="button" title="Print PDF">
					// 	<i class="icon-printer text-center"></i>
					// </button>
					// </a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->perolehan_produksi_nomor,
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
			'title_page2' 	=> 'Perolehan Produksi',
			'id'			=> $id
		);
		$this->open_page('perolehan-produksi/V_form_perolehan_produksi', $data);
	}

	// public function getForm2($id = null){
	// 	$data = array(
	// 		'aplikasi'		=> $this->app_name,
	// 		'title_page' 	=> 'Pembelian',
	// 		'title_page2' 	=> 'Ketidaksesuaian Spesifikasi',
	// 		'id'			=> $id
	// 	);
	// 	$this->open_page('ketidaksesuaian-spesifikasi/V_form_ketidaksesuaian_spesifikasi2', $data);
	// }

	public function loadDataWhere($type){
		$select = 'a.*, b.*';
		$join_JP['data'][] = array(
			'table' => 't_jadwal_produksi b',
			'join'	=> 'b.jadwal_produksi_id = a.t_jadwal_produksi_id',
			'type' 	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'perolehan_produksi_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, 't_perolehan_produksi a', $join_JP, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				if (@$join['data']) {
					unset($join['data']);
				}
				if (@$where_det['data']) {
					unset($where_det['data']);
				}
				$join['data'][] = array(
					'table' => 't_jadwal_produksi_awaldet b',
					'join'	=> 'b.jadwal_produksi_awaldet_id = a.t_jadwal_produksi_awaldet_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 't_jadwal_produksi c',
					'join'	=> 'c.jadwal_produksi_id = b.t_jadwal_produksi_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_barang d',
					'join'	=> 'd.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_satuan e',
					'join'	=> 'e.satuan_id = d.m_satuan_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_jenis_barang f',
					'join'	=> 'f.jenis_barang_id = d.m_jenis_barang_id',
					'type' 	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 't_perolehan_produksi_id',
					'param'	 => $val->perolehan_produksi_id
				);
				if($type == '2')
				{
					$where_det['data'][] = array(
						'column' => 'perolehan_produksi_awaldet_status <',
						'param'	 => 1
					);
				}
				$query_det = $this->mod->select('a.*, b.*, c.*, d.*, e.satuan_nama, f.jenis_barang_nama', 't_perolehan_produksi_awaldet a', $join, $where_det);
				$response['val2'] = array();
				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$gudang_id = '';
						$gudang_nama = '';
						$selectGudang = 'a.*, b.*';
						if (@$whereGudang['data']) {
							unset($whereGudang['data']);
						}
						$joinGudang['data'][] = array(
							'table'	=> 'm_gudang b',
							'join'	=> 'b.gudang_id = a.m_gudang_id',
							'type'	=> 'left'
						);
						// $whereGudang['data'][] = array(
						// 	'column'	=> 'a.perhitungan_kebutuhan_status',
						// 	'param'		=> 3
						// );
						$whereGudang['data'][] = array(
							'column'	=> 'a.t_jadwal_produksi_id',
							'param'		=> '"'.$val2->jadwal_produksi_id.'"'
						);
						$queryGudang = $this->mod->select($select, 't_perhitungan_kebutuhan a', $joinGudang, null, null, $whereGudang);
						if ($queryGudang<>false) {
							foreach ($queryGudang->result() as $val3) {
								// $response['gudang_produksi'] = $val3->m_gudang_id;
								$gudang_id = $val3->m_gudang_id;
								$gudang_nama = $val3->gudang_nama;
								$response['id'] = $val3->perhitungan_kebutuhan_id;
								// $idJadwal = json_decode($val3->t_jadwal_produksi_id);
								// $response['idJadwal'][] = $idJadwal;
								// for($k = 0; $k < sizeof($idJadwal); $k++)
								// {
								// 	if($idJadwal[$k] == $val2->jadwal_produksi_id)
								// 	{
								// 		$gudang_id = $val3->m_gudang_id;
								// 		$gudang_nama = $val3->gudang_nama;
								// 		$verifikasi = $val3->perhitungan_kebutuhan_verifikasi_jumlah;
								// 		$verifikasi++;
								// 		$response['val2'][] = array(
								// 			'jadwal_produksi_id'						=> $val2->jadwal_produksi_id,
								// 			'jadwal_produksi_nomor'						=> $val2->jadwal_produksi_nomor,
								// 			't_jadwal_produksi_awaldet_id'				=> $val2->t_jadwal_produksi_awaldet_id,
								// 			'jadwal_produksi_awaldet_no_seri'			=> $val2->jadwal_produksi_awaldet_no_seri,
								// 			'perolehan_produksi_awaldet_id'				=> $val2->perolehan_produksi_awaldet_id,
								// 			't_perolehan_produksi_id'					=> $val2->t_perolehan_produksi_id,
								// 			'barang_id'									=> $val2->barang_id,
								// 			'barang_kode'								=> $val2->barang_kode,
								// 			'barang_nama'								=> $val2->barang_nama,
								// 			'barang_uraian'								=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
								// 			'satuan_nama'								=> $val2->satuan_nama,
								// 			'gudang_produksi_id'						=> $gudang_id,
								// 			'gudang_produksi_nama'						=> $gudang_nama,
								// 			'perolehan_produksi_awaldet_bahangross'		=> $val2->perolehan_produksi_awaldet_bahangross,
								// 			'perolehan_produksi_awaldet_bahannet'		=> $val2->perolehan_produksi_awaldet_bahannet,
								// 			'perolehan_produksi_awaldet_bahantimbang'	=> $val2->perolehan_produksi_awaldet_bahantimbang,
								// 			'perolehan_produksi_awaldet_bahankulit'		=> $val2->perolehan_produksi_awaldet_bahankulit,
								// 			'perolehan_produksi_awaldet_bahantong'		=> $val2->perolehan_produksi_awaldet_bahantong,
								// 		);
								// 		if($verifikasi == sizeof($idJadwal))
								// 		{
								// 			$rev = $val3->perhitungan_kebutuhan_revised;
								// 			$rev++;
								// 			$dataStatus = array(
								// 				'perhitungan_kebutuhan_verifikasi_jumlah'	=> $verifikasi,
								// 				'perhitungan_kebutuhan_status'	=> 4,
								// 				'perhitungan_kebutuhan_update_date'	=> date('Y-m-d H:i:s'),
								// 				'perhitungan_kebutuhan_update_by'	=> $this->session->userdata('user_username'),
								// 				'perhitungan_kebutuhan_revised'		=> $rev

								// 			);
								// 			if (@$whereStatus['data']) {
								// 				unset($whereStatus['data']);
								// 			}
								// 			$whereStatus['data'][] = array(
								// 				'column' => 'perhitungan_kebutuhan_id',
								// 				'param'	 => $val3->perhitungan_kebutuhan_id
								// 			);
								// 			$jumlah = $this->mod->update_data_table('t_perhitungan_kebutuhan', $whereStatus, $dataStatus);
								// 		}
								// 		else
								// 		{
								// 			$rev = $val3->perhitungan_kebutuhan_revised;
								// 			$rev++;
								// 			$dataStatus = array(
								// 				'perhitungan_kebutuhan_verifikasi_jumlah'	=> $verifikasi,
								// 				'perhitungan_kebutuhan_update_date'	=> date('Y-m-d H:i:s'),
								// 				'perhitungan_kebutuhan_update_by'	=> $this->session->userdata('user_username'),
								// 				'perhitungan_kebutuhan_revised'		=> $rev

								// 			);
								// 			if (@$whereStatus['data']) {
								// 				unset($whereStatus['data']);
								// 			}
								// 			$whereStatus['data'][] = array(
								// 				'column' => 'perhitungan_kebutuhan_id',
								// 				'param'	 => $val3->perhitungan_kebutuhan_id
								// 			);
								// 			$jumlah = $this->mod->update_data_table('t_perhitungan_kebutuhan', $whereStatus, $dataStatus);
								// 		}
								// 		break 3;
								// 	}
								// }
								
							}
							$response['val2'][] = array(
								'jadwal_produksi_id'						=> $val2->jadwal_produksi_id,
								'jadwal_produksi_nomor'						=> $val2->jadwal_produksi_nomor,
								't_jadwal_produksi_awaldet_id'				=> $val2->t_jadwal_produksi_awaldet_id,
								'jadwal_produksi_awaldet_no_seri'			=> $val2->jadwal_produksi_awaldet_no_seri,
								'perolehan_produksi_awaldet_id'				=> $val2->perolehan_produksi_awaldet_id,
								't_perolehan_produksi_id'					=> $val2->t_perolehan_produksi_id,
								'barang_id'									=> $val2->barang_id,
								'barang_kode'								=> $val2->barang_kode,
								'barang_nama'								=> $val2->barang_nama,
								'barang_uraian'								=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
								'satuan_nama'								=> $val2->satuan_nama,
								'gudang_produksi_id'						=> $gudang_id,
								'gudang_produksi_nama'						=> $gudang_nama,
								'perolehan_produksi_awaldet_bahangross'		=> $val2->perolehan_produksi_awaldet_bahangross,
								'perolehan_produksi_awaldet_bahannet'		=> $val2->perolehan_produksi_awaldet_bahannet,
								'perolehan_produksi_awaldet_bahantimbang'	=> $val2->perolehan_produksi_awaldet_bahantimbang,
								'perolehan_produksi_awaldet_bahankulit'		=> $val2->perolehan_produksi_awaldet_bahankulit,
								'perolehan_produksi_awaldet_bahantong'		=> $val2->perolehan_produksi_awaldet_bahantong,
							);
						}
						
					}
				}
				if (@$where_brg['data']) {
					unset($where_brg['data']);
				}
				if (@$where_brg['data']) {
					unset($where_brg['data']);
				}
				// CARI DETAIL BARANG
				$join_brg['data'][] = array(
					'table' => 't_jadwal_produksi_akhirdet b',
					'join'	=> 'b.jadwal_produksi_akhirdet_id = a.t_jadwal_produksi_akhirdet_id',
					'type' 	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 't_jadwal_produksi c',
					'join'	=> 'c.jadwal_produksi_id = b.t_jadwal_produksi_id',
					'type' 	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_barang d',
					'join'	=> 'd.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_satuan e',
					'join'	=> 'e.satuan_id = d.m_satuan_id',
					'type' 	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_jenis_barang f',
					'join'	=> 'f.jenis_barang_id = d.m_jenis_barang_id',
					'type' 	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 't_perolehan_produksi g',
					'join'	=> 'g.perolehan_produksi_id = a.t_perolehan_produksi_id',
					'type' 	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_gudang h',
					'join'	=> 'h.gudang_id = g.m_gudang_id',
					'type' 	=> 'left'
				);
				$where_brg['data'][] = array(
					'column' => 't_perolehan_produksi_id',
					'param'	 => $val->perolehan_produksi_id
				);
				if($type == '2')
				{
					$where_brg['data'][] = array(
						'column' => 'perolehan_produksi_akhirdet_status <',
						'param'	 => 1
					);
				}
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.*', 't_perolehan_produksi_akhirdet a', $join_brg, $where_brg);
				$response['val3'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val2) {
						if($val2->jadwal_produksi_id != null)
						{
							
						}
						$response['val3'][] = array(
							'jadwal_produksi_id'						=> $val2->t_jadwal_produksi_id,
							'jadwal_produksi_nomor'						=> $val2->jadwal_produksi_nomor,
							't_jadwal_produksi_akhirdet_id'				=> $val2->t_jadwal_produksi_akhirdet_id,
							'perolehan_produksi_akhirdet_id'			=> $val2->perolehan_produksi_akhirdet_id,
							't_perolehan_produksi_id'					=> $val2->t_perolehan_produksi_id,
							'barang_id'									=> $val2->barang_id,
							'barang_kode'								=> $val2->barang_kode,
							'barang_nama'								=> $val2->barang_nama,
							'barang_uraian'								=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'satuan_nama'								=> $val2->satuan_nama,
							'perolehan_produksi_akhirdet_berat'			=> $val2->perolehan_produksi_akhirdet_berat,
							'perolehan_produksi_akhirdet_panjang'		=> $val2->perolehan_produksi_akhirdet_panjang,
							'perolehan_produksi_akhirdet_tebal'			=> $val2->perolehan_produksi_akhirdet_tebal,
							'perolehan_produksi_akhirdet_micro'			=> $val2->perolehan_produksi_akhirdet_micro,
							'perolehan_produksi_akhirdet_qty'			=> $val2->perolehan_produksi_akhirdet_qty,
							'perolehan_produksi_akhirdet_ns'			=> $val2->perolehan_produksi_akhirdet_ns,
							'perolehan_produksi_akhirdet_qty_rusak'		=> $val2->perolehan_produksi_akhirdet_qty_rusak,
							'perolehan_produksi_akhirdet_konversi'		=> $val2->perolehan_produksi_akhirdet_konversi,
							'perolehan_produksi_akhirdet_keterangan'	=> $val2->perolehan_produksi_akhirdet_keterangan,
							'gudang_id'									=> $val2->gudang_id,
							'gudang_nama'								=> $val2->gudang_nama,
							'perolehan_produksi_akhirdet_status'		=> $val2->perolehan_produksi_akhirdet_status,
						);
					}
				}

				// NO ORDER
				$where1['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->m_gudang_id
				);
				$query1 = $this->mod->select('*', 'm_gudang', NULL, $where1);
				$hasil1['val2'] = array();
				if ($query1) {
					foreach ($query1->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->gudang_id,
							'text' 	=> $val2->gudang_nama
						);
					}
				}
				$selectKonversi = '*';
				if (@$whereKonversi['data']) {
					unset($whereKonversi['data']);
				}
				$response['jenis'] = $val->jadwal_produksi_jenis;
				$whereKonversi['data'][] = array(
					'column'	=> 'jenis_produksi_id',
					'param'		=> $val->jadwal_produksi_jenis
				);
				$hasil['val2'] = array();
				$queryKonversi = $this->mod->select($selectKonversi, 'm_jenis_produksidet', null, $whereKonversi);
				if($queryKonversi)
				{
					$tanda = '';
					
					foreach ($queryKonversi->result() as $val3) {
						$hasil['val2'][] = array(
							'type'		=> $val3->jenis_produksi_type,
							'parameter'	=> $val3->jenis_produksidet_parameter,
							'operator'	=> $val3->jenis_produksidet_operator
						);
					}
				}
				// $where2['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->ketidaksesuaian_spesifikasi_operator
				// );
				// $query2 = $this->mod->select('*', 'm_karyawan', NULL, $where2);
				// $hasil5['val2'] = array();
				// if ($query2) {
				// 	foreach ($query2->result() as $val2) {
				// 		$hasil5['val2'][] = array(
				// 			'id' 	=> $val2->karyawan_id,
				// 			'text' 	=> $val2->karyawan_nama
				// 		);
				// 	}
				// }

				$response['val'][] = array(
					'kode' 								=> $val->perolehan_produksi_id,
					'perolehan_produksi_nomor' 			=> $val->perolehan_produksi_nomor,
					'perolehan_produksi_total' 			=> $val->perolehan_produksi_total,
					'perolehan_produksi_afalan' 		=> $val->perolehan_produksi_afalan,
					'perolehan_produksi_rusak' 			=> $val->perolehan_produksi_rusak,
					'm_gudang_id_tujuan'				=> $hasil1,
					'jenis_produksidet'					=> $hasil,
					'perolehan_produksi_status' 		=> $val->perolehan_produksi_status,
				);
			}

			echo json_encode($response);
		}
	}

	public function loadDataAwalWhere()
	{
		$join['data'][] = array(
			'table' => 't_jadwal_produksi_awaldet b',
			'join'	=> 'b.jadwal_produksi_awaldet_id = a.t_jadwal_produksi_awaldet_id',
			'type' 	=> 'left'
		);
		$join['data'][] = array(
			'table' => 't_jadwal_produksi c',
			'join'	=> 'c.jadwal_produksi_id = b.t_jadwal_produksi_id',
			'type' 	=> 'left'
		);
		$join['data'][] = array(
			'table' => 'm_barang d',
			'join'	=> 'd.barang_id = a.m_barang_id',
			'type' 	=> 'left'
		);
		$join['data'][] = array(
			'table' => 'm_satuan e',
			'join'	=> 'e.satuan_id = d.m_satuan_id',
			'type' 	=> 'left'
		);
		$join['data'][] = array(
			'table' => 'm_jenis_barang f',
			'join'	=> 'f.jenis_barang_id = d.m_jenis_barang_id',
			'type' 	=> 'left'
		);
		$where_det['data'][] = array(
			'column' => 'a.t_perolehan_produksi_id',
			'param'	 => $this->input->get('id')
		);
		$where_det['data'][] = array(
			'column' => 'a.m_barang_id',
			'param'	 => $this->input->get('barang_id')
		);
		$query_det = $this->mod->select('a.*, b.*, c.*, d.*, e.satuan_nama, f.jenis_barang_nama', 't_perolehan_produksi_awaldet a', $join, $where_det);
		$response['val2'] = array();
		if ($query_det) {
			foreach ($query_det->result() as $val2) {
				// $whereGudang['data'][] = array(
				// 	'column'	=> 't_jadwal_produksi_id',
				// 	'param'		=> $val2->jadwal_produksi_id
				// );
				// $queryGudang = $this->mod->select('*', 't_perhitungan_kebutuhan', null, null, null, $whereGudang);
				// if($queryGudang)
				// {
				// 	foreach ($queryGudang->result() as $val3) {
				// 		$response['gudang'] = $val3->m_gudang_id;
				// 	}
				// }
				$response['val2'][] = array(
					'jadwal_produksi_id'						=> $val2->t_jadwal_produksi_id,
					'jadwal_produksi_nomor'						=> $val2->jadwal_produksi_nomor,
					't_jadwal_produksi_awaldet_id'				=> $val2->t_jadwal_produksi_awaldet_id,
					'jadwal_produksi_awaldet_no_seri'			=> $val2->jadwal_produksi_awaldet_no_seri,
					'perolehan_produksi_awaldet_id'				=> $val2->perolehan_produksi_awaldet_id,
					't_perolehan_produksi_id'					=> $val2->t_perolehan_produksi_id,
					'barang_id'									=> $val2->barang_id,
					'barang_kode'								=> $val2->barang_kode,
					'barang_nama'								=> $val2->barang_nama,
					'barang_uraian'								=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
					'satuan_nama'								=> $val2->satuan_nama,
					'perolehan_produksi_awaldet_bahangross'		=> $val2->perolehan_produksi_awaldet_bahangross,
					'perolehan_produksi_awaldet_bahannet'		=> $val2->perolehan_produksi_awaldet_bahannet,
					'perolehan_produksi_awaldet_bahantimbang'	=> $val2->perolehan_produksi_awaldet_bahantimbang,
					'perolehan_produksi_awaldet_bahankulit'		=> $val2->perolehan_produksi_awaldet_bahankulit,
					'perolehan_produksi_awaldet_bahantong'		=> $val2->perolehan_produksi_awaldet_bahantong,
				);
			}
		}
		echo json_encode($response);
	}

	public function loadDataAkhirWhere()
	{
		$join['data'][] = array(
			'table' => 't_jadwal_produksi_akhirdet b',
			'join'	=> 'b.jadwal_produksi_akhirdet_id = a.t_jadwal_produksi_akhirdet_id',
			'type' 	=> 'left'
		);
		$join['data'][] = array(
			'table' => 't_jadwal_produksi c',
			'join'	=> 'c.jadwal_produksi_id = b.t_jadwal_produksi_id',
			'type' 	=> 'left'
		);
		$join['data'][] = array(
			'table' => 'm_barang d',
			'join'	=> 'd.barang_id = a.m_barang_id',
			'type' 	=> 'left'
		);
		$join['data'][] = array(
			'table' => 'm_satuan e',
			'join'	=> 'e.satuan_id = d.m_satuan_id',
			'type' 	=> 'left'
		);
		$join['data'][] = array(
			'table' => 'm_jenis_barang f',
			'join'	=> 'f.jenis_barang_id = d.m_jenis_barang_id',
			'type' 	=> 'left'
		);
		$join['data'][] = array(
			'table' => 't_perolehan_produksi g',
			'join'	=> 'g.perolehan_produksi_id = a.t_perolehan_produksi_id',
			'type' 	=> 'left'
		);
		$join['data'][] = array(
			'table' => 'm_gudang h',
			'join'	=> 'h.gudang_id = g.m_gudang_id',
			'type' 	=> 'left'
		);
		$where_det['data'][] = array(
			'column' => 'a.perolehan_produksi_akhirdet_id',
			'param'	 => $this->input->get('id')
		);
		// $where_det['data'][] = array(
		// 	'column' => 'a.m_barang_id',
		// 	'param'	 => $this->input->get('barang_id')
		// );
		$query_det = $this->mod->select('a.*, b.*, c.*, d.*, e.satuan_nama, f.jenis_barang_nama, h.gudang_nama, h.gudang_id', 't_perolehan_produksi_akhirdet a', $join, $where_det);
		$response['val2'] = array();
		$hasil['val2'] = array();
		if ($query_det) {
			foreach ($query_det->result() as $val2) {
				// $selectKonversi = '*';
				// $whereKonversi['data'][] = array(
				// 	'column'	=> 'jenis_produksi_id',
				// 	'param'		=> $val2->jadwal_produksi_jenis
				// );
				// $queryKonversi = $this->mod->select($selectKonversi, 'm_jenis_produksidet', null, $whereKonversi);
				// if($queryKonversi)
				// {
				// 	$tanda = '';
				// 	$hasilKonversi;
				// 	foreach ($queryKonversi->result() as $val3) {
				// 		$hasil['val2'][] = array(
				// 			'type'		=> $val3->jenis_produksi_type,
				// 			'parameter'	=> $val3->jenis_produksidet_parameter,
				// 			'operator'	=> $val3->jenis_produksidet_operator
				// 		);
				// 	}
				// }
				$response['val2'][] = array(
					'jadwal_produksi_id'						=> $val2->t_jadwal_produksi_id,
					'jadwal_produksi_nomor'						=> $val2->jadwal_produksi_nomor,
					't_jadwal_produksi_akhirdet_id'				=> $val2->t_jadwal_produksi_akhirdet_id,
					'perolehan_produksi_akhirdet_id'			=> $val2->perolehan_produksi_akhirdet_id,
					't_perolehan_produksi_id'					=> $val2->t_perolehan_produksi_id,
					'barang_id'									=> $val2->barang_id,
					'barang_kode'								=> $val2->barang_kode,
					'barang_nama'								=> $val2->barang_nama,
					'barang_uraian'								=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
					'gudang_id'									=> $val2->gudang_id,
					'gudang_nama'								=> $val2->gudang_nama,
					'satuan_nama'								=> $val2->satuan_nama,
					'perolehan_produksi_akhirdet_berat'			=> $val2->perolehan_produksi_akhirdet_berat,
					'perolehan_produksi_akhirdet_panjang'		=> $val2->perolehan_produksi_akhirdet_panjang,
					'perolehan_produksi_akhirdet_tebal'			=> $val2->perolehan_produksi_akhirdet_tebal,
					'perolehan_produksi_akhirdet_micro'			=> $val2->perolehan_produksi_akhirdet_micro,
					'perolehan_produksi_akhirdet_qty'			=> $val2->perolehan_produksi_akhirdet_qty,
					'perolehan_produksi_akhirdet_ns'			=> $val2->perolehan_produksi_akhirdet_ns,
					'perolehan_produksi_akhirdet_qty_rusak'		=> $val2->perolehan_produksi_akhirdet_qty_rusak,
					'perolehan_produksi_akhirdet_konversi'		=> $val2->perolehan_produksi_akhirdet_konversi,
					'perolehan_produksi_akhirdet_keterangan'	=> $val2->perolehan_produksi_akhirdet_keterangan,
					'perolehan_produksi_akhirdet_status'		=> $val2->perolehan_produksi_akhirdet_status,
					// 'jenis_produksidet'							=> $hasil,
				);
			}
		}
		echo json_encode($response);
	}

	// public function checkStatus(){
	// 	$id = $this->input->get('id');
	// 	$select = '*';
	// 	$where['data'][] = array(
	// 		'column' => 'ketidaksesuaian_spesifikasi_id',
	// 		'param'	 => $id
	// 	);
	// 	$query = $this->mod->select($select, $this->tbl, NULL, $where);
	// 	if ($query<>false) {
	// 		foreach ($query->result() as $row) {
	// 			if ($row->ketidaksesuaian_spesifikasi_status == 1) {
	// 				$data = $this->general_post_data(3, $id);
	// 				$where['data'][] = array(
	// 					'column' => 'ketidaksesuaian_spesifikasi_id',
	// 					'param'	 => $id
	// 				);
	// 				$update = $this->mod->update_data_table($this->tbl, $where, $data);
	// 				// INSERT LOG);
	// 				$data_log = array(
	// 					'referensi_id' 								=> $id,
	// 					'ketidaksesuaian_spesifikasilog_status_dari' 			=> 1,
	// 					'ketidaksesuaian_spesifikasilog_status_ke' 				=> 2,
	// 					'ketidaksesuaian_spesifikasilog_status_update_date' 	=> date('Y-m-d H:i:s'),
	// 					'ketidaksesuaian_spesifikasilog_status_update_by'		=> $this->session->userdata('user_username'),
	// 				);
	// 				$insert_log = $this->mod->insert_data_table('t_ketidaksesuaian_spesifikasilog', NULL, $data_log);
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
		$where_like['data'][] = array(
			'column' => 'perolehan_produksi_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'perolehan_produksi_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, 't_perolehan_produksi', null, null, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$selectStatus = '*';
				if (@$whereStatus['data']) {
					unset($whereStatus['data']);
				}
				$whereStatus['data'][] = array(
					'column' => 't_perolehan_produksi_id',
					'param'	 => $val->perolehan_produksi_id
				);
				$whereStatus['data'][] = array(
					'column' => 'perolehan_produksi_akhirdet_status',
					'param'	 => 0
				);
				$queryStatus = $this->mod->select($selectStatus, 't_perolehan_produksi_akhirdet', null, $whereStatus, NULL);
				if($queryStatus)
				{
					$response['items'][] = array(
						'id'	=> $val->perolehan_produksi_id,
						'text'	=> $val->perolehan_produksi_nomor
					);
				}
				
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function loadData_selectFKS(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'perolehan_produksi_status',
			'param'	 => 1
		);
		$where['data'][] = array(
			'column' => 'perolehan_produksi_rusak >',
			'param'	 => '0'
		);
		$where_like['data'][] = array(
			'column' => 'perolehan_produksi_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'perolehan_produksi_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, 't_perolehan_produksi a', null, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->perolehan_produksi_id,
					'text'	=> $val->perolehan_produksi_nomor
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
			// if ($type == 2) {
				//UPDATE
				$data = $this->general_post_data(2, $id);
				$response['data'] = $data;
				$where['data'][] = array(
					'column' => 'perolehan_produksi_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					// INSERT DETAIL AWAL
					for ($i = 0; $i < sizeof($this->input->post('perolehan_produksi_awaldet_id', TRUE)); $i++) {
						$data_det_awal = $this->general_post_data2(3, $id, $i, $this->input->post('perolehan_produksi_awaldet_id', TRUE)[$i]);
						$response['data_awal'] = $data_det_awal;
						if (@$where_det_awal['data']) {
							unset($where_det_awal['data']);
						}
						$where_det_awal['data'][] = array(
							'column' => 'perolehan_produksi_awaldet_id',
							'param'	 => $this->input->post('perolehan_produksi_awaldet_id', TRUE)[$i]
						);
						$update_det_awal = $this->mod->update_data_table('t_perolehan_produksi_awaldet', $where_det_awal, $data_det_awal);
						if($update_det_awal->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
					// INSERT DETAIL AKHIR
					for ($i = 0; $i < sizeof($this->input->post('jadwal_produksi_akhirdet_id', TRUE)); $i++) {
						$data_det_akhir = $this->general_post_data2(4, $id, $i, $this->input->post('perolehan_produksi_akhirdet_id', TRUE)[$i]);
						$response['data_det_akhir'] = $data_det_akhir;
						if (@$where_det_akhir['data']) {
							unset($where_det_akhir['data']);
						}
						$where_det_akhir['data'][] = array(
							'column' => 'perolehan_produksi_akhirdet_id',
							'param'	 => $this->input->post('perolehan_produksi_akhirdet_id', TRUE)[$i]
						);
						$update_det_akhir = $this->mod->update_data_table('t_perolehan_produksi_akhirdet', $where_det_akhir, $data_det_akhir);
						if($update_det_akhir->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
				} else {
					$response['status'] = '204';
				}
			// }
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
				// INSERT DETAIL BAHAN
				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) {
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_perolehan_produksi_awaldet', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
				// INSERT DETAIL BARANG JADI
				for ($i = 0; $i < sizeof($this->input->post('barang_id', TRUE)); $i++) {
					$data_det_akhir = $this->general_post_data2(2, $insert->output, $i);
					$insert_det_akhir = $this->mod->insert_data_table('t_perolehan_produksi_akhirdet', NULL, $data_det_akhir);
					if($insert_det_akhir->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
				// TAMBAH UPDATE STATUS JADWAL JADI REALISASI!!!
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
			'column' => 'perolehan_produksi_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join['data'][] = array(
					'table' => 't_jadwal_produksi_awaldet b',
					'join'	=> 'b.jadwal_produksi_awaldet_id = a.t_jadwal_produksi_awaldet_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 't_jadwal_produksi c',
					'join'	=> 'c.jadwal_produksi_id = b.t_jadwal_produksi_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_barang d',
					'join'	=> 'd.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_satuan e',
					'join'	=> 'e.satuan_id = d.m_satuan_id',
					'type' 	=> 'left'
				);
				$join['data'][] = array(
					'table' => 'm_jenis_barang f',
					'join'	=> 'f.jenis_barang_id = d.m_jenis_barang_id',
					'type' 	=> 'left'
				);
				$where_det['data'][] = array(
					'column' => 't_perolehan_produksi_id',
					'param'	 => $val->perolehan_produksi_id
				);
				$query_det = $this->mod->select('a.*, b.*, c.jadwal_produksi_nomor, d.*, e.satuan_nama, f.*', 't_perolehan_produksi_awaldet a', $join, $where_det);
				$response['val2'] = array();
				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'jadwal_produksi_id'						=> $val2->t_jadwal_produksi_id,
							'jadwal_produksi_nomor'						=> $val2->jadwal_produksi_nomor,
							't_jadwal_produksi_awaldet_id'				=> $val2->t_jadwal_produksi_awaldet_id,
							'jadwal_produksi_awaldet_no_seri'			=> $val2->jadwal_produksi_awaldet_no_seri,
							'perolehan_produksi_awaldet_id'				=> $val2->perolehan_produksi_awaldet_id,
							't_perolehan_produksi_id'					=> $val2->t_perolehan_produksi_id,
							'barang_id'									=> $val2->barang_id,
							'barang_kode'								=> $val2->barang_kode,
							'barang_uraian'								=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'barang_nama'								=> $val2->barang_nama,
							'satuan_nama'								=> $val2->satuan_nama,
							'perolehan_produksi_awaldet_bahangross'		=> $val2->perolehan_produksi_awaldet_bahangross,
							'perolehan_produksi_awaldet_bahannet'		=> $val2->perolehan_produksi_awaldet_bahannet,
							'perolehan_produksi_awaldet_bahantimbang'	=> $val2->perolehan_produksi_awaldet_bahantimbang,
							'perolehan_produksi_awaldet_bahankulit'		=> $val2->perolehan_produksi_awaldet_bahankulit,
							'perolehan_produksi_awaldet_bahantong'		=> $val2->perolehan_produksi_awaldet_bahantong,
						);
					}
				}

				// CARI DETAIL BARANG
				$join_brg['data'][] = array(
					'table' => 't_jadwal_produksi_akhirdet b',
					'join'	=> 'b.jadwal_produksi_akhirdet_id = a.t_jadwal_produksi_akhirdet_id',
					'type' 	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 't_jadwal_produksi c',
					'join'	=> 'c.jadwal_produksi_id = b.t_jadwal_produksi_id',
					'type' 	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_barang d',
					'join'	=> 'd.barang_id = a.m_barang_id',
					'type' 	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_satuan e',
					'join'	=> 'e.satuan_id = d.m_satuan_id',
					'type' 	=> 'left'
				);
				$where_brg['data'][] = array(
					'column' => 't_perolehan_produksi_id',
					'param'	 => $val->perolehan_produksi_id
				);
				$query_brg = $this->mod->select('a.*, b.t_jadwal_produksi_id, c.jadwal_produksi_nomor, d.*, e.satuan_nama', 't_perolehan_produksi_akhirdet a', $join_brg, $where_brg);
				$response['val3'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val2) {
						$response['val3'][] = array(
							'jadwal_produksi_id'						=> $val2->t_jadwal_produksi_id,
							'jadwal_produksi_nomor'						=> $val2->jadwal_produksi_nomor,
							't_jadwal_produksi_akhirdet_id'				=> $val2->t_jadwal_produksi_akhirdet_id,
							'perolehan_produksi_akhirdet_id'			=> $val2->perolehan_produksi_akhirdet_id,
							't_perolehan_produksi_id'					=> $val2->t_perolehan_produksi_id,
							'barang_id'									=> $val2->barang_id,
							'barang_kode'								=> $val2->barang_kode,
							'barang_nama'								=> $val2->barang_nama,
							'satuan_nama'								=> $val2->satuan_nama,
							'perolehan_produksi_akhirdet_berat'			=> $val2->perolehan_produksi_akhirdet_berat,
							'perolehan_produksi_akhirdet_panjang'		=> $val2->perolehan_produksi_akhirdet_panjang,
							'perolehan_produksi_akhirdet_tebal'			=> $val2->perolehan_produksi_akhirdet_tebal,
							'perolehan_produksi_akhirdet_micro'			=> $val2->perolehan_produksi_akhirdet_micro,
							'perolehan_produksi_akhirdet_qty'			=> $val2->perolehan_produksi_akhirdet_qty,
							'perolehan_produksi_akhirdet_ns'			=> $val2->perolehan_produksi_akhirdet_ns,
							'perolehan_produksi_akhirdet_qty_rusak'		=> $val2->perolehan_produksi_akhirdet_qty_rusak,
							'perolehan_produksi_akhirdet_konversi'		=> $val2->perolehan_produksi_akhirdet_konversi,
							'perolehan_produksi_akhirdet_keterangan'	=> $val2->perolehan_produksi_akhirdet_keterangan,
						);
					}
				}
				// CARI PENYETUJU
				// $hasil4['val2'] = array();
				// $where_penyetuju['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->ketidaksesuaian_spesifikasi_penyetuju
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
				// 	'param'	 => $val->ketidaksesuaian_spesifikasi_pemeriksa
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
				// CARI OPERATOR
				// $hasil6['val2'] = array();
				// $where_operator['data'][] = array(
				// 	'column' => 'karyawan_id',
				// 	'param'	 => $val->ketidaksesuaian_spesifikasi_operator
				// );
				// $query_operator = $this->mod->select('*','m_karyawan',null,$where_operator);
				// if ($query_operator) {
				// 	foreach ($query_operator->result() as $val3) {
				// 		$hasil6['val2'][] = array(
				// 			'id' 		=> $val3->karyawan_id,
				// 			'text' 		=> $val3->karyawan_nama
				// 		);
				// 	}
				// }
				// END CARI OPERATOR
				// CARI JADWAL PRODUKSI
				// $hasil5['val2'] = array();
				// $where_jadwal['data'][] = array(
				// 	'column' => 'jadwal_produksi_id',
				// 	'param'	 => $val->t_jadwal_produksi_id
				// );
				// $query_jadwal = $this->mod->select('*','t_jadwal_produksi',null,$where_jadwal);
				// if ($query_jadwal) {
				// 	foreach ($query_jadwal->result() as $val3) {
				// 		$hasil5['val2'][] = array(
				// 			'nomor' 		=> $val3->jadwal_produksi_nomor,
				// 			'shift' 		=> $val3->jadwal_produksi_shift,
				// 			'jenis_produksi'=> $val3->jadwal_produksi_jenis
				// 		);
				// 	}
				// }
				// END CARI JADWAL PRODUKSI
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
				$name = $val->perolehan_produksi_nomor;
				// END CARI CABANG
				$response['val'][] = array(
					'kode' 									=> $val->perolehan_produksi_id,
					'perolehan_produksi_nomor' 				=> $val->perolehan_produksi_nomor,
					'perolehan_produksi_total'				=> $val->perolehan_produksi_total,
					'perolehan_produksi_afalan' 			=> $val->perolehan_produksi_afalan,
					'perolehan_produksi_rusak' 				=> $val->perolehan_produksi_rusak,
					// 'ketidaksesuaian_spesifikasi_ppn' 		=> $val->ketidaksesuaian_spesifikasi_ppn,
					'perolehan_produksi_tanggal'			=> date("d/m/Y",strtotime($val->perolehan_produksi_created_date)),
					'perolehan_produksi_hari'				=> date("D",strtotime($val->perolehan_produksi_created_date)),
					// 'ketidaksesuaian_spesifikasi_catatan' 	=> $val->ketidaksesuaian_spesifikasi_catatan,
					// 'ketidaksesuaian_spesifikasi_status' 	=> $val->ketidaksesuaian_spesifikasi_status,
					// 'ketidaksesuaian_spesifikasi_penyetuju' 				=> $hasil4,
					// 'ketidaksesuaian_spesifikasi_produksi'	=> $hasil5,
					'perolehan_produksi_created_by' 	=> $val->perolehan_produksi_created_by,
					// 'ketidaksesuaian_spesifikasi_operator' 	=> $hasil6,
					'cabang'								=> $hasil7
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Perolehan Produksi',
			'title_page2' 	=> 'Print Perolehan Produksi',
		);
		// echo json_encode($response);
		$this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_perolehan_produksi', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		// $arrDate = explode('/', $this->input->post('perolehan_produksi_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'perolehan_produksi_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('perolehan_produksi_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['perolehan_produksi_revised'] + 1;
		}
		if ($type == 1) {
			$perolehan_produksi_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 						=> $this->session->userdata('cabang_id'),
				'perolehan_produksi_nomor' 			=> $perolehan_produksi_nomor,
				// 'perolehan_produksi_tanggal' 		=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'perolehan_produksi_total' 			=> $this->input->post('perolehan_produksi_total', TRUE),
				't_jadwal_produksi_id' 				=> $this->input->post('t_jadwal_id', TRUE),
				'perolehan_produksi_afalan'			=> $this->input->post('perolehan_produksi_afalan', TRUE),
				'perolehan_produksi_rusak'			=> $this->input->post('perolehan_produksi_rusak', TRUE),
				'm_gudang_id'						=> $this->input->post('m_gudang_id_tujuan', TRUE),
				'perolehan_produksi_created_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_update_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_created_by'		=> $this->session->userdata('user_username'),
				'perolehan_produksi_status'			=> 1,
				'perolehan_produksi_revised' 		=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'm_gudang_id'						=> $this->input->post('m_gudang_id_tujuan', TRUE),
				'perolehan_produksi_total' 			=> $this->input->post('perolehan_produksi_total', TRUE),
				'perolehan_produksi_afalan'			=> $this->input->post('perolehan_produksi_afalan', TRUE),
				'perolehan_produksi_rusak'			=> $this->input->post('perolehan_produksi_rusak', TRUE),
				'perolehan_produksi_update_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_update_by'		=> $this->session->userdata('user_username'),
				'perolehan_produksi_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'perolehan_produksi_status'			=> 2,
				'perolehan_produksi_status_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_update_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_update_by'		=> $this->session->userdata('user_username'),
				'perolehan_produksi_revised' 		=> $rev,
			);
		} 

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if ($type == 1) {
			$data = array(
				't_perolehan_produksi_id' 					=> $idHdr,
				'm_barang_id'								=> $this->input->post('m_barang_id', TRUE)[$seq],
				't_jadwal_produksi_awaldet_id' 				=> $this->input->post('jadwal_produksi_awaldet_id', TRUE)[$seq],
				'perolehan_produksi_awaldet_bahangross' 	=> $this->input->post('perolehan_produksi_awaldet_bahangross', TRUE)[$seq],
				'perolehan_produksi_awaldet_bahannet' 		=> $this->input->post('perolehan_produksi_awaldet_bahannet', TRUE)[$seq],
				'perolehan_produksi_awaldet_bahantimbang' 	=> $this->input->post('perolehan_produksi_awaldet_bahantimbang', TRUE)[$seq],
				'perolehan_produksi_awaldet_bahankulit' 	=> $this->input->post('perolehan_produksi_awaldet_bahankulit', TRUE)[$seq],
				'perolehan_produksi_awaldet_bahantong' 		=> $this->input->post('perolehan_produksi_awaldet_bahantong', TRUE)[$seq],
				'perolehan_produksi_awaldet_status'			=> 0,
				'perolehan_produksi_awaldet_created_by'		=> $this->session->userdata('user_username'),
				'perolehan_produksi_awaldet_created_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_awaldet_revised'		=> 0,
			);	
		} else if ($type == 2) {
			$data = array(
				't_perolehan_produksi_id' 					=> $idHdr,
				'm_barang_id'								=> $this->input->post('barang_id', TRUE)[$seq],
				't_jadwal_produksi_akhirdet_id' 			=> $this->input->post('jadwal_produksi_akhirdet_id', TRUE)[$seq],
				'perolehan_produksi_akhirdet_berat' 		=> $this->input->post('perolehan_produksi_akhirdet_berat', TRUE)[$seq],
				'perolehan_produksi_akhirdet_panjang' 		=> $this->input->post('perolehan_produksi_akhirdet_panjang', TRUE)[$seq],
				'perolehan_produksi_akhirdet_tebal' 		=> $this->input->post('perolehan_produksi_akhirdet_tebal', TRUE)[$seq],
				'perolehan_produksi_akhirdet_micro' 		=> $this->input->post('perolehan_produksi_akhirdet_micro', TRUE)[$seq],
				'perolehan_produksi_akhirdet_qty' 			=> $this->input->post('perolehan_produksi_akhirdet_qty', TRUE)[$seq],
				'perolehan_produksi_akhirdet_qty_rusak' 	=> $this->input->post('perolehan_produksi_akhirdet_qty_rusak', TRUE)[$seq],
				'perolehan_produksi_akhirdet_ns' 			=> $this->input->post('perolehan_produksi_akhirdet_ns', TRUE)[$seq],
				'perolehan_produksi_akhirdet_konversi' 		=> $this->input->post('perolehan_produksi_akhirdet_konversi', TRUE)[$seq],
				'perolehan_produksi_akhirdet_keterangan' 	=> $this->input->post('perolehan_produksi_akhirdet_ket', TRUE)[$seq],
				'perolehan_produksi_akhirdet_status'		=> 0,
				'perolehan_produksi_akhirdet_created_by'	=> $this->session->userdata('user_username'),
				'perolehan_produksi_akhirdet_created_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_akhirdet_revised'		=> 0,
			);
		} else if ($type == 3) {
			if (@$where['data']) {
				unset($where['data']);
			}
			$where['data'][] = array(
				'column' => 'perolehan_produksi_awaldet_id',
				'param'	 => $id
			);
			$queryRevised = $this->mod->select('perolehan_produksi_awaldet_revised', 't_perolehan_produksi_awaldet', NULL, $where);
			if ($queryRevised) {
				$revised = $queryRevised->row_array();
				$rev = $revised['perolehan_produksi_awaldet_revised'] + 1;
			}
			$data = array(
				'perolehan_produksi_awaldet_bahangross' 	=> $this->input->post('perolehan_produksi_awaldet_bahangross', TRUE)[$seq],
				'perolehan_produksi_awaldet_bahannet' 		=> $this->input->post('perolehan_produksi_awaldet_bahannet', TRUE)[$seq],
				'perolehan_produksi_awaldet_bahantimbang' 	=> $this->input->post('perolehan_produksi_awaldet_bahantimbang', TRUE)[$seq],
				'perolehan_produksi_awaldet_bahankulit' 	=> $this->input->post('perolehan_produksi_awaldet_bahankulit', TRUE)[$seq],
				'perolehan_produksi_awaldet_bahantong' 		=> $this->input->post('perolehan_produksi_awaldet_bahantong', TRUE)[$seq],
				'perolehan_produksi_awaldet_update_by'		=> $this->session->userdata('user_username'),
				'perolehan_produksi_awaldet_update_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_awaldet_revised'		=> $rev,
			);	
		} else if ($type == 4) {
			if (@$where['data']) {
				unset($where['data']);
			}
			$where['data'][] = array(
				'column' => 'perolehan_produksi_akhirdet_id',
				'param'	 => $id
			);
			$queryRevised = $this->mod->select('perolehan_produksi_akhirdet_revised', 't_perolehan_produksi_akhirdet', NULL, $where);
			if ($queryRevised) {
				$revised = $queryRevised->row_array();
				$rev2 = $revised['perolehan_produksi_akhirdet_revised'] + 1;
			}
			$data = array(
				'perolehan_produksi_akhirdet_berat' 		=> $this->input->post('perolehan_produksi_akhirdet_berat', TRUE)[$seq],
				'perolehan_produksi_akhirdet_panjang' 		=> $this->input->post('perolehan_produksi_akhirdet_panjang', TRUE)[$seq],
				'perolehan_produksi_akhirdet_tebal' 		=> $this->input->post('perolehan_produksi_akhirdet_tebal', TRUE)[$seq],
				'perolehan_produksi_akhirdet_micro' 		=> $this->input->post('perolehan_produksi_akhirdet_micro', TRUE)[$seq],
				'perolehan_produksi_akhirdet_qty' 			=> $this->input->post('perolehan_produksi_akhirdet_qty', TRUE)[$seq],
				'perolehan_produksi_akhirdet_qty_rusak' 	=> $this->input->post('perolehan_produksi_akhirdet_qty_rusak', TRUE)[$seq],
				'perolehan_produksi_akhirdet_ns' 			=> $this->input->post('perolehan_produksi_akhirdet_ns', TRUE)[$seq],
				'perolehan_produksi_akhirdet_konversi' 		=> $this->input->post('perolehan_produksi_akhirdet_konversi', TRUE)[$seq],
				'perolehan_produksi_akhirdet_keterangan' 	=> $this->input->post('perolehan_produksi_akhirdet_ket', TRUE)[$seq],
				'perolehan_produksi_akhirdet_update_by'		=> $this->session->userdata('user_username'),
				'perolehan_produksi_akhirdet_update_date'	=> date('Y-m-d H:i:s'),
				'perolehan_produksi_akhirdet_revised'		=> $rev2,
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(perolehan_produksi_nomor,9,5) as id';
		$where['data'][] = array(
			'column' => 'MID(perolehan_produksi_nomor,1,8)',
			'param'	 => 'PP'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'perolehan_produksi_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('PP',$query,$bln);
		return $kode_baru;
	}
	/* end Function */

}
