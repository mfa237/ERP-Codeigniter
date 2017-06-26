<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class C_penerimaan_barang extends MY_Controller {

	private $any_error = array();

	// Define Main Table

	public $tbl = 't_penerimaan_barang';



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

				'title_page' 	=> 'Gudang',

				'title_page2' 	=> 'Penerimaan Barang',

				'priv_add'		=> $priv['create']

				);

			if($priv['read'] == 1)

			{

				$this->open_page('penerimaan-barang/V_penerimaan_barang', $data);

			}

			else

			{

				$this->load->view('layout/V_404', $data);

			}

		} else if ($type == 2) {

			$data = array(

				'aplikasi'		=> $this->app_name,

				'title_page' 	=> 'Pembelian',

				'title_page2' 	=> 'Penerimaan Barang',

				'priv_add'		=> ''

				);



			$this->open_page('penerimaan-barang/V_penerimaan_barang2', $data);

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

			'column' => 'cabang_nama, penerimaan_barang_nomor, order_nomor, penerimaan_barang_tanggal, penerimaan_barang_status_nama',

			'param'	 => $this->input->get('search[value]')

		);

		//ORDER

		$index_order = $this->input->get('order[0][column]');

		$order['data'][] = array(

			'column' => $this->input->get('columns['.$index_order.'][name]'),

			'type'	 => $this->input->get('order[0][dir]')

		);



		$query_total = $this->mod->select($select, 'v_penerimaan_barang');

		$query_filter = $this->mod->select($select, 'v_penerimaan_barang', NULL, NULL, NULL, $where_like, $order);

		$query = $this->mod->select($select, 'v_penerimaan_barang', NULL, NULL, NULL, $where_like, $order, $limit);



		$response['data'] = array();

		if ($query<>false) {

			$no = $limit['start']+1;

			foreach ($query->result() as $val) {



				if ($type == 1) {

					$button = '

					<a href="'.base_url().'Gudang/Penerimaan-Barang/Form/'.$val->penerimaan_barang_id.'">

					<button class="btn blue-ebonyclay" type="button" title="Lihat BPB">

						<i class="icon-eye text-center"></i>

					</button>

					</a>

					<a href="'.base_url().'Gudang/Penerimaan-Barang/print-BPB/'.$val->penerimaan_barang_id.'">

					<button class="btn green-jungle" type="button" title="Print PDF">

						<i class="icon-printer text-center"></i>

					</button>

					</a>';

					if ($val->penerimaan_barang_status == 1) {

						$button .= '

						<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->penerimaan_barang_id.')" title="Hapus Data">

							<i class="icon-close text-center"></i>

						</button>';

					}

				} else if ($type == 2) {

					$button = '

					<a href="'.base_url().'Pembelian/Penerimaan-Barang/Form/'.$val->penerimaan_barang_id.'">

					<button class="btn blue-ebonyclay" type="button" onclick="checkStatusBPB('.$val->penerimaan_barang_id.')"  title="Lihat BPB">

						<i class="icon-eye text-center"></i>

					</button>

					</a>

					<a href="'.base_url().'Gudang/Penerimaan-Barang/print-BPB/'.$val->penerimaan_barang_id.'">

					<button class="btn green-jungle" type="button" title="Print PDF">

						<i class="icon-printer text-center"></i>

					</button>

					</a>';

				}



				$response['data'][] = array(

					$no,

					$val->cabang_nama,

					$val->penerimaan_barang_nomor,

					$val->order_nomor,

					date("d/m/Y",strtotime($val->penerimaan_barang_tanggal)),

					$val->penerimaan_barang_status_nama,

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

		// echo $this->db->last_query();
		// die;

		echo json_encode($response);

	}



	public function getForm1($id = null){

		$this->check_session();

		$data = array(

			'aplikasi'			=> $this->app_name,

			'title_page' 		=> 'Gudang',

			'title_page2' 	=> 'Penerimaan Barang',

			'id'						=> $id

		);

		$this->open_page('penerimaan-barang/V_form_penerimaan_barang', $data);

	}



	public function getForm2($id = null){

		$this->check_session();

		$data = array(

			'aplikasi'			=> $this->app_name,

			'title_page' 		=> 'Pembelian',

			'title_page2' 	=> 'Penerimaan Barang',

			'id'						=> $id

		);

		$this->open_page('penerimaan-barang/V_form_penerimaan_barang2', $data);

	}



	public function loadDataWhere(){

		$select = '*';

		$paramid = "";

		$where2 = NULL;



		$where['data'][] = array(

			'column' => 'penerimaan_barang_id',

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

					'column' => 'a.t_penerimaan_barang_id',

					'param'	 => $val->penerimaan_barang_id

				);

				if ($this->input->get('Paramid')) {
					$paramid = $this->input->get('Paramid');

					if ( $paramid != 1) {
						if ($paramid == 2) {
							$where_brg['data'][] = array(
								'column' => 'a.statusdelcom',
								'param'	 => 1
							);
						} elseif ($paramid == 3) {
							$where_brg['data'][] = array(
								'column' => 'a.statusdelcom',
								'param'	 => 0
							);
						} elseif ($paramid == 4) {
							$where_brg['data'][] = array(
								'column' => 'a.statusdelcom',
								'param'	 => 0
							);
						}
					}
				}

				// $where_brg['data'][] = array(

				// 	'column' => 'a.statusdelcom',

				// 	'param'	 => 0

				// );


				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_penerimaan_barangdet a', $join_brg, $where_brg);



				$response['val2'] = array();

				if ($query_brg) {

					foreach ($query_brg->result() as $val2) {

						$response['val2'][] = array(

							'penerimaan_barangdet_id'			=> $val2->penerimaan_barangdet_id,

							't_penerimaan_barang'					=> $val2->t_penerimaan_barang_id,
							'barang_id'										=> $val2->barang_id,

							'barang_nomor'								=> $val2->barang_nomor,

							'barang_nama'									=> $val2->barang_nama,

							'barang_uraian'								=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',

							'jenis_barang_nama'						=> $val2->jenis_barang_nama,

							'satuan_nama'									=> $val2->satuan_nama,

							'penerimaan_barang_no_seri'					=> '',

							'penerimaan_barangdet_qty_no_seri'	=> '',

							'penerimaan_barangdet_qty'					=> $val2->penerimaan_barangdet_qty,

							'penerimaan_barangdet_qty_retur'		=> $val2->penerimaan_barangdet_qty_retur,

							'penerimaan_barangdet_verifikasi'		=> $val2->penerimaan_barangdet_verifikasi,

							'penerimaan_barangdet_harga_satuan'	=> $val2->penerimaan_barangdet_harga_satuan,

							'penerimaan_barangdet_potongan'			=> $val2->penerimaan_barangdet_potongan,

							'penerimaan_barangdet_total'				=> $val2->penerimaan_barangdet_total,

							'penerimaan_barangdet_keterangan'		=> $val2->penerimaan_barangdet_keterangan,

							'statusdelcom'											=> $val2->statusdelcom,

						);

					}

				}



				// PEMERIKSA

				$where1['data'][] = array(

					'column' => 'karyawan_id',

					'param'	 => $val->penerimaan_barang_pemeriksa

				);

				$query1 = $this->mod->select('*', 'm_karyawan', NULL, $where1);

				$hasil1['val2'] = array();

				if ($query1) {

					foreach ($query1->result() as $val2) {

						$hasil1['val2'][] = array(

							'id' 		=> $val2->karyawan_id,

							'text' 	=> $val2->karyawan_nama

						);

					}

				}

				// PENYETUJU

				$where2['data'][] = array(

					'column' => 'karyawan_id',

					'param'	 => $val->penerimaan_barang_penyetuju

				);

				$query2 = $this->mod->select('*', 'm_karyawan', NULL, $where2);

				$hasil2['val2'] = array();

				if ($query2) {

					foreach ($query2->result() as $val2) {

						$hasil2['val2'][] = array(

							'id' 	=> $val2->karyawan_id,

							'text' 	=> $val2->karyawan_nama

						);

					}

				}

				// GUDANG

				$where3['data'][] = array(

					'column' => 'gudang_id',

					'param'	 => $val->m_gudang_id

				);

				$query3 = $this->mod->select('*', 'm_gudang', NULL, $where3);

				$hasil3['val2'] = array();

				if ($query3) {

					foreach ($query3->result() as $val2) {

						$hasil3['val2'][] = array(

							'id' 	=> $val2->gudang_id,

							'text' 	=> $val2->gudang_nama

						);

					}

				}

				// NO ORDER

				$where4['data'][] = array(

					'column' => 'order_id',

					'param'	 => $val->t_order_id

				);

				$query4 = $this->mod->select('*', 't_order', NULL, $where4);

				$hasil4['val2'] = array();

				if ($query4) {

					foreach ($query4->result() as $val2) {

						$hasil4['val2'][] = array(

							'id' 	=> $val2->order_id,

							'text' 	=> $val2->order_nomor

						);

					}

				}



				$response['val'][] = array(

					'kode' 															=> $val->penerimaan_barang_id,

					'penerimaan_barang_nomor' 					=> $val->penerimaan_barang_nomor,

					'penerimaan_barang_jenis' 					=> $val->penerimaan_barang_jenis,

					'penerimaan_barang_tanggal'					=> date("d/m/Y",strtotime($val->penerimaan_barang_tanggal)),

					'penerimaan_barang_tanggal_terima'	=> date("d/m/Y",strtotime($val->penerimaan_barang_tanggal_terima)),

					'penerimaan_barang_pemeriksa'				=> $hasil1,

					'penerimaan_barang_penyetuju'				=> $hasil2,

					'm_gudang_id'												=> $hasil3,

					'penerimaan_barang_sj' 							=> $val->penerimaan_barang_sj,

					't_order_id'												=> $hasil4,

					'penerimaan_barang_status' 					=> $val->penerimaan_barang_status,

					'penerimaan_barang_catatan'					=> $val->penerimaan_barang_catatan,

					'penerimaan_barang_subtotal'				=> $val->penerimaan_barang_subtotal,

					'penerimaan_barang_ppn'							=> $val->penerimaan_barang_ppn,

					'penerimaan_barang_total'						=> $val->penerimaan_barang_total,

					'penerimaan_barang_status_pembayaran'		=> $val->penerimaan_barang_status_pembayaran,

					'penerimaan_barang_nominal_pembayaran'	=> $val->penerimaan_barang_nominal_pembayaran,

					'penerimaan_barang_kekurangan'					=> floatval(floatval($val->penerimaan_barang_total) - floatval($val->penerimaan_barang_nominal_pembayaran)),

				);

			}



			echo json_encode($response);

		}

	}



	public function checkStatus(){

		$id = $this->input->get('id');

		$select = '*';

		$where['data'][] = array(

			'column' => 'penerimaan_barang_id',

			'param'	 => $id

		);

		$query = $this->mod->select($select, $this->tbl, NULL, $where);

		if ($query<>false) {

			foreach ($query->result() as $row) {

				if ($row->penerimaan_barang_status == 1) {

					$data = $this->general_post_data(3, $id);

					$where['data'][] = array(

						'column' => 'penerimaan_barang_id',

						'param'	 => $id

					);

					$update = $this->mod->update_data_table($this->tbl, $where, $data);

					// INSERT LOG);

					$data_log = array(

						'referensi_id' 															=> $id,

						'penerimaan_baranglog_status_dari' 					=> 1,

						'penerimaan_baranglog_status_ke' 						=> 2,

						'penerimaan_baranglog_status_update_date' 	=> date('Y-m-d H:i:s'),

						'penerimaan_baranglog_status_update_by'			=> $this->session->userdata('user_username'),

					);

					$insert_log = $this->mod->insert_data_table('t_penerimaan_baranglog', NULL, $data_log);

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



	public function checkPO(){

		$where['data'][] = array(

			'column' => 't_order_id',

			'param'	 => $this->input->get('id', TRUE)

		);

		$query = $this->mod->select('COUNT(*) AS result', $this->tbl, NULL, $where)->row();

		// print_r($this->db->last_query());



		if ($query->result > 0) {

			$response['status'] = '204';

		} else {

			$response['status'] = '200';

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

			'column' => 'penerimaan_barang_status',

			'param'	 => 3

		);

		$where_like['data'][] = array(

			'column' => 'penerimaan_barang_nomor',

			'param'	 => $this->input->get('q')

		);

		$order['data'][] = array(

			'column' => 'penerimaan_barang_nomor',

			'type'	 => 'ASC'

		);

		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);

		$response['items'] = array();

		if ($query<>false) {

			foreach ($query->result() as $val) {

				$response['items'][] = array(

					'id'	=> $val->penerimaan_barang_id,

					'text'	=> $val->penerimaan_barang_nomor

				);

			}

			$response['status'] = '200';

		}



		echo json_encode($response);

	}



	public function loadData_selectPembayaran(){

		$param = $this->input->get('q');

		if ($param!=NULL) {

			$param = $this->input->get('q');

		} else {

			$param = "";

		}

		$select = 'a.*, b.*';

		$join['data'][] = array(

			'table' => 't_order b',

			'join'	=> 'b.order_id = a.t_order_id',

			'type'	=> 'left'

		);

		$where['data'][] = array(

			'column' => 'a.penerimaan_barang_jenis',

			'param'	 => 0

		);

		$where['data'][] = array(

			'column' => 'a.penerimaan_barang_status',

			'param'	 => 3

		);

		$where['data'][] = array(

			'column' => 'a.penerimaan_barang_status_pembayaran',

			'param'	 => 1

		);

		$where['data'][] = array(

			'column' => 'b.m_supplier_id',

			'param'	 => $this->input->get('idsup')

		);

		$where['data'][] = array(

			'column' => 'b.order_type',

			'param'	 => 0

		);

		$where_like['data'][] = array(

			'column' => 'a.penerimaan_barang_nomor',

			'param'	 => $this->input->get('q')

		);

		$order['data'][] = array(

			'column' => 'a.penerimaan_barang_nomor',

			'type'	 => 'ASC'

		);

		$query = $this->mod->select($select, 't_penerimaan_barang a', $join, $where, NULL, $where_like, $order);

		$response['items'] = array();

		if ($query<>false) {

			foreach ($query->result() as $val) {

				$response['items'][] = array(

					'id'	=> $val->penerimaan_barang_id,

					'text'	=> $val->penerimaan_barang_nomor

				);

			}

			$response['status'] = '200';

		}



		echo json_encode($response);

	}



	// Function Insert & Update

	public function postData($type){

		$id = $this->input->post('kode');

		// echo $id;

		$response['test'] = $type;

		if (strlen($id)>0) {

			if ($type == 2) {

				//UPDATE

				$data = $this->general_post_data(2, $id);

				$where['data'][] = array(

					'column' => 'penerimaan_barang_id',

					'param'	 => $id

				);

				$update = $this->mod->update_data_table($this->tbl, $where, $data);

				if($update->status) {

					$response['status'] = '200';

					// INSERT DETAIL

					for ($i = 0; $i < sizeof($this->input->post('penerimaan_barangdet_id', TRUE)); $i++) {

						$data_det = $this->general_post_data2(2, $id, $i, $this->input->post('penerimaan_barangdet_id', TRUE)[$i]);

						if (@$where_det['data']) {

							unset($where_det['data']);

						}

						$where_det['data'][] = array(

							'column' => 'penerimaan_barangdet_id',

							'param'	 => $this->input->post('penerimaan_barangdet_id', TRUE)[$i]

						);

						$update_det = $this->mod->update_data_table('t_penerimaan_barangdet', $where_det, $data_det);

						if($update_det->status) {

							$response['status'] = '200';

						} else {

							$response['status'] = '204';

						}

					}

				} else {

					$response['status'] = '204';

				}

			}

		} else {

			//INSERT

			$ulang = 0;

			$ulang2 = 0;

			$ulang3 = 0;

			$data = $this->general_post_data(1);

			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);

			if($insert->status) {

				$response['status'] = '200';

				// INSERT DETAIL

				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) {

					$response['m_barang_id'][] = $this->input->post('m_barang_id', TRUE)[$i];

					$noSeri = array();

					$qtyNoSeri = array();

					$data_det = $this->general_post_data2(1, $insert->output, $i);

					$insert_det = $this->mod->insert_data_table('t_penerimaan_barangdet', NULL, $data_det);

					if($insert_det->status) {

						$response['status'] = '200';

						// $noSeri = '';

						// $qtyNoSeri = '';

						// $response['qtyNoSeri'][] = $qtyNoSeri;

						// $response['testSeri'][] = '';

						// $response['qty'][] = sizeof($noSeri);

						// for($j = 0; $j < sizeof($noSeri); $j++)

						for($j = 0; $j < 1; $j++)

						{

							// if($noSeri[$j] != '')

							// {

								// STOK GUDANG DAN KARTU STOK

								if (@$where_gudang2['data']) {

									unset($where_gudang2['data']);

								}

								if (@$order['data']) {

									unset($order['data']);

								}

								// PENAMBAHAN STOK GUDANG

								$where_gudang2['data'][] = array(

									'column' => 'm_barang_id',

									'param'	 => $this->input->post('m_barang_id', TRUE)[$i]

								);

								$where_gudang2['data'][] = array(

									'column' => 'm_gudang_id',

									'param'	 => $data['m_gudang_id']

								);

								$order['data'][] = array(

									'column' => 'kartu_stok_id',

									'type'	 => 'DESC'

								);

								$limit = array(

									'start'  => 0,

									'finish' => 1

								);

								$query_gudang2 = $this->mod->select('*', 't_kartu_stok', NULL, $where_gudang2, null, null, $order, $limit);

								if($query_gudang2)

								{

									// JIKA DATA BARANG SUDAH ADA DI STOK GUDANG

									foreach ($query_gudang2->result() as $rowStok) {

										// $response['gudang'][] = $rowStok->kartu_stok_saldo;

										// if(!isset($qtyNoSeri[$j]))

										// {

										// 	$qtyNoSeri[$j] = 0;

										// }

										// $response['noSeri'][] = $noSeri[$j];

										// $response['qtyNoSeri'][] = $qtyNoSeri[$j];

										// PENAMBAHAN KARTU STOK

										$dataKStok2 = array(

											'm_gudang_id' 				=> $rowStok->m_gudang_id,

											'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$i],

											'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),

											'kartu_stok_referensi' 		=> $data['penerimaan_barang_nomor'],

											'kartu_stok_saldo' 			=> $rowStok->kartu_stok_saldo+$rowStok->kartu_stok_masuk-$rowStok->kartu_stok_keluar,

											'kartu_stok_masuk' 			=> $data_det['penerimaan_barangdet_qty'],

											'kartu_stok_keluar' 		=> 0,

											'kartu_stok_penyesuaian'	=> 0,

											'kartu_stok_keterangan' 	=> "Penerimaan Barang",

											'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),

											'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),

											'kartu_stok_revised' 		=> 0,

										);

										// END PENAMBAHAN KARTU STOK

										$insertKStok2 = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok2);

										$dataStok2 = array(

											'm_gudang_id' 				=> $rowStok->m_gudang_id,

											'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$i],

											'stok_gudang_jumlah' 		=> $data_det['penerimaan_barangdet_qty'],

											// 'stok_gudang_no_seri' 		=> $noSeri[$j],

											'stok_gudang_no_seri' 		=> '',

											'stok_gudang_created_date'	=> date('Y-m-d H:i:s'),

											'stok_gudang_created_by'	=> $this->session->userdata('user_username'),

											'stok_gudang_revised' 		=> 0,

										);



										// CHECK STOK GUDANG

										// QUERY

										if (@$where_stok_gudang['data']) {

											unset($where_stok_gudang['data']);

										}

										$where_stok_gudang['data'][] = array(

											'column' => 'm_gudang_id',

											'param'	 => $dataStok2['m_gudang_id']

										);

										$where_stok_gudang['data'][] = array(

											'column' => 'm_barang_id',

											'param'	 => $dataStok2['m_barang_id']

										);

										$select_stok_gudang = $this->mod->select('*', 't_stok_gudang', NULL, $where_stok_gudang);



										if ($select_stok_gudang) {

											foreach ($select_stok_gudang->result() as $value) {

												// UPDATE

												$dataStok2 = array(

													'm_gudang_id' 				=> $value->m_gudang_id,

													'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$i],

													'stok_gudang_jumlah' 		=> $data_det['penerimaan_barangdet_qty'] + $value->stok_gudang_jumlah,

													// 'stok_gudang_no_seri' 		=> $noSeri[$j],

													'stok_gudang_no_seri' 		=> '',

													'stok_gudang_created_date'	=> date('Y-m-d H:i:s'),

													'stok_gudang_created_by'	=> $this->session->userdata('user_username'),

													'stok_gudang_revised' 		=> 0,

												);

												$this->mod->update_data_table('t_stok_gudang', $where_stok_gudang, $dataStok2);


											}

										} else {

											// INSERT

											$this->mod->insert_data_table('t_stok_gudang', null, $dataStok2);

										}

										// END CHECK STOK GUDANG

										// $ulang++;

									}

								}

								else

								{

									// JIKA DATA BARANG TIDAK ADA DI STOK GUDANG

									// if($noSeri[$j] != '')

									// {

										// if(!isset($qtyNoSeri[$j]))

										// {

										// 	$qtyNoSeri[$j] = 0;

										// }

										// $response['belumada'][] = 'belumada';

										// $response['noSeri'][] = $noSeri[$j];

										// $response['qtyNoSeri'][] = $qtyNoSeri[$j];

										// PENAMBAHAN KARTU STOK

										$dataKStok2 = array(

											'm_gudang_id' 				=> $data['m_gudang_id'],

											'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$i],

											'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),

											'kartu_stok_referensi' 		=> $data['penerimaan_barang_nomor'],

											'kartu_stok_saldo' 			=> 0,

											'kartu_stok_masuk' 			=> $data_det['penerimaan_barangdet_qty'],

											'kartu_stok_keluar' 		=> 0,

											'kartu_stok_penyesuaian'	=> 0,

											'kartu_stok_keterangan' 	=> "Penerimaan Barang",

											'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),

											'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),

											'kartu_stok_revised' 		=> 0,

										);

										// END PENAMBAHAN KARTU STOK

										$insertKStok2 = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok2);

										$dataStok2 = array(

											'm_gudang_id' 				=> $data['m_gudang_id'],

											'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$i],

											'stok_gudang_jumlah' 		=> $data_det['penerimaan_barangdet_qty'],

											'stok_gudang_no_seri' 		=> '',

											'stok_gudang_created_date'	=> date('Y-m-d H:i:s'),

											'stok_gudang_created_by'	=> $this->session->userdata('user_username'),

											'stok_gudang_revised' 		=> 0,

										);





										// CHECK STOK GUDANG

										// QUERY

										if (@$where_stok_gudang['data']) {

											unset($where_stok_gudang['data']);

										}

										$where_stok_gudang['data'][] = array(

											'column' => 'm_gudang_id',

											'param'	 => $dataStok2['m_gudang_id']

										);

										$where_stok_gudang['data'][] = array(

											'column' => 'm_barang_id',

											'param'	 => $dataStok2['m_barang_id']

										);

										$select_stok_gudang = $this->mod->select('*', 't_stok_gudang', NULL, $where_stok_gudang);



										if ($select_stok_gudang) {

											// UPDATE

											foreach ($select_stok_gudang->result() as $value) {

												$dataStok2 = array(

													'm_gudang_id' 				=> $value->m_gudang_id,

													'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$i],

													'stok_gudang_jumlah' 		=> $data_det['penerimaan_barangdet_qty'] + $value->stok_gudang_jumlah,

													// 'stok_gudang_no_seri' 		=> $noSeri[$j],

													'stok_gudang_no_seri' 		=> '',

													'stok_gudang_created_date'	=> date('Y-m-d H:i:s'),

													'stok_gudang_created_by'	=> $this->session->userdata('user_username'),

													'stok_gudang_revised' 		=> 0,

												);

												$insertStok2 = $this->mod->update_data_table('t_stok_gudang', $where_stok_gudang, $dataStok2);

												// echo "string1";

												// print_r($dataStok2);

											}

										} else {

											// INSERT

											$insertStok2 = $this->mod->insert_data_table('t_stok_gudang', null, $dataStok2);

										}

										// END CHECK STOK GUDANG

									// }

								}

								// END PENAMBAHAN STOK GUDANG

								// END STOK GUDANG DAN KARTU STOK

								// $ulang2++;

							// }

						}

						// $ulang3++;

						// $response['ulang'] = $ulang;

						// $response['ulang2'] = $ulang2;

						// $response['ulang3'] = $ulang3;

						// PO

						if (@$where_po2['data']) {

							unset($where_po2['data']);

						}

						$where_po2['data'][] = array(

							'column' => 'orderdet_id',

							'param'	 => $this->input->post('orderdet_id', TRUE)[$i]

						);

						$query_po2 = $this->mod->select('*', 't_orderdet', NULL, $where_po2);

						if ($query_po2) {

							foreach ($query_po2->result() as $row) {

								$data_po2 = array(

									// 'orderdet_status'			=> $data_det['penerimaan_barangdet_verifikasi'],

									'orderdet_qty_realisasi' 	=> $this->input->post('orderdet_qty_realisasi', TRUE)[$i],

									'orderdet_update_by'		=> $this->session->userdata('user_username'),

									'orderdet_update_date'		=> date('Y-m-d H:i:s'),

									'orderdet_revised' 			=> $row->orderdet_revised + 1,

								);

								$update_po2 = $this->mod->update_data_table('t_orderdet', $where_po2, $data_po2);

								// echo "string2";

								// print_r($data_po2);

							}

						}

						// END PO

					} else {

						$response['status'] = '204';

					}

				}

			} else {

				$response['status'] = '204';

			}

		}

		// print_r($this->db->last_query());

		echo json_encode($response);

	}



	public function cetakPDF($id){

		$this->load->library('pdf');

		$name = '';

		$select = '*';

		$where['data'][] = array(

			'column' => 'penerimaan_barang_id',

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

					'column' => 't_penerimaan_barang_id',

					'param'	 => $val->penerimaan_barang_id

				);

				$query_det = $this->mod->select('*','t_penerimaan_barangdet',NULL,$where_det);

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

									'penerimaan_barang_id'				=> $val2->penerimaan_barangdet_id,

									'barang_nomor'						=> $val3->barang_nomor,

									'barang_nama'						=> $val3->barang_nama,

									'barang_nomor'						=> $val3->barang_nomor,

									'jenis_barang_nama'					=> $val3->jenis_barang_nama,

									'satuan_nama'						=> $val3->satuan_nama,

									'penerimaan_barangdet_qty'			=> $val2->penerimaan_barangdet_qty,

									'penerimaan_barangdet_harga_satuan'	=> $val2->penerimaan_barangdet_harga_satuan,

									'penerimaan_barangdet_total'		=> $val2->penerimaan_barangdet_total,

									'penerimaan_barangdet_keterangan'	=> $val2->penerimaan_barangdet_keterangan,

									'm_barang_id'						=> $val2->m_barang_id,

								);

							}

						}

						// CARI BARANG DAN STOK

					}

				}

				// END CARI DETAIL

				// CARI PENYETUJU

				$hasil4['val2'] = array();

				$where_penyetuju['data'][] = array(

					'column' => 'karyawan_id',

					'param'	 => $val->penerimaan_barang_penyetuju

				);

				$query_penyetuju = $this->mod->select('*','m_karyawan',NULL,$where_penyetuju);

				if ($query_penyetuju) {

					foreach ($query_penyetuju->result() as $val2) {

						$hasil4['val2'][] = array(

							'id' 	=> $val2->karyawan_id,

							'text' 	=> $val2->karyawan_nama

						);

					}

				} else {

						$hasil4['val2'][] = array(

							'id' 	=> '',

							'text' 	=> ''

						);

				}

				// END CARI PENYETUJU

				// CARI PENERIMA

				$hasil5['val2'] = array();

				$where_penerima['data'][] = array(

					'column' => 'karyawan_id',

					'param'	 => $val->penerimaan_barang_pemeriksa

				);

				$query_penerima = $this->mod->select('*','m_karyawan',NULL,$where_penerima);

				if ($query_penerima) {

					foreach ($query_penerima->result() as $val2) {

						$hasil5['val2'][] = array(

							'id' 	=> $val2->karyawan_id,

							'text' 	=> $val2->karyawan_nama

						);

					}

				}

				// END CARI PENERIMA

				// CARI SUPPLIER

				$hasil6['val2'] = array();

				$join_supp['data'][] = array(

					'table' => 'm_partner c',

					'join'	=> 'c.partner_id = a.m_supplier_id',

					'type'	=> 'left'

				);

				$where_supp['data'][] = array(

					'column' => 'a.order_id',

					'param'	 => $val->t_order_id

				);

				$query_supp = $this->mod->select('a.*, c.partner_nama','t_order a',$join_supp,$where_supp);

				if ($query_supp) {

					foreach ($query_supp->result() as $val3) {

						$hasil6['val2'][] = array(

							'id' 	=> $val3->order_nomor,

							'supplier' 	=> $val3->partner_nama

						);

					}

				}

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

					'kode' 										=> $val->penerimaan_barang_id,

					'penerimaan_barang_nomor' 					=> $val->penerimaan_barang_nomor,

					'penerimaan_barang_jenis' 					=> $val->penerimaan_barang_jenis,

					'penerimaan_barang_sj' 						=> $val->penerimaan_barang_sj,

					'penerimaan_barang_ppn' 					=> $val->penerimaan_barang_ppn,

					'penerimaan_barang_tanggal'					=> date("d/m/Y",strtotime($val->penerimaan_barang_tanggal)),

					'penerimaan_barang_tanggal_terima'			=> date("d/m/Y",strtotime($val->penerimaan_barang_tanggal_terima)),

					'penerimaan_barang_catatan' 				=> $val->penerimaan_barang_catatan,

					'penerimaan_barang_status' 					=> $val->penerimaan_barang_status,

					'penerimaan_barang_penyetuju' 				=> $hasil4,

					'penerimaan_barang_pemeriksa' 				=> $hasil5,

					'penerimaan_barang_pembuat' 				=> $val->penerimaan_barang_created_by,

					'penerimaan_barang_supplier' 				=> $hasil6,

					'cabang'													=> $hasil7

				);

			}

		}

		$response['title'][] = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Penerimaan Barang',

			'title_page2' 	=> 'Print BPB',

		);

		// echo json_encode($response);

		$this->pdf->load_view('print/P_bpb', $response);

		$this->pdf->render();

		$this->pdf->stream($name,array("Attachment"=>false));

	}



	public function deleteData(){

		// error_reporting(E_ALL);

		$response['id'] = $this->input->post('id', TRUE);

		$where['data'][] = array(

			'column' => 'penerimaan_barang_id',

			'param'	 => $this->input->post('id')

		);

		$query = $this->mod->select('*', $this->tbl, NULL, $where);

		if ($query) {

			foreach ($query->result() as $row) {

				// update qty realisasi

				$whereOrderid['data'][] = array(

					'column' => 't_order_id',

					'param'	 => $row->t_order_id);



				$dataUpdateorder = array(

					'orderdet_qty_realisasi' => 0,

				);



				$qorderdet = $this->mod->update_data_table('t_orderdet', $whereOrderid, $dataUpdateorder);

				// end update qty realisasi

				// HAPUS KARTU STOK

				$where_kartustok['data'][] = array(

					'column' => 'kartu_stok_referensi',

					'param'	 => $row->penerimaan_barang_nomor

				);

				$query_kartustok = $this->mod->delete_data_table('t_kartu_stok', $where_kartustok);

				// END HAPUS KARTU STOK

				$where_det['data'][] = array(

					'column' => 't_penerimaan_barang_id',

					'param'	 => $row->penerimaan_barang_id

				);

				$query_det = $this->mod->select('*', 't_penerimaan_barangdet', NULL, $where_det);

				if ($query_det) {

					foreach ($query_det->result() as $row2) {

						// PENGURANGAN STOK

						if (@$where_stok_gudang['data']) {

							unset($where_stok_gudang['data']);

						}

						$where_stok_gudang['data'][] = array(

							'column' => 'm_gudang_id',

							'param'	 => $row->m_gudang_id

						);

						$where_stok_gudang['data'][] = array(

							'column' => 'm_barang_id',

							'param'	 => $row2->m_barang_id

						);

						$select_stok_gudang = $this->mod->select('*', 't_stok_gudang', NULL, $where_stok_gudang);

						if ($select_stok_gudang) {

							// UPDATE

							foreach ($select_stok_gudang->result() as $value) {

								$dataStok2 = array(

									'm_gudang_id' 				=> $row->m_gudang_id,

									'm_barang_id' 				=> $row2->m_barang_id,

									'stok_gudang_jumlah' 		=> $value->stok_gudang_jumlah - $row2->penerimaan_barangdet_qty,

									'stok_gudang_no_seri' 		=> '',

									'stok_gudang_created_date'	=> date('Y-m-d H:i:s'),

									'stok_gudang_created_by'	=> $this->session->userdata('user_username'),

									'stok_gudang_revised' 		=> 0,

								);

								$updateStok2 = $this->mod->update_data_table('t_stok_gudang', $where_stok_gudang, $dataStok2);

							}

						}

						// END PENGURANGAN STOK

					}

				} else {

					$response['status'] = '204';

				}

			}

			// HAPUS PENERIMAAN

			$where_penerimaan_hdr['data'][] = array(

				'column' => 'penerimaan_barang_id',

				'param'	 => $this->input->post('id')

			);

			$query_penerimaan_hdr = $this->mod->delete_data_table('t_penerimaan_barang', $where_penerimaan_hdr);

			$where_penerimaan_dtl['data'][] = array(

				'column' => 't_penerimaan_barang_id',

				'param'	 => $this->input->post('id')

			);

			$query_penerimaan_dtl = $this->mod->delete_data_table('t_penerimaan_barangdet', $where_penerimaan_dtl);



			// END HAPUS PENERIMAAN

			$response['status'] = '200';

		} else {

			$response['status'] = '204';

		}

		echo json_encode($response);

	}



	/* Saving $data as array to database */

	function general_post_data($type, $id = null){

		// 1 Insert, 2 Update, 3 Delete / Non Aktif

		$arrDate = explode('/', $this->input->post('penerimaan_barang_tanggal', TRUE));

		$arrDate2 = explode('/', $this->input->post('penerimaan_barang_tanggal_terima', TRUE));

		$where['data'][] = array(

			'column' => 'penerimaan_barang_id',

			'param'	 => $id

		);

		$queryRevised = $this->mod->select('penerimaan_barang_status, penerimaan_barang_revised', $this->tbl, NULL, $where);

		if ($queryRevised) {

			$revised = $queryRevised->row_array();

			$rev = $revised['penerimaan_barang_revised'] + 1;

			$status = $revised['penerimaan_barang_status'];

		}

		if ($type == 1) {

			if($this->input->post('penerimaan_barang_jenis', TRUE) == 0)

			{

				$penerimaan_barang_nomor = $this->get_kode_transaksi($arrDate[1]);

			}

			else if($this->input->post('penerimaan_barang_jenis', TRUE) == 1)

			{

				$penerimaan_barang_nomor = $this->get_kode_transaksi2($arrDate[1]);

			}

			$data = array(

				'm_cabang_id' 							=> $this->session->userdata('cabang_id'),

				'penerimaan_barang_nomor' 				=> $penerimaan_barang_nomor,

				'penerimaan_barang_tanggal'				=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],

				'penerimaan_barang_tanggal_terima'		=> $arrDate2[2]."-".$arrDate2[1]."-".$arrDate2[0],

				'penerimaan_barang_sj' 					=> $this->input->post('penerimaan_barang_sj', TRUE),

				't_order_id'							=> $this->input->post('t_order_id', TRUE),

				'penerimaan_barang_pemeriksa' 			=> $this->input->post('penerimaan_barang_pemeriksa', TRUE),

				'penerimaan_barang_penyetuju'			=> $this->input->post('penerimaan_barang_penyetuju', TRUE),

				'penerimaan_barang_jenis'				=> $this->input->post('penerimaan_barang_jenis', TRUE),

				'm_gudang_id'							=> $this->input->post('m_gudang_id', TRUE),

				'penerimaan_barang_catatan'				=> $this->input->post('penerimaan_barang_catatan', TRUE),

				'penerimaan_barang_status' 				=> 1,

				'penerimaan_barang_status_date'			=> date('Y-m-d H:i:s'),

				'penerimaan_barang_created_date'		=> date('Y-m-d H:i:s'),

				'penerimaan_barang_update_date'			=> date('Y-m-d H:i:s'),

				'penerimaan_barang_created_by'			=> $this->session->userdata('user_username'),

				'penerimaan_barang_revised' 			=> 0,

			);

		} else if ($type == 2) {

			$data = array(

				'penerimaan_barang_status' 		=> 3,

				'penerimaan_barang_subtotal'	=> $this->input->post('penerimaan_barang_subtotal', TRUE),

				'penerimaan_barang_ppn' 		=> $this->input->post('penerimaan_barang_ppn', TRUE),

				'penerimaan_barang_total' 		=> $this->input->post('penerimaan_barang_total', TRUE),

				'penerimaan_barang_update_date'	=> date('Y-m-d H:i:s'),

				'penerimaan_barang_update_by'	=> $this->session->userdata('user_username'),

				'penerimaan_barang_revised' 	=> $rev,

			);

		} else if ($type == 3) {

			$data = array(

				'penerimaan_barang_status'		=> 2,

				'penerimaan_barang_status_date'	=> date('Y-m-d H:i:s'),

				'penerimaan_barang_update_date'	=> date('Y-m-d H:i:s'),

				'penerimaan_barang_update_by'	=> $this->session->userdata('user_username'),

				'penerimaan_barang_revised' 	=> $rev,

			);

		}



		return $data;

	}



	function general_post_data2($type, $idHdr, $seq, $id = null){

		// 1 Insert, 2 Update, 3 Delete / Non Aktif

		$where['data'][] = array(

			'column' => 'penerimaan_barangdet_id',

			'param'	 => $id

		);

		$queryRevised = $this->mod->select('penerimaan_barangdet_revised', 't_penerimaan_barangdet', NULL, $where);

		if ($queryRevised) {

			$revised = $queryRevised->row_array();

			$rev = $revised['penerimaan_barangdet_revised'] + 1;

		}

		if ($type == 1) {

			$data = array(

				't_penerimaan_barang_id' 			=> $idHdr,

				'm_barang_id' 						=> $this->input->post('m_barang_id', TRUE)[$seq],

				'penerimaan_barang_no_seri'			=> '',

				'penerimaan_barangdet_qty_no_seri'			=> '',

				'penerimaan_barangdet_qty' 			=> $this->input->post('penerimaan_barangdet_qty', TRUE)[$seq],

				'penerimaan_barangdet_status'		=> 1,

				'penerimaan_barangdet_status_date'	=> date('Y-m-d H:i:s'),

				'penerimaan_barangdet_created_date'	=> date('Y-m-d H:i:s'),

				'penerimaan_barangdet_created_by'	=> $this->session->userdata('user_username'),

				'penerimaan_barangdet_update_date'	=> date('Y-m-d H:i:s'),

				'penerimaan_barangdet_revised' 		=> 0,

			);

		} else if ($type == 2) {

			if ($this->input->post('penerimaan_barangdet_verifikasi', TRUE)[$seq]) {

				$verifikasi = 1;

			} else {

				$verifikasi = 0;

			}

			$data = array(

				't_penerimaan_barang_id' 			=> $idHdr,

				'm_barang_id' 						=> $this->input->post('m_barang_id', TRUE)[$seq],

				'penerimaan_barangdet_verifikasi'	=> $verifikasi,

				'penerimaan_barangdet_harga_satuan' => $this->input->post('penerimaan_barangdet_harga_satuan', TRUE)[$seq],

				'penerimaan_barangdet_potongan' 	=> $this->input->post('penerimaan_barangdet_potongan', TRUE)[$seq],

				'penerimaan_barangdet_total'		=> $this->input->post('penerimaan_barangdet_total', TRUE)[$seq],

				'penerimaan_barangdet_keterangan'	=> $this->input->post('penerimaan_barangdet_keterangan', TRUE)[$seq],

				'penerimaan_barangdet_update_by'	=> $this->session->userdata('user_username'),

				'penerimaan_barangdet_update_date'	=> date('Y-m-d H:i:s'),

				'penerimaan_barangdet_revised' 		=> $rev,

			);

		}



		return $data;

	}



	function get_kode_transaksi($bulan){

		$bln = $bulan;

		$thn = date('Y');

		$select = 'MID(penerimaan_barang_nomor,10,5) as id';

		$where['data'][] = array(

			'column' => 'MID(penerimaan_barang_nomor,1,9)',

			'param'	 => 'BPB'.$thn.''.$bln

		);

		$order['data'][] = array(

			'column' => 'penerimaan_barang_nomor',

			'type'	 => 'DESC'

		);

		$limit = array(

			'start'  => 0,

			'finish' => 1

		);

		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);

		$kode_baru = $this->format_kode_transaksi('BPB',$query,$bln);

		return $kode_baru;

	}



	function get_kode_transaksi2($bulan){

		$bln = $bulan;

		$thn = date('Y');

		$select = 'MID(penerimaan_barang_nomor,10,5) as id';

		$where['data'][] = array(

			'column' => 'MID(penerimaan_barang_nomor,1,9)',

			'param'	 => 'BPBJ'.$thn.''.$bln

		);

		$order['data'][] = array(

			'column' => 'penerimaan_barang_nomor',

			'type'	 => 'DESC'

		);

		$limit = array(

			'start'  => 0,

			'finish' => 1

		);

		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);

		$kode_baru = $this->format_kode_transaksi('BPBJ',$query,$bln);

		return $kode_baru;

	}

	function editstatusPO(){
		$index = $this->input->post('index');
		$barang_id = $this->input->post('barang_id');
		$removedelcomPO = $this->input->post('removedelcomPO');
		$penerimaan_barangdet_id = $this->input->post('penerimaan_barangdet_id');

		$table = "t_penerimaan_barangdet a";
		$where['data'][] = array(

			'column' => 'a.penerimaan_barangdet_id',

			'param'	 => $penerimaan_barangdet_id

		);
		if ($removedelcomPO) {
			$data = array('statusdelcom' => 0);
		} else {
			$data = array('statusdelcom' => 1);
		}

		// $orderdet_id = $this->mod->getorderdet_id($index, $barang_id, $penerimaan_barangdet_id);

		$update = $this->mod->update_data_table($table, $where, $data);

		$table = "t_penerimaan_barangdet a";
		$where['data'][] = array(
			'column' => 'a.penerimaan_barangdet_id',
			'param'	 => $penerimaan_barangdet_id
		);
		if ($removedelcomPO) {
			$dataOrder = array('statusdelcom' => 0);
		} else {
			$dataOrder = array('statusdelcom' => 1);
		}

		if($update->status) {

			$response['status'] = '200';

		} else {

			$response['status'] = '204';

		}

		echo json_encode($response);
	}


	/* end Function */



}

