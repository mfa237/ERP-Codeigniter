<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_bank extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_bank';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(3);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Master Data',
			'title_page2' 	=> 'Bank',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('bank/V_bank', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(3);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, bank_cabang, bank_nama, bank_no_rek, bank_atas_nama, bank_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_bank');
		$query_filter = $this->mod->select($select, 'v_bank', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_bank', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->bank_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormBank('.$val->bank_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->bank_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}

				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormBank('.$val->bank_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->bank_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}

				}
				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->bank_cabang,
					$val->bank_nama,
					$val->bank_atas_nama,
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

		echo json_encode($response);
	}

	public function getForm(){
		$this->load->view("bank/V_form_bank");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'bank_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$hasil['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				foreach ($query_cabang->result() as $val2) {
					$hasil['val2'][] = array(
						'id' 	=> $val2->cabang_id,
						'text' 	=> $val2->cabang_nama
					);
				}
				$response['val'][] = array(
					'kode' 					=> $val->bank_id,
					'm_cabang_id' 			=> $hasil,
					'bank_cabang' 			=> $val->bank_cabang,
					'bank_nama' 			=> $val->bank_nama,
					'bank_atas_nama' 		=> $val->bank_atas_nama,
					'bank_no_rek' 			=> $val->bank_no_rek,
					'bank_status_aktif' 	=> $val->bank_status_aktif
				);
			}

			echo json_encode($response);
		}
	}

	public function loadData_select(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'm_cabang_id',
			'param'	 => $this->input->get('id')
		);
		$where['data'][] = array(
			'column' => 'bank_status_aktif',
			'param'	 => 'y'
		);
		// $where_like['data'][] = array(
		// 	'column' => 'bank_nama',
		// 	'param'	 => $this->input->get('q')
		// );
		// $order['data'][] = array(
		// 	'column' => 'bank_nama',
		// 	'type'	 => 'ASC'
		// );
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->bank_id,
					'text'	=> $val->bank_nama.' ('.$val->bank_atas_nama.' - '.$val->bank_no_rek.')',
					'bank_nama' 			=> $val->bank_nama,
					'bank_atas_nama' 		=> $val->bank_atas_nama,
					'bank_no_rek' 			=> $val->bank_no_rek,
				);
			}
			// $response['status'] = '200';
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
				'column' => 'bank_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($update->status) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
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
			'column' => 'bank_id',
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

	public function aktifData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(4, $id);
		$where['data'][] = array(
			'column' => 'bank_id',
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
			'column' => 'bank_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('bank_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['bank_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'm_cabang_id' 			=> $this->input->post('m_cabang_id', TRUE),
				'bank_cabang' 			=> $this->input->post('bank_cabang', TRUE),
				'bank_nama' 			=> $this->input->post('bank_nama', TRUE),
				'bank_atas_nama' 		=> $this->input->post('bank_atas_nama', TRUE),
				'bank_no_rek' 			=> $this->input->post('bank_no_rek', TRUE),
				'bank_status_aktif' 	=> $this->input->post('bank_status_aktif', TRUE),
				'bank_created_date' 	=> date('Y-m-d H:i:s'),
				'bank_update_date' 		=> date('Y-m-d H:i:s'),
				'bank_created_by' 		=> $this->session->userdata('user_username'),
				'bank_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'm_cabang_id' 			=> $this->input->post('m_cabang_id', TRUE),
				'bank_cabang' 			=> $this->input->post('bank_cabang', TRUE),
				'bank_nama' 			=> $this->input->post('bank_nama', TRUE),
				'bank_atas_nama' 		=> $this->input->post('bank_atas_nama', TRUE),
				'bank_no_rek' 			=> $this->input->post('bank_no_rek', TRUE),
				'bank_status_aktif' 	=> $this->input->post('bank_status_aktif', TRUE),
				'bank_update_date' 		=> date('Y-m-d H:i:s'),
				'bank_update_by' 		=> $this->session->userdata('user_username'),
				'bank_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'bank_status_aktif' 	=> 'n',
				'bank_update_date' 		=> date('Y-m-d H:i:s'),
				'bank_update_by' 		=> $this->session->userdata('user_username'),
				'bank_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'bank_status_aktif' 	=> 'y',
				'bank_update_date' 		=> date('Y-m-d H:i:s'),
				'bank_update_by' 		=> $this->session->userdata('user_username'),
				'bank_revised' 			=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

}
