<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_POS extends MY_Controller{

  public function __construct(){
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->check_session();
    $this->load->model('M_penjualan');
  }

  function index(){
    // $this->get_header();
    // $this->penjualan_list();
    // $this->get_footer();
  }

  public function view(){
    $this->check_session();
    $priv = $this->cekUser(28);

    $data = array(
      'aplikasi'		=> $this->app_name,
      'title_page' 	=> 'Penjualan',
      'title_page2' => 'Point Of Sales',
      'priv_add'		=> $priv['create'],
      'priv_view'		=> $priv['read'],
      );
      $data['pilihkasir'] = '';

      if ($priv['m_type_karyawan_id'] == 1) {
        $data['pilihkasir'] = "<select class='form-control' id='i_kasir' name='i_kasir' aria-required='true'
        aria-describedby='select-error' onchange='searchData(); searchDatasummarykasir();' required></select>";
      }

      // if ($priv['m_type_karyawan_id'] == 1) {
      //   $data['pilihcabang'] = "<select class='form-control' id='i_cabang' name='i_cabang' aria-required='true' aria-describedby='select-error' required></select>";
      // }

    $this->open_page('transaksi/penjualan/V_penjualan_list', $data);
  }

  function viewendofsheets(){
    $this->check_session();
    $priv = $this->cekUser(42);

    $data = array(
      'aplikasi'		=> $this->app_name,
      'title_page' 	=> 'Penjualan',
      'title_page2' => 'Point Of Sales',
      'priv_add'		=> $priv['create'],
      'priv_view'		=> $priv['read'],
    );

    $this->open_page('transaksi/penjualan/V_endofsheets', $data);
  }

  function loadData($type){
    $datarange  = $this->input->get('daterange');
    $kasir      = $this->input->get('kasir');

    $tanggal = explode("-", $datarange);
    $tanggal1 = $tanggal[0];
    $tanggal2 = $tanggal[1];
    // var_dump($tanggal);

    $tanggal1 = str_replace("/","-", $tanggal1);
    $tanggal2 = str_replace("/","-", $tanggal2);
    $tanggal1 = date("Y-m-d H:m:s", strtotime($tanggal1));
    $tanggal2 = date("Y-m-d H:m:s", strtotime($tanggal2));

    $select = 'a.*, b.cabang_nama, c.user_username, d.partner_nama, e.pengiriman_id';
    $table  = 'tb_penjualan a';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);

    $where = NULL;
    $where2 = NULL;


    $join['data'][] = array(
      'table' => 'm_cabang b',
      'join'  => 'b.cabang_id = a.branch',
      'type'  => 'left'
    );

    $join['data'][] = array(
      'table' => 's_user c',
      'join'  => 'c.user_id = a.user',
      'type'  => 'left'
    );

    $join['data'][] = array(
      'table' => 'm_partner d',
      'join'  => 'd.partner_id = a.customer',
      'type'  => 'left'
    );

    $join['data'][] = array(
      'table' => 'tb_pengiriman e',
      'join'  => 'e.penjualan_id = a.penjualan_id',
      'type'  => 'left'
    );
    if ($kasir!=NULL) {
      $where['data'][] = array(
        'column' => 'a.user',
        'param'	 => $kasir
      );
    }

    $where['data'][] = array(
      'column' => 'a.status',
      'param'	 => 0
    );

    $where_like['data'][] = array(
			'column' => 'b.cabang_nama, a.penjualan_code, a.penjualan_date, a.penjualan_total, a.penjualan_payment',
			'param'	 => $this->input->get('search[value]')
		);

    $where2 = array('a.penjualan_date >=' => $tanggal1, 'a.penjualan_date <=' => $tanggal2);

    $index_order = $this->input->get('order[0][column]');
    $order['data'][] = array(
      'column' => $this->input->get('columns['.$index_order.'][name]'),
      'type'	 => $this->input->get('order[0][dir]')
    );

    $limit = array(
      'start'  => $this->input->get('start'),
      'finish' => $this->input->get('length')
    );

    $query_total  = $this->mod->select($select, $table, $join);
    $query_filter = $this->mod->select($select, $table, $join, $where, $where2, $where_like);
    $query        = $this->mod->select($select, $table, $join, $where, $where2, $where_like, $order, $limit);

    $penjualan_status = "";
    $response['data'] = array();
    if ($query<>false) {
      $no = $limit['start']+1;
      foreach ($query->result() as $val) {
        if ($val->booking_status == 2) $penjualan_status = "Booking All";
        $button = '';
          if ($val->pengiriman_id != null) {
            $button = $button.'
  					<button class="btn blue-ebonyclay" type="button" title="">
  						<i class="fa fa-truck text-center"></i>
  					</button>
            ';
          }

					$button = $button.'
					<a href="'.base_url().'Penjualan/penjualan_details/'.$val->penjualan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat PO">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
          <button class="btn green-jungle" type="button" title="Print Struk Penjualan" onclick="print_struk('.$val->penjualan_id.')">
						<i class="icon-printer text-center"></i>
					</button>
					<button class="btn red-thunderbird" type="button" title="Hapus Penjualan" onclick="hapusPenjualan('.$val->penjualan_id.')">
						<i class="icon-trash text-center"></i>
					</button>';

        $response['data'][] = array(
          $no,
          $val->cabang_nama,
          $val->penjualan_code,
          date("d/m/Y",strtotime($val->penjualan_date)),
          number_format($val->penjualan_grand_total),
          number_format($val->penjualan_payment),
          $penjualan_status,
          $val->user_username,
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

  function open_page_penjualan(){
    $this->get_header();
    $this->penjualan_form();
    $this->get_footer();
  }

  function penjualan_form(){
    // $this->get_all_item();
    $where = '';
    $where_user_id = array('user_id' =>  $this->session->userdata('user_id'));

    $data = array(
        'back_to_pos_list' => "C_POS",
        'all_item' => $this->select_config('m_barang', $where),
        'user'     => $this->select_config('s_user', $where)->row()
      );
    $this->load->view('transaksi/penjualan/V_penjualan', $data);
  }

  function get_items(){
    $kategori_id = null;

    if ($this->input->post('kategori_id')) {
      $kategori_id = $this->input->post('kategori_id');
    }

    $where = '';

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
    $cabang = $user->m_cabang_id;
    $Gudangdisplay = $user->cabang_gudangdisplay;

    $q_item = $this->M_penjualan->get_all_item($cabang, $Gudangdisplay, $kategori_id);
    $aktif = 0;


    foreach ($q_item->result() as $row) {
      if ($row->det_promo_status_aktif != '' || $row->promo_status_aktif != '') {
        $aktif = 1;
      } else {
        $aktif = 0;
      }
    $where_as = array('m_gudang_id' => $Gudangdisplay,
                      'm_barang_id' => $row->barang_id);
    $stokcabang = $this->mod->select_config_one('t_stok_gudang', 'stok_gudang_jumlah', $where_as);

    $wherebarangid['data'][] = array(
      'column' => 'b.promo_item_id',
      'param'	 => $row->barang_id
    );


      $response['itemsall'][] = array(
        'barang_id'           => $row->barang_id,
        'm_jenis_barang_id'   => $row->m_jenis_barang_id,
        'category_2_id'       => $row->m_category_2_id,
        'barang_kode'         => $row->barang_kode,
        'barang_nomor'        => $row->barang_nomor,
        'barang_nama'         => $row->barang_nama,
        'm_satuan_id'         => $row->m_satuan_id,
        'brand_id'            => $row->m_brand_id,
        'harga_beli'          => $row->harga_beli,
        'harga_jual'          => $row->harga_jual,
        'harga_jual_pajak'    => $row->harga_jual_pajak,
        'stok'                => $row->stok,
        'barang_minimum_stok' => $row->barang_minimum_stok,
        'stok_maks'           => $row->stok_maks,
        'barang_status_aktif' => $row->barang_status_aktif,
        'barang_create_date'  => $row->barang_create_date,
        'barang_create_by'    => $row->barang_create_by,
        'barang_update_date'  => $row->barang_update_date,
        'barang_update_by'    => $row->barang_update_by,
        'barang_revised'      => $row->barang_revised,
        'det_promo_status_aktif' => $row->det_promo_status_aktif,
        'promo_nama'             => $row->promo_nama,
        'promo_qty'              => $row->promo_qty,
        'promo_status_aktif'     => $row->promo_status_aktif,
        'stok_gudang_jumlah'     => $row->stockgudang,
        'stok_display_jumlah'    => $stokcabang,
        'aktif'                  => $aktif
     );
    }
    echo json_encode($response);
  }

  function simpan_transaksi(){
      $qty_s = $this->input->post('item_qty');
      $item_s = $this->input->post('item_id');
      $item_discount = $this->input->post('item_discount');
      $item_discount_percent = $this->input->post('item_discount_percent');
      $item_book = $this->input->post('item_book');
      $item_price = $this->input->post('item_price');
      $item_getFromGudang = $this->input->post('item_getFromGudang');
      $tgl_penjualan = $this->input->post('tgl_penjualan');
      $tgl_penjualan = explode("/", $tgl_penjualan);
      $gettime = date("H:m:s");
      $tgl_penjualan = $tgl_penjualan[2]."-".$tgl_penjualan[1]."-".$tgl_penjualan[0]." ".$gettime;

      $discount_s = $this->input->post('item_discount');
      $sales_pay = $this->input->post('sales_pay');
      $sales_type = $this->input->post('sales_type');
      $customer_id = $this->input->post('customer_id');
      $sales_dp = $this->input->post('sales-dp');
      $sales_nama = $this->input->post('sales-nama');
      $sales_nomor_kartu = $this->input->post('sales-nomor-kartu');
      $sales_nama_bank = $this->input->post('sales-nama-bank');
      $sales_nomor_rekening = $this->input->post('sales-nomor-rekening');
      $mesin_edc = $this->input->post('i_edc');
      $tgl_jatuh_tempo = $this->input->post('tgl_jatuh_tempo');
      $input_total = $this->input->post('input-total');
      $outlet_id = $this->input->post('outlet_id');
      $sales_discount = $this->input->post('sales_discount');
      $input_cashback = $this->input->post('input-cashback');
      $status = $this->input->post('item_price');
      $pengiriman = $this->input->post('pengiriman');
      $promo_id = $this->input->post('promo_id');
      $promo_id_ = '';
      $input_potongan = $this->input->post('input-potongan');
      if ($promo_id) {
        foreach ($promo_id as $key => $value) {
          $promo_id_ = $promo_id[$key];
          $promo_id_ = $promo_id_."|";
        }
      }

      $book_all = $this->input->post('book_all');



      $penjualan_total = $input_total;

      $input_jarak = null;
      $booking_status = null;
      $biaya_pengiriman = null;
      $input_jarak_currency = null;

      if ($item_book!=null) {
        $booking_status = 1;
      }

      if ($book_all!=null) {
        $booking_status = 2;
      }

      if ($pengiriman) {

        $tujuan_pengiriman = $this->input->post('tujuan_pengiriman');
        $input_jarak = $this->input->post('input_jarak');
        $biaya_pengiriman = $this->input->post('input_biaya_currency');

      }
      // echo $booking_status;

      $sales_dp = $this->input->post('sales-dp');
      $tgl_jatuh_tempo = $this->input->post('tgl_jatuh_tempo');

      $user_id = $this->session->userdata('user_id');

      $wherecabang = array('cabang_id' => $outlet_id);
      $kodeCabang = $this->mod->select_config_one("m_cabang", "cabang_kode as result", $wherecabang);
      $getkodegenerate = $this->getkodegenerate($tgl_penjualan);
      $penjualan_code = $kodeCabang->result."/".date("d/m/Y")."/".$getkodegenerate;

      $status = '';
      if ($sales_type == 3) {
        $status = 1;
      }

      if ($sales_discount) {
        $penjualan_total = $input_total-$sales_discount;
      }

      if ($biaya_pengiriman) {
        $penjualan_total = $input_total+$biaya_pengiriman;
      }



        $selectuser = "a.*, b.m_cabang_id, c.cabang_gudangdisplay";
        $tableuser = 's_user a';

        $joinuser['data'][] = array(
          'table' => 'm_karyawan b',
          'join'	=> 'b.karyawan_id = a.m_karyawan_id',
          'type'	=> 'left'
        );

        $joinuser['data'][] = array(
          'table' => 'm_cabang c',
          'join'	=> 'c.cabang_id = b.m_cabang_id',
          'type'	=> 'left'
        );

        $whereuser['data'][] = array(
          'column' => 'a.user_id',
          'param'	 => $this->session->userdata('user_id')
        );


        $user = $this->mod->select($selectuser, $tableuser, $joinuser, $whereuser)->row();

      $data = array(
                    'penjualan_code'    => $penjualan_code,
                    'penjualan_date'    => $tgl_penjualan,
                    'customer'          => $customer_id,
                    'branch'            => $user->m_cabang_id,
                    'penjualan_all_discount'  => $sales_discount,
                    'penjualan_total'         => $penjualan_total,
                    'penjualan_pajak'         => '',
                    'penjualan_all_discount_percent' => '',
                    'penjualan_all_discount_nominal' => $sales_discount,
                    'penjualan_biaya_pengiriman'     => $biaya_pengiriman,
                    'penjualan_grand_total'          => $input_total,
                    'penjualan_payment'              => $sales_pay,
                    'penjualan_change'               => $input_cashback,
                    'penjualan_payment_method'       => $sales_type,
                    'bank_atas_name'                 => $sales_nama,
                    'bank'                           => $sales_nama_bank,
                    'bank_number'                    => $sales_nomor_kartu,
                    'user'                           => $user_id,
                    'booking_status'                 => $booking_status,
                    'no_edc'                         => $mesin_edc,
                    'status'                         => $status,
                    'promo'                          => $promo_id_,
                    'promo_total'                    => $input_potongan);

      $id = $this->create_config('tb_penjualan', $data);

      if ($biaya_pengiriman!=null) {
        $data_pengiriman =  array(
                            'pengiriman_id'       => '',
                            'penjualan_id'        => $id,
                            'penjualan_code'      => $penjualan_code,
                            'penjualan_tanggal'   => date("Y-m-d h:m:s"),
                            'pengiriman_date'     => null,
                            'pengiriman_tujuan'   => $tujuan_pengiriman,
                            'pengiriman_jarak'    => $input_jarak,
                            'pengiriman_biaya'    => $biaya_pengiriman,
                            'pengiriman_tanggal'  => null,
                            'pengiriman_tanggal_sampai' => '',
                            'status'                    => 0
                          );
        $this->create_config('tb_pengiriman', $data_pengiriman);
      }

      $no = 0;
      foreach ($item_s as $row) {
        $item_total = $item_price[$no]*($qty_s[$no]+$item_getFromGudang[$no]);
        $item_grand_total = $item_total-$item_discount[$no];
        $data_detail = array(
                            // 'penjualan_detail_id' => '',
                            'penjualan'               => $id,
                            'barang'                  => $item_s[$no],
                            'barang_qty'              => $qty_s[$no],
                            'barang_price'            => $item_price[$no],
                            'barang_total'            => $item_total,
                            'barang_discount_percent' => $item_discount_percent[$no],
                            'barang_discount_nominal' => $item_discount[$no],
                            'barang_grand_total'      => $item_grand_total,
                            'booking_status'          => $item_book[$no],
                            'item_getFromGudang'      => $item_getFromGudang[$no],
                            'promo'                   => 0
                            );

        $this->create_config('tb_penjualan_details', $data_detail);


        $no++;
      }

      if ($sales_type==3) {
          $data_kredit = array(
            'penjualan_id'    => $id,
            'penjualan_code'  => $penjualan_code,
            'tanggal_batas'   => $tgl_jatuh_tempo,
            'customer'        => $sales_nama,
            'user'            => $user_id
          );
          $this->create_config('tb_kredit', $data_kredit);
      }

      // $data['id'] = $id;
      echo json_encode($id);
  }

	function print_struk($id){
		$where='';

    // $where_penjualan_id = "WHERE penjualan_id = '$id'";
    $where_penjualan_id_ =  "WHERE a.penjualan = '$id'";

    $select = "a.*, b.user_username, d.partner_nama";
    $table = "tb_penjualan a";

    $join['data'][] = array(
      'table' => 's_user b',
      'join'	=> 'b.user_id = a.user',
      'type'	=> 'left'
    );

    $join['data'][] = array(
      'table' => 'm_partner d',
      'join'	=> 'd.partner_id = a.customer',
      'type'	=> 'left'
    );

    $where['data'][] = array(
      'column' => 'a.penjualan_id',
      'param'  => $id
    );

    $wherepenjualan_id = array('penjualan_id' => $id);

    $rpenjualan = $this->mod->select_config_one('tb_penjualan', 'promo', $wherepenjualan_id);
    $promo = $rpenjualan->promo;

    $q_transaksi = $this->mod->select($select, $table, $join, $where)->row();
    $q_promo = '';
    if ($promo) {
      $q_promo     = $this->M_penjualan->select_promostruk($promo);
    }

		$data = array(
			'transaksi'        => $q_transaksi,
      'promo'            => $q_promo,
			'transaksi_detail' => $this->db->query("select a.*, b.* from tb_penjualan_details a
                                               left join m_barang b on b.barang_id = a.barang
                                               $where_penjualan_id_"));


		$this->load->view('transaksi/penjualan/invoice_penjualan', $data);
	}

  function get_customers(){
    $where = '';
    $q_member = $this->select_config('m_partner', $where);
    foreach ($q_member->result() as $r_member) {
      $data[] = array(
                      'partner_id' => $r_member->partner_id,
                      'partner_status' =>  $r_member->partner_status,
                      'partner_nama'  => $r_member->partner_nama,
                      'partner_telepon' => $r_member->partner_telepon
                    );
    }

    echo json_encode($data);

  }

  function penjualan_details($id){
      $this->check_session();
      $priv = $this->cekUser(28);

      $select = 'a.*, b.partner_nama, c.*, SUM(d.barang_discount_nominal) as discountbarang';

      $table = 'tb_penjualan a';

      $join['data'][] = array(
            'table' => 'm_partner b',
            'join'	=> 'b.partner_id = a.customer',
            'type'	=> 'left'
          );

      $join['data'][] = array(
            'table' => 'tb_pengiriman c',
            'join'	=> 'c.penjualan_id = a.penjualan_id',
            'type'	=> 'left'
          );

      $join['data'][] = array(
            'table' => 'tb_penjualan_details d',
            'join'	=> 'd.penjualan = a.penjualan_id',
            'type'	=> 'left'
          );

      $where['data'][] = array(
        'column' => 'a.penjualan_id',
        'param'  => $id
      );

      $data = array(
        'aplikasi'		    => $this->app_name,
        'title_page' 	        => 'List Penjualan',
        'title_page2' 	    => 'Detil Penjualan',
        'penjualan_id'    => $id,
        'penjualan'     => $this->mod->select($select, $table, $join, $where, NULL, NULL, '')->row()
        );

      // echo $this->db->last_query();
      // die;
      $this->open_page('transaksi/penjualan/V_penjualan_details', $data);
    }

  function loadDatadetail($id)
    {
      $privPenjualan = $this->cekUser(76);
      $priv = $this->cekUser(76);
      $select = '*';
  		//LIMIT
  		$limit = array(
  			'start'  => $this->input->get('start'),
  			'finish' => $this->input->get('length')
  		);
      $where_like['data'][] = array(
  			'column' => 'cabang_nama, penjualan_code, penjualan_date, penjualan_total, penjualan_payment',
  			'param'	 => $this->input->get('search[value]')
  		);
      $where = array('penjualan_id' => $id );

      $query_total = $this->M_penjualan->select_transaction_details();
      $query = $this->M_penjualan->select_transaction_details($select, '', NULL, $where, NULL, $where_like, '');
      $query_filter = $this->M_penjualan->select_transaction_details($select, '', NULL, '', NULL, $where_like, '');

      if ($query<>false) {
        $no = $limit['start']+1;
        foreach ($query->result() as $val) {
          $button = '';
          $classdonebook = "blue-ebonyclay";
          if ($val->booking_status==2){$classdonebook="green-jungle";}

          if ($val->booking_status==1 || $val->booking_status==2){
      					$button = $button.'<button class="btn '.$classdonebook.'" type="button" id="btn_'.$val->penjualan_detail_id.'"
                                    data-penjualan-detail-id="" onclick="bookBtn('.$val->penjualan_detail_id.')" href="#modaladd">
                                    <i class="fa fa-book text-center"></i>
                                   </button>';
                }
          $response['data'][] = array(
            $no,
            $val->barang_nama,
            number_format($val->barang_price),
            number_format($val->barang_qty+$val->item_getFromGudang),
            number_format($val->barang_total),
            number_format($val->barang_discount_nominal),
            number_format($val->barang_grand_total),
            $button
          );

          $no++;
        }
      }

      // echo $this->db->last_query();

      $response['recordsTotal'] = 0;
  		if ($query_total<>false) {
  			$response['recordsTotal'] = $query->num_rows();
  		}
      echo json_encode($response);
    }

    function popmodal_form_login()
    {
      $data['action'] = "C_POS/checklogin";
      $this->load->view('transaksi/penjualan/popmodal_check_login', $data);
    }

    function popmodal_form_login3()
    {
      $data['action'] = "C_POS/checklogin";
      $this->load->view('transaksi/penjualan/popmodal_check_login3', $data);
    }

    function popmodal_form_login2($penjualanId)
    {
      $data['action'] = "C_POS/checklogin";
      $data['penjualan_id'] = $penjualanId;
      $this->load->view('transaksi/penjualan/popmodal_check_login2', $data);
    }

    function checklogin()
  	{
  		$user = $this->input->post('i_username', TRUE);
  		$pass = md5(base64_decode($this->input->post('i_password', TRUE)));
  		$user_data = $this->mod->check_exist_user($user,$pass);
		
  		if(!$user_data)
  		{
			$response['status'] = '204';
        }
		else 
		{
			$response['status'] = '200';
			$response['type_karyawan'] = $user_data->m_type_karyawan_id;
			
			$where = array('type_karyawan_id' => $user_data->m_type_karyawan_id);
			$checkkode = $this->mod->select_config_one("m_type_karyawan", "type_karyawan_maxdiskon as result", $where);
			$checkkode = $checkkode->result;
			
			$response['type_karyawan_maxdiskon'] = $checkkode;
		}

  		echo json_encode($response);
  	}

    function booking_popmodal($stok_display, $stok_gudang, $item_id, $status)
    {
      $where_barang_id = "WHERE a.barang_id = '$item_id'";
      $data = array(
                    'barang' => $this->M_penjualan->get_item($where_barang_id)->row(),
                    'action' => "C_POS/booking_storage",
                    'status' => $status,
                    'stockdisplay' => $stok_display
                  );

      $this->load->view('transaksi/penjualan/booking_modal', $data);
    }

    function update_book()
    {
      $penjualan_detail_id = $_POST['id'];
      $where_penjualan_detail_id = array('penjualan_detail_id' => $penjualan_detail_id);
      $data_update = array('booking_status' => 2);
      $this->update_config('tb_penjualan_details', $data_update, $where_penjualan_detail_id);

      echo json_encode($penjualan_detail_id);
    }

    function getfromGudang(){
      // $data = array('action' => 'C_POS/save', );
      $this->load->view('transaksi/penjualan/getfromGudang');
    }

      public function loaddatakasir(){
    		$param = $this->input->get('q');
    		if ($param!=NULL) {
    			$param = $this->input->get('q');
    		} else {
    			$param = "";
    		}
    		$select = 'a.*, b.*';

        $join['data'][] = array(
          'table' => 'm_karyawan b',
          'join'  => 'b.karyawan_id = a.m_karyawan_id',
          'type'  => 'left'
        );

        $where['data'][] = array(
    			'column' => 'b.m_type_karyawan_id',
    			'param'	 => '11'
    		);

    		$where['data'][] = array(
    			'column' => 'b.karyawan_status_aktif',
    			'param'	 => 'y'
    		);

    		$where_like['data'][] = array(
    			'column' => 'b.karyawan_nama',
    			'param'	 => $this->input->get('q')
    		);

    		$query = $this->mod->select($select, 's_user a', $join, $where, NULL, $where_like);
    		$response['items'] = array();
    		if ($query<>false) {
    			foreach ($query->result() as $val) {
    					$response['items'][] = array(
    						'id'	=> $val->user_id,
    						'text'	=> $val->karyawan_nama
    					);
    			}
    			$response['status'] = '200';
    		}
        // echo $this->db->last_query();
    		echo json_encode($response);
    	}

      public function loadcabang(){
        $param = $this->input->get('q');
        if ($param!=NULL) {
          $param = $this->input->get('q');
        } else {
          $param = "";
        }
        $select = 'a.*, b.*';

        $join['data'][] = array(
          'table' => 'm_karyawan b',
          'join'  => 'b.karyawan_id = a.m_karyawan_id',
          'type'  => 'left'
        );

        $where['data'][] = array(
          'column' => 'm_type_karyawan_id',
          'param'	 => '11'
        );

        $where['data'][] = array(
          'column' => 'karyawan_status_aktif',
          'param'	 => 'y'
        );

        $where_like['data'][] = array(
          'column' => 'user_username',
          'param'	 => $this->input->get('q')
        );

        $query = $this->mod->select($select, 's_user a', $join, $where, NULL, $where_like);
        $response['items'] = array();
        if ($query<>false) {
          foreach ($query->result() as $val) {
              $response['items'][] = array(
                'id'	=> $val->user_id,
                'text'	=> $val->user_username
              );
          }
          $response['status'] = '200';
        }
        // echo $this->db->last_query();
        echo json_encode($response);
      }

      function loaddatawhere(){
        $tanggal = $this->input->post('daterange');
        $i_kasir = $this->input->post('i_kasir');
        $table   =  'tb_penjualan a';
        $select  = 'SUM(a.penjualan_grand_total) as grandtotal, SUM(b.barang_qty) as totalitem';
        if (!$i_kasir) {
          $i_kasir = NULL;
        }

        if (!$tanggal) {
          $tanggal = NULL;
        }

        $join['data'][] = array(
          'table' => 'tb_penjualan_details b',
          'join'  => 'b.penjualan = a.penjualan_id',
          'type'  => 'left'
        );

        $where2 = "";
        if ($i_kasir) {
          $where2['data'][] = array(
            'column' => 'user',
            'param'	 => $i_kasir
          );
        }

        $where2['data'][] = array(
          'column' => 'a.status',
          'param'	 => 0
        );

        $where = array('a.status' => 0);

        $group_by = "";

       $select2 = "COUNT(a.penjualan_id) as jmlpenjualan";
      //  $table  = 'tb_penjualan a';
       $query2  = $this->M_penjualan->select2($select2, $table, $where);
       $row2 = $query2->row();

        $penjualan = $this->mod->select($select, $table, $join, $where2)->row();

        $data = array(
          'jmlpenjualan'  => $row2->jmlpenjualan,
          'grandtotal'    => $penjualan->grandtotal,
          'totalitem'     => $penjualan->totalitem
        );
        // echo $this->db->last_query();
        echo json_encode($data);
      }

  function getsummarydata(){

    $datarange  = $this->input->post('daterange');

    if ($datarange) {
      $tanggal = explode("-", $datarange);
      $date1 = $tanggal[0];
      $date2 = $tanggal[1];

      $date1 = str_replace("/","-", $date1);
      $date2 = str_replace("/","-", $date2);
      $date1 = date("Y-m-d H:m:s", strtotime($date1));
      $date2 = date("Y-m-d H:m:s", strtotime($date2));

    } else {
      $date1 = $this->input->post('date1');
      $date2 = $this->input->post('date2');
    }

    $user_id = $this->input->post('user_id');
    $select  = "SUM(b.barang_qty) AS totalitem, SUM(b.item_getFromGudang) as item_getFromGudang";
    $select2 = "SUM(a.penjualan_grand_total) as grandtotal, COUNT(a.penjualan_id) as jmlpenjualan";
    $table  = 'tb_penjualan a';
    $where ="";

    if ($date1) {

      if ($user_id) {
        $where = array(
          'a.penjualan_date >=' => $date1,
          'a.penjualan_date <=' => $date2,
          'a.user =' => $user_id,
          'a.status ' => 0
        );
      } else {
        $where = array(
          'a.penjualan_date >=' => $date1,
          'a.penjualan_date <=' => $date2,
          'a.status ' => 0
         );
      }

    } else if ($user_id){
      $where = array('a.user =' => $user_id,
                     'a.status ' => 0);
    }

    $query  = $this->M_penjualan->select2($select, $table, $where, '1');
    $query2  = $this->M_penjualan->select2($select2, $table, $where);

    $row = $query->row();
    $row2 = $query2->row();

    $data = array(
      'jmlpenjualan'  => $row2->jmlpenjualan,
      'grandtotal'    => $row2->grandtotal,
      'totalitem'     => $row->totalitem+$row->item_getFromGudang
    );
    echo json_encode($data);
  }

  function getPromo(){
    $select = "a.*";
    $table = "m_promo a";

    $where['data'][] = array(
            'column' => 'promo_status_aktif',
            'param'	 => 'y'
          );
    $qpromo = $this->M_penjualan->select_promo();
    $data = array();
    foreach ($qpromo->result() as $key) {
      // if ($key->promo_datestart <= date("Y-m-d") && $key->promo_dateend >= date("Y-m-d")) {
        $data['promo'][] = array(
          'promo_id'          => $key->promo_id,
          'promo_nama'        => $key->promo_nama,
          'promo_qty'         => $key->promo_qty,
          'promo_harga'       => $key->promo_harga,
          'jmlpromodetail'    => $key->jml
        );
      // }
    }

    $selectpromo = "a.*, b.*";
    $tablepromodetail = "m_promo a";
    $join['data'][] = array(
      'table' => 'm_promodetail b',
      'join'  => 'b.promo = a.promo_id',
      'type'  => 'left'
    );

    $wherepromoaktif['data'][] = array(
            'column' => 'promo_status_aktif',
            'param'	 => 'y'
          );

    $qpromodetail = $this->M_penjualan->select_promodetail();
    foreach ($qpromodetail->result() as $rowdetail) {
      $data['promo_detail'][] = array(
        'promo_id'          => $rowdetail->promo,
        'promo_item_id'     => $rowdetail->promo_item_id,
        'promo_item_qty'    => $rowdetail->promo_item_qty,
        'jmlpromodetail'    => $rowdetail->jml
      );
    }

    echo json_encode($data);
  }

  function cancelPenjualan(){
    $penjualan_id = $this->input->post('penjualan_id');
    $table  = "tb_penjualan a";
    $select = "a.*, b.*, c.cabang_gudangdisplay, c.cabang_id, d.gudang_id";
    $join['data'][] = array(
			'table' => 'tb_penjualan_details b',
			'join'	=> 'b.penjualan = a.penjualan_id',
			'type'	=> 'left'
		);

    $join['data'][] = array(
			'table' => 'm_cabang c',
			'join'	=> 'c.cabang_id = a.branch',
			'type'	=> 'left'
		);

    $join['data'][] = array(
			'table' => 'm_gudang d',
			'join'	=> 'd.m_cabang_id = c.cabang_id',
			'type'	=> 'left'
		);

    $where['data'][] = array(
      'column'  => 'a.penjualan_id',
      'param'   => $penjualan_id
    );

    $qPenjualan = $this->M_penjualan->selectpenjualan($select, $penjualan_id);
    foreach ($qPenjualan->result() as $key => $value) {
      $data['barang'][] = array(
        'barang_id'   => $value->barang,
        'barang_qty'  => $value->barang_qty,
        'barangGetfromgudang' => $value->item_getFromGudang
      );

      $data['cabang'][] = array(
        'cabang' => $value->branch,
        'cabang' => $value->cabang_gudangdisplay
      );

      $data_pengurangan = array(
        'hapuspenjualan_date' => date("Y-m-d H:m:s"),
        'cabang'            => $value->cabang_id,
        'gudang'            => $value->gudang_id,
        'penjualan'         => $penjualan_id,
        'penjualan_detail'  => $value->penjualan_detail_id,
        'barang'            => $value->barang,
        'barangqty'         => $value->barang_qty,
        'barangqtygudang'   => $value->item_getFromGudang
      );

      $insert = $this->mod->insert_data_table('hapus_penjualan', NULL, $data_pengurangan);
    }
    if ($insert->status) {
      $response['status'] = '200';
    } else {
      $response['status'] = '204';
    }
    echo json_encode($response);
  }

  function getkodegenerate($tgl_penjualan){
    $newpenjualan_id = 1;
    $tgl_penjualan = date("Y-m-d", strtotime($tgl_penjualan));
    $where = array('penjualan_date' => $tgl_penjualan);
    $checkkode = $this->mod->select_config_one("tb_penjualan", "MAX(penjualan_id) as result", $where);
    $checkkode = $checkkode->result + 1;
    if ($checkkode) {
      $newpenjualan_id = $checkkode;
    }
    if ($newpenjualan_id < 10 ) {
      $newpenjualan_id = "000".$newpenjualan_id;
    } elseif ($newpenjualan_id < 100 ) {
      $newpenjualan_id = "00".$newpenjualan_id;
    } elseif ($newpenjualan_id < 1000 ) {
      $newpenjualan_id = "0".$newpenjualan_id;
    } else {
      $newpenjualan_id = $newpenjualan_id;
    }
    return $newpenjualan_id;
  }

  function getkategori(){
      $q_kategori = $this->mod->select_config("m_category_2", "")->result();
    $data = array();
    foreach ($q_kategori as $key => $value) {
      $data[] = array(
        'kategori_id'   => $value->category_2_id,
        'kategori_name' => $value->category_2_nama
      );
    }
    echo json_encode($data);

  }

  function getEdc(){
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
    $data = array();
    $user = $this->mod->select($select, $tableuser, $join, $where)->row();
    $cabang = $user->m_cabang_id;
    $where  = "WHERE edc_cabang = '$cabang'";
    $q_edc  = $this->mod->select_config("m_edc", $where);
    foreach ($q_edc->result() as $key => $value) {
      $data[] = array(
        'data_id'   => $value->edc_id,
        'data_nama' => $value->edc_nama
      );
    }
    echo json_encode($data);
  }

}
