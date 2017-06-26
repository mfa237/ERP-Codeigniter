<?php

/**
 * @property  M_base_config $M_base_config
 * @property  base_config $base_config
 * @property  Ion_auth|Ion_auth_model $ion_auth
 * @property  CI_Lang $lang
 * @property  CI_URI $uri
 * @property  CI_DB_query_builder|CI_DB_mysqli_driver $db
 * @property  CI_Config $config
 * @property  CI_Input $input
 * @property  CI_User_agent $agent
 * @property  Item_model Item_model
 */
class Front extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('Item_model');
    }

    public function change_customer($sales_id, $customer_id)
    {
        $data = array(
            'customer_id' => $customer_id,
        );

        $this->db->where('sales_id', $sales_id);
        return $this->db->update('tb_sales', $data);
    }

    public function get_recent_item()
    {
        $tmp = [];
        $this->db->join('tb_master_item','tb_master_item.item_id=tb_sales_detail.item_id');
        $this->db->join('tb_inventory','tb_inventory.item_id=tb_sales_detail.item_id');
        $this->db->where('tb_inventory.outlet_id', $this->outlet());
        $this->db->where('inventory_stok >', 0);
        $this->db->order_by('item_name', 'asc');
        $this->db->group_by('tb_sales_detail.item_id');
        $results = $this->db->get('tb_sales_detail', 10);
        foreach ($results->result_array() as $item) {
            $price = $this->Item_model->get_price($this->outlet(), $item['item_id']);
            $price_outlet = $price['outlet'];
            $price_sales = $price['sales'];
            $promo = $this->Item_model->get_promo($item['item_id'], null, $this->outlet());
            if( $price_outlet > 0 && $price_sales > 0 ){
                $tmp[] = [
                    'item_disc' => 0,
                    'item_disc_percent' => 0,
                    'inventory_stok' => $item['inventory_stok'],
                    'inventory_expired' => $this->M_base_config->my_date($item['inventory_expired']),
                    'inventory_price_sales' => $price_sales,
                    'inventory_price_outlet' => $price_outlet,
                    'inventory_price_real' => $this->Item_model->get_price_real($item['item_id'], $item['inventory_expired']),
                    'item_id' => $item['item_id'],
                    'inventory_id' => $item['inventory_id'],
                    'item_name' => $item['item_name'],
                    'has_promo' => $promo['has_promo'],
                    'promo_type' => $promo['type'],
                    'promo_item_name' => $promo['item_name'],
                    'promo_item_id' => $promo['item_id'],
                    'promo_gratis' => $promo['gratis'],
                    'promo_qty' => $promo['item_qty'],
                ];
            }
        }
        return $tmp;
    }

    public function get_customer( $id=null )
    {
        if ($id) {
            $this->db->where('customer_id', $id);
        }
        return $this->db->get('tb_customer')->result();
    }

	public function getPromo($item_id, $qty){
		$this->db->where( 'item_id', $item_id );
        $this->db->where( 'item_promo_qty <= '.$qty);
        $this->db->where( 'outlet_id', $this->session->userdata('outlet_id'));
        $this->db->where( "'".date("Y-m-d")."' BETWEEN item_promo_date_start and item_promo_date_end");
        $result = $this->db->get('tb_item_promo');
		return $result;
	}
	public function getInvo($id){
		$this->db->select('tsd.*, tmi.item_name');
		$this->db->from('tb_sales_detail tsd');
		$this->db->join('tb_master_item tmi', 'tsd.item_id = tmi.item_id');
		$this->db->where('tsd.sales_id', base64_decode($id));
		$query = $this->db->get();
		
		return $query->result();
	}
	public function getHeadInvo($id){
		//$this->db->select('ts.sales_dp, ts.sales_discount, ts.sales_date, ts.sales_total, ts.sales_pay, ts.sales_cashback, tu.first_name');
		$this->db->select('*');
		$this->db->from('tb_sales ts');
		$this->db->join('tb_user tu', 'ts.user_id = tu.id');
		$this->db->where('ts.sales_id', base64_decode($id));
		$query = $this->db->get();
		
		return $query->row();
	}

	protected function outlet()
    {
        return $this->session->userdata('outlet_id');
    }
}
