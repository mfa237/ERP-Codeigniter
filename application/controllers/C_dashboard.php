<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class C_dashboard extends MY_Controller {

	private $any_error = array();



	public function __construct() {

        parent::__construct();

	}



	public function index(){

		$this->view();

	}



	public function view(){

		$this->check_session();

		$user_id = $this->session->userdata('user_id');

		$priv = $this->inputpengunjung();

		$priv_ = null;

		if ($priv) {

			// $priv_ = $priv->row(),

			$priv_ = $priv[0]->create;

		}



		$data = array(

			'aplikasi'					=> $this->app_name,

			'title_page' 				=> 'Dashboard',

			'title_page2' 			=> 'Dashboard ERP',

			'title' 						=> '',

			'inputpengunjung'		=> $priv_,

		);



		$this->open_page('dashboard/V_dashboard', $data);

	}



	function Aruskas(){

		// $reportrange = $this->input->post('reportrange');

		$strstart =	$this->input->post('strstart');

		$strend		=	$this->input->post('strend');



		$selectuser = "a.*, b.m_cabang_id, c.cabang_gudangdisplay";

		$tableuser 	= 's_user a';



		$joinuser['data'][] = array(

			'table' => 'm_karyawan b',

			'join'	=> 'b.karyawan_id = a.m_karyawan_id',

			'type'	=> 'left'

		);



		$joinuser['data'][] = array(

			'table' => 'm_cabang c',

			'join'	=> 'c.cabang_id = b.m_cabang_id',

			'type'	=> 'left'

		);



		$whereuser['data'][] = array(

			'column' => 'a.user_id',

			'param'	 => $this->session->userdata('user_id')

		);



		$where2 = "tb_penjualan.penjualan_date >= '$strstart' AND tb_penjualan.penjualan_date <= '$strend' ";





		$user = $this->mod->select($selectuser, $tableuser, $joinuser, $whereuser)->row();

		$cabang_id 	= $user->m_cabang_id;

		$selectaruskas = $this->mod->selectaruskas($cabang_id, $where2);



		$hari = date("d");

		$tahun = date("Y");



		$data = array();

		foreach ($selectaruskas->result() as $key => $value) {

			$tanggal = $tahun."-".$value->bulan_id."-".$hari;

			$data[] = array(

						'penjualan'			=> $value->penjualan_total,

						'pembelian' 		=> $value->order_total,

						'tanggal' 			=> $tanggal,

						'tanggalstart'	=> date("Y-m-d", strtotime($strstart)),

						'tanggalend'		=> date("Y-m-d", strtotime($strend)),

						'tanggaljual'		=> date("Y-m-d", strtotime($value->penjualan_date)),

						'tanggalbeli'		=> date("Y-m-d", strtotime($value->order_tanggal))

			);

		}

		// echo $this->db->last_query();

		echo json_encode($data);



	}



	public function loadDataSelectWhere(){

		$param = $this->input->get('q');



		$m_category_2_id = $this->input->get('parameter');

		$table = "m_barang a";



		if ($param!=NULL) {

			$param = $this->input->get('q');

		} else {

			$param = "";

		}



		$select = 'a.*';



		$where_like['data'][] = array(

			'column' => 'a.barang_nama',

			'param'	 => $this->input->get('q')

		);



		$order['data'][] = array(

			'column' => 'a.barang_nama',

			'type'	 => 'ASC'

		);



		$query = $this->mod->select($select, $table, null, null, null, $where_like, $order);



		$response['items'] = array();

		if ($query<>false) {

			foreach ($query->result() as $val) {

				$response['items'][] = array(

					'id'									=> $val->barang_id,

					'text'								=> $val->barang_nama,

				);

			}

			$response['status'] = '200';

		}



		echo json_encode($response);

	}



	function Grafikbarang(){

		$barang_id = $this->input->post('barang_id');

		$barang_id = explode(",", $barang_id);

		$where 		 = null;




		$select = "sum(barang_qty + item_getFromGudang) as total_barangqty, sum(barang_total) as total_barangprice, b.*";

		$table 	= "tb_penjualan_details a";

		$join['data'][] = array(

			'table' => 'm_barang b',

			'join' 	=> 'b.barang_id = a.barang',

			'type'	=> 'laft'

		 );



		 $data['barang'] = array();



		 $qbarang = $this->mod->selectbarang($barang_id);

		 $hari = date("d");

		 $tahun = date("Y");

		 foreach ($qbarang->result() as $key => $value) {



	 	 	$tanggal = $tahun."-".$value->bulan_id."-".$hari;

			$barang_qty = $value->barang_qty + $value->item_getFromGudang;

		 	$data['barang'][] = array(

				'barang_id'					=> $value->barang_id,

				'penjualan_date'		=> $tanggal,

				'total_barangqty' 	=> $barang_qty,

				'total_barangprice' => $value->barang_total,

				'barang_nama' 			=> $value->barang_nama,

				'barang_price' 			=> $value->harga_jual,

				'barang_pricepajak' => $value->harga_jual_pajak,

				'barang_beli'				=> $value->harga_beli

			);

		 }



		 $qbarangnama = $this->mod->selectbarangnama($barang_id);

		 $data['barang_nama'] = array();

		 foreach ($qbarangnama->result() as $key => $valuenama) {

			 $data['barang_nama'][] = array(

				 'barang_id'					=> $valuenama->barang_id,

				 'barang_nama' 			=> $valuenama->barang_nama,

			 );

		 }

		//  echo $this->db->last_query();

		 echo json_encode($data);





	}



	function getDataSummary(){



		$strstart = $this->input->post('strstart');

		$strend 	= $this->input->post('strend');



		$data = array();

		$data['jmlpengunjung'] = $this->mod->select_config_one("t_pengunjung", "SUM(pengunjung_total) AS jmlpengunjung", "pengunjung_date >= '$strstart' AND pengunjung_date <= '$strend'");

		$data['jmlpenjualan'] = $this->mod->select_config_one("tb_penjualan", "COUNT(penjualan_id) AS jmlpenjualan", "penjualan_date >= '$strstart' AND penjualan_date <= '$strend'");

		// echo $this->db->last_query();
		// die;
		$data['avgpenjualan'] = $this->mod->select_config_one("tb_penjualan", "AVG(penjualan_grand_total) AS avgpenjualan", "penjualan_date >= '$strstart' AND penjualan_date <= '$strend'");



		echo json_encode($data);

	}



	function saveintot_pengunjung(){

		$jmlpenjualan = $this->input->post('jmlpenjualan');

		$tanggal 	= date("Y-m-d");

		$where 		= "WHERE pengunjung_date = '$tanggal'";

		$checkpengunjung = $this->mod->select_config("t_pengunjung", $where)->num_rows();

		$type = 1;

		if($checkpengunjung>0){

			$type = 2;

		}



		$data = $this->general_post_data($type);

		if ($type == 1) {

			$where['data'] = null;

			$insert = $this->mod->insert_data_table("t_pengunjung", $where, $data);



			if($insert->status) {

				$response['status'] = '200';

			} else {

				$response['status'] = '204';

			}



		} elseif ($type == 2) {

			$where = array('pengunjung_date' => $tanggal);
			$update = $this->mod->update_config("t_pengunjung", $data, $where);

			echo $this->db->last_query();

			if($update->status) {

				$response['status'] = '200';

			} else {

				$response['status'] = '204';

			}



		}



		echo json_encode($response);



	}



	function general_post_data($type, $id = null){

		$where = '';



    $select = "a.*, b.m_cabang_id, c.cabang_gudangdisplay";

    $tableuser = 's_user a';



    $join['data'][] = array(

      'table' => 'm_karyawan b',

      'join'	=> 'b.karyawan_id = a.m_karyawan_id',

      'type'	=> 'left'

    );



    $join['data'][] = array(

      'table' => 'm_cabang c',

      'join'	=> 'c.cabang_id = b.m_cabang_id',

      'type'	=> 'left'

    );



    $where['data'][] = array(

      'column' => 'a.user_id',

      'param'	 => $this->session->userdata('user_id')

    );





    $user = $this->mod->select($select, $tableuser, $join, $where)->row();

    $cabang = $user->m_cabang_id;

		if ($type == 1) {

			$data = array(

				'm_cabang_id' 						=> $cabang,

				'm_user_id' 							=> $this->session->userdata('user_id'),

				'pengunjung_date' 				=> date("Y-m-d"),

				'pengunjung_total' 				=> $this->input->post('jmlpenjualan')

			);

		} else if ($type == 2) {

			$data = array(

				'pengunjung_total' 				=> $this->input->post('jmlpenjualan')

			);

		}

		return $data;

	}



}

