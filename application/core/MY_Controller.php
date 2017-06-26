<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $admin_granted = false;
	public $logged_in = false;
	public $app_name = 'ERP';

	public function __construct() {
		parent::__construct();
		$this->is_logged_in();
		$this->user_has_access();
	}

	/* ====================================
		General Function
	==================================== */

	// Check Session Active
	function is_logged_in() {
	   	$user = $this->session->userdata('logged');
	   	if($user=="")
	   		$this->logged_in = false;
	   	else
	   		$this->logged_in = true;
	}

	function check_session()
	{
		if(!$this->logged_in)
			redirect('Login');
	}

	// Check if user has level
	function user_has_access()
	{
		$user_level = $this->session->userdata('level');
		if($user_level!=0)
			$this->admin_granted = true;
		else if($user_level==0)
			$this->admin_granted = false;
	}

	// Check Authorized User
	// function check_authorized($table,$id){
	// 	if ($table == 'mainmenu') {
	// 		$table1 = $table;
	// 		$id1 = 'idmenu';
	// 		$status1 = 'status_menu';
	// 	} else if ($table == 'submenu') {
	// 		$table1 = $table;
	// 		$id1 = 'idsub';
	// 		$status1 = 'status_submenu';
	// 	}
	// 	$select = 'a.*,b.*';
	// 	$tbl =  $table1.' a';
	// 	//JOIN
	// 	$join['data'][] = array(
	// 		'table' => $table1.'_akses b',
	// 		'join'	=> 'b.'.$table1.'_'.$id1.'=a.'.$id1,
	// 		'type'	=> 'inner'
	// 	);
	// 	//WHERE
	// 	$where['data'][] = array(
	// 		'column' => 'b.st_level_user_kode',
	// 		'param'	 => $this->session->userdata('level')
	// 	);
	// 	$where['data'][] = array(
	// 		'column' => 'a.'.$status1,
	// 		'param'	 => 1
	// 	);
	// 	$where['data'][] = array(
	// 		'column' => 'a.'.$id1,
	// 		'param'	 => $id
	// 	);
	// 	//ORDER
	// 	$order['data'][] = array(
	// 		'column' => 'a.index',
	// 		'type'	 => 'ASC'
	// 	);
	// 	$query = $this->mod->select($select,$tbl,NULL,NULL,$order,$join,$where);
	// 	foreach ($query->result() as $row) {
	// 		$data = array(
	// 			'c' => $row->c,
	// 			'r' => $row->r,
	// 			'u' => $row->u,
	// 			'd' => $row->d,
	// 		);
	// 	}
	// 	return $data;
	// }
	function cekUser($idmenu){
		$select = '*';
		$tbl = 's_privilege';
		$where['data'][] = array(
			'column' => 'm_type_karyawan_id',
			'param'	 => $this->session->userdata('type_karyawan_id')
		);
		$where['data'][] = array(
			'column' => 'menu_id',
			'param'	 => $idmenu
		);
		$priv = $this->mod->select($select, $tbl, null, $where)->row_array();
		return $priv;
	}

	// Merge content to header and footer
	function open_page_app($file_name, $data=null){
		$this->load->view('layout/V_header_app', $data);
		$this->load->view($file_name);
	}

	function open_page($file_name, $data=null){
		$select = 'a.*,b.*';
		$tbl = 's_menu a';
		//JOIN
		$join['data'][] = array(
			'table' => 's_privilege b',
			'join'	=> 'b.menu_id=a.menu_id',
			'type'	=> 'inner'
		);
		//WHERE
		$where['data'][] = array(
			'column' => 'b.m_type_karyawan_id',
			'param'	 => $this->session->userdata('type_karyawan_id')
		);
		$where['data'][] = array(
			'column' => 'a.menu_type',
			'param'	 => 0
		);
		$where['data'][] = array(
			'column' => 'b.read',
			'param'	 => 1
		);
		//ORDER
		$order['data'][] = array(
			'column' => 'a.menu_index',
			'type'	 => 'ASC'
		);
		$data['mainmenu'] = $this->mod->select($select, $tbl, $join, $where, NULL, NULL, $order, NULL);

		$select2 = 'a.*,b.*';
		$tbl2 = 's_menu a';
		//JOIN
		$join2['data'][] = array(
			'table' => 's_privilege b',
			'join'	=> 'b.menu_id=a.menu_id',
			'type'	=> 'inner'
		);
		//WHERE
		$where2['data'][] = array(
			'column' => 'b.m_type_karyawan_id',
			'param'	 => $this->session->userdata('type_karyawan_id')
		);
		$where2['data'][] = array(
			'column' => 'a.menu_type',
			'param'	 => 1
		);
		$where2['data'][] = array(
			'column' => 'b.read',
			'param'	 => 1
		);
		//ORDER
		$order2['data'][] = array(
			'column' => 'a.menu_index',
			'type'	 => 'ASC'
		);
		$data['submenu'] = $this->mod->select($select2, $tbl2, $join2, $where2, NULL, NULL, $order2, NULL);

		$this->load->view('layout/V_header', $data);
		$this->load->view($file_name);
	}

	// Format indonesian money
	function format_money_id($value){
		$format = "RP ".number_format($value,0,',','.');
		return $format;
	}

	// Format indonesian month
	function format_month_id($bln){
		$Bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		$result = $Bulan[(int)$bln-1];
		return($result);
	}

	// Format Transaction Code
	function format_kode_transaksi($type, $query, $bln = NULL, $thn = NULL){
		if ($bln) {
			$bln = $bln;
		} else {
			$bln = date('m');
		}
		$thn = date('Y');
		if ($query<>false) {
			foreach ($query->result() as $row) {
				$urut = intval($row->id) + 1;
				$seq = sprintf("%05d",$urut);
			}
		} else {
			$seq = sprintf("%05d",1);
		}
		$kode_baru = $type.$thn.$bln.$seq;
		return $kode_baru;
	}

	function insert_kartu_stok($table,$data){
		$insert = $this->mod->insert_data_table($table, NULL, $data);
		if($insert->status) {
			$status = '200';
		} else {
			$status = '204';
		}
		return $status;
	}

	function replaceFormatNumber($value){
		$number = str_replace(',', '', $value);
		return $number;
	}

	function generateFormatNumber($value){
		$number = number_format($value, 2, ".", ",");
		return $number;
	}

	function generateFormatDate($value){
		$string = date("d/m/Y", strtotime($value));
		return $string;
	}

	function terbilang($x)
    {
      $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
      if ($x < 12)
      return " " . $abil[$x];
      elseif ($x < 20)
      return $this->terbilang($x - 10) . "belas";
      elseif ($x < 100)
      return $this->terbilang($x / 10) . " puluh" . $this->terbilang($x % 10);
      elseif ($x < 200)
      return " seratus" . $this->terbilang($x - 100);
      elseif ($x < 1000)
      return $this->terbilang($x / 100) . " ratus" . $this->terbilang($x % 100);
      elseif ($x < 2000)
      return " seribu" . $this->terbilang($x - 1000);
      elseif ($x < 1000000)
      return $this->terbilang($x / 1000) . " ribu" . $this->terbilang($x % 1000);
      elseif ($x < 1000000000)
      return $this->terbilang($x / 1000000) . " juta" . $this->terbilang($x % 1000000);
    }

	/* ====================================
		End General Function
	==================================== */

	/* ====================================
		Custom Function
	==================================== */

	/* ====================================
		End Custom Function
	==================================== */

function create_config($table, $data){
    $id = $this->mod->create_config($table, $data);
    return $id;
  }

  function select_config($table, $where){
    $query = $this->mod->select_config($table, $where);
    return $query;
  }

  function select_config_one($table, $obj, $where){
    $query = $this->mod->select_config_one($table , $obj, $where);
    return $query;
  }

  function update_config($table, $data, $where){
    $query = $this->mod->update_config($table, $data,$where);
  }

  function delete_config($table, $where){
    $query = $this->mod->delete_config($table,$where);
  }

  function get_header(){
    $this->load->view('template/header');
		// $this->load->view('template/topbar');
    // $this->sidebar();
  }

  function get_footer(){
    // $this->load->view('template/js');
		$this->load->view('template/footer');
  }

  function sidebar()
  {
    $data['sidebar_lv1'] = $this->mod->sidebar_lv1()->result();
    $data['controller']=$this;
    error_reporting(0);
    $this->load->view('template/sidebar', $data);
  }

  function sidebar_lv2($sidebar_lv1){
    $user_type = $this->session->userdata('user_type');
    $data = $this->mod->sidebar_lv2($sidebar_lv1, $user_type->user_type)->result();
    return $data;
  }

  function get_page($data, $url){
    $this->session->userdata('sidebar_id', 1);
    $this->load->view('template/head');
    $this->load->view('template/topbar');
    $this->sidebar();
    $this->load->view($url, $data);
    $this->load->view('template/js');
    $this->load->view('template/foot');
  }

  function do_upload($i_img, $path){

    $config['upload_path'] = '../../assets/img/items/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']     = '100';
    $config['max_width'] = '1024';
    $config['max_height'] = '768';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload($i_img))
             {
               echo "string";
                     $error = array('error' => $this->upload->display_errors());
             }
             else
             {
                     $data = array('upload_data' => $this->upload->data());
             }

  }
	// cek privelege input pengunjung
	function inputpengunjung(){
		$select = '*';
		$tbl = 's_privilege';
		$where['data'][] = array(
			'column' => 'm_type_karyawan_id',
			'param'	 => $this->session->userdata('type_karyawan_id')
		);
		$where['data'][] = array(
			'column' => 'menu_id',
			'param'	 => 84
		);
		$priv = $this->mod->select($select, $tbl, null, $where)->result();

		return $priv;
	}

	public function print_r($value)
	{
		echo "<pre>";
		print_r($value);
		echo "</pre>";
	}

}

/* End of file home.php */
/* Location: ./application/controllers/admin/home.php */
