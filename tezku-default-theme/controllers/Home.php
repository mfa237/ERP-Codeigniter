<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @property  M_base_config M_base_config
 * @property  base_config $base_config
 * @property  Ion_auth|Ion_auth_model $ion_auth
 * @property  CI_Lang $lang
 * @property  CI_URI $uri
 * @property  CI_DB_query_builder|CI_DB_mysqli_driver $db
 * @property  CI_Config $config
 * @property  CI_Input $input
 * @property  CI_User_agent $agent
 * @property  Front $Front
 * @property CI_Form_validation $form_validation
 * @property CI_Session session
 * @property Stok_model Stok_model
 * @property Item_model Item_model
 */
class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Front');
        $this->load->model('Item_model');
        $this->load->model('Stok_model');
    }

    public function _remap()
    {
        $segment_1 = $this->uri->segment(1);
        $segment_2 = $this->uri->segment(2);
        $segment_3 = $this->uri->segment(3);
        //$segment_4 = $this->uri->segment(4);
        //$segment_5 = $this->uri->segment(5);
        //$segment_6 = $this->uri->segment(6);
        //$segment_7 = $this->uri->segment(7);
        switch ($segment_1) {
            case null:
            case false:
            case '':
                $this->index();
                break;
            case 'pos':
                $this->pos();
                break;
			case 'invo':
                $this->invo($segment_2);
                break;
            case 'ajax':
                $this->ajax();
                break;
            case 'customers':
                $this->get_customers();
                break;
            case 'items':
                $this->get_items();
                break;
            case 'roti_diskon':
                $this->get_roti_diskon();
                break;
            case 'recent-items':
                $this->get_recent_items();
                break;
            case 'get_biayatambahan':
                $this->get_biayatambahan($segment_2,$segment_3);
                break;
            default:
                show_404();
                break;
        }
    }

    public function index()
    {
        redirect( base_url('cms'), 'refresh' );
    }

    public function get_biayatambahan($type_pembayaran, $nominal){
       
        $this->db->where("jenis",strtoupper($type_pembayaran));

        $this->db->where("range_awal <= ", $nominal);
        $this->db->where("range_akhir >=",$nominal);

        $r = $this->db->get("tb_jenis_pembayaran");
        
        if ($r->num_rows() > 0){
            $r = $r->row();
            echo $r->persentase;
        }else{
            echo "0";
        }
    }

    public function pos()
    {
        $this->M_base_config->cekaAuth();
        if( $this->base_config->groups_access_sigle('menu','penjualan') ) show_404();
        $user = $this->ion_auth->user()->row();
        $outlets = $this->M_base_config->get_current_outlet();
        $data['outlets'] = $outlets;
        $data['outlet_id'] = $outlets['id'];
        $data['outlet_name'] = $outlets['value'];
        $data['store_name'] = $outlets['value'];
        $data['user_name'] = $user->username;
        $data['customer_name'] = 'UMUM';
        $data['all_sales'] = 0;
        $data['sales_discount'] = 0;
        $data['sales_id'] = 1;
        $data['setting_sales'] = $this->M_base_config->getSetting('setting_sales');
        $data['path'] = $this->base_config->asset_front();
        $data['theme_path'] = $this->base_config->asset_back();
        $this->load->view('_v_body', $data);
    }

    public function ajax()
    {
        if (!$this->ion_auth->logged_in()) {
            echo json_encode(array('status' => 0, 'message' => 'Harus login untuk mengakses halaman ini'));
            exit();
        }

        $user = $this->ion_auth->user()->row();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>');
        $this->form_validation->set_rules('sales_shift', 'Shift', 'required');
        $this->form_validation->set_rules('customer_id', 'Customer', 'required');
        $this->form_validation->set_rules('sales_pay', 'Bayar', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['status'] = 0;
            $data['message'] = validation_errors();
            echo json_encode($data);
            exit();
        } else {
            $qty_s = $this->input->post('item_qty');
            $item_s = $this->input->post('item_id');
            $discount_s = $this->input->post('item_discount');
            $discount_nota = $this->number($this->input->post('sales_discount'));
            $sales_pay = $this->number($this->input->post('sales_pay'));
            $sales_type = $this->input->post('sales_type');
            $customer_id = $this->input->post('customer_id');
            $sales_dp = $this->number($this->input->post('sales-dp'));
            $sales_nama = $this->input->post('sales-nama');
            $sales_nomor_kartu = $this->input->post('sales-nomor-kartu');
            $sales_nama_bank = $this->input->post('sales-nama-bank');
            $sales_nomor_rekening = $this->input->post('sales-nomor-rekening');
            $setting_sales = $this->M_base_config->getSetting('setting_sales');
            $sales_fee_persen = $setting_sales['sales_charge_kartu_kredit'];
            $sales_fee = 0;
            $sales_fee_batas = $setting_sales['sales_batas_kartu_kredit'];
            $sales_cashback = 0;
            $all_total_after_discount = 0;
            $all_total_before_discount = 0;
            $discount_product_total = 0;
            $discount_nota_total = 0;

            foreach ($item_s as $key => $inv_id) {
                $discount_product = $this->number($discount_s[$key]);
                $this->db->join('tb_master_item','tb_master_item.item_id=tb_inventory.item_id');
                $this->db->where('outlet_id', $this->outlet_id());
                $this->db->where('inventory_id', $inv_id);
                $result = $this->db->get('tb_inventory');
                $item_id = $result->row('item_id');
                $price = $this->Item_model->get_price( $this->outlet_id(), $item_id )['sales'];
                $total_after_discount = ( $price - $discount_product ) * (int)$qty_s[$key];
                $total_before_discount = $price * (int)$qty_s[$key];
                $all_total_after_discount += $total_after_discount;
                $all_total_before_discount += $total_before_discount;
                $discount_product_total += $discount_product;
            }

            if( $discount_nota > 0 ) $discount_nota_total += $discount_nota;
            $discount_total = $discount_nota_total + $discount_product_total;
            $all_total_after_discount = $all_total_before_discount - $discount_total;

            if( $sales_type == 'cash' ){
                $sales_lunas = 'YA';
                $sales_cashback = $sales_pay - ($all_total_after_discount);
                $sales_nama = '';
                $sales_nomor_kartu = '';
                $sales_nama_bank = '';
                $sales_nomor_rekening = '';

                $this->db->where("jenis","CASH");
                $this->db->where("range_awal <=",$all_total_after_discount);
                $this->db->where("range_akhir >=",$all_total_after_discount);
                $biaya_tambahan = $this->db->get("tb_jenis_pembayaran");

                if ($biaya_tambahan->num_rows() > 0){
                    $sales_fee = $biaya_tambahan->row()->persentase;
                    $sales_fee = $sales_fee / 100 * $all_total_after_discount;

                    $sales_cashback = $sales_pay - ($all_total_after_discount + $sales_fee);
                }
            }else if( $sales_type == 'kredit' ){
                $this->db->where("jenis","KREDIT");
                $this->db->where("range_awal <=",$all_total_after_discount);
                $this->db->where("range_akhir >=",$all_total_after_discount);
                $biaya_tambahan = $this->db->get("tb_jenis_pembayaran");

                if ($biaya_tambahan->num_rows() > 0){
                    $sales_fee = $biaya_tambahan->row()->persentase;
                    $sales_fee = $sales_fee / 100 * $all_total_after_discount;

                }


                if ($sales_dp >= $all_total_after_discount + $sales_fee){

                    $sales_lunas = 'YA';
                }else{

                    $sales_lunas = 'TIDAK';
                }
                $sales_pay = 0;
                $sales_nama = '';
                $sales_nomor_kartu = '';
                $sales_nama_bank = '';
                $sales_nomor_rekening = '';



            }else if ($sales_type == 'debit' ) {
                $this->db->where("jenis","KREDIT");
                $this->db->where("range_awal <=",$all_total_after_discount);
                $this->db->where("range_akhir >=",$all_total_after_discount);
                $biaya_tambahan = $this->db->get("tb_jenis_pembayaran");

                if ($biaya_tambahan->num_rows() > 0){
                    $sales_fee = $biaya_tambahan->row()->persentase;
                    $sales_fee = $sales_fee / 100 * $all_total_after_discount;

                }


                
                $sales_lunas = 'YA';
               
                $sales_pay = 0;
                $sales_nama = '';
                $sales_nomor_kartu = '';
                $sales_nama_bank = '';
                $sales_nomor_rekening = '';

            }else if( $sales_type == 'transfer' ){
                $sales_lunas = 'YA';
                $sales_pay = 0;
                $sales_nomor_kartu = '';

                $this->db->where("jenis","TRANSFER");
                $this->db->where("range_awal <=",$all_total_after_discount);
                $this->db->where("range_akhir >=",$all_total_after_discount);
                $biaya_tambahan = $this->db->get("tb_jenis_pembayaran");

                if ($biaya_tambahan->num_rows() > 0){
                    $sales_fee = $biaya_tambahan->row()->persentase;
                    $sales_fee = $sales_fee / 100 * $all_total_after_discount;

                }


            }else if( $sales_type == 'kartu_kredit' ){
                $sales_lunas = 'YA';
                $sales_pay = 0;
                
                $this->db->where("jenis","KARTU_KREDIT");
                $this->db->where("range_awal <=",$all_total_after_discount);
                $this->db->where("range_akhir >=",$all_total_after_discount);
                $biaya_tambahan = $this->db->get("tb_jenis_pembayaran");

                if ($biaya_tambahan->num_rows() > 0){
                    $sales_fee = $biaya_tambahan->row()->persentase;
                    $sales_fee = $sales_fee / 100 * $all_total_after_discount;

                }

                $sales_nomor_rekening = '';
            }else{
                $sales_lunas = 'TIDAK';
            }

            $data_sales = array(
                'sales_nama'                    => $sales_nama,
                'sales_nomor_kartu'             => $sales_nomor_kartu,
                'sales_nama_bank'               => $sales_nama_bank,
                'sales_nomor_rekening'          => $sales_nomor_rekening,
                'sales_dp'                      => $sales_dp,
                'sales_fee'                     => $sales_fee,
                'sales_lunas'                   => $sales_lunas,
                'sales_type'                    => $sales_type,
                'sales_date'                    => date('Y-m-d H:i:s'),
                'customer_id'                   => $customer_id,
                'user_id'                       => $user->id,
                'outlet_id'                     => $this->outlet_id(),
                'sales_total'                   => $all_total_after_discount+$sales_fee,
                'sales_cashback'                => $sales_cashback,
                'sales_pay'                     => $sales_pay,
                'sales_total_before_discount'   => $all_total_before_discount,
                'sales_discount_total'          => $discount_total,
                'sales_discount'                => $discount_nota_total,
                'sales_disc_product'            => $discount_product_total
            );
            $this->db->insert('tb_sales', $data_sales);
            $sales_id = $this->db->insert_id();

            $sales_nota = 'PJ-'.sprintf("%04s", $sales_id);
            $this->db->set("sales_nota",$sales_nota);
            $this->db->where("sales_id",$sales_id);
            $this->db->update("tb_sales");

            if( $sales_type == 'kredit' ){
                $data_kredit = [
                    'jenis' => 'penjualan',
                    'sales_id' => $sales_id,
                    'dp' => $sales_dp,
                    'nota' => 'PJ-'.sprintf("%04s", $sales_id),
                    'jumlah_hutang' => $all_total_after_discount+$sales_fee,
                    'tanggal' => date('Y-m-d'),
                    'jatuh_tempo' => date('Y-m-d'),
                    'customer_id' => $customer_id,
                ];
                $this->db->insert('tb_kredit', $data_kredit);
            }

            $data_sales_detail = array();
            foreach ($item_s as $key => $inv_id) {
                $discount_product = $this->number($discount_s[$key]);
                $this->db->join('tb_master_item','tb_master_item.item_id=tb_inventory.item_id');
                $this->db->where('outlet_id', $this->outlet_id());
                $this->db->where('inventory_id', $inv_id);
                $result = $this->db->get('tb_inventory',1);
                $item_id = $result->row('item_id');
                $expired = $result->row('inventory_expired');
                $price = $this->Item_model->get_price( $this->outlet_id(), $item_id )['sales'];
                $total = ($price - $discount_product) * (int)$qty_s[$key];
                $total_before_discount = $price * (int)$qty_s[$key];
                $data_sales_detail[] = array(
                    'sales_detail_price'    => $price,
                    'sales_detail_qty'      => $qty_s[$key],
                    'sales_detail_total'    => $total,
                    'sales_detail_disc'     => $discount_product,
                    'sales_id'              => $sales_id,
                    'item_id'               => $item_id,
                    'expired'               => $expired,
                    'sales_detail_total_before_discount' => $total_before_discount
                );
                $this->Stok_model->remove_inventory_outlet($this->outlet_id(), $item_id, $expired, $qty_s[$key]);

				//cekPromo
				// $promo = $this->Item_model->get_promo($item_id, null, $this->outlet_id());

				// //ifPromo
				// if($promo['has_promo']){
				// 	if($promo['type'] == 'item'){
    //                     $this->db->join('tb_master_item','tb_master_item.item_id=tb_inventory.item_id');
    //                     $this->db->where('outlet_id', $this->outlet_id());
    //                     $this->db->where('tb_inventory.item_id', $promo['item_id']);
    //                     $this->db->where('tb_inventory.inventory_stok >', '0');
    //                     $result = $this->db->get('tb_inventory',1);
    //                     $expired = $result->row('inventory_expired');
    //                     $price = $this->Item_model->get_price( $this->outlet_id(), $item_id )['sales'];

    //                     $qty = (int)$qty_s[$key];
    //                     $minimal_pembelian = (int)$promo['item_qty'];
    //                     $gratis = (int)$promo['gratis'];
    //                     $kelipatan = floor($qty/$minimal_pembelian);
    //                     $jumlah_gratis = $gratis*$kelipatan;

    //                     if( $jumlah_gratis > 0 ){
    //                         $data_sales_detail[] = array(
    //                             'sales_detail_price'    => $price,
    //                             'sales_detail_qty'      => $jumlah_gratis,
    //                             'sales_detail_total'    => 0,
    //                             'sales_detail_disc'     => $price,
    //                             'sales_id'              => $sales_id,
    //                             'item_id'               => $promo['item_id'],
    //                             'expired'               => $expired,
    //                             'sales_detail_total_before_discount' => $price*$jumlah_gratis
    //                         );
    //                         $this->Stok_model->remove_inventory_outlet($this->outlet_id(), $promo['item_id'], $expired, $jumlah_gratis);
    //                     }
				// 	}
				// }

            }

            $query = $this->db->insert_batch('tb_sales_detail', $data_sales_detail);
            if ($query) {
                echo json_encode(array('status' => 1, 'message' => 'Sukses', 'ids'=>base64_encode($sales_id) ));
                exit();
            } else {
                echo json_encode(array('status' => 0, 'message' => 'Proses gagal, silahkan ulangi lagi'));
                exit();
            }
        }
    }

	public function invo($id){
	    $data = $this->M_base_config->getSetting('setting_sales');

        $this->db->where("master_outlet_id",$this->session->userdata('outlet_id'));
        $outlet =  $this->db->get("tb_master_outlet")->row();

        $data['outlet']     = $outlet;

		$data["header"] = $this->Front->getHeadInvo($id);
		$data["data"] 	= $this->Front->getInvo($id);
		$this->load->view("_v_invo", $data);
	}
    protected function outlet_id()
    {
        return $this->session->userdata('outlet_id');
    }

    protected function number($string)
    {
        return intval(preg_replace('/[^\d.]/', '', $string ));
    }

    public function get_customers()
    {
        $data = $this->Front->get_customer();
        $this->json($data);
    }

    public function get_items()
    {
        
        $data = $this->Item_model->get_inventory_item( $this->outlet_id() );
        $this->json($data);
    }

    public function get_roti_diskon()
    {
        $this->db->where('tb_retur_detail.retur_detail_status', 'YA');
        $this->db->where('tb_retur.outlet_id', $this->session->userdata('outlet_id'));
        $this->db->like('master_category_name', 'Roti Diskon ', 'after');
        $this->db->join('tb_retur_detail', 'tb_retur_detail.retur_id = tb_retur.retur_id');
        $this->db->join('tb_master_item', 'tb_master_item.item_id = tb_retur_detail.item_id');
        $this->db->join('tb_master_category', 'tb_master_category.master_category_id = tb_master_item.item_category');
        $data = $this->db->get('tb_retur')->result();
        $this->json($data);
    }

    protected function json($data=[])
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    public function get_recent_items()
    {
        $data = $this->Front->get_recent_item();
        $this->json($data);
    }

}
