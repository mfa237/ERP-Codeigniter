<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_atribut_barang extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 'm_atribut_barang';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(10);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Atribut Barang',
			'title_page2' 	=> 'Master Atribut Barang',
			'priv_add'		=>	$priv['create'],
			);
		if($priv['read'] == 1)
		{
			$this->open_page('atribut-barang/V_atribut_barang', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}

	}

	public function loadData(){
		$priv = $this->cekUser(10);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'barang_nama, atribut_nama, atribut_jenis, satuan_nama, atribut_default_value, atribut_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_atribut');
		$query_filter = $this->mod->select($select, 'v_atribut', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_atribut', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($val->atribut_jenis == '1') {
					$jenis = 'option';
				}
				elseif ($val->atribut_jenis == '2') {
					$jenis = 'textarea';
				}
				else
				{
					$jenis = 'text';
				}
				if ($val->atribut_status_aktif == 'y') {
					$status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button. '<button class="btn blue-ebonyclay" type="button" onclick="openFormAtributBarang('.$val->atribut_id.')" title="Edit" data-toggle="modal" href="#modaladd">
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->atribut_id.')" title="Non Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}

				} else {
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';
					if($priv['update'] == 1)
					{
						$button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormAtributBarang('.$val->atribut_id.')" title="Edit" data-toggle="modal" href="#modaladd" disabled>
											<i class="icon-pencil text-center"></i>
										</button>';
					}
					if($priv['delete'] == 1)
					{
						$button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->atribut_id.')" title="Aktifkan">
						<i class="icon-power text-center"></i>
					</button>';
					}

				}

				if ($val->atribut_jenis == 1) {
					// SET TRUE IF WANT TO DECODE ALL TO ARRAY
					$array_value = json_decode($val->atribut_default_value, TRUE);
					$hasil = array();
					for ($i = 0; $i < sizeof($array_value); $i++) {
						array_push($hasil, $array_value[$i]['nama']);
					}
					$default_value = implode(', ', $hasil);
				} else {
					$default_value = $val->atribut_default_value;
				}

				$response['data'][] = array(
					$no,
					$val->barang_nama,
					$val->atribut_nama,
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
 		$this->load->view("atribut-barang/V_form_atribut_barang");
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'atribut_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
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
				// CARI Satuan
				$hasil2['val2'] = array();
				$where_satuan['data'][] = array(
					'column' => 'satuan_id',
					'param'	 => $val->atribut_satuan
				);
				$query_satuan = $this->mod->select('*','m_satuan',NULL,$where_satuan);
				foreach ($query_satuan->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->satuan_id,
						'text' 	=> $val2->satuan_nama
					);
				}
				// END CARI Satuan
				$response['val'][] = array(
					'kode' 							=> $val->atribut_id,
					'm_barang_id' 					=> $hasil1,
					'atribut_nama' 					=> $val->atribut_nama,
					'atribut_jenis' 				=> $val->atribut_jenis,
					'atribut_satuan' 				=> $hasil2,
					'atribut_default_value' 		=> $val->atribut_default_value,
					'atribut_status_aktif' 			=> $val->atribut_status_aktif
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
			'column' => 'atribut_status_aktif',
			'param'	 => 'y'
		);
		$where_like['data'][] = array(
			'column' => 'atribut_nama',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'atribut_nama',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->atribut_id,
					'text'	=> $val->atribut_nama
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
				'column' => 'atribut_id',
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
			'column' => 'atribut_id',
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
			'column' => 'atribut_id',
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
			'column' => 'atribut_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('atribut_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['atribut_revised'] + 1;
		}
		if ($type == 1) {
			if($this->input->post('atribut_jenis') == "1")
			{
				$value = array();
				for($i = 0; $i < $this->input->post('jml_itemOption', TRUE); $i++)
				{
					$id = $this->input->post('atribut_default_value_id'.($i+1));
					$nama = $this->input->post('atribut_default_value_nama'.($i+1));
					$temp = array("id"=>$id, "nama"=>$nama);
					array_push($value, $temp);
				}
				$defaultValue = json_encode($value);
			}
			else
			{
				$defaultValue = $this->input->post('atribut_default_value', TRUE);
			}
			$data = array(
				'm_barang_id' 					=> $this->input->post('m_barang_id', TRUE),
				'atribut_nama' 					=> $this->input->post('atribut_nama', TRUE),
				'atribut_jenis' 				=> $this->input->post('atribut_jenis', TRUE),
				'atribut_satuan' 				=> $this->input->post('atribut_satuan', TRUE),
				'atribut_default_value' 		=> $defaultValue,
				'atribut_status_aktif' 			=> $this->input->post('atribut_status_aktif', TRUE),
				'atribut_create_date' 			=> date('Y-m-d H:i:s'),
				'atribut_update_date' 			=> date('Y-m-d H:i:s'),
				'atribut_create_by' 			=> $this->session->userdata('user_username'),
				'atribut_revised' 				=> 0,
			);
		} else if ($type == 2) {
			if($this->input->post('atribut_jenis') == "1")
			{
				$value = array();
				for($i = 0; $i < $this->input->post('jml_itemOption', TRUE); $i++)
				{
					$id = $this->input->post('atribut_default_value_id'.($i+1));
					$nama = $this->input->post('atribut_default_value_nama'.($i+1));
					$temp = array("id"=>$id, "nama"=>$nama);
					array_push($value, $temp);
				}
				$defaultValue = json_encode($value);
			}
			else
			{
				$defaultValue = $this->input->post('atribut_default_value', TRUE);
			}
			$data = array(
				'm_barang_id' 					=> $this->input->post('m_barang_id', TRUE),
				'atribut_nama' 					=> $this->input->post('atribut_nama', TRUE),
				'atribut_jenis' 				=> $this->input->post('atribut_jenis', TRUE),
				'atribut_satuan' 				=> $this->input->post('atribut_satuan', TRUE),
				'atribut_default_value' 		=> $defaultValue,
				'atribut_status_aktif' 			=> $this->input->post('atribut_status_aktif', TRUE),
				'atribut_update_date' 			=> date('Y-m-d H:i:s'),
				'atribut_update_by' 			=> $this->session->userdata('user_username'),
				'atribut_revised' 				=> $rev,
			);
		} else if ($type == 3) {
			$data = array(
				'atribut_status_aktif' 			=> 'n',
				'atribut_update_date' 			=> date('Y-m-d H:i:s'),
				'atribut_update_by' 			=> $this->session->userdata('user_username'),
				'atribut_revised' 				=> $rev,
			);
		} else if ($type == 4) {
			$data = array(
				'atribut_status_aktif' 			=> 'y',
				'atribut_update_date' 			=> date('Y-m-d H:i:s'),
				'atribut_update_by' 			=> $this->session->userdata('user_username'),
				'atribut_revised' 				=> $rev,
			);
		}

		return $data;
	}
	/* end Function */

}
