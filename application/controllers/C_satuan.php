<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_satuan extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_satuan';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(14);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Satuan',
			'title_page2' 	=> 'Master Satuan',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('satuan/V_satuan', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(14);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'satuan_nama, satuan_status_aktif',
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
				if ($val->satuan_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormSatuan('.$val->satuan_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->satuan_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
						</button>';
					}

				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormSatuan('.$val->satuan_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->satuan_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}

				}
				$response['data'][] = array(
					$no,
					$val->satuan_nama,
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
 		$this->load->view("satuan/V_form_satuan");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'satuan_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// // CARI JENIS GUDANG
				// $hasil1['val2'] = array();
				// $where_type['data'][] = array(
				// 	'column' => 'satuan_id',
				// 	'param'	 => $val->m_satuan_id
				// );
				// $query_type = $this->mod->select('*','m_jenis_gudang',NULL,$where_type);
				// foreach ($query_type->result() as $val2) {
				// 	$hasil1['val2'][] = array(
				// 		'id' 	=> $val2->jenis_gudang_id,
				// 		'text' 	=> $val2->jenis_gudang_nama
				// 	);
				// }
				// // END CARI JENIS GUDANG
				$response['val'][] = array(
					'kode' 							=> $val->satuan_id,
					'satuan_nama' 					=> $val->satuan_nama,
					'satuan_status_aktif' 			=> $val->satuan_status_aktif
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
			'column' => 'satuan_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'satuan_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'satuan_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->satuan_id,
					'text'	=> $val->satuan_nama
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
				'column' => 'satuan_id',
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
			'column' => 'satuan_id',
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
			'column' => 'satuan_id',
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
			'column' => 'satuan_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('satuan_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['satuan_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'satuan_nama' 				=> $this->input->post('satuan_nama', TRUE),
				'satuan_status_aktif' 		=> $this->input->post('satuan_status_aktif', TRUE),
				'satuan_create_date' 		=> date('Y-m-d H:i:s'),
				'satuan_update_date' 		=> date('Y-m-d H:i:s'),
				'satuan_create_by' 			=> $this->session->userdata('user_username'),
				'satuan_revised' 			=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'satuan_nama' 				=> $this->input->post('satuan_nama', TRUE),
				'satuan_status_aktif' 		=> $this->input->post('satuan_status_aktif', TRUE),
				'satuan_update_date' 		=> date('Y-m-d H:i:s'),
				'satuan_update_by' 			=> $this->session->userdata('user_username'),
				'satuan_revised' 			=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'satuan_status_aktif' 		=> 'n',
				'satuan_update_date' 		=> date('Y-m-d H:i:s'),
				'satuan_update_by' 			=> $this->session->userdata('user_username'),
				'satuan_revised' 			=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'satuan_status_aktif' 		=> 'y',
				'satuan_update_date' 		=> date('Y-m-d H:i:s'),
				'satuan_update_by' 			=> $this->session->userdata('user_username'),
				'satuan_revised' 			=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

}
