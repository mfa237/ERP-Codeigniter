<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_promo extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_promo';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(77);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Promo',
			'title_page2' 	=> 'Master Promo',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('promo/V_promo_list', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(77);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'promo_nama,promo_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, $this->tbl);
		$query_filter = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, $this->tbl, NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->promo_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormPromo('.$val->promo_id.')" title="Edit">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->promo_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
						</button>';
					}

				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormPromo('.$val->promo_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->promo_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
				}
				$response['data'][] = array(
					$no,
					$val->promo_nama,
					date("d-m-Y", strtotime($val->promo_datestart)),
					date("d-m-Y", strtotime($val->promo_dateend)),
					$status,
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
		echo json_encode($response);
	}

	public function getForm(){
		$data = array(
			'action' => "Master-Data/Master-Promo/postData",
		);
		$this->load->view("promo/V_form_promo", $data);
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
			'column' => 'promo_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'promo_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'promo_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->promo_id,
					'text'	=> $val->promo_nama
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	// Function Insert & Update
	public function postData(){
		$id = $this->input->post('kode');
		if (strlen($id)>0) {
			//UPDATE
			$data = $this->general_post_data(2, $id);
			$where['data'][] = array(
				'column' => 'promo_id',
				'param'	 => $id
			);
			// var_dump($this->input->post('daterange'));
			// var_dump($data);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			$itemgetpromo			= $this->input->post('itemgetpromo');
			$itemqtygetpromo	= $this->input->post('itemqtygetpromo');
			if($update->status){
				$wheredatadet['data'][] = array(
					'column' => 'promo',
					'param'	 => $id
				);

				$deletedetail = $this->mod->delete_data_table('m_promodetail', $wheredatadet);
				if ($deletedetail) {
					foreach ($itemgetpromo as $row => $value) {
						$datadetail = array(
							'promo' 				=> $id,
							'promo_item_id' => $value,
							'promo_item_qty'=> $itemqtygetpromo[$row]
						);
						$insertdetail = $this->mod->insert_data_table('m_promodetail', NULL, $datadetail);
					}
				}
			}
			if($data['promo_status_aktif'] == 'n')
			{
				$updateKaryawan = $this->nonaktif_karyawan($id);
				if($update->status) {
						$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}
			} else {
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
			$id = $this->db->insert_id();
			$itemgetpromo			= $this->input->post('itemgetpromo');
			$itemqtygetpromo	= $this->input->post('itemqtygetpromo');
			// var_dump($itemgetpromo);
			if($insert->status){

				// $row = 0;
				foreach ($itemgetpromo as $row => $value) {
					$datadetail = array(
						'promo' 				=> $id,
						'promo_item_id' => $value,
						'promo_item_qty'=> $itemqtygetpromo[$row]
					);
					$insertdetail = $this->mod->insert_data_table('m_promodetail', NULL, $datadetail);
					// $row++;
				}
			}

			if($insert->status) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		}

		echo json_encode($response);
	}

	// Function Delete
	public function deleteData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(3, $id);
		$where['data'][] = array(
			'column' => 'promo_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		// $updateKaryawan = $this->nonaktif_karyawan($id);
		if($update->status) {
			$response['status'] = '200';
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}
	public function aktifData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(4, $id);
		$where['data'][] = array(
			'column' => 'promo_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		if($update->status) {
			$response['status'] = '200';
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'promo_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('promo_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['promo_revised'] + 1;
		}

		$daterange = $this->input->post('daterange', TRUE);
		$daterange 	 = str_replace(" ","", $daterange);
		$tanggal 	 = explode("-", $daterange);
		$tanggal1  = $tanggal[0];
		$tanggal2  = $tanggal[1];
		$tanggal1 = explode("/", $tanggal1);
		$tanggal1 =  $tanggal1[2]."-".$tanggal1[1]."-".$tanggal1[0];
		$tanggal2 = explode("/", $tanggal2);
		$tanggal2 =  $tanggal2[2]."-".$tanggal2[1]."-".$tanggal2[0];

		// $tanggal1 = date("Y-m-d", strtotime($tanggal1));
		// $tanggal2 = date("Y-m-d", strtotime($tanggal2));

		if ($type == 1) {
			$data = array(
				'promo_nama' 					=> $this->input->post('promo_nama', TRUE),
				'promo_status_aktif' 	=> $this->input->post('promo_status_aktif', TRUE),
				'promo_datestart'			=> $tanggal1,
				'promo_dateend'				=> $tanggal2,
				'promo_create_date' 	=> date('Y-m-d H:m:s'),
				'promo_update_date' 	=> date('Y-m-d H:m:s'),
				'promo_create_by' 		=> $this->session->userdata('user_username'),
				'promo_revised' 			=> 0,
				'promo_harga'					=> $this->input->post('promo_harga')
			);
		} else if ($type == 2) {
			$data = array(
				'promo_nama' 					=> $this->input->post('promo_nama', TRUE),
				'promo_status_aktif' 	=> $this->input->post('promo_status_aktif', TRUE),
				'promo_datestart'			=> $tanggal1,
				'promo_dateend'				=> $tanggal2,
				'promo_update_date' 	=> date('Y-m-d H:i:s'),
				'promo_update_by' 		=> $this->session->userdata('user_username'),
				'promo_revised' 			=> $rev,
				'promo_harga'					=> $this->input->post('promo_harga')
			);
		} else if ($type == 3) {
			$data = array(
				'promo_status_aktif' 	=> 'n',
				'promo_update_date' 	=> date('Y-m-d H:i:s'),
				'promo_update_by' 		=> $this->session->userdata('user_username'),
				'promo_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'promo_status_aktif' 	=> 'y',
				'promo_update_date' 	=> date('Y-m-d H:i:s'),
				'promo_update_by' 		=> $this->session->userdata('user_username'),
				'promo_revised' 		=> $rev,
			);
		}

		return $data;
	}

	/* end Function */
	function loadData_selectbarang(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$table = "m_barang";
		$select = '*';
		$where = NULL;
		// $where['data'][] = array(
		// 	'column' => 'promo_status_aktif',
		// 	'param'	 => 'y'
		// );
		$where_like['data'][] = array(
			'column' => 'barang_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'barang_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $table, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->barang_id,
					'text'	=> $val->barang_nama
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	function getBarang(){
		$item_id = $this->input->post('itemid');
		$table = "m_barang";
		$select = '*';
		$where = NULL;
		$where['data'][] = array(
			'column' => 'barang_id',
			'param'	 => $item_id
		);
		$query = $this->mod->select($select, $table, NULL, $where);
		$row = $query->row();
		$data['itemdetail'] = array(
			'barang_kode' 	=> $row->barang_kode ? $row->barang_kode : 0,
			'barang_nomor' 	=> $row->barang_nomor ? $row->barang_nomor : 0,
			'barang_nama'		=> $row->barang_nama ? $row->barang_nama : 0,
			'harga_beli'		=> $row->harga_beli ? $row->harga_beli : 0,
			'harga_jual'		=> $row->harga_jual ? $row->harga_jual : 0,
			'harga_jual_pajak'	=> $row->harga_jual_pajak
		);

		echo json_encode($data);
	}

	function loadDataWhere(){
		$select = "a.*";
		$id = $this->input->post('id');
		$table = "m_promo a";
		$where['data'][] = array(
			'column' => 'a.promo_id',
			'param'	 => $id
		);


		$order['data'][] = array(
			'column' => 'promo_nama',
			'type'	 => 'ASC'
		);

		$data = array();
		$query = $this->mod->select($select, $table, NULL, $where);
		if ($query) {
			foreach ($query->result() as $key => $value) {
				$tanggal1  = date("d/m/Y", strtotime($value->promo_datestart));
				$tanggal2  = date("d/m/Y", strtotime($value->promo_dateend));
				$promo_date = $tanggal1." - ".$tanggal2;
				$data['datapromo'] = array(
					'promo_id' 							=> $value->promo_id,
					'promo_nama' 						=> $value->promo_nama,
					'promo_harga' 					=> $value->promo_harga,
					'promo_status_aktif' 		=> $value->promo_status_aktif,
					'promo_datestart' 			=> $value->promo_datestart,
					'promo_dateend' 				=> $value->promo_dateend,
					'promo_date' 						=> $promo_date,
				);
			}

			$selectdetail = "a.*, b.*";
			$tablepromodetail = "m_promodetail a";
			$wheredetail['data'][] = array(
				'column' => 'a.promo',
				'param'	 => $id
			);

			$joinpromo['data'][] = array(
	      'table' => 'm_barang b',
	      'join'  => 'b.barang_id = a.promo_item_id',
	      'type'  => 'left'
	    );

			$qpromodetail = $this->mod->select($selectdetail, $tablepromodetail, $joinpromo, $wheredetail);
			if ($qpromodetail) {
				foreach ($qpromodetail->result() as $keydetail => $valuedetail) {
					$data['datapromodetail'][] = array(
						'promo_item_id'    => $valuedetail->promo_item_id,
						'promo_item_qty'   => $valuedetail->promo_item_qty,
						'barang_nomor'		 => $valuedetail->barang_nomor,
						'barang_kode'		 	 => $valuedetail->barang_kode,
						'barang_nama' 	   => $valuedetail->barang_nama,
						'harga_jual_pajak' => $valuedetail->harga_jual_pajak,
					);
				}
			}
		}
		echo json_encode($data);
	}
}
