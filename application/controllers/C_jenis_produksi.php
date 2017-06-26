<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_jenis_produksi extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_jenis_produksi';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(58);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Jenis Produksi',
			'title_page2' 	=> 'Master Jenis Produksi',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('jenis-produksi/V_jenis_produksi', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(58);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'jenis_produksi_nama,jenis_produksi_status_aktif',
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
				if ($val->jenis_produksi_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormJenisProduksi('.$val->jenis_produksi_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->jenis_produksi_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormJenisProduksi('.$val->jenis_produksi_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->jenis_produksi_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				}
				$response['data'][] = array(
					$no,
					$val->jenis_produksi_nama,
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
		$this->load->view("jenis-produksi/V_form_jenis_produksi");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'jenis_produksi_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				if(@$where_det['data'])
				{
					unset($where_det['data']);
				}
				$where_det['data'][] = array(
					'column' => 'jenis_produksi_id',
					'param'	 => $val->jenis_produksi_id
				);
				$query_det = $this->mod->select('*','m_jenis_produksidet a', null, $where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						$response['val2'][] = array(
							'jenis_produksidet_id'			=> $val2->jenis_produksidet_id,
							'jenis_produksi_id'				=> $val2->jenis_produksi_id,
							'jenis_produksidet_parameter'	=> $val2->jenis_produksidet_parameter,
							'jenis_produksidet_operator'	=> $val2->jenis_produksidet_operator,
							'jenis_produksi_type'			=> $val2->jenis_produksi_type,
						);
					}
				}
				$response['val'][] = array(
					'kode' 							=> $val->jenis_produksi_id,
					'jenis_produksi_nama' 			=> $val->jenis_produksi_nama,
					'jenis_produksi_status_aktif' 	=> $val->jenis_produksi_status_aktif
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
			'column' => 'jenis_produksi_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'jenis_produksi_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'jenis_produksi_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->jenis_produksi_id,
					'text'	=> $val->jenis_produksi_nama
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
				'column' => 'jenis_produksi_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($update->status)
			{
				$response['status'] = '200';
				for($i = 0; $i < sizeof($this->input->post('jenis_produksidet_id', TRUE)); $i++)
				{
					$data_det = $this->general_post_data2(2, null, $i);
					if(@$where_det['data'])
					{
						unset($where_det['data']);
					}
					$where_det['data'][] = array(
						'column'	=> 'jenis_produksidet_id',
						'param'		=> $this->input->post('jenis_produksidet_id', TRUE)[$i]
					);
					$update_det = $this->mod->update_data_table('m_jenis_produksidet', $where_det, $data_det);
					if($update_det->status)
					{
						$response['status'] = '200';
					}
					else
					{
						$response['status'] = '204';
					}
				}
			}
			else
			{
				$response['status'] = '204';
			}
			// if($data['jenis_produksi_status_aktif'] == 'n')
			// {
			// 	if($update->status) {
			// 		if($updateKaryawan)
			// 		{
			// 			$response['status'] = '200';
			// 		}
			// 		else
			// 		{
			// 			$response['status'] = '204';
			// 		}
			// 	} else {
			// 		$response['status'] = '204';
			// 	}
			// } else {
			// 	if($update->status) {
			// 		$response['status'] = '200';
			// 	} else {
			// 		$response['status'] = '204';
			// 	}	
			// }
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
				for($i = 0; $i < sizeof($this->input->post('jenis_produksidet_parameter', TRUE)); $i++)
				{
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('m_jenis_produksidet', NULL, $data_det);
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

	// Function Delete
	public function deleteData(){
		$id = $this->input->post('id');
		$data = $this->general_post_data(3, $id);
		$where['data'][] = array(
			'column' => 'jenis_produksi_id',
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
			'column' => 'jenis_produksi_id',
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
			'column' => 'jenis_produksi_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('jenis_produksi_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['jenis_produksi_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				'jenis_produksi_nama' 			=> $this->input->post('jenis_produksi_nama', TRUE),
				'jenis_produksi_status_aktif' 	=> $this->input->post('jenis_produksi_status_aktif', TRUE),
				'jenis_produksi_created_date' 	=> date('Y-m-d H:i:s'),
				'jenis_produksi_update_date' 	=> date('Y-m-d H:i:s'),
				'jenis_produksi_created_by' 	=> $this->session->userdata('user_username'),
				'jenis_produksi_revised' 		=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				'jenis_produksi_nama' 			=> $this->input->post('jenis_produksi_nama', TRUE),
				'jenis_produksi_status_aktif' 	=> $this->input->post('jenis_produksi_status_aktif', TRUE),
				'jenis_produksi_update_date' 	=> date('Y-m-d H:i:s'),
				'jenis_produksi_update_by' 		=> $this->session->userdata('user_username'),
				'jenis_produksi_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'jenis_produksi_status_aktif' 	=> 'n',
				'jenis_produksi_update_date' 	=> date('Y-m-d H:i:s'),
				'jenis_produksi_update_by' 		=> $this->session->userdata('user_username'),
				'jenis_produksi_revised' 		=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'jenis_produksi_status_aktif' 	=> 'y',
				'jenis_produksi_update_date' 	=> date('Y-m-d H:i:s'),
				'jenis_produksi_update_by' 		=> $this->session->userdata('user_username'),
				'jenis_produksi_revised' 		=> $rev,
			);
		}

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		// if (@$where['data']) {
		// 	unset($where['data']);
		// }
		// $where['data'][] = array(
		// 	'column' => 'jenis_produksidet_revised',
		// 	'param'	 => $id
		// );
		// $queryRevised = $this->mod->select('sj_returdet_revised', 't_sj_returdet', NULL, $where);
		// if ($queryRevised) {
		// 	$revised = $queryRevised->row_array();
		// 	$rev = $revised['sj_returdet_revised'] + 1;
		// }
		if ($type == 1) {
			$data = array(
				'jenis_produksi_id' 			=> $idHdr,
				'jenis_produksi_type'			=> $this->input->post('jenis_produksi_type'.($seq+1), TRUE),
				'jenis_produksidet_parameter' 	=> $this->input->post('jenis_produksidet_parameter', TRUE)[$seq],
				'jenis_produksidet_operator'	=> $this->input->post('jenis_produksidet_operator', TRUE)[$seq],
			);
		} else if($type == 2) {
			$data = array(
				'jenis_produksi_type'			=> $this->input->post('jenis_produksi_type'.($seq+1), TRUE),
				'jenis_produksidet_parameter' 	=> $this->input->post('jenis_produksidet_parameter', TRUE)[$seq],
				'jenis_produksidet_operator'	=> $this->input->post('jenis_produksidet_operator', TRUE)[$seq],
			);
		}

		return $data;
	}
	/* end Function */

}
