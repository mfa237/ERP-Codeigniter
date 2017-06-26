<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_mutasibarang extends MY_Controller{
  private $any_error = array();
  public $tbl = 't_mutasibarang';

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    $this->view();
  }

  public function view(){
    $this->check_session();
    $priv = $this->cekUser(82);
    $data = array(
      'aplikasi'		  => $this->app_name,
      'title_page' 	  => 'Mutasi',
      'title_page2' 	=> 'Mutasi Barang',
      'priv_add'		  => $priv['create'],
      );
    if($priv['read'] == 1)
    {
      $this->open_page('mutasi/V_mutasilist', $data);
    }
    else
    {
      $this->load->view('layout/V_404', $data);
    }
  }

  function loadData()
  {
    $priv = $this->cekUser(9);
    $table = "t_mutasibarang a";
		$select = 'a.*, b.*, c.satuan_nama, d.user_username';

		$join['data'][] = array(
			'table' => 'm_barang b',
			'join'	=> 'b.barang_id = a.m_barang_id',
			'type'	=> 'left'
		);

    $join['data'][] = array(
			'table' => 'm_satuan c',
			'join'	=> 'c.satuan_id = a.mutasi_satuan',
			'type'	=> 'left'
		);

    $join['data'][] = array(
			'table' => 's_user d',
			'join'	=> 'd.user_id = a.mutasi_user',
			'type'	=> 'left'
		);

    $where_like['data'][] = array(
			'column' => 'a.mutasi_tanggal, b.barang_nama',  'param'	 => $this->input->get('search[value]')
		);

    $index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

    $limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);

    $query_total = $this->mod->select($select, $table, $join);
		$query_filter = $this->mod->select($select, $table, $join, NULL, NULL, $where_like);
    $query        = $this->mod->select($select, $table, $join, NULL, NULL, $where_like, $order, $limit);

    $response['data'] = array();
		if ($query<>false) {
      $no = $limit['start']+1;

      foreach ($query->result() as $val) {
        $button = '';
        // $button = $button.'<button class="btn blue-ebonyclay" type="button" onclick="openFormMutasi('.$val->barang_id.')" title="Edit">
        //                     <i class="icon-pencil text-center"></i>
        //                   </button>';

        $response['data'][] = array(
					$no,
          $val->mutasi_tanggal,
          $val->barang_nomor,
					$val->barang_nama,
          $val->mutasi_qty,
					$val->user_username,
					// $button
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

  function getForm()
  {
    $id = $this->input->post('id');
    // echo "string";
    $data = array('mutasi_barangid' => $id);
    $this->load->view("mutasi/V_mutasi_popmodal", $data);
  }

function getGudang()
{
  $id = 1;
  $table = "m_gudang a";
  $select = 'a.*';

  $where['data'][] = array(
    'column' => 'a.m_cabang_id',
    'param'	 => '1'
  );

  $join['data'][] = array(
    'table' => 'm_cabang b',
    'join'	=> 'b.cabang_id = a.m_cabang_id',
    'type'	=> 'right'
  );

  $where2 = array('b.cabang_gudangdisplay !=' => 'select gudang_id from m_gudang where m_cabang_id = 1');

  $response['items'] = array();
  $qGudang = $this->mod->gudangnotdisplay($id);

  if ($qGudang<>false) {
    foreach ($qGudang->result() as $row)
    {
      $response['items'][] = array(
        'id' => $row->gudang_id,
        'text' => $row->gudang_nama
      );
    }
  }
  // echo $this->db->last_query();
  echo json_encode($response);
}

public function getBarang()
{
  $gudang_id = $this->input->get('id');
  $table = "t_stok_gudang a";
  $select = 'a.*, b.*';

  $join['data'][] = array(
    'table' => 'm_barang b',
    'join'	=> 'b.barang_id = a.m_barang_id',
    'type'	=> 'left'
  );

  $where['data'][] = array(
    'column' => 'a.m_gudang_id',
    'param'	 => $gudang_id
  );

  $data['items'] = array();

  $qstokGudang = $this->mod->select($select, $table, $join, $where);
  if ($qstokGudang<>false) {
    foreach ($qstokGudang->result() as $row) {
      $data['items'][] = array(
        'id' => $row->barang_id,
        'text' => $row->barang_nama
      );
    }
  }

  echo json_encode($data);

}

public function getQTY()
{
  $i_barang = $this->input->post('i_barang');
  $i_gudang = $this->input->post('i_gudang');

  $select = '*';
  $table = 't_stok_gudang a';

  $where['data'][] = array(
    'column' => 'a.m_gudang_id',
    'param'	 => $i_gudang
  );

  $where['data'][] = array(
    'column' => 'a.m_barang_id',
    'param'	 => $i_barang
  );

  // $data['stok'] = 0;
  $qstokGudang = $this->mod->select($select, $table, NULL, $where)->row();

  if ($qstokGudang<>false) {
    $data['items'] = $qstokGudang->stok_gudang_jumlah;
  }

  echo json_encode($data);

}

function postData()
{
  $id = $this->input->post('mutasiid');
  if (strlen($id)>0) {
    echo "string";
  } else {
    //INSERT
    $data = $this->general_post_data(1);
    $table = "t_stok_gudang a";
    $i_gudang = $this->input->post('i_gudang');
    $i_barang = $this->input->post('i_barang');
    $barangQty = $this->input->post('barangQty');
    $jml_barangrequest = $this->input->post('jml_barang');

    $cabang_id = $data['cabang'];
    $gudangdisplayid = $data['mutasi_gudangdisplay'];

    $select = "a.stok_gudang_jumlah";

    $where = array(
      'column' => 'a.m_cabang_id',
			'param'	 => $cabang_id
    );

    $where['data'][] = array(
			'column' => 'a.m_barang_id',
			'param'	 => $i_barang
		);

    $where['data'][] = array(
			'column' => 'a.m_gudang_id',
			'param'	 => $i_gudang
		);

    $dataupdate = array(
      'a.stok_gudang_jumlah' => $barangQty-$jml_barangrequest,
    );

    $wheregudangdisplay['data'][] = array(
      'column' => 'a.m_barang_id',
			'param'	 => $i_barang
    );

    $wheregudangdisplay['data'][] = array(
      'column' => 'a.m_gudang_id',
			'param'	 => $gudangdisplayid
    );

    // $wheregudangdisplay['data'][] = array(
    //   'column' => 'a.m_cabang_id',
		// 	'param'	 => $cabang_id
    // );

    $this->mod->update_data_table($table, $where, $dataupdate);

    $qstockdisplay_ = $this->mod->select($select, 't_stok_gudang a', null, $wheregudangdisplay);
    // echo $this->db->last_query();

    if ($qstockdisplay_<>false) {
      $qstockdisplay = $qstockdisplay_->row();

      $dataupdatedisplay = array(
        'stok_gudang_jumlah' => $qstockdisplay->stok_gudang_jumlah+$jml_barangrequest,
      );
      // nambah display
      $this->mod->update_data_table($table, $wheregudangdisplay, $dataupdatedisplay);

    } else {

      $datainsert = array(
        'm_gudang_id' => $gudangdisplayid,
        'm_barang_id' => $i_barang,
        'stok_gudang_jumlah' => $jml_barangrequest,
        'stok_gudang_created_date' => date("Y-m-d H:m:s"),
        'stok_gudang_update_by' => $this->session->userdata('user_id')
      );

      $insert = $this->mod->create_config('t_stok_gudang', $datainsert);

    }

    $insert = $this->mod->create_config($this->tbl, $data['insert']);
    if($insert) {
      $response['status'] = '200';
    } else {
      $response['status'] = '204';
    }
  }

  echo json_encode($response);
}

function general_post_data($type, $id = null)
{
  $i_gudang = $this->input->post('i_gudang');
  $i_barang = $this->input->post('i_barang');
  $barangQty = $this->input->post('barangQty');
  $jml_barang = $this->input->post('jml_barang');
  $i_barang = $this->input->post('i_barang');
  $jml_barang = $this->input->post('jml_barang');


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
  if ($type == 1) {
    $data['insert'] = array(
      'mutasi_tanggal'      => date("Y-m-d H:m:s"),
      'mutasi_user'         => $this->session->userdata('user_id'),
      'mutasi_branch_id'    => $user->m_cabang_id,
      'mutasi_gudangid'     => $i_gudang,
      'mutasi_gudangdisplay'=> $user->cabang_gudangdisplay,
      'm_barang_id'         => $i_barang,
      'mutasi_qty'          => $jml_barang
    );

    $data['cabang'] = $user->m_cabang_id;
    $data['mutasi_gudangdisplay'] = $user->cabang_gudangdisplay;
  }
  	return $data;
}


}
