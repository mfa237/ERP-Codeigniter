<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user_privilege extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 's_privilege';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(27);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'User Privilege',
			'title_page2' 	=> 'Setting User Privilege',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('user-privilege/V_user_privilege', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'type_karyawan_nama,type_karyawan_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'm_type_karyawan');
		$query_filter = $this->mod->select($select, 'm_type_karyawan', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'm_type_karyawan', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				if ($val->type_karyawan_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
				}
				$button = '<a href="'.base_url().'Setting/Edit-User-Privilege/'.$val->type_karyawan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Edit User Privilege">
						<i class="icon-pencil text-center"></i>
					</button>
					</a>';
				$response['data'][] = array(
					$no,
					$val->type_karyawan_nama,
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

	public function getForm($id){
		$this->check_session();
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'User Privilege',
			'title_page2' 	=> 'Edit User Privilege',
			);
		$selectParent = '*';
		$where['data'][] = array(
			'column' => 'menu_type',
			'param'	 => 0
		);
		$queryParent = $this->mod->select($selectParent, 's_menu', NULL, $where);
		if ($queryParent<>false) {
			foreach ($queryParent->result() as $val) {
				$data['parent'][] = array(
					'menu_nama' 		=> $val->menu_nama,
					'menu_id' 			=> $val->menu_id,
				);
			}
			// echo json_encode($data);
		}
		$selectSub = '*';
		$whereSub['data'][] = array(
			'column' => 'menu_type',
			'param'	 => 1
		);
		$querySub = $this->mod->select($selectSub, 's_menu', NULL, $whereSub);
		if($querySub<>false)
		{
			foreach ($querySub->result() as $val2) {
				$data['subMenu'][] = array(
					'menu_nama' 		=> $val2->menu_nama,
					'menu_id' 			=> $val2->menu_id,
					'menu_parent' 		=> $val2->menu_parent,
				);	
			}
		}
		
		$data['tipeKaryawan'] = $id;
		// echo json_encode($data);
		$this->open_page("user-privilege/V_form_user_privilege", $data);
	}

	public function loadDataWhere(){
		$id = $this->input->get("tipe");
		$selectPrivilege = '*';
		$wherePrivilege['data'][] = array(
			'column' => 'm_type_karyawan_id',
			'param'	 => $id
		);
		$queryPrivilege = $this->mod->select($selectPrivilege, $this->tbl, NULL, $wherePrivilege);
		if($queryPrivilege<>false)
		{
			foreach ($queryPrivilege->result() as $val3) {
				$data['val'][] = array(
					'menu_id' 		=> $val3->menu_id,
					'create' 		=> $val3->create,
					'read' 			=> $val3->read,
					'update' 		=> $val3->update,
					'delete' 		=> $val3->delete,
				);	
			}
		}
		echo json_encode($data);
	}

	// Function Insert & Update
	public function postData(){
		$id = $this->input->post('valPost');
		if ($id>0) {
			$idmenu = $this->input->post("id");
			//UPDATE
			$data = $this->general_post_data(2, $idmenu);
			$where['data'][] = array(
				'column' => 'm_type_karyawan_id',
				'param'	 => $this->input->post("tipe_karyawan")
			);
			$where['data'][] = array(
				'column' => 'menu_id',
				'param'	 => $idmenu
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			$selectPrivilege = '*';
			$wherePrivilege['data'][] = array(
				'column' => 'menu_id',
				'param'	 => $idmenu
			);
			// $wherePrivilege['data'][] = array(
			// 	'column' => 'm_type_karyawan_id',
			// 	'param'	 => $this->input->post("tipe_karyawan")
			// );
			$queryPrivilege = $this->mod->select($selectPrivilege, 's_menu', NULL, $wherePrivilege);
			if($queryPrivilege)
			{
				$menu = $queryPrivilege->row_array();
				$menuParent = $menu['menu_parent'];

				$select = 'a.*, b.*';
				$whereData['data'][] = array(
					'column' => 'b.menu_parent',
					'param'  => $menuParent
				);
				$whereData['data'][] = array(
					'column' => 'a.m_type_karyawan_id',
					'param'  => $this->input->post("tipe_karyawan")
				);
				$joinData['data'][] = array(
					'table' => 's_menu b',
					'join'	=> 'b.menu_id = a.menu_id',
					'type'	=> 'left'
				);
				$queryData = $this->mod->select($select, 's_privilege a', $joinData, $whereData);
				if($queryData)
				{
					$data = array();
					// $response['query'] = $queryData->result();
					foreach ($queryData->result() as $dataRead) {
						array_push($data, $dataRead->read);
					}
					// $response['cek'] = in_array('1', $data);
					// $response['data'] = $data;
					if((in_array('1', $data)) || ($this->input->post('lihat', TRUE) == 1))
					{
						$dataParent = $this->general_post_data(3, $menuParent);
						$whereParent['data'][] = array(
							'column' => 'm_type_karyawan_id',
							'param'	 => $this->input->post("tipe_karyawan")
						);
						$whereParent['data'][] = array(
							'column' => 'menu_id',
							'param'	 => $menuParent
						);
						$updateParent = $this->mod->update_data_table($this->tbl, $whereParent, $dataParent);
					}
					else
					{
						$dataParent = $this->general_post_data(4, $menuParent);
						$whereParent['data'][] = array(
							'column' => 'm_type_karyawan_id',
							'param'	 => $this->input->post("tipe_karyawan")
						);
						$whereParent['data'][] = array(
							'column' => 'menu_id',
							'param'	 => $menuParent
						);
						$updateParent = $this->mod->update_data_table($this->tbl, $whereParent, $dataParent);
					}
				}
				
			}
			if(($update->status) && ($updateParent->status)) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		} else {
			//INSERT
			// ambil menu_parent
			$idmenu = $this->input->post('id');
			$selectPrivilege = '*';
			$wherePrivilege['data'][] = array(
				'column' => 'menu_id',
				'param'	 => $idmenu
			);
			$queryPrivilege = $this->mod->select($selectPrivilege, 's_menu', NULL, $wherePrivilege);
			if($queryPrivilege)
			{
				$menu = $queryPrivilege->row_array();
				$menuParent = $menu['menu_parent'];
				// lihat menu_parent ada atau tidak
				$selectParent = '*';
				$whereParent['data'][] = array(
					'column' => 'menu_id',
					'param'	 => $menuParent
				);
				$whereParent['data'][] = array(
					'column' => 'm_type_karyawan_id',
					'param'	 => $this->input->post("tipe_karyawan")
				);
				$queryParent = $this->mod->select($selectParent, $this->tbl, NULL, $whereParent);
				if($queryParent)
				{
					$response['update'] = 'masuk';
					// ada, data diupdate
					$dataParent = $this->general_post_data(3, $menuParent);
					$where['data'][] = array(
						'column' => 'm_type_karyawan_id',
						'param'	 => $this->input->post("tipe_karyawan")
					);
					$where['data'][] = array(
						'column' => 'menu_id',
						'param'	 => $menuParent
					);
					$updateParent = $this->mod->update_data_table($this->tbl, $where, $dataParent);
				}
				else
				{
					$response['insert'] = 'masuk';
					$dataParent = $this->general_post_data(3, $menuParent);
					$insertParent = $this->mod->insert_data_table($this->tbl, NULL, $dataParent);
				}
				$response['parent'] = $menuParent;
			}
			$data = $this->general_post_data(1, $idmenu);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		}
		
		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $menuId){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if ($type == 1) {
			$data = array(
				'menu_id' 				=> $menuId,
				'm_type_karyawan_id' 	=> $this->input->post('tipe_karyawan', TRUE),
				'create' 				=> $this->input->post('tambah', TRUE),
				'update' 				=> $this->input->post('edit', TRUE),
				'read' 					=> $this->input->post('lihat', TRUE),
				'delete' 				=> $this->input->post('hapus', TRUE)
			);
		} else if ($type == 2) {
			$data = array(
				'create' 				=> $this->input->post('tambah', TRUE),
				'update' 				=> $this->input->post('edit', TRUE),
				'read' 					=> $this->input->post('lihat', TRUE),
				'delete' 				=> $this->input->post('hapus', TRUE)
			);
		} else if ($type == 3) {
			$data = array(
				'menu_id' 				=> $menuId,
				'm_type_karyawan_id' 	=> $this->input->post('tipe_karyawan', TRUE),
				'create' 				=> 1,
				'update' 				=> 1,
				'read' 					=> 1,
				'delete' 				=> 1
			);
		} else if ($type == 4) {
			$data = array(
				'create' 				=> 0,
				'update' 				=> 0,
				'read' 					=> 0,
				'delete' 				=> 0
			);
		}

		return $data;
	}
			/* end Function */

}
