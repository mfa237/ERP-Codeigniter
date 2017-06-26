<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_stok_gudang extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = '';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(17);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Stok Gudang',
			'title_page2' 	=> 'Stok Gudang',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('stok-gudang/V_stok_gudang', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadDataStok(){
		// $priv = $this->cekUser(17);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		$where['data'][] = array(
			'column' => 'barang_status_aktif',
			'param'	 => 'y'
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, gudang_nama, barang_nomor, barang_nama, jenis_barang_nama, stok_minimum, stok_gudang, satuan_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_stok_gudang');
		$query_filter = $this->mod->select($select, 'v_stok_gudang', NULL, $where, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_stok_gudang', NULL, $where, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				if ($val->barang_status_aktif == 'y') {
					$button = '';
				} else {
					$button = '';
				}
				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->gudang_nama,
					$val->barang_nomor,
					$val->barang_nama,
					$val->jenis_barang_nama,
					number_format($val->stok_minimum, 2, ',', '.'),
					number_format($val->stok_gudang, 2, ',', '.'),
					$val->satuan_nama
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

	public function loadDataKartuStok(){
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		$where['data'][] = array(
			'column' => 'cabang_id',
			'param'	 => $this->input->get('id_cabang')
		);
		$where['data'][] = array(
			'column' => 'gudang_id',
			'param'	 => $this->input->get('id_gudang')
		);
		$where['data'][] = array(
			'column' => 'barang_id',
			'param'	 => $this->input->get('id_barang')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'kartu_stok_tanggal, kartu_stok_referensi, kartu_stok_masuk, kartu_stok_keluar, kartu_stok_sisa',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_kartu_stok');
		$query_filter = $this->mod->select($select, 'v_kartu_stok', NULL, $where, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_kartu_stok', NULL, $where, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			$nilai = 0;
			foreach ($query->result() as $val) {

				if ($val->kartu_stok_keterangan == "Penerimaan Barang") {
					if (@$join_det['data']) {
						unset($join_det['data']);
					}
					if (@$where_det['data']) {
						unset($where_det['data']);
					}
					$join_det['data'][] = array(
						'table' => 't_penerimaan_barangdet b',
						'join'	=> 'b.t_penerimaan_barang_id = a.penerimaan_barang_id',
						'type'	=> 'inner'
					);
					$where_det['data'][] = array(
						'column' => 'a.penerimaan_barang_nomor',
						'param'	 => $val->kartu_stok_referensi
					);
					$where_det['data'][] = array(
						'column' => 'b.m_barang_id',
						'param'	 => $val->barang_id
					);
					$query_det = $this->mod->select('b.*', 't_penerimaan_barang a', $join_det, $where_det);
					if ($query_det) {
						foreach ($query_det->result() as $val2) {
							$nilai = $val2->penerimaan_barangdet_harga_satuan;
						}
					}
				}

				$response['data'][] = array(
					$no,
					date("d/m/Y", strtotime($val->kartu_stok_tanggal)),
					$val->kartu_stok_referensi,
					$val->kartu_stok_keterangan,
					number_format($val->kartu_stok_masuk, 2, ',', '.'),
					number_format($val->kartu_stok_keluar, 2, ',', '.'),
					number_format($val->kartu_stok_sisa, 2, ',', '.'),
					number_format(($nilai * $val->kartu_stok_sisa), 2, ',', '.'),
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

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'm_barang_id',
			'param'	 => $this->input->get('id')
		);
		$response['id'] = $this->input->get('id');
		$query = $this->mod->select($select, 't_stok_gudang', NULL, $where);
		if ($query<>false) {
			$response['query'] = $query;
			foreach ($query->result() as $val) {
				$response['val'][] = array(
					// 'kode' 							=> $val->barang_id,
					// 'barang_kode' 					=> $val->barang_kode,
					// 'barang_nomor' 					=> $val->barang_nomor,
					// 'barang_nama' 					=> $val->barang_nama,
					// 'barang_minimum_stok' 			=> $val->barang_minimum_stok,
					// 'm_satuan_id'					=> $hasil2,
					// 'm_jenis_barang_id' 			=> $hasil1,
					// 'barang_status_aktif' 			=> $val->barang_status_aktif
					'stok_gudang_no_seri' 				=> $val->stok_gudang_no_seri,
					// 'stok_gudang_berat_barang' 			=> explode(',', $val->stok_gudang_berat_barang),
				);
			}

			echo json_encode($response);
		}
	}

	public function loadDataJumlahWhere(){
		$select = '*';
		$where_like['data'][] = array(
			'column' => 'stok_gudang_no_seri',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, 't_stok_gudang', NULL, NULL, NULL, $where_like);
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'stok_gudang_jumlah' 	=> $val->stok_gudang_jumlah,
				);
			}

			echo json_encode($response);
		}
	}

	public function cetakPDF()
	{
		$this->load->library('pdf');
		$name = 'Kartu Stok Barang -';
		// print_r($name);
		$select = '*';
		$where['data'][] = array(
			'column' => 'cabang_id',
			'param'	 => $this->input->post('m_cabang_id')
		);
		$where['data'][] = array(
			'column' => 'gudang_id',
			'param'	 => $this->input->post('m_gudang_id')
		);
		$where['data'][] = array(
			'column' => 'barang_id',
			'param'	 => $this->input->post('m_barang_id')
		);
		$query = $this->mod->select($select, 'v_kartu_stok', NULL, $where, NULL, NULL, NULL, NULL);
		$response['val'] = array();
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Stok Gudang',
			'title_page2' 	=> 'Kartu Stok',
		);
 		if ($query<>false) {
 			$no = 0;
			foreach ($query->result() as $val) {
				if($no == 0)
				{
					$response['barang_nama'] = $val->barang_nama;
					$response['satuan'] = $val->satuan_nama;
					$name = $name.' '.$val->barang_nama.'';
				}
				$no++;
				$response['val'][] = array(
					'tanggal_kartu_stok' 		=> date("d/m/Y", strtotime($val->kartu_stok_tanggal)),
					'referensi'					=> $val->kartu_stok_referensi,
					'keterangan' 				=> $val->kartu_stok_keterangan,
					'qty_masuk' 				=> number_format($val->kartu_stok_masuk, "0", ",", "."),
					'qty_keluar' 				=> number_format($val->kartu_stok_keluar, "0", ",", "."),
					'sisa' 						=> number_format($val->kartu_stok_sisa, "0", ",", "."),
				);
			}
		}
		$this->pdf->load_view('print/P_kartu_stok', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}
}
