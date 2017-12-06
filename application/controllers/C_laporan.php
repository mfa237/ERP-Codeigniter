<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class C_laporan extends MY_Controller {

	private $any_error = array();

	// Define Main Table

	public $tbl = '';



	public function __construct() {

        parent::__construct();

	}



	// --------------------------------------------------

	// LAPORAN HARIAN KELUAR BARANG

	public function lhkb(){

		$this->check_session();

		$priv = $this->cekUser(25);

		$data = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Laporan',

			'title_page2' 	=> 'Laporan Harian Keluar Barang',

			'priv_add'		=> $priv['create']

			);

		if($priv['read'] == 1)

		{

			$this->open_page('laporan/V_laporan_harian_keluar_barang', $data);

		}

		else

		{

			$this->load->view('layout/V_404', $data);

		}

	}

	public function penerimaan_barang(){

		$this->check_session();

		$priv = $this->cekUser(85);

		$data = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Laporan',

			'title_page2' 	=> 'Laporan Penerimaan Barang',

			'priv_add'		=> $priv['create']

			);

		if($priv['read'] == 1)

		{

			$this->open_page('laporan/V_laporan_penerimaan_barang', $data);

		}

		else

		{

			$this->load->view('layout/V_404', $data);

		}

	}

	public function loadDataPenerimaanBarang(){

		$select = '*';

		//LIMIT

		$limit = array(

			'start'  => $this->input->get('start'),

			'finish' => $this->input->get('length')

		);

		// $where['data'][] = array(

		// 	'column' => 'cabang_id',

		// 	'param'	 => $this->input->get('id_cabang')

		// );

		// $where['data'][] = array(

		// 	'column' => 'kartu_stok_keluar >',

		// 	'param'	 => 0

		// );

		$where['data'][] = array(

			'column' => 'penerimaan_barang_tanggal <=',

			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->get('to_tanggal')))

		);

		$where['data'][] = array(

			'column' => 'penerimaan_barang_tanggal >=',

			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->get('from_tanggal')))

		);

		//WHERE LIKE

		$where_like['data'][] = array(

			'column' => 'penerimaan_barang_tanggal, penerimaan_barang_nomor, order_nomor, barang_nama',

			'param'	 => $this->input->get('search[value]')

		);

		//ORDER

		$index_order = $this->input->get('order[0][column]');
		// echo "<pre>";
		// print_r($index_order);
		// echo "</pre>";
		// die;
		$order['data'][] = array(

			'column' => $this->input->get('columns['.$index_order.'][name]'),

			'type'	 => $this->input->get('order[0][dir]')

		);
		// $order['data'][] = array(

		// 	'column' => "penerimaan_barang_id",

		// 	'type'	 => "asc"

		// );

		// $this->print_r($order["data"]);
		// die;
		$query_total = $this->mod->select($select, 'v_penerimaan_barang_laporan');

		$query_filter = $this->mod->select($select, 'v_penerimaan_barang_laporan', NULL, $where, NULL, $where_like, $order);

		$query = $this->mod->select($select, 'v_penerimaan_barang_laporan', NULL, $where, NULL, $where_like, $order, $limit);
		// $this->print_r($order);
		// $this->print_r($query->result());
		// $query->result();
		// echo $this->db->last_query();
		// die;
		// $this->print_r($query->result());
		// die;
		$response['data'] = array();

		if ($query<>false) {

			$no = $limit['start']+1;
			$data = $query->result();
			$qty_kekurangan = array();
			// $this->print_r($data);
			foreach ($data as $key => $val) {
				// SET QTY KEKURANGAN
				// RESET QTY KEKURANGAN

				// $this->print_r($qty_kekurangan);
				if (!isset($qty_kekurangan[$val->order_nomor])) {
					$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_order"]      = $val->orderdet_qty; 
					$qty_kekurangan[$val->order_nomor]["qty_bpb"] 							= 0; 
					$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_kekurangan"] = $val->orderdet_qty; 
				}

				if (!isset($qty_kekurangan[$val->order_nomor][$val->m_barang_id])) {
					$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_order"]      = $val->orderdet_qty; 
					$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_kekurangan"] = $val->orderdet_qty;
				}

				$qty_kekurangan[$val->order_nomor]["qty_bpb"] 							+= $val->penerimaan_barangdet_qty; 
				$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_kekurangan"] = $qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_kekurangan"] - $val->penerimaan_barangdet_qty;

				// echo "KEY ===> $key"."<br>";
				// $this->print_r($qty_kekurangan);

				$response['data'][] = array(

					$no,

					$key != 0 && $data[$key]->order_nomor == $data[$key-1]->order_nomor ? "":$val->order_nomor,

					$key != 0 && $data[$key]->barang_nomor == $data[$key-1]->barang_nomor ? "":$val->barang_nomor,

					$key != 0 && $data[$key]->barang_nama == $data[$key-1]->barang_nama ? "":$val->barang_nama,

					$val->penerimaan_barang_nomor,

					date("d/m/Y", strtotime($val->penerimaan_barang_tanggal)),

					$val->orderdet_qty,

					$val->penerimaan_barangdet_qty,

					$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_kekurangan"]
				);

				// $this->print_r($qty_kekurangan);
				// die;
				if ($data[$key]->m_barang_id != @$data[$key+1]->m_barang_id) {
					$m_barang_id = $data[$key]->m_barang_id;
					// echo "string===>$key"."<br>";
					// $this->print_r($qty_kekurangan);
					// die;
					$response["data"][] = array("", 
							"<b>subtotal</b>","", "","", "",
							$qty_kekurangan[$val->order_nomor][$m_barang_id]["qty_order"], 
							$qty_kekurangan[$val->order_nomor][$m_barang_id]["qty_order"] - $qty_kekurangan[$val->order_nomor][$m_barang_id]["qty_kekurangan"], 
							$qty_kekurangan[$val->order_nomor][$m_barang_id]["qty_kekurangan"]);
					$qty_ordered = 0;
					// foreach ($qty_kekurangan[$val->order_nomor] as $key_kekurangan => $value_kekurangan) {
					// 	if ($key_kekurangan != "qty_bpb") {
					// 		$response["data"][] = array("", 
					// 				"<b>subtotal</b>","", "","", "",
					// 				$value_kekurangan["qty_order"], 
					// 				$qty_kekurangan[$val->order_nomor]["qty_bpb"], 
					// 				$qty_ordered - $qty_kekurangan[$val->order_nomor]["qty_bpb"]);
					// 	}
					// }
					// print_r($qty_ordered);die;

				}

				$no++;

			}

		}

		// $this->print_r($response["data"]);
		// die;



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

	public function penerimaan_barang_pdf(){
		$this->load->library('pdf');

		$name = 'LAPORAN BPB '.date('d-m-Y', strtotime($this->input->post('from_tanggal'))).' - '.date('d-m-Y', strtotime($this->input->post('to_tanggal'))).'';
		$select = '*';

		// $this->print_r($this->input->post());
		// die;
		//LIMIT

		$limit = array(

			'start'  => $this->input->post('start'),

			'finish' => $this->input->post('length')

		);

		$where['data'][] = array(

			'column' => 'penerimaan_barang_tanggal <=',

			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->post('to_tanggal')))

		);

		$where['data'][] = array(

			'column' => 'penerimaan_barang_tanggal >=',

			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->post('from_tanggal')))

		);

		//WHERE LIKE

		$where_like['data'][] = array(

			'column' => 'penerimaan_barang_tanggal, penerimaan_barang_nomor, order_nomor, barang_nama',

			'param'	 => $this->input->post('search[value]')

		);

		//ORDER

		$index_order = $this->input->post('order[0][column]');

		$order['data'][] = array(

			'column' => "order_nomor",

			'type'	 => "desc"

		);
		// $order['data'][] = array(

		// 	'column' => "penerimaan_barang_id",

		// 	'type'	 => "asc"

		// );

		// $this->print_r($order["data"]);
		// die;
		$query_total = $this->mod->select($select, 'v_penerimaan_barang_laporan');

		$query_filter = $this->mod->select($select, 'v_penerimaan_barang_laporan', NULL, $where, NULL, $where_like, $order);

		$query = $this->mod->select($select, 'v_penerimaan_barang_laporan', NULL, $where, NULL, $where_like, $order, $limit);
		
		$response['data'] = array();

		$response['from_tanggal'] = date('d-m-Y', strtotime($this->input->post('from_tanggal')));

		$response['to_tanggal'] = date('d-m-Y', strtotime($this->input->post('to_tanggal')));

		$response['title'][] = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Laporan',

			'title_page2' 	=> 'Laporan BPB',

		);

		if ($query<>false) {

			$no = $limit['start']+1;
			$data = $query->result();
			$qty_kekurangan = array();
			// $this->print_r($data);
			foreach ($data as $key => $val) {
				// SET QTY KEKURANGAN
				// RESET QTY KEKURANGAN

				// $this->print_r($qty_kekurangan);
				if (!isset($qty_kekurangan[$val->order_nomor])) {
					$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_order"]      = $val->orderdet_qty; 
					$qty_kekurangan[$val->order_nomor]["qty_bpb"] 							= 0; 
					$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_kekurangan"] = $val->orderdet_qty; 
				}

				if (!isset($qty_kekurangan[$val->order_nomor][$val->m_barang_id])) {
					$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_order"]      = $val->orderdet_qty; 
					$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_kekurangan"] = $val->orderdet_qty;
				}

				$qty_kekurangan[$val->order_nomor]["qty_bpb"] 							+= $val->penerimaan_barangdet_qty; 
				$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_kekurangan"] = $qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_kekurangan"] - $val->penerimaan_barangdet_qty;

				// echo "KEY ===> $key"."<br>";
				// $this->print_r($qty_kekurangan);

				$response['data'][] = array(

					$no,

					$key != 0 && $data[$key]->order_nomor == $data[$key-1]->order_nomor ? "":$val->order_nomor,

					$key != 0 && $data[$key]->barang_nomor == $data[$key-1]->barang_nomor ? "":$val->barang_nomor,

					$key != 0 && $data[$key]->barang_nama == $data[$key-1]->barang_nama ? "":$val->barang_nama,

					$val->penerimaan_barang_nomor,

					date("d/m/Y", strtotime($val->penerimaan_barang_tanggal)),

					$val->orderdet_qty,

					$val->penerimaan_barangdet_qty,

					$qty_kekurangan[$val->order_nomor][$val->m_barang_id]["qty_kekurangan"]
				);

				// $this->print_r($qty_kekurangan);
				// die;
				if ($data[$key]->m_barang_id != @$data[$key+1]->m_barang_id) {
					$m_barang_id = $data[$key]->m_barang_id;
					// echo "string===>$key"."<br>";
					// $this->print_r($qty_kekurangan);
					// die;
					$response["data"][] = array("", 
							"<b>subtotal</b>","", "","", "",
							$qty_kekurangan[$val->order_nomor][$m_barang_id]["qty_order"], 
							$qty_kekurangan[$val->order_nomor][$m_barang_id]["qty_order"] - $qty_kekurangan[$val->order_nomor][$m_barang_id]["qty_kekurangan"], 
							$qty_kekurangan[$val->order_nomor][$m_barang_id]["qty_kekurangan"]);
					$qty_ordered = 0;
					// foreach ($qty_kekurangan[$val->order_nomor] as $key_kekurangan => $value_kekurangan) {
					// 	if ($key_kekurangan != "qty_bpb") {
					// 		$response["data"][] = array("", 
					// 				"<b>subtotal</b>","", "","", "",
					// 				$value_kekurangan["qty_order"], 
					// 				$qty_kekurangan[$val->order_nomor]["qty_bpb"], 
					// 				$qty_ordered - $qty_kekurangan[$val->order_nomor]["qty_bpb"]);
					// 	}
					// }
					// print_r($qty_ordered);die;

				}

				$no++;

			}

		}

		// $this->print_r($response["data"]);
		// die;
		// echo $this->db->last_query();
		// die;
		// echo json_encode($response);
		// $response = array();

		// $this->print_r($response);
		// die;
		$this->pdf->set_paper('A4', 'landscape');

		$this->pdf->load_view('print/P_laporan_bpb', $response);

		$this->pdf->render();

		$this->pdf->stream($name,array("Attachment"=>false));
		// $this->load->view('print/P_laporan_bpb', $response);
	}

	public function penjualan(){
		$priv = $this->cekUser(86);

		$m_jenis_barang_id = $this->input->get("m_jenis_barang_id");
		$m_category_2_id = $this->input->get("m_category_2_id");

		// var_dump($this->input->get("daterange"));

		$daterange = $this->input->get("daterange");
		$date = explode("-", $daterange);
		$from_tanggal = $date[0];
		$to_tanggal = $date[1];

		$from_tanggal = str_replace("/","-", $from_tanggal);
		$to_tanggal = str_replace("/","-", $to_tanggal);
		$from_tanggal = date("Y-m-d H:i:s", strtotime($from_tanggal));
		$to_tanggal = date("Y-m-d H:i:s", strtotime($to_tanggal));


		// $this->print_r($date);

		// echo date("Y-m-d", strtotime($this->input->get("daterange")));


		$this->db->select("*");
		$this->db->from("m_jenis_barang");
		$this->db->join("m_category_2", "m_jenis_barang.jenis_barang_id = m_category_2.m_jenis_barang_id");
		$this->db->where(array("jenis_barang_id"=>$m_jenis_barang_id));
		if (!empty($m_category_2_id)) {
			$this->db->where(array("category_2_id"=> $m_category_2_id));
		}
		$m_barang = $this->db->get()->result_array();

		$table = 'tb_penjualan a';

		$join['data'][] = array(
							      'table' => 'tb_penjualan_details d',
							      'join'	=> 'd.penjualan = a.penjualan_id',
							      'type'	=> 'left'
							    );

		$join['data'][] = array(
							      'table' => 'm_barang mb',
							      'join'	=> 'd.barang = mb.barang_id',
							      'type'	=> 'inner'
							    );

		$join['data'][] = array(
							      'table' => 'm_satuan ms',
							      'join'	=> 'mb.`m_satuan_id` = ms.`satuan_id`',
							      'type'	=> 'inner'
							    );

		$join['data'][] = array(
							      'table' => 'm_jenis_barang mjb',
							      'join'	=> 'mjb.`jenis_barang_id` = mb.`m_jenis_barang_id`',
							      'type'	=> 'inner'
							    );

		$join['data'][] = array(
							      'table' => 'm_category_2 mc',
							      'join'	=> 'mb.`m_category_2_id` = mc.`category_2_id`',
							      'type'	=> 'inner'
							    );

		$where['data'][] = array(

			'column' => 'penjualan_date >=',

			'param'	 => $from_tanggal

		);

		$where['data'][] = array(

			'column' => 'penjualan_date <=',

			'param'	 => $to_tanggal

		);

		$where['data'][] = array(

			'column' => 'a.status',

			'param'	 => 0

		);


		$group = array();

		$select = "`d`.*, `mb`.*, `ms`.`satuan_nama`, `mjb`.`jenis_barang_nama`, `mc`.`category_2_nama`, `mc`.`category_2_id`, 
					(d.`barang_qty` + d.`item_getFromGudang`) AS qty,
					d.`barang_price` AS  barang_price,
					d.barang_harga_beli * (d.`barang_qty` + d.`item_getFromGudang`)AS  barang_total_harga_beli,
					d.barang_harga_jual* (d.`barang_qty` + d.`item_getFromGudang`)AS  barang_total_harga_jual,
					d.`barang_discount_nominal` AS discount,
					d.`barang_grand_total` AS barang_grand_total,
					a.`penjualan_pajak` AS penjualan_pajak,
					a.`penjualan_all_discount_nominal` AS penjualan_all_discount_nominal,
					(a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) AS total_transaksi_penjualan,
					(d.`barang_grand_total` / (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) * penjualan_all_discount_nominal) AS total_discout_nota,
					d.`barang_grand_total` - (d.`barang_grand_total` / (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) * penjualan_all_discount_nominal) AS total_transaksi_barang";
		if (!empty($m_jenis_barang_id) && empty($m_category_2_id)) {
			$search_by = "m_category_2_id";
			
			$where['data'][] = array('column' => 'mb.m_jenis_barang_id',
										'param'	 => $m_jenis_barang_id );

		}

		else if(!empty($m_jenis_barang_id) && !empty($m_category_2_id)) {
		
			
			$where['data'][] = array('column' => 'mb.m_jenis_barang_id',
										'param'	 => $m_jenis_barang_id );

			$where['data'][] = array('column' => 'mb.m_category_2_id',
										'param'	 => $m_category_2_id);

			$search_by = "barang_id";

			// $group = array("mb.barang_id");
		}
		else{
		

			$search_by = "m_jenis_barang_id";
			
			// $group = array("mb.m_jenis_barang_id");
		}


		$this->check_session();

		$penjualan = $this->mod->select($select, $table, $join, $where, NULL, NULL, NULL, NULL, NULL, $group);

		// echo $this->db->last_query();
		// die;		

		if ($penjualan == TRUE) {
			$penjualan = $this->calculate_penjualan($penjualan->result_array());
		}
		else{
			$penjualan = array();
		}

		// $this->print_r($penjualan);
		// die;

		$summary_qty = 0;
		$summary_harga_beli = 0;
		$summary_harga_jual = 0;
		$summary_harga_jual_pajak = 0;

		// foreach ($penjualan as $key => $value) {
		// 	$summary_qty += $value["qty"];
		// 	$summary_harga_beli += $value["harga_beli"];
		// 	$summary_harga_jual += $value["harga_jual"];
		// 	$summary_harga_jual_pajak += $value["harga_jual_pajak"];  
		// }

		// echo $this->db->last_query();
		$data = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Laporan',

			'title_page2' 	=> 'Laporan POS',

			'priv_add'		=> $priv['create'],
			// 'kategori'		=> $this->mod->select_config("m_category_2", "")->result_array(),
	        'penjualan'     => $penjualan,

	        // 'summary' 		=> array("summary_qty" => $summary_qty,
	        // 							"summary_harga_beli" => $summary_harga_beli,
	        // 							"summary_harga_jual" => $summary_harga_jual,
	        // 							"summary_harga_jual_pajak" => $summary_harga_jual_pajak),
	        
	        "search_by" 	=> $search_by,

	        "jenis_barang_nama" => @$m_barang[0]["jenis_barang_nama"],

	        "category_2_nama" => @$m_barang[0]["category_2_nama"]
		);
		// $this->print_r($data);
		// $this->print_r($penjualan);
		// die;

		if($priv['read'] == 1)
		{
			$this->open_page('laporan/V_laporan_penjualan', $data);
		}

		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function calculate_penjualan($data)
	{
		$result = array();
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				// JIKA m_jenis_barang_id TIDAK DITEMUKKAN, SET ARRAY dimensi ke-1 ==> m_jenis_barang_id
				if (@!array_key_exists($value["m_jenis_barang_id"], $result["m_jenis_barang_id"])) {
					$result["m_jenis_barang_id"][$value["m_jenis_barang_id"]] = $value;
				}
				else{
					$result["m_jenis_barang_id"][$value["m_jenis_barang_id"]]["barang_total"] += $value["barang_total"];
					$result["m_jenis_barang_id"][$value["m_jenis_barang_id"]]["barang_total_harga_beli"] += $value["barang_total_harga_beli"];
					$result["m_jenis_barang_id"][$value["m_jenis_barang_id"]]["barang_total_harga_jual"] += $value["barang_total_harga_jual"];
					
					$result["m_jenis_barang_id"][$value["m_jenis_barang_id"]]["barang_grand_total"] += $value["barang_grand_total"];
					$result["m_jenis_barang_id"][$value["m_jenis_barang_id"]]["barang_discount_nominal"] += $value["barang_discount_nominal"];
					$result["m_jenis_barang_id"][$value["m_jenis_barang_id"]]["total_transaksi_barang"] += $value["total_transaksi_barang"];
					$result["m_jenis_barang_id"][$value["m_jenis_barang_id"]]["total_discout_nota"] += $value["total_discout_nota"];
					$result["m_jenis_barang_id"][$value["m_jenis_barang_id"]]["qty"] += $value["qty"];
				}

				if (@!array_key_exists($value["m_category_2_id"], $result["m_category_2_id"])) {
					$result["m_category_2_id"][$value["m_category_2_id"]] = $value;
				}
				else{
					$result["m_category_2_id"][$value["m_category_2_id"]]["barang_total"] += $value["barang_total"];
					$result["m_category_2_id"][$value["m_category_2_id"]]["barang_total_harga_beli"] += $value["barang_total_harga_beli"];
					$result["m_category_2_id"][$value["m_category_2_id"]]["barang_total_harga_jual"] += $value["barang_total_harga_jual"];
					
					$result["m_category_2_id"][$value["m_category_2_id"]]["barang_grand_total"] += $value["barang_grand_total"];
					$result["m_category_2_id"][$value["m_category_2_id"]]["barang_discount_nominal"] += $value["barang_discount_nominal"];
					$result["m_category_2_id"][$value["m_category_2_id"]]["total_transaksi_barang"] += $value["total_transaksi_barang"];
					$result["m_category_2_id"][$value["m_category_2_id"]]["total_discout_nota"] += $value["total_discout_nota"];
					$result["m_category_2_id"][$value["m_category_2_id"]]["qty"] += $value["qty"];
				}

				if (@!array_key_exists($value["barang_id"], $result["barang_id"])) {
					$result["barang_id"][$value["barang_id"]] = $value;
				}
				else{
					$result["barang_id"][$value["barang_id"]]["barang_total"] += $value["barang_total"];
					$result["barang_id"][$value["barang_id"]]["barang_total_harga_beli"] += $value["barang_total_harga_beli"];
					$result["barang_id"][$value["barang_id"]]["barang_total_harga_jual"] += $value["barang_total_harga_jual"];
					
					$result["barang_id"][$value["barang_id"]]["barang_grand_total"] += $value["barang_grand_total"];
					$result["barang_id"][$value["barang_id"]]["barang_discount_nominal"] += $value["barang_discount_nominal"];
					$result["barang_id"][$value["barang_id"]]["total_transaksi_barang"] += $value["total_transaksi_barang"];
					$result["barang_id"][$value["barang_id"]]["total_discout_nota"] += $value["total_discout_nota"];
					$result["barang_id"][$value["barang_id"]]["qty"] += $value["qty"];
				}
			}
			usort($result["m_jenis_barang_id"], function($a, $b) {
			    return $b['qty'] - $a['qty'];
			});
			usort($result["m_category_2_id"], function($a, $b) {
			    return $b['qty'] - $a['qty'];
			});
			usort($result["barang_id"], function($a, $b) {
			    return $b['qty'] - $a['qty'];
			});
		}
		// echo $this->db->last_query();
		// $this->print_r($result["barang_id"]);
		// echo count($result["barang_id"]);
		// die;
		return $result;
		// echo "------------------------------------------------------------------------";
		// $this->print_r($result["m_jenis_barang_id"]);
		// echo count($result["m_jenis_barang_id"]);
		// die;
		// die;
	}

	// X_UNUSED
	public function loadDataPenjualan()
	{
		$response["data"][] = array("name"=>"samuel",
									"position"=>"web dev",
									"salary"=> "$112,000",
									"start_date"=> "2011/01/25",
									"office"=> "New York",
									"extn"=> "4226"
							);
		echo json_encode($response);
	}

	public function konsinyasi(){
		$priv = $this->cekUser(89);

		$m_jenis_barang_id = $this->input->get("m_jenis_barang_id");
		$m_category_2_id = $this->input->get("m_category_2_id");

		$daterange = $this->input->get("daterange");
		$date = explode("-", $daterange);
		$from_tanggal = $date[0];
		$to_tanggal = $date[1];

		$from_tanggal = str_replace("/","-", $from_tanggal);
		$to_tanggal = str_replace("/","-", $to_tanggal);
		$from_tanggal = date("Y-m-d H:i:s", strtotime($from_tanggal));
		$to_tanggal = date("Y-m-d H:i:s", strtotime($to_tanggal));


		// $this->print_r($daterange);
		// $this->print_r($from_tanggal);
		// $this->print_r($to_tanggal);
		// die;
		$this->db->select("*");
		$this->db->from("m_jenis_barang");
		$this->db->join("m_category_2", "m_jenis_barang.jenis_barang_id = m_category_2.m_jenis_barang_id");
		$this->db->where(array("jenis_barang_id"=>$m_jenis_barang_id));
		if (!empty($m_category_2_id)) {
			$this->db->where(array("category_2_id"=> $m_category_2_id));
		}
		$m_barang = $this->db->get()->result_array();

		$table = 'tb_penjualan a';

		$join['data'][] = array(
							      'table' => 'tb_penjualan_details d',
							      'join'	=> 'd.penjualan = a.penjualan_id',
							      'type'	=> 'left'
							    );

		$join['data'][] = array('table' => 'm_barang mb',
							      'join'	=> 'd.barang = mb.barang_id',
							      'type'	=> 'inner');

		$join['data'][] = array(
							      'table' => 'm_satuan ms',
							      'join'	=> 'mb.`m_satuan_id` = ms.`satuan_id`',
							      'type'	=> 'inner'
							    );

		$join['data'][] = array(
							      'table' => 'm_jenis_barang mjb',
							      'join'	=> 'mjb.`jenis_barang_id` = mb.`m_jenis_barang_id`',
							      'type'	=> 'inner'
							    );

		$join['data'][] = array(
							      'table' => 'm_category_2 mc',
							      'join'	=> 'mb.`m_category_2_id` = mc.`category_2_id`',
							      'type'	=> 'inner'
							    );

		$where['data'][] = array(

			'column' => 'penjualan_date >=',

			'param'	 => $from_tanggal

		);

		$where['data'][] = array(

			'column' => 'penjualan_date <=',

			'param'	 => $to_tanggal

		);

		$where['data'][] = array(

			'column' => 'a.status',

			'param'	 => 0

		);


		// IF KONSINYASI
		if ($this->input->get("konsinyasi") == "true") 
		{
			$where['data'][] = array(

				'column' => 'd.is_konsinyasi',

				'param'	 => 1

			);
		}

		if ($this->input->get("konsinyasi") == "false") 
		{	
			$where['data'][] = array(

				'column' => 'd.is_konsinyasi',

				'param'	 => 0

			);
		}



		$group = array();

		$select = "`d`.*, `mb`.*, `ms`.`satuan_nama`, `mjb`.`jenis_barang_nama`, `mc`.`category_2_nama`, `mc`.`category_2_id`, 
					(d.`barang_qty` + d.`item_getFromGudang`) AS qty,
					d.`barang_price` AS  barang_price,
					d.barang_harga_beli * (d.`barang_qty` + d.`item_getFromGudang`)AS  barang_total_harga_beli,
					d.barang_harga_jual* (d.`barang_qty` + d.`item_getFromGudang`)AS  barang_total_harga_jual,
					d.`barang_discount_nominal` AS discount,
					d.`barang_grand_total` AS barang_grand_total,
					a.`penjualan_pajak` AS penjualan_pajak,
					a.`penjualan_all_discount_nominal` AS penjualan_all_discount_nominal,
					(a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) AS total_transaksi_penjualan,
					(d.`barang_grand_total` / (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) * penjualan_all_discount_nominal) AS total_discout_nota,
					d.`barang_grand_total` - (d.`barang_grand_total` / (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) * penjualan_all_discount_nominal) AS total_transaksi_barang";
		if (!empty($m_jenis_barang_id) && empty($m_category_2_id)) {
			$search_by = "m_category_2_id";
			
			$where['data'][] = array('column' => 'mb.m_jenis_barang_id',
										'param'	 => $m_jenis_barang_id );

		}

		else if(!empty($m_jenis_barang_id) && !empty($m_category_2_id)) {
			$where['data'][] = array('column' => 'mb.m_jenis_barang_id',
										'param'	 => $m_jenis_barang_id );

			$where['data'][] = array('column' => 'mb.m_category_2_id',
										'param'	 => $m_category_2_id);

			$search_by = "barang_id";
		}
		else
		{
			$search_by = "m_jenis_barang_id";
		}


		$this->check_session();
		$penjualan = $this->mod->select($select, $table, $join, $where);

		// echo $this->db->last_query();
		// die;

		if ($penjualan == TRUE) {
			$penjualan = $this->calculate_penjualan($penjualan->result_array());
		}
		else{
			$penjualan = array();
		}

		// $this->print_r($penjualan);
		// die;

		$summary_qty = 0;
		$summary_harga_beli = 0;
		$summary_harga_jual = 0;
		$summary_harga_jual_pajak = 0;

		// foreach ($penjualan as $key => $value) {
		// 	$summary_qty += $value["qty"];
		// 	$summary_harga_beli += $value["harga_beli"];
		// 	$summary_harga_jual += $value["harga_jual"];
		// 	$summary_harga_jual_pajak += $value["harga_jual_pajak"];  
		// }

		// echo $this->db->last_query();
		$data = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Laporan',

			'title_page2' 	=> 'Laporan Konsinyasi',

			'priv_add'		=> $priv['create'],
			// 'kategori'		=> $this->mod->select_config("m_category_2", "")->result_array(),
	        'penjualan'     => $penjualan,

	        // 'summary' 		=> array("summary_qty" => $summary_qty,
	        // 							"summary_harga_beli" => $summary_harga_beli,
	        // 							"summary_harga_jual" => $summary_harga_jual,
	        // 							"summary_harga_jual_pajak" => $summary_harga_jual_pajak),
	        
	        "search_by" 	=> $search_by,

	        "jenis_barang_nama" => @$m_barang[0]["jenis_barang_nama"],

	        "category_2_nama" => @$m_barang[0]["category_2_nama"]
		);
		// $this->print_r($data);
		// $this->print_r($penjualan);
		// die;

		if($priv['read'] == 1)
		{
			$this->open_page('laporan/V_laporan_konsinyasi', $data);
		}

		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function pembelian(){
		$priv = $this->cekUser(90);

		$m_jenis_barang_id = $this->input->get("m_jenis_barang_id");
		$m_category_2_id = $this->input->get("m_category_2_id");

		$daterange = $this->input->get("daterange");
		$date = explode("-", $daterange);
		$from_tanggal = $date[0];
		$to_tanggal = $date[1];

		$from_tanggal = str_replace("/","-", $from_tanggal);
		$to_tanggal = str_replace("/","-", $to_tanggal);
		$from_tanggal = date("Y-m-d H:i:s", strtotime($from_tanggal));
		$to_tanggal = date("Y-m-d H:i:s", strtotime($to_tanggal));


		// $this->print_r($daterange);
		// $this->print_r($from_tanggal);
		// $this->print_r($to_tanggal);
		// die;
		$this->db->select("*");
		$this->db->from("m_jenis_barang");
		$this->db->join("m_category_2", "m_jenis_barang.jenis_barang_id = m_category_2.m_jenis_barang_id");
		$this->db->where(array("jenis_barang_id"=>$m_jenis_barang_id));
		if (!empty($m_category_2_id)) {
			$this->db->where(array("category_2_id"=> $m_category_2_id));
		}
		$m_barang = $this->db->get()->result_array();

		$table = 'tb_penjualan a';

		$join['data'][] = array(
							      'table' => 'tb_penjualan_details d',
							      'join'	=> 'd.penjualan = a.penjualan_id',
							      'type'	=> 'left'
							    );

		$join['data'][] = array('table' => 'm_barang mb',
							      'join'	=> 'd.barang = mb.barang_id',
							      'type'	=> 'inner');

		$join['data'][] = array(
							      'table' => 'm_satuan ms',
							      'join'	=> 'mb.`m_satuan_id` = ms.`satuan_id`',
							      'type'	=> 'inner'
							    );

		$join['data'][] = array(
							      'table' => 'm_jenis_barang mjb',
							      'join'	=> 'mjb.`jenis_barang_id` = mb.`m_jenis_barang_id`',
							      'type'	=> 'inner'
							    );

		$join['data'][] = array(
							      'table' => 'm_category_2 mc',
							      'join'	=> 'mb.`m_category_2_id` = mc.`category_2_id`',
							      'type'	=> 'inner'
							    );

		$where['data'][] = array(

			'column' => 'penjualan_date >=',

			'param'	 => $from_tanggal

		);

		$where['data'][] = array(

			'column' => 'penjualan_date <=',

			'param'	 => $to_tanggal

		);

		$where['data'][] = array(

			'column' => 'a.status',

			'param'	 => 0

		);


		// IF KONSINYASI
		if ($this->input->get("konsinyasi") == "true") 
		{
			$where['data'][] = array(

				'column' => 'd.is_konsinyasi',

				'param'	 => 1

			);
		}

		if ($this->input->get("konsinyasi") == "false") 
		{	
			$where['data'][] = array(

				'column' => 'd.is_konsinyasi',

				'param'	 => 0

			);
		}



		$group = array();

		$select = "`d`.*, `mb`.*, `ms`.`satuan_nama`, `mjb`.`jenis_barang_nama`, `mc`.`category_2_nama`, `mc`.`category_2_id`, 
					(d.`barang_qty` + d.`item_getFromGudang`) AS qty,
					d.`barang_price` AS  barang_price,
					d.barang_harga_beli * (d.`barang_qty` + d.`item_getFromGudang`)AS  barang_total_harga_beli,
					d.barang_harga_jual* (d.`barang_qty` + d.`item_getFromGudang`)AS  barang_total_harga_jual,
					d.`barang_discount_nominal` AS discount,
					d.`barang_grand_total` AS barang_grand_total,
					a.`penjualan_pajak` AS penjualan_pajak,
					a.`penjualan_all_discount_nominal` AS penjualan_all_discount_nominal,
					(a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) AS total_transaksi_penjualan,
					(d.`barang_grand_total` / (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) * penjualan_all_discount_nominal) AS total_discout_nota,
					d.`barang_grand_total` - (d.`barang_grand_total` / (a.`penjualan_all_discount_nominal` + a.penjualan_grand_total) * penjualan_all_discount_nominal) AS total_transaksi_barang";
		if (!empty($m_jenis_barang_id) && empty($m_category_2_id)) {
			$search_by = "m_category_2_id";
			
			$where['data'][] = array('column' => 'mb.m_jenis_barang_id',
										'param'	 => $m_jenis_barang_id );

		}

		else if(!empty($m_jenis_barang_id) && !empty($m_category_2_id)) {
			$where['data'][] = array('column' => 'mb.m_jenis_barang_id',
										'param'	 => $m_jenis_barang_id );

			$where['data'][] = array('column' => 'mb.m_category_2_id',
										'param'	 => $m_category_2_id);

			$search_by = "barang_id";
		}
		else
		{
			$search_by = "m_jenis_barang_id";
		}


		$this->check_session();
		$penjualan = $this->mod->select($select, $table, $join, $where);

		// echo $this->db->last_query();
		// die;

		if ($penjualan == TRUE) {
			$penjualan = $this->calculate_penjualan($penjualan->result_array());
		}
		else{
			$penjualan = array();
		}

		// $this->print_r($penjualan);
		// die;

		$summary_qty = 0;
		$summary_harga_beli = 0;
		$summary_harga_jual = 0;
		$summary_harga_jual_pajak = 0;

		// foreach ($penjualan as $key => $value) {
		// 	$summary_qty += $value["qty"];
		// 	$summary_harga_beli += $value["harga_beli"];
		// 	$summary_harga_jual += $value["harga_jual"];
		// 	$summary_harga_jual_pajak += $value["harga_jual_pajak"];  
		// }

		// echo $this->db->last_query();
		$data = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Laporan',

			'title_page2' 	=> 'Laporan Pembelian',

			'priv_add'		=> $priv['create'],
			// 'kategori'		=> $this->mod->select_config("m_category_2", "")->result_array(),
	        'penjualan'     => $penjualan,

	        // 'summary' 		=> array("summary_qty" => $summary_qty,
	        // 							"summary_harga_beli" => $summary_harga_beli,
	        // 							"summary_harga_jual" => $summary_harga_jual,
	        // 							"summary_harga_jual_pajak" => $summary_harga_jual_pajak),
	        
	        "search_by" 	=> $search_by,

	        "jenis_barang_nama" => @$m_barang[0]["jenis_barang_nama"],

	        "category_2_nama" => @$m_barang[0]["category_2_nama"]
		);
		// $this->print_r($data);
		// $this->print_r($penjualan);
		// die;

		if($priv['read'] == 1)
		{
			$this->open_page('laporan/V_laporan_pembelian', $data);
		}

		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadDataPembelian(){

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

				$response['data'][] = array(

					$no,

					$val->cabang_nama,

					$val->order_nomor,

					$val->penawaran_nomor,

					date("d/m/Y",strtotime($val->order_tanggal)),

					$val->order_status_nama
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



	public function cetakPDFlhkb(){

		$this->load->library('pdf');

		$name = 'LHKB '.date('d-m-Y', strtotime($this->input->post('from_tanggal'))).' - '.date('d-m-Y', strtotime($this->input->post('to_tanggal'))).'';

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

			'column' => 'kartu_stok_keluar >',

			'param'	 => 0

		);

		$where['data'][] = array(

			'column' => 'kartu_stok_tanggal <=',

			'param'	 => date('Y/m/d H:i:s', strtotime($this->input->post('to_tanggal')))

		);

		$where['data'][] = array(

			'column' => 'kartu_stok_tanggal >=',

			'param'	 =>  date('Y/m/d H:i:s', strtotime($this->input->post('from_tanggal')))

		);

		$query = $this->mod->select($select, 'v_kartu_stok', NULL, $where);

		$response['val'] = array();

		$response['from_tanggal'] = date('d-m-Y', strtotime($this->input->post('from_tanggal')));

		$response['to_tanggal'] = date('d-m-Y', strtotime($this->input->post('to_tanggal')));

		$response['title'][] = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Laporan',

			'title_page2' 	=> 'Laporan Harian Keluar Barang',

		);

 		if ($query<>false) {

			foreach ($query->result() as $val) {

				$departmen = '';

				if($val->kartu_stok_referensi != '')

				{

					if(strpos($val->kartu_stok_referensi, 'BKB') !== false)

					{

						$selectDepartmen = 'departemen_nama';

						$whereDepartmen['data'][] = array(

							'column' =>  'keluar_barang_nomor',

							'param'  =>	 $val->kartu_stok_referensi

						);

						$queryDepartmen = $this->mod->select($selectDepartmen, 'v_bkb', NULL, $whereDepartmen, NULL, NULL, NULL);

						if($queryDepartmen)

						{

							foreach ($queryDepartmen->result() as $row) {

								$departmen = $row->departemen_nama;

							}

						}

					}

				}

				// CARI CABANG

				$hasil1['val2'] = array();

				$where_cabang['data'][] = array(

					'column' => 'cabang_id',

					'param'	 => $val->cabang_id

				);

				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);

				if ($query_cabang) {

					foreach ($query_cabang->result() as $val2) {

						// CARI KOTA

						$hasil2['val2'] = array();

						$where_kota['data'][] = array(

							'column' => 'id',

							'param'	 => $val2->cabang_kota

						);

						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);

						if ($query_kota) {

							foreach ($query_kota->result() as $val3) {

								$hasil2['val3'][] = array(

									'id' 		=> $val3->id,

									'text' 		=> $val3->name,

								);

							}

						}

						// END CARI KOTA

						$hasil1['val2'][] = array(

							'id' 	=> $val2->cabang_id,

							'text' 	=> $val2->cabang_nama,

							'alamat'=> $val2->cabang_alamat,

							'kota'	=> $hasil2,

							'telp'  => json_decode($val2->cabang_telepon)

						);

					}

				}

				// END CARI CABANG

				$response['val'][] = array(

					'tanggal_bkb' 			=> date("d/m/Y", strtotime($val->kartu_stok_tanggal)),

					'referensi_bkb'			=> $val->kartu_stok_referensi,

					'departemen' 			=> $departmen,

					'cabang'				=> $hasil1,

					'barang_kode' 			=> $val->barang_kode,

					'barang_nama' 			=> $val->barang_nama,

					'qty' 					=> $val->kartu_stok_keluar,

					'satuan_nama' 			=> $val->satuan_nama,

					'keterangan' 			=> $val->kartu_stok_keterangan,

				);

			}

		}

		// echo json_encode($response);

		$this->pdf->set_paper('A4', 'landscape');

		$this->pdf->load_view('print/P_lhkb', $response);

		$this->pdf->render();

		$this->pdf->stream($name,array("Attachment"=>false));

	}



	public function loadDatalhkb(){

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

			'column' => 'kartu_stok_keluar >',

			'param'	 => 0

		);

		$where['data'][] = array(

			'column' => 'kartu_stok_tanggal <=',

			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->get('to_tanggal')))

		);

		$where['data'][] = array(

			'column' => 'kartu_stok_tanggal >=',

			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->get('from_tanggal')))

		);

		//WHERE LIKE

		$where_like['data'][] = array(

			'column' => 'kartu_stok_tanggal, kartu_stok_referensi, kartu_stok_keluar',

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

			foreach ($query->result() as $val) {

				$departmen = '';

				if($val->kartu_stok_referensi != '')

				{

					if(strpos($val->kartu_stok_referensi, 'BKB') !== false)

					{

						$selectDepartmen = 'departemen_nama';

						$whereDepartmen['data'][] = array(

							'column' =>  'keluar_barang_nomor',

							'param'  =>	 $val->kartu_stok_referensi

						);

						$queryDepartmen = $this->mod->select($selectDepartmen, 'v_bkb', NULL, $whereDepartmen, NULL, NULL, NULL);

						if($queryDepartmen)

						{

							foreach ($queryDepartmen->result() as $row) {

								$departmen = $row->departemen_nama;

							}

						}

					}

				}

				$response['data'][] = array(

					$no,

					date("d/m/Y", strtotime($val->kartu_stok_tanggal)),

					$val->kartu_stok_referensi,

					$departmen,

					$val->barang_kode,

					$val->barang_nama,

					$val->kartu_stok_keluar,

					$val->satuan_nama,

					$val->kartu_stok_keterangan,

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

	// end LAPORAN HARIAN KELUAR BARANG

	// --------------------------------------------------



	// --------------------------------------------------

	// LAPORAN SPP BELUM REALISASI

	public function spp_belum_realisasi(){

		$this->check_session();

		$priv = $this->cekUser(62);

		$data = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Laporan',

			'title_page2' 	=> 'Laporan SPP Belum Realisasi',

			'priv_add'		=> $priv['create']

			);

		if($priv['read'] == 1)

		{

			$this->open_page('laporan/V_laporan_spp_belum_realisasi', $data);

		}

		else

		{

			$this->load->view('layout/V_404', $data);

		}

	}



	public function loadDataspp_belum_realisasi(){

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

			'column' => 'permintaan_pembelian_tanggal <=',

			'param'	 => date ("Y-m-d H:i:s",strtotime($this->input->get('to_tanggal')))

		);

		$where['data'][] = array(

			'column' => 'permintaan_pembelian_tanggal >=',

			'param'	 => date ("Y-m-d H:i:s",strtotime($this->input->get('from_tanggal')))

		);

		//WHERE LIKE

		$where_like['data'][] = array(

			'column' => 'permintaan_pembelian_nomor, permintaan_pembelian_tanggal, barang_kode, barang_nama, permintaan_pembelian_qty, satuan_nama, permintaan_pembelian_alasan',

			'param'	 => $this->input->get('search[value]')

		);

		//ORDER

		$index_order = $this->input->get('order[0][column]');

		$order['data'][] = array(

			'column' => $this->input->get('columns['.$index_order.'][name]'),

			'type'	 => $this->input->get('order[0][dir]')

		);



		$query_total = $this->mod->select($select, 'v_laporan_spp_belum_realisasi');

		$query_filter = $this->mod->select($select, 'v_laporan_spp_belum_realisasi', NULL, $where, NULL, $where_like, $order);

		$query = $this->mod->select($select, 'v_laporan_spp_belum_realisasi', NULL, $where, NULL, $where_like, $order, $limit);



		$response['data'] = array();

		if ($query<>false) {

			$no = $limit['start']+1;

			foreach ($query->result() as $val) {

				$response['data'][] = array(

					$no,

					$val->permintaan_pembelian_nomor,

					date("d/m/Y", strtotime($val->permintaan_pembelian_tanggal)),

					$val->barang_kode,

					$val->barang_nama,

					$val->permintaan_pembelian_qty,

					$val->satuan_nama,

					$val->permintaan_pembelian_alasan,

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



	public function cetakPDFspp_belum_realisasi($cabang, $gudang, $bulanawal, $tanggalawal, $tahunawal, $bulanakhir, $tanggalakhir, $tahunakhir){

		$this->load->library('pdf');

		$awal = $tanggalawal.'-'.$bulanawal.'-'.$tahunawal;

		$akhir =$tanggalakhir.'-'.$bulanakhir.'-'.$tahunakhir;

		$name = 'SPP Belum Realisasi '.date('d-m-Y', strtotime($awal)).' - '.date('d-m-Y', strtotime($akhir)).'';

		$select = '*';

		$where['data'][] = array(

			'column' => 'cabang_id',

			'param'	 => $cabang

		);

		$where['data'][] = array(

			'column' => 'gudang_id',

			'param'	 => $gudang

		);

		$where['data'][] = array(

			'column' => 'permintaan_pembelian_tanggal >=',

			'param'	 => date ("Y-m-d H:i:s", strtotime($awal))

		);

		$where['data'][] = array(

			'column' => 'permintaan_pembelian_tanggal <=',

			'param'	 => date ("Y-m-d H:i:s", strtotime($akhir))

		);

		$query = $this->mod->select($select, 'v_laporan_spp_belum_realisasi', NULL, $where);

		$response['val'] = array();

		if ($query<>false) {

			$no = 1;

			foreach ($query->result() as $val) {

				$response['data'][] = array(

					'no'							=> $no,

					'permintaan_pembelian_nomor'	=> $val->permintaan_pembelian_nomor,

					'permintaan_pembelian_tanggal'	=> date("d/m/Y", strtotime($val->permintaan_pembelian_tanggal)),

					'barang_kode'					=> $val->barang_kode,

					'barang_nama'					=> $val->barang_nama,

					'permintaan_pembelian_qty'		=> $val->permintaan_pembelian_qty,

					'satuan_nama'					=> $val->satuan_nama,

					'permintaan_pembelian_alasan'	=> $val->permintaan_pembelian_alasan,

				);

				$no++;

			}

		}

		$response['from_tanggal'] = date('d-m-Y', strtotime($awal));

		$response['to_tanggal'] = date('d-m-Y', strtotime($akhir));

		$response['title'][] = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'Laporan',

			'title_page2' 	=> 'Laporan SPP Belum Realisasi',

		);

				

		// CARI CABANG

		$hasil1['val2'] = array();

		$where_cabang['data'][] = array(

			'column' => 'cabang_id',

			'param'	 => $cabang

		);

		$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);

		if ($query_cabang) {

			foreach ($query_cabang->result() as $val2) {

				// CARI KOTA

				$hasil2['val2'] = array();

				$where_kota['data'][] = array(

					'column' => 'id',

					'param'	 => $val2->cabang_kota

				);

				$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);

				if ($query_kota) {

					foreach ($query_kota->result() as $val3) {

						$hasil2['val3'][] = array(

							'id' 		=> $val3->id,

							'text' 		=> $val3->name,

						);

					}

				}

				// END CARI KOTA

				$hasil1['val2'][] = array(

					'id' 	=> $val2->cabang_id,

					'text' 	=> $val2->cabang_nama,

					'alamat'=> $val2->cabang_alamat,

					'kota'	=> $hasil2,

					'telp'  => json_decode($val2->cabang_telepon)

				);

			}

		}

		$response['val'][] = array(

			'cabang'				=> $hasil1,

		);

		// END CARI CABANG

		// echo json_encode($response);

		// $this->pdf->set_paper('A4', 'landscape');

		$this->pdf->load_view('print/P_spp_belum_realisasi', $response);

		$this->pdf->render();

		$this->pdf->stream($name,array("Attachment"=>false));

		// $this->load->view('print/P_spp_belum_realisasi', $response);

	}

	// end LAPORAN SPP BELUM REALISASI

	// --------------------------------------------------



	public function loadDataKartuStokMasuk(){

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

			'column' => 'kartu_stok_masuk >',

			'param'	 => 0

		);

		$where['data'][] = array(

			'column' => 'kartu_stok_tanggal <=',

			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->get('to_tanggal')))

		);

		$where['data'][] = array(

			'column' => 'kartu_stok_tanggal >=',

			'param'	 => date ("Y/m/d H:i:s",strtotime($this->input->get('from_tanggal')))

		);

		//WHERE LIKE

		$where_like['data'][] = array(

			'column' => 'kartu_stok_tanggal, kartu_stok_referensi, kartu_stok_masuk',

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

			foreach ($query->result() as $val) {

				$departmen = '';

				if($val->kartu_stok_referensi != '')

				{

					if(strpos($val->kartu_stok_referensi, 'BKB') !== false)

					{

						$selectDepartmen = 'departemen_nama';

						$whereDepartmen['data'][] = array(

							'column' =>  'keluar_barang_nomor',

							'param'  =>	 $val->kartu_stok_referensi

						);

						$queryDepartmen = $this->mod->select($selectDepartmen, 'v_bkb', NULL, $whereDepartmen, NULL, NULL, NULL);

						if($queryDepartmen)

						{

							$departmen = $queryDepartmen->row_array();

						}

					}

				}

				$response['data'][] = array(

					$no,

					date("d/m/Y", strtotime($val->kartu_stok_tanggal)),

					$val->kartu_stok_referensi,

					$departmen['departemen_nama'],

					$val->barang_kode,

					$val->barang_nama,

					$val->kartu_stok_masuk,

					$val->satuan_nama,

					$val->kartu_stok_keterangan,

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

}

