<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jenis_gudang extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_jenis_gudang';

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
			'title_page' 	=> 'Jenis Gudang',
			'title_page2' 	=> 'Master Jenis Gudang',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('jenis-gudang/V_jenis_gudang', $data);
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
			'column' => 'jenis_gudang_nama,jenis_gudang_status_aktif',
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
				if ($val->jenis_gudang_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormJenisGudang('.$val->jenis_gudang_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->jenis_gudang_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormJenisGudang('.$val->jenis_gudang_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->jenis_gudang_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				}
				$response['data'][] = array(
					$no,
					$val->jenis_gudang_nama,
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
		$this->load->view("jenis-gudang/V_form_jenis_gudang");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'jenis_gudang_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'kode' 							=> $val->jenis_gudang_id,
					'jenis_gudang_nama' 			=> $val->jenis_gudang_nama,
					'jenis_gudang_status_aktif' 	=> $val->jenis_gudang_status_aktif
				);
			}

			echo json_encode($response);
		}
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
			'column' => 'jenis_gudang_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'jenis_gudang_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'jenis_gudang_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->jenis_gudang_id,
					'text'	=> $val->jenis_gudang_nama
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
				'column' => 'jenis_gudang_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($data['jenis_gudang_status_aktif'] == 'n')
			{
				$updateGudang = $this->nonaktif_gudang($id);
				if($update->status) {
					if($updateGudang)
					{
						$response['status'] = '200';
					}
					else
					{
						$response['status'] = '204';
					}
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
			'column' => 'jenis_gudang_id',
			'param'	 => $id
		);
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		$updateGudang = $this->nonaktif_gudang($id);
		if($update->status) {
			if($updateGudang)
			{
				$response['status'] = '200';
			}
			else
			{
				$response['status'] = '204';
			}
		} else {
			$response['status'] = '204';
		}

		echo json_encode($response);
	}

	public function aktifData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(4, $id);
		$where['data'][] = array(
			'column' => 'jenis_gudang_id',
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
			'column' => 'jenis_gudang_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('jenis_gudang_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['jenis_gudang_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'jenis_gudang_nama' 			=> $this->input->post('jenis_gudang_nama', TRUE),
				'jenis_gudang_status_aktif' 	=> $this->input->post('jenis_gudang_status_aktif', TRUE),
				'jenis_gudang_create_date' 		=> date('Y-m-d H:i:s'),
				'jenis_gudang_update_date' 		=> date('Y-m-d H:i:s'),
				'jenis_gudang_create_by' 		=> $this->session->userdata('user_username'),
				'jenis_gudang_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'jenis_gudang_nama' 			=> $this->input->post('jenis_gudang_nama', TRUE),
				'jenis_gudang_status_aktif' 	=> $this->input->post('jenis_gudang_status_aktif', TRUE),
				'jenis_gudang_update_date' 		=> date('Y-m-d H:i:s'),
				'jenis_gudang_update_by' 		=> $this->session->userdata('user_username'),
				'jenis_gudang_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'jenis_gudang_status_aktif' 	=> 'n',
				'jenis_gudang_update_date' 		=> date('Y-m-d H:i:s'),
				'jenis_gudang_update_by' 		=> $this->session->userdata('user_username'),
				'jenis_gudang_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'jenis_gudang_status_aktif' 	=> 'y',
				'jenis_gudang_update_date' 		=> date('Y-m-d H:i:s'),
				'jenis_gudang_update_by' 		=> $this->session->userdata('user_username'),
				'jenis_gudang_revised' 			=> $rev,
			);
		}

		return $data;
	}

	function nonaktif_gudang($type_id)
	{
		$tblGudang= 'm_gudang';
		$where['data'][] = array(
			'column' => 'm_jenis_gudang_id',
			'param'	 => $type_id,
		);
		$queryRevised = $this->mod->select('gudang_revised', $tblGudang, NULL, $where);
		if($queryRevised)
		{
			$revised = $queryRevised->row_array();
			$rev = $revised['gudang_revised'] + 1;
			$dataGudang = array(
				'gudang_status_aktif' 		=> 'n',
				'gudang_update_date' 		=> date('Y-m-d H:i:s'),
				'gudang_update_by' 			=> $this->session->userdata('user_username'),
				'gudang_revised' 			=> $rev,
			);
			$updateGudang = $this->mod->update_data_table($tblGudang, $where, $dataGudang);
			if($updateGudang->status)
				return true;
			else
				return false;
		}
		else
			return true;
	}
	/* end Function */

}
