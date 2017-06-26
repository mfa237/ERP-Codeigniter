<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_sub_atribut_barang extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_sub_atribut_barang';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(11);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Sub Atribut Barang',
			'title_page2' 	=> 'Master Sub Atribut Barang',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('sub-atribut-barang/V_sub_atribut_barang', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData(){
		$priv = $this->cekUser(11);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'atribut_nama, sub_atribut_nama, sub_atribut_jenis, satuan_nama, sub_atribut_default_value, sub_atribut_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_sub_atribut');
		$query_filter = $this->mod->select($select, 'v_sub_atribut', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_sub_atribut', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->sub_atribut_jenis == '1') {
					$jenis = 'option';
				}
				elseif ($val->sub_atribut_jenis == '2') {
					$jenis = 'textarea';
				}
				else
				{
					$jenis = 'text';
				}
				if ($val->sub_atribut_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormSubAtributBarang('.$val->sub_atribut_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->sub_atribut_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormSubAtributBarang('.$val->sub_atribut_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->sub_atribut_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}
					
				}
				
				if ($val->sub_atribut_jenis == 1) {
					// SET TRUE IF WANT TO DECODE ALL TO ARRAY
					$array_value = json_decode($val->sub_atribut_default_value, TRUE);
					$hasil = array();
					for ($i = 0; $i < sizeof($array_value); $i++) { 
						array_push($hasil, $array_value[$i]['nama']);
					}
					$default_value = implode(', ', $hasil);
				} else {
					$default_value = $val->sub_atribut_default_value;
				}

				$response['data'][] = array(
					$no,
					$val->barang_nama,
					$val->atribut_nama,
					$val->sub_atribut_nama,
					$jenis,
					$val->satuan_nama,
					$default_value,
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
		$join['data'][] = array(
			'table' => 'm_barang a',
			'join'	=> 'b.m_barang_id = a.barang_id',
			'type'	=> 'left'
		);
		$query = $this->mod->select('distinct(a.barang_nama), a.barang_id', 'm_atribut_barang b', $join);
		$atribut['item'] = $query->result_array();
 		$this->load->view("sub-atribut-barang/V_form_sub_atribut_barang", $atribut);
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'sub_atribut_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, 'v_sub_atribut', NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI BARANG
				$hasil1['val2'] = array();
				$where_barang['data'][] = array(
					'column' => 'barang_id',
					'param'	 => $val->m_barang_id
				);
				$query_barang = $this->mod->select('*','m_barang',NULL,$where_barang);
				foreach ($query_barang->result() as $val2) {
					$hasil1['val2'][] = array(
						'id' 	=> $val2->barang_id,
						'text' 	=> $val2->barang_nama
					);
				}
				// END CARI BARANG
				// CARI ATRIBUT BARANG
				$hasil2['val2'] = array();
				$where_attribut_barang['data'][] = array(
					'column' => 'atribut_id',
					'param'	 => $val->m_atribut_id
				);
				$query_attribut_barang = $this->mod->select('*','m_atribut_barang',NULL,$where_attribut_barang);
				foreach ($query_attribut_barang->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->atribut_id,
						'text' 	=> $val2->atribut_nama
					);
				}
				// END CARI ATRIBUT BARANG
				// CARI ATRIBUT BARANG
				$hasil3['val2'] = array();
				$where_satuan['data'][] = array(
					'column' => 'satuan_id',
					'param'	 => $val->sub_atribut_satuan
				);
				$query_satuan = $this->mod->select('*','m_satuan',NULL,$where_satuan);
				foreach ($query_satuan->result() as $val2) {
					$hasil3['val2'][] = array(
						'id' 	=> $val2->satuan_id,
						'text' 	=> $val2->satuan_nama
					);
				}
				// END CARI ATRIBUT BARANG
				$response['val'][] = array(
					'kode' 								=> $val->sub_atribut_id,
					'm_barang_id' 						=> $hasil1,
					'm_atribut_id' 						=> $hasil2,
					'sub_atribut_nama' 					=> $val->sub_atribut_nama,
					'sub_atribut_jenis' 				=> $val->sub_atribut_jenis,
					'sub_atribut_satuan' 				=> $hasil3,
					'sub_atribut_default_value' 		=> $val->sub_atribut_default_value,
					'sub_atribut_status_aktif' 			=> $val->sub_atribut_status_aktif
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
		$where_like['data'][] = array(
			'column' => 'sub_atribut_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'sub_atribut_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, NULL, $where_like, NULL, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->sub_atribut_id,
					'text'	=> $val->sub_atribut_nama
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
				'column' => 'sub_atribut_id',
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
			'column' => 'sub_atribut_id',
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
			'column' => 'sub_atribut_id',
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

	public function loadAtribut(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'm_barang_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, 'm_atribut_barang', NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'atribut_id' 						=> $val->atribut_id,
					'atribut_nama' 						=> $val->atribut_nama
				);
			}

			echo json_encode($response);
		}
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'sub_atribut_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('sub_atribut_revised', $this->tbl, NULL, $where);
		if($queryRevised)
		{
			$revised = $queryRevised->row_array();
			$rev = $revised['sub_atribut_revised'] + 1;
		}
		if ($type == 1) {
			if($this->input->post('sub_atribut_jenis') == "1")
			{
				$value = array();
				for($i = 0; $i < $this->input->post('jml_itemOption', TRUE); $i++)
				{
					$id = $this->input->post('sub_atribut_default_value_id'.($i+1));
					$nama = $this->input->post('sub_atribut_default_value_nama'.($i+1));
					$temp = array("id"=>$id, "nama"=>$nama);
					array_push($value, $temp);
				}
				$defaultValue = json_encode($value);
			}
			else
			{
				$defaultValue = $this->input->post('sub_atribut_default_value', TRUE);
			}
			$data = array(
				'm_atribut_id' 						=> $this->input->post('m_atribut_id', TRUE),
				'sub_atribut_nama' 					=> $this->input->post('sub_atribut_nama', TRUE),
				'sub_atribut_jenis' 				=> $this->input->post('sub_atribut_jenis', TRUE),
				'sub_atribut_satuan' 				=> $this->input->post('sub_atribut_satuan', TRUE),
				'sub_atribut_default_value' 		=> $defaultValue,
				'sub_atribut_status_aktif' 			=> $this->input->post('sub_atribut_status_aktif', TRUE),
				'sub_atribut_create_date' 			=> date('Y-m-d H:i:s'),
				'sub_atribut_update_date' 			=> date('Y-m-d H:i:s'),
				'sub_atribut_create_by' 			=> $this->session->userdata('user_username'),
				'sub_atribut_revised' 				=> 0,
			);
		} else if ($type == 2) {
			if($this->input->post('sub_atribut_jenis') == "1")
			{
				$value = array();
				for($i = 0; $i < $this->input->post('jml_itemOption', TRUE); $i++)
				{
					$id = $this->input->post('sub_atribut_default_value_id'.($i+1));
					$nama = $this->input->post('sub_atribut_default_value_nama'.($i+1));
					$temp = array("id"=>$id, "nama"=>$nama);
					array_push($value, $temp);
				}
				$defaultValue = json_encode($value);
			}
			else
			{
				$defaultValue = $this->input->post('sub_atribut_default_value', TRUE);
			}
			$data = array(
				'm_atribut_id' 						=> $this->input->post('m_atribut_id', TRUE),
				'sub_atribut_nama' 					=> $this->input->post('sub_atribut_nama', TRUE),
				'sub_atribut_jenis' 				=> $this->input->post('sub_atribut_jenis', TRUE),
				'sub_atribut_satuan' 				=> $this->input->post('sub_atribut_satuan', TRUE),
				'sub_atribut_default_value' 		=> $defaultValue,
				'sub_atribut_status_aktif' 			=> $this->input->post('sub_atribut_status_aktif', TRUE),
				'sub_atribut_update_date' 			=> date('Y-m-d H:i:s'),
				'sub_atribut_update_by' 			=> $this->session->userdata('user_username'),
				'sub_atribut_revised' 				=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'sub_atribut_status_aktif' 			=> 'n',
				'sub_atribut_update_date' 			=> date('Y-m-d H:i:s'),
				'sub_atribut_update_by' 			=> $this->session->userdata('user_username'),
				'sub_atribut_revised' 				=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'sub_atribut_status_aktif' 			=> 'y',
				'sub_atribut_update_date' 			=> date('Y-m-d H:i:s'),
				'sub_atribut_update_by' 			=> $this->session->userdata('user_username'),
				'sub_atribut_revised' 				=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

}
