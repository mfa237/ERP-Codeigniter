<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class C_purchase_order extends MY_Controller {

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

				'title_page2' 	=> 'Purchase Order',

				'priv_add'		=> $priv['create']

				);

			if($priv['read'] == 1)

			{

				$this->open_page('purchase-order/V_purchase_order', $data);

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

				'title_page2' => 'Purchase Order',

				'priv_add'		=> $priv['create']

				);

			if($priv['read'] == 1)

			{

				$this->open_page('purchase-order/V_purchase_order2', $data);

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

			'param'	 => 0

		);

		// $where['data'][] = array(

		// 	'column' => 'partner_id',

		// 	'param'	 => $this->input->get("partner_id")

		// );

		//ORDER

		$index_order = $this->input->get('order[0][column]');

		$order['data'][] = array(

			'column' => $this->input->get('columns['.$index_order.'][name]'),

			'type'	 => $this->input->get('order[0][dir]')

		);



		$query_total = $this->mod->select($select, 'v_order');

		$query_filter = $this->mod->select($select, 'v_order', NULL, $where, NULL, $where_like, $order);

		$query = $this->mod->select($select, 'v_order', NULL, $where, NULL, $where_like, $order, $limit);

		// echo $this->db->last_query();
		// die;

		$response['data'] = array();

		if ($query<>false) {

			$no = $limit['start']+1;

			foreach ($query->result() as $val) {

				$button = '';

				if ($type == 1) {

					if($privPembelian['update'] == 1)

					{

						if(($val->order_status_nama == 'PO Baru') || ($val->order_status_nama == 'PO Diterima ') || ($val->order_status_nama == 'PO Tidak Disetujui') || ($val->order_status_nama == 'PO Edited'))

						{

							$button = $button.'<a href="'.base_url().'Pembelian/Purchase-Order/EditForm/'.$val->order_id.'">

							<button class="btn blue-ebonyclay" type="button" title="Edit PO">

								<i class="icon-pencil text-center"></i>

							</button>

							</a>';

						}

					}



					$button = $button.'

					<a href="'.base_url().'Pembelian/Purchase-Order/Form/'.$val->order_id.'">

					<button class="btn blue-ebonyclay" type="button" title="Lihat PO">

						<i class="icon-eye text-center"></i>

					</button>

					</a>

					<a href="'.base_url().'Pembelian/Purchase-Order/print-PO/'.$val->order_id.'">

					<button class="btn green-jungle" type="button" title="Print PO">

						<i class="icon-printer text-center"></i>

					</button>

					</a>';

					// if ($val->order_status == 1) {

						$button .= '

						<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->order_id.')" title="Hapus Data">

							<i class="icon-close text-center"></i>

						</button>';

						if ($val->order_status_nama != 'PO Selesai' && $val->order_status_nama != 'PO Dibatalkan')
						{
							$button .= '

							<button class="btn yellow-saffron" type="button" onclick="delcomData('.$val->order_id.')" title="Delcom Data">

								<i class="icon-refresh text-center"></i>

							</button>';
						}

					// }

				} else if ($type == 2) {

					if($val->order_status_nama == 'PO Disetujui')

					{

						$button = $button.'

						<button class="btn red-thunderbird" type="button" title="Batalkan Persetujuan PO" onclick="batalkanPO('.$val->order_id.')">

							<i class="icon-power text-center"></i>

						</button>';

					}

					$button = $button.'

					<a href="'.base_url().'Persetujuan/Purchase-Order/Form/'.$val->order_id.'">

					<button class="btn blue-ebonyclay" type="button" title="Lihat PO" onclick="checkStatusPO('.$val->order_id.')">

						<i class="icon-eye text-center"></i>

					</button>

					<a href="'.base_url().'Persetujuan/Purchase-Order/print-PO/'.$val->order_id.'">

					<button class="btn green-jungle" type="button" title="Print PO">

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



	public function getForm1($id = null)

	{

		$this->check_session();

		$data = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Pembelian',

			'title_page2' => 'Purchase Order',

			'id'					=> $id

		);

		$this->open_page('purchase-order/V_form_purchase_order', $data);

	}



	public function getForm2($id = null){

		$this->check_session();

		$data = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Persetujuan',

			'title_page2' 	=> 'Purchase Order',

			'id'			=> $id

		);

		$this->open_page('purchase-order/V_form_purchase_order2', $data);

	}



	public function getForm3($id = null){

		$this->check_session();

		$data = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Pembelian',

			'title_page2' 	=> 'Purchase Order',

			'id'			=> $id,

			'edit'			=> 1

		);

		$this->open_page('purchase-order/V_form_purchase_order', $data);

	}



	public function loadDataWhere($type)

	{

		$select = '*';

		$where['data'][] = array(

			'column' => 'order_id',

			'param'	 => $this->input->get('id')

		);



		$query = $this->mod->select($select, $this->tbl, NULL, $where);

		// echo $this->db->last_query();
		// die;

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

				// $join_det['data'][] = array(

				// 	'table' => 't_penawaran_harga d',

				// 	'join'	=> 'd.satuan_id = b.m_satuan_id',

				// 	'type'	=> 'left'

				// );

				$where_det['data'][] = array(

					'column' => 'a.t_order_id',

					'param'	 => $val->order_id

				);

				$query_det = $this->mod->select('a.*, b.*, c.*, d.*','t_orderdet a',$join_det,$where_det);

				$response['val2'] = array();



				if ($query_det) {

					foreach ($query_det->result() as $val2) {

						$response['val2'][] = array(

							'orderdet_id'							=> $val2->orderdet_id,

							't_order_id'							=> $val2->t_order_id,

							'm_barang_id'							=> $val2->m_barang_id,

							'barang_nomor'						=> $val2->barang_nomor,

							'barang_uraian'						=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',

							'orderdet_qty'						=> $val2->orderdet_qty,

							'orderdet_qty_realisasi'	=> $val2->orderdet_qty_realisasi,

							'orderdet_status'					=> $val2->orderdet_status,

							'satuan_nama'							=> $val2->satuan_nama,

							'orderdet_harga_satuan'		=> $val2->orderdet_harga_satuan,

							'orderdet_disc'						=> $val2->orderdet_disc,

							'orderdet_total'					=> $val2->orderdet_total,

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

							'id' 		=> $val2->penawaran_id,

							'text' 	=> $val2->penawaran_nomor

						);

					}

				}



				// END CARI PENERIMA



				$response['val'][] = array(

					'kode' 									=> $val->order_id,

					'order_nomor' 					=> $val->order_nomor,

					'order_tanggal'					=> date("d/m/Y",strtotime($val->order_tanggal)),

					'order_type' 						=> $val->order_type,

					'order_status' 					=> $val->order_status,

					'm_supplier_id' 				=> $hasil1,

					'order_referensi_id' 		=> $hasil2,

					'order_nama_dikirim' 		=> $val->order_nama_dikirim,

					'order_alamat_dikirim' 	=> $val->order_alamat_dikirim,

					'order_hp_fax' 					=> $val->order_hp_fax,

					// 'orderdet_disc'					=> $val->orderdet_disc,

					'order_subtotal' 				=> $val->order_subtotal,

					'order_ppn' 						=> $val->order_ppn,

					'order_total' 					=> $val->order_total,

					'order_tanggal_kirim'		=> date("d/m/Y",strtotime($val->order_tanggal_kirim)),

					'order_pembayaran'			=> $val->order_pembayaran,

					'order_top'							=> $val->order_top,

					// 'order_status_pembayaran'	=> $val->order_status_pembayaran,

					// 'order_nominal_pembayaran'	=> $val->order_nominal_pembayaran,

					// 'order_kekurangan'			=> floatval(floatval($val->order_total) - floatval($val->order_nominal_pembayaran)),

					// 'order_dp'					=> $val->order_dp,

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

							'barang_nomor'			=> $val2->barang_nomor,

							'barang_uraian'			=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',

							'orderdet_qty'			=> $val2->orderdet_qty,

							'satuan_nama'				=> $val2->satuan_nama,

							'orderdet_harga_satuan'		=> $val2->orderdet_harga_satuan,

							'orderdet_disc'				=> $val2->orderdet_disc,

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

				$where_t_penawaran['data'][] = array(

					'column' => 't_penawaran_id',

					'param'	 => $val->order_referensi_id

				);

				$q_penawaran_harga = $this->mod->select('*', 't_penawaran_harga', NULL, $where_t_penawaran);

				if ($q_penawaran_harga) {

					foreach ($q_penawaran_harga->result() as $vpenawaranstats) {

						$vpenawaranstats = $vpenawaranstats->penawaran_harga_ppn;

						// echo $vpenawaranstats->penawaran_harga_ppn;

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

				if ($vpenawaranstats == 1) {

					$ppn = $val->order_ppn;

				} else if ($vpenawaranstats == 2) {

					$ppn = '10';

				} else {

					$ppn = "";

				}



				$response['val'][] = array(

					'kode' 								=> $val->order_id,

					'order_nomor' 				=> $val->order_nomor,

					'order_tanggal'				=> date("d/m/Y",strtotime($val->order_tanggal)),

					'order_type' 					=> $val->order_type,

					'order_status' 				=> $val->order_status,

					'm_supplier_id' 			=> $hasil1,

					'order_referensi_id' 	=> $hasil2,

					'cabang'							=> $hasil3,

					'order_nama_dikirim' 	=> $val->order_nama_dikirim,

					'order_alamat_dikirim'=> $val->order_alamat_dikirim,

					'order_hp_fax' 				=> $val->order_hp_fax,

					'order_subtotal' 			=> $val->order_subtotal,

					'order_ppn' 					=> $ppn,

					'order_total' 				=> $val->order_total,

					'order_terbilang' 		=> $this->terbilang($val->order_total),

					'order_tanggal_kirim'	=> date("d/m/Y",strtotime($val->order_tanggal_kirim)),

					'order_pembayaran'		=> $val->order_pembayaran,

					'order_top'						=> $val->order_top,

					'order_dp'						=> $val->order_dp,

					'ppnstatus'						=> $vpenawaranstats

				);

			}

		}

		$response['title'][] = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Purchase Order',

			'title_page2' 	=> 'Print PO',

		);



		$this->load->view('print/P_PO', $response);

		$this->pdf->load_view('print/P_PO', $response);

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

		$table = "t_order a";



		$select = '*';



		$join['data'][] = array(

			'table' => 't_orderdet b',

			'join'	=> 'b.t_order_id = a.order_id',

			'type'	=> 'left'

		);



		$where['data'][] = array(

			'column' => 'a.order_status >= ',

			'param'	 => 3

		);



		$where['data'][] = array(

			'column' => 'a.order_status <= ',

			'param'	 => 4

		);



		$where['data'][] = array(

			'column' => 'a.order_type',

			'param'	 => 0

		);



		$where_like['data'][] = array(

			'column' => 'a.order_nomor',

			'param'	 => $this->input->get('q')

		);



		$order['data'][] = array(

			'column' => 'a.order_nomor',

			'type'	 => 'ASC'

		);



		$query = $this->mod->select($select, $table, NULL, $where, NULL, $where_like, $order);

		// echo  $this->db->last_query();



		$response['items'] = array();



		if ($query<>false) {

			foreach ($query->result() as $valorder) {

				// if ($valorder->order_status == 1) {

					$response['items'][] = array(

						'id'		=> $valorder->order_id,

						'text'		=> $valorder->order_nomor

					);

				// }

			}

			$response['status'] = '200';

		}

		// echo $this->db->last_query();

		echo json_encode($response);

	}



	public function loadData_selectPembayaran(){

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

			'param'	 => 5

		);

		$where['data'][] = array(

			'column' => 'order_status_pembayaran',

			'param'	 => 1

		);

		$where['data'][] = array(

			'column' => 'm_supplier_id',

			'param'	 => $this->input->get('idsup')

		);

		$where['data'][] = array(

			'column' => 'order_type',

			'param'	 => 0

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

	public function postData($type)

	{

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

							'referensi_id' 					=> $row->order_id,

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



	public function deleteData(){

		// HAPUS PO

		$where_order_hdr['data'][] = array(

			'column' => 'order_id',

			'param'	 => $this->input->post('id')

		);

		$query_order_hdr = $this->mod->delete_data_table('t_order', $where_order_hdr);

		$where_order_dtl['data'][] = array(

			'column' => 't_order_id',

			'param'	 => $this->input->post('id')

		);

		$query_order_dtl = $this->mod->delete_data_table('t_orderdet', $where_order_dtl);

		// END HAPUS PO

		$response['status'] = '200';

		echo json_encode($response);

	}


	// CUSTOM SAMUEL
	public function delcomData(){
		$select = 'tbd.m_barang_id, tbd.penerimaan_barangdet_qty AS orderdet_qty';
		$table = 't_penerimaan_barang tb';

		$join['data'][] = array(
							      'table' => 't_penerimaan_barangdet tbd',
							      'join'	=> 'tb.penerimaan_barang_id = tbd.t_penerimaan_barang_id',
							      'type'	=> 'inner'
							    );

		$where['data'][] = array(
			'column' => 't_order_id',
			'param'	 => $this->input->post('id')
		);
		// GET QTY TERIMA
		$penerimaan_barang = $this->mod->select($select, $table, $join, $where, NULL, NULL, NULL, NULL, NULL, NULL);

		// UPDATE TABLE ORDER DETAIL 
		if ($penerimaan_barang) {
			$penerimaan_barang = $penerimaan_barang->result_array();
			$t_orderdet = $this->mod->select("*", "t_orderdet", NULL, $where, NULL, NULL, NULL, NULL, NULL, NULL)->result_array();
			// $this->print_r($penerimaan_barang);
			// $this->print_r($t_orderdet);
			
			foreach ($t_orderdet as $key => $value) {
				foreach ($penerimaan_barang as $key_penerimaan_barang => $value_penerimaan_barang) {
					if ($value["m_barang_id"] == $value_penerimaan_barang["m_barang_id"]) {
						$penerimaan_barang[$key_penerimaan_barang]["orderdet_total"] = $value_penerimaan_barang["orderdet_qty"] * $value["orderdet_harga_satuan"];
					}
				}
			}

			// $this->print_r($penerimaan_barang);
			// die;
			$this->db->where("t_order_id", $this->input->post('id'));
			$result_update = $this->db->update_batch("t_orderdet", $penerimaan_barang, "m_barang_id");
			// var_dump($result_update);
			// die;
			// UPDATE TABLE ORDER
			if (is_numeric($result_update) && $result_update > 0) {
				$where_order['data'][] = array(
					'column' => 'order_id',
					'param'	 => $this->input->post('id')
				);
				// GET PPN
				$t_order 	= $this->mod->select("*", "t_order", 	NULL, $where_order, NULL, NULL, NULL, NULL, NULL, NULL)->result_array();
				$calculate_orderdet = $this->calculate_orderdet($penerimaan_barang, $t_order[0]["order_ppn"]);

				if ($calculate_orderdet) {
					$this->db->update("t_order", $calculate_orderdet, array("order_id"=>$this->input->post("id")));
				}

				// $this->print_r($t_order);
				// echo $this->db->last_query();
				$response["status"] = '200';
				$response["message"] = "Data berhasil tersimpan";
			}
			else{
				// echo "ORDER DETAIL TIDAK ADA PERUBAHAN";
				$response["status"] = "204";
				$response["message"] = "ORDER DETAIL TIDAK ADA PERUBAHAN";
			}
		}
		else{
			$response["status"] = "200";
			$response["message"] = "Belum ada penerimaan barang, PO Dibatalkan";
			$this->db->update("t_order", array("order_status"=> 6), array("order_id"=>$this->input->post("id")));
		}
		// echo $this->db->last_query();
		// $this->print_r($penerimaan_barang);
		// die;
		// $this->print_r($t_orderdet);

		echo json_encode($response);

	}

	public function calculate_orderdet($data, $ppn)
	{
		$subtotal = 0;
		if (!empty($data) && is_array($data)) 
		{
			foreach ($data as $key => $value) {
				$subtotal += $value["orderdet_total"];
			}

			$result["order_subtotal"] 	= $subtotal;
			$result["order_status"]   	= '5';
			$result["order_total"]		= $subtotal + ($subtotal * $ppn / 100);
			return $result;
		}
		else
		{
			return false;
		}
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

				'm_cabang_id' 					=> $this->session->userdata('cabang_id'),

				'order_nomor' 					=> $order_nomor,

				'order_tanggal'					=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],

				'order_referensi_id'		=> $this->input->post('order_referensi_id', TRUE),

				'order_type' 						=> $this->input->post('order_type', TRUE),

				'm_supplier_id'					=> $this->input->post('m_supplier_id', TRUE),

				'order_nama_dikirim'		=> $this->input->post('order_nama_dikirim', TRUE),

				'order_alamat_dikirim'	=> $this->input->post('order_alamat_dikirim', TRUE),

				'order_hp_fax'					=> $this->input->post('order_hp_fax', TRUE),

				'order_subtotal'				=> $this->input->post('order_subtotal', TRUE),

				'order_ppn'							=> $this->input->post('order_ppn', TRUE),

				'order_total'						=> $this->input->post('order_total', TRUE),

				'order_tanggal_kirim'		=> $arrDate2[2]."-".$arrDate2[1]."-".$arrDate2[0],

				'order_pembayaran'			=> $this->input->post('order_pembayaran', TRUE),

				'order_tunai'						=> $this->input->post('i_payment', TRUE),

				'order_dp'							=> $this->input->post('order_dp', TRUE),

				'order_top'							=> $this->input->post('order_top', TRUE),

				'order_status' 					=> 1,

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

					'order_update_by'		=> $this->session->userdata('user_username'),

					'order_revised' 		=> $rev,

				);

			} else {

				$data = array(

					'order_status' 			=> $this->input->post('order_status', TRUE),

					'order_update_date'	=> date('Y-m-d H:i:s'),

					'order_update_by'		=> $this->session->userdata('user_username'),

					'order_revised' 		=> $rev,

				);

			}

		} else if ($type == 3) {

			$data = array(

				'order_status'			=> 2,

				'order_status_date'	=> date('Y-m-d H:i:s'),

				'order_update_date'	=> date('Y-m-d H:i:s'),

				'order_update_by'		=> $this->session->userdata('user_username'),

				'order_revised' 		=> $rev,

			);

		} else if ($type == 4) {

			// $arrDate2 = explode('/', );

			$data = array(

				'm_cabang_id' 					=> $this->session->userdata('cabang_id'),

				// 'order_nomor' 					=> $order_nomor,

				// 'order_tanggal'				=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],

				'order_referensi_id'		=> $this->input->post('order_referensi_id', TRUE),

				'order_type' 						=> $this->input->post('order_type', TRUE),

				'm_supplier_id'					=> $this->input->post('m_supplier_id', TRUE),

				'order_nama_dikirim'		=> $this->input->post('order_nama_dikirim', TRUE),

				'order_alamat_dikirim'	=> $this->input->post('order_alamat_dikirim', TRUE),

				'order_hp_fax'					=> $this->input->post('order_hp_fax', TRUE),

				'order_subtotal'				=> $this->replaceFormatNumber($this->input->post('order_subtotal', TRUE)),

				'order_ppn'							=> $this->input->post('order_ppn', TRUE),

				'order_total'						=> $this->replaceFormatNumber($this->input->post('order_total', TRUE)),

				'order_pembayaran'			=> $this->input->post('order_pembayaran', TRUE),

				// 'order_dp'					=> $this->input->post('order_dp', TRUE),

				'order_top'							=> $this->input->post('order_top', TRUE),

				'order_status' 					=> -2,

				'order_status_date'			=> date('Y-m-d H:i:s'),

				// 'order_created_date'		=> date('Y-m-d H:i:s'),

				'order_update_date'			=> date('Y-m-d H:i:s'),

				'order_update_by'				=> $this->session->userdata('user_username'),

				// 'order_created_by'			=> $this->session->userdata('user_username'),

				'order_revised' 				=> $rev,

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

				't_order_id' 						=> $idHdr,

				'm_barang_id' 					=> $this->input->post('m_barang_id', TRUE)[$seq],

				'orderdet_qty' 					=> $this->replaceFormatNumber($this->input->post('orderdet_qty', TRUE)[$seq]),

				'orderdet_harga_satuan'	=> $this->replaceFormatNumber($this->input->post('orderdet_harga_satuan', TRUE)[$seq]),

				'orderdet_disc'					=> $this->replaceFormatNumber($this->input->post('orderdet_disc', TRUE)[$seq]),

				'orderdet_total'				=> $this->replaceFormatNumber($this->input->post('orderdet_total', TRUE)[$seq]),

				'orderdet_created_date'	=> date('Y-m-d H:i:s'),

				'orderdet_created_by'		=> $this->session->userdata('user_username'),

				'orderdet_update_date'	=> date('Y-m-d H:i:s'),

				'orderdet_revised' 			=> 0,

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

				'orderdet_qty' 			=> $this->replaceFormatNumber($this->input->post('orderdet_qty', TRUE)[$seq]),

				'orderdet_harga_satuan'	=> $this->replaceFormatNumber($this->input->post('orderdet_harga_satuan', TRUE)[$seq]),

				'orderdet_total'		=> $this->replaceFormatNumber($this->input->post('orderdet_total', TRUE)[$seq]),

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

			'param'	 => 'PO'.$thn.''.$bln

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

		$kode_baru = $this->format_kode_transaksi('PO',$query);

		return $kode_baru;

	}

	/* end Function */



}

