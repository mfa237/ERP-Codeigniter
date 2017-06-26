<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class C_edc extends MY_Controller
{
	public $tbl = 'm_edc';
	
	public function __construct()
	{
		parent::__construct();
		//Codeigniter : Write Less Do More

	}
	
	function index()
	{
		$this->view();
	}
	
	public function view()
	{
		$this->check_session();

		$priv = $this->cekUser(9);

		$data = array(

			'aplikasi'		=> $this->app_name,

			'title_page' 	=> 'EDC',

			'title_page2' => 'Master EDC',

			'priv_add'		=> $priv['create'],

		);
		
		if($priv['read'] == 1)
		{
			$this->open_page('edc/V_edc_list', $data);
		} 
		else 
		{
			$this->load->view('layout/V_404', $data);
		}

	}



  public function loadData(){

    $priv   = $this->cekUser(9);

    $table  = "m_edc a";

		$select = 'a.*, b.bank_nama';

		//LIMIT

		$limit = array(

			'start'  => $this->input->get('start'),

			'finish' => $this->input->get('length')

		);



		$join['data'][] = array(

			'table' => 'm_bank b',

			'join'	=> 'b.bank_id = a.edc_bank',

			'type'	=> 'left'

		);

		//WHERE LIKE

		$where_like['data'][] = array(

			'column' => 'a.edc_nama, b.bank_nama', 'param'	 => $this->input->get('search[value]')

		);

		//ORDER

		$index_order = $this->input->get('order[0][column]');

		$order['data'][] = array(

			'column' => $this->input->get('columns['.$index_order.'][name]'),

			'type'	 => $this->input->get('order[0][dir]')

		);



		$query_total = $this->mod->select($select, $table, $join);

		$query_filter = $this->mod->select($select, $table, $join, NULL, NULL, $where_like, $order);

		$query = $this->mod->select($select, $table, $join, NULL, NULL, $where_like, $order, $limit);



		$response['data'] = array();

		if ($query<>false) {

			$no = $limit['start']+1;



			foreach ($query->result() as $val) {

        $button = '';

        if ($val->edc_status_aktif == 'y') {

          $status = '<span class="label bg-green-jungle bg-font-green-jungle"> Aktif </span>';

          if($priv['update'] == 1)

          {

            $button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormEdc('.$val->edc_id.')" title="Edit" data-toggle="modal" href="#modaladd">

                      <i class="icon-pencil text-center"></i>

                    </button>';

          }

          if($priv['delete'] == 1)

          {

            $button = $button.'<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->edc_id.')" title="Non Aktifkan">

            <i class="icon-power text-center"></i>

          </button>';

          }



        } else {

          $status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird"> Non Aktif </span>';

          if($priv['update'] == 1)

          {

            $button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormEdc('.$val->edc_id.')" title="Edit" title="Edit" data-toggle="modal" href="#modaladd" disabled>

                      <i class="icon-pencil text-center"></i>

                    </button>';

          }

          if($priv['delete'] == 1)

          {

            $button = $button.'<button class="btn green-jungle" type="button" onclick="aktifData('.$val->edc_id.')" title="Aktifkan">

            <i class="icon-power text-center"></i>

            </button>';

          }



        }

				$response['data'][] = array(

					$no,

					$val->edc_nama,

					$val->bank_nama,

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



  function getForm(){

    $data = array();

    $this->load->view('edc/V_edc_form');

  }



  function loadDataWhere(){

    $id = $this->input->post('id');

    $table  = "m_edc a";

		$select = 'a.*';



		$join['data'][] = array(

			'table' => 'm_bank b',

			'join'	=> 'b.bank_id = a.edc_bank',

			'type'	=> 'left'

		);



    $join['data'][] = array(

			'table' => 'm_cabang c',

			'join'	=> 'c.cabang_id = a.edc_cabang',

			'type'	=> 'left'

		);

		//WHERE LIKE

		$where['data'][] = array(

			'column' => 'a.edc_id',

      'param'	 => $id

		);
		
		$query = $this->mod->select($select, $table, $join, $where);

    $value = $query->row();

    
	#############
	//CARI CABANG
	$hasil1['val2'] = array();
	$where_type['data'][] = array(
		'column' => 'cabang_id',
		'param'	 => $value->edc_cabang
	);

	$query_type = $this->mod->select('*','m_cabang',NULL,$where_type);
	foreach ($query_type->result() as $val2) 
	{
		$hasil1['val2'][] = array(
			'id' 	=> $val2->cabang_id,
			'text' 	=> $val2->cabang_nama
		);
	}
	
	//CARI BANK
	$hasil2['val3'] = array();
	$where_bank['data'][] = array(
		'column' => 'bank_id',
		'param'	 => $value->edc_bank
	);

	$query_bank = $this->mod->select('*','m_bank',NULL,$where_bank);
	foreach ($query_bank->result() as $val3) 
	{
		$hasil2['val3'][] = array(
			'id' 	=> $val3->bank_id,
			'text' 	=> $val3->bank_nama
		);
	}
	#############
	
	
      $data = array(

        'edc_id'            => $value->edc_id,

        'edc_nama'          => $value->edc_nama,

        'edc_bank'          => $hasil2,

        'edc_status_aktif'  => $value->edc_status_aktif,

        'edc_create_date'   => $value->edc_create_date,

        'edc_cabang'        => $hasil1

      );



    echo json_encode($data);



  }



  public function loadData_selectbank($value=''){

    $data = array();

    $query = $this->mod->select_config("m_bank", "")->result();



    foreach ($query as $key => $value) {

      $data[] = array(

        'data_id' => $value->bank_id,

        'data_name' => $value->bank_nama

      );

    }



    echo json_encode($data);



  }
  
	//SELECT CABANG
	public function loadData_select_cabang()
	{
		$param = $this->input->get('q');
		if ($param!=NULL) 
		{
			$param = $this->input->get('q');
		}
		else 
		{
			$param = "";
		}
		
		$select = '*';

		$where['data'][] = array(
			'column' => 'cabang_status_aktif',
			'param'	 => 'y'
		);
		
		$where_like['data'][] = array(
			'column' => 'cabang_nama',
			'param'	 => $this->input->get('q')
		);
		
		$order['data'][] = array(
			'column' => 'cabang_nama',
			'type'	 => 'ASC'
		);
		
		$query = $this->mod->select($select, 'm_cabang', NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) 
		{
			foreach ($query->result() as $val) 
			{
				$response['items'][] = array(
					'id'	=> $val->cabang_id,
					'text'	=> $val->cabang_nama
				);
			}
			
			$response['status'] = '200';
		}
		
		echo json_encode($response);
	}
	
	//SELECT BANK
	public function loadData_select_bank()
	{
		$param = $this->input->get('q');
		if ($param!=NULL) 
		{
			$param = $this->input->get('q');
		}
		else 
		{
			$param = "";
		}
		
		$select = '*';

		$where['data'][] = array(
			'column' => 'bank_status_aktif',
			'param'	 => 'y'
		);
		
		$where_like['data'][] = array(
			'column' => 'bank_nama',
			'param'	 => $this->input->get('q')
		);
		
		$order['data'][] = array(
			'column' => 'bank_nama',
			'type'	 => 'ASC'
		);
		
		$query = $this->mod->select($select, 'm_bank', NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) 
		{
			foreach ($query->result() as $val) 
			{
				$response['items'][] = array(
					'id'	=> $val->bank_id,
					'text'	=> $val->bank_nama
				);
			}
			
			$response['status'] = '200';
		}
		
		echo json_encode($response);
	}
	
	
  
  // Function Delete

	public function deleteData(){

		$id = $this->input->post('id');

		$data = $this->general_post_data(3, $id);

		$where['data'][] = array(

			'column' => 'edc_id',

			'param'	 => $id

		);

		$update = $this->mod->update_data_table($this->tbl, $where, $data);

		$updateKaryawan = $this->nonaktif_karyawan($id);

		if($update->status) {

			if($updateKaryawan)

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
	
	//Aktif Data
	public function aktifData()
	{
		$id = $this->input->post('id');
		$data = $this->general_post_data(4, $id);
		$where['data'][] = array(
			'column' => 'edc_id',
			'param'	 => $id
		);
		
		$update = $this->mod->update_data_table($this->tbl, $where, $data);
		
		if($update->status) 
		{
			$response['status'] = '200';
		}
		else 
		{
			$response['status'] = '204';
		}
		
		echo json_encode($response);
	}



  function loadDataSelectCabang(){

    $data = array();

    $query = $this->mod->select_config("m_cabang", "")->result();



    foreach ($query as $key => $value) {

      $data[] = array(

        'data_id' => $value->cabang_id,

        'data_name' => $value->cabang_nama

      );

    }



    echo json_encode($data);

  }



  function general_post_data($type, $id = null){

		// 1 Insert, 2 Update, 3 Delete / Non Aktif

		if ($type == 1) {

			$data = array(

        'edc_nama'                => $this->input->post('i_edc', TRUE),

        'edc_bank'                => $this->input->post('i_bank', TRUE),

        'edc_status_aktif'        => $this->input->post('edc_status_aktif', TRUE),

				'edc_create_date' 			  => date('Y-m-d H:i:s'),

				'edc_create_by' 			    => $this->session->userdata('user_username'),

				// 'edc_update_date' 				=> date('Y-m-d H:i:s'),

				// 'edc_update_by' 				  => $this->session->userdata('user_username'),,

        'edc_revised'             => 0,

        'edc_cabang'              => $this->input->post('m_cabang_id')

			);

		} else if ($type == 2) {

			$data = array(

        'edc_nama'                => $this->input->post('i_edc', TRUE),

        'edc_bank'                => $this->input->post('i_bank', TRUE),

        'edc_status_aktif'        => $this->input->post('edc_status_aktif', TRUE),

				'edc_update_date' 				=> date('Y-m-d H:i:s'),

				'edc_update_by' 				  => $this->session->userdata('user_username'),

        'edc_revised'             => 0,

        'edc_cabang'              => $this->input->post('m_cabang_id')

			);

		} else if ($type == 3) {

			$data = array(

        'edc_status_aktif'        => 'n',

				'edc_update_date' 				=> date('Y-m-d H:i:s'),

				'edc_update_by' 				  => $this->session->userdata('user_username'),

        // 'edc_revised'             => $rev,

        'edc_cabang'              => $this->input->post('m_cabang_id')

			);

		} else if ($type == 4) {

			$data = array(

        'edc_status_aktif'        => 'y',

				'edc_update_date' 				=> date('Y-m-d H:i:s'),

				'edc_update_by' 				  => $this->session->userdata('user_username'),

        // 'edc_revised'             => $rev,

        'edc_cabang'              => $this->input->post('m_cabang_id')

			);

		}



		return $data;

	}





  public function postData(){

		$id = $this->input->post('edc_id');

		if (strlen($id)>0) {

			//UPDATE

			$data = $this->general_post_data(2, $id);

			$where['data'][] = array(

				'column' => 'edc_id',

				'param'	 => $id

			);

			$update      = $this->mod->update_data_table($this->tbl, $where, $data);



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
	
	
	function nonaktif_karyawan($type_id)
	{
		// select data karyawan
		$tblKaryawan = 'm_karyawan';
		$select = 'karyawan_id, karyawan_revised';
		$where['data'][] = array(
			'column' => 'm_departemen_id',
			'param'	 => $type_id,
		);
		
		$idKaryawan = $this->mod->select($select, $tblKaryawan, NULL, $where);
		if ($idKaryawan) 
		{
			$idKaryawan = $idKaryawan->result_array();$dataKaryawan = array();
			$data = array();
			$i = 0;
			
			foreach ($idKaryawan as $id) 
			{
				// masukkan data karyawan ke dalam array
				$dataKaryawan[$i] = array(
					'karyawan_id' 				=> $id['karyawan_id'],
					'karyawan_status_aktif' 	=> 'n',
					'karyawan_update_date' 		=> date('Y-m-d H:i:s'),
					'karyawan_update_by' 		=> $this->session->userdata('user_username'),
					'karyawan_revised' 			=> $id['karyawan_revised'] + 1, 
				);
				
				
				//select user_revised
				$select = 'user_revised';
				$whereUser['data'][] = array(
					'column' => 'm_karyawan_id',
					'param'	 => $id['karyawan_id'],
				);
				
				$revUser = $this->mod->select($select, 's_user', NULL, $whereUser);
				// end select
				
				// cek jika data ada
				if($revUser)
				{
					// ambil data dan masukkan ke dalam array data
					$revisedUser = $revUser->row_array();
					$data[$i] = array(
						'm_karyawan_id' 		=> $id['karyawan_id'] ,
						'user_status_aktif' 	=> 'n',
						'user_update_date' 		=> date('Y-m-d H:i:s'),
						'user_update_by' 		=> $this->session->userdata('user_username'),
						'user_revised' 			=> $revisedUser['user_revised'] + 1,
					);
				}
				$i++;
			}
			
			$updateKaryawan = $this->db->update_batch($tblKaryawan, $dataKaryawan, 'karyawan_id');
			if(count($data) > 0)
			{
				$updateUser = $this->db->update_batch('s_user', $data, 'm_karyawan_id');
			}
		}
	
		return true;
	}





}

