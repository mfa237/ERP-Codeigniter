<?php

/**
 * @property  M_base_config $M_base_config
 * @property  base_config $base_config
 * @property  Ion_auth|Ion_auth_model $ion_auth
 * @property  CI_Lang $lang
 * @property  CI_URI $uri
 * @property  CI_DB_query_builder $db
 * @property  CI_Config $config
 * @property  CI_Input $input
 * @property  CI_User_agent $agent
 * @property CI_Session session
 */
class M_base_config extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getData($param)
    {
        $data = '';
        if (array_key_exists('where', $param)) {
            for ($i = 0; $i < count($param['where']); $i++) {
                $this->db->where($param['where'][$i]['wherefield'], $param['where'][$i]['where_value']);
            }
        }
        $query = $this->db->order_by($param['nm_sort'], $param['sort'])
            ->limit($param['limit'], $param['offset'])
            ->get($param['table']);
        if ($query) {
            $data = $query->result();
        } else {
            $data = '';
        }
        return $data;
    }

    public function getSimpleData($param)
    {
        $tmp = '';
        if (array_key_exists('where', $param)) {
            for ($i = 0; $i < count($param['where']); $i++) {
                $this->db->where($param['where'][$i]['wherefield'], $param['where'][$i]['where_value']);
            }
        }
        $query = $this->db->get($param['table']);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $val) {
                $tmp = $val->$param['return'];
            }
            return $tmp;
        }
    }

    public function countDatamultiple($param)
    {
        if (array_key_exists('where', $param)) {
            for ($i = 0; $i < count($param['where']); $i++) {
                $this->db->where($param['where'][$i]['wherefield'], $param['where'][$i]['where_value']);
            }
        }
        return $this->db->count_all_results($param['table']);
    }

    public function getSingleSetting($jenis, $nama)
    {
        $this->db->where('setting_type', $jenis);
        $this->db->where('setting_name', $nama);
        $query = $this->db->get('tb_setting');
        if ($query)
            $row = $query->row();
        if ($row) {
            $data = $row->setting_value;
        } else {
            $data = '';
        }
        return $data;
    }

    public function getSetting($jenis)
    {
        $tmp = [];
        $this->db->where('setting_type', $jenis);
        $query = $this->db->get('tb_setting');
        foreach ($query->result_array() as $item) {
            $tmp[$item['setting_desc']] = $item['setting_value'];
        }
        return $tmp;
    }

    public function getMultiSetting($jenis, $nama)
    {
        if (!empty($nama))
            $this->db->where_in('setting_name', $nama);

        $this->db->where('setting_typ', $jenis);
        $query = $this->db->get('tb_setting');
        if ($query) {
            $data = $query->result();
        } else {
            $data = '';
        }
        return $data;
    }

    public function cekaAuth()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('cms/auth', 'refresh');
        }
    }

    public function ifLogin()
    {
        if ($this->ion_auth->logged_in()) {
            redirect('cms', 'refresh');
        }
    }

    public function countData($table, $where, $where_value)
    {
        return $this->db
            ->where($where, $where_value)
            ->get($table)
            ->num_rows();
    }

    public function search($param)
    {
        $data = '';
        if (array_key_exists('where', $param)) {
            for ($i = 0; $i < count($param['where']); $i++) {
                $this->db->where($param['where'][$i]['wherefield'], $param['where'][$i]['where_value']);
            }
        }
        if (array_key_exists('match', $param)) {
            for ($i = 0; $i < count($param['match']); $i++) {
                $this->db->where('MATCH (' . $param['match'][$i]['matchfield'] . ') AGAINST ("' . $param['match'][$i]['match_value'] . '")', NULL, FALSE);

            }
        }
        $query = $this->db->order_by($param['nm_sort'], $param['sort'])
            ->limit($param['limit'], $param['offset'])
            ->get($param['table']);
        if ($query->num_rows() > 0) {
            $data = $query->result();
        } else {
            if (array_key_exists('where', $param)) {
                for ($i = 0; $i < count($param['where']); $i++) {
                    $this->db->where($param['where'][$i]['wherefield'], $param['where'][$i]['where_value']);
                }
            }
            if (array_key_exists('match', $param)) {
                for ($i = 0; $i < count($param['match']); $i++) {
                    $this->db->like($param['match'][$i]['matchfield'], $param['match'][$i]['match_value']);
                }
            }
            $query = $this->db->order_by($param['nm_sort'], $param['sort'])
                ->limit($param['limit'], $param['offset'])
                ->get($param['table']);
            $data = $query->result();
        }
        return $data;
    }

    public function countSearch($param)
    {
        $data = '';
        if (array_key_exists('where', $param)) {
            for ($i = 0; $i < count($param['where']); $i++) {
                $this->db->where($param['where'][$i]['wherefield'], $param['where'][$i]['where_value']);
            }
        }
        if (array_key_exists('match', $param)) {
            for ($i = 0; $i < count($param['match']); $i++) {
                $this->db->where('MATCH (' . $param['match'][$i]['matchfield'] . ') AGAINST ("' . $param['match'][$i]['match_value'] . '")', NULL, FALSE);
            }
        }
        $query = $this->db->get($param['table']);
        if ($query->num_rows() > 0) {
            $data = $query->num_rows();
        } else {
            if (array_key_exists('match', $param)) {
                for ($i = 0; $i < count($param['match']); $i++) {
                    $this->db->like($param['match'][$i]['matchfield'], $param['match'][$i]['match_value']);
                }
            }
            $query = $this->db->get($param['table']);
            $data = $query->num_rows();
        }
        return $data;
    }

    //Record Notification
    public function insertnotif($data = array())
    {
        $user_notification = array(
            "notification_type" => $data['type'],
            "notification_user" => $data['user'],
            "notification_parent" => $data['parent'],
            "notification_link" => $data['link'],
            "notification_desc" => $data['desc'],
            "notification_status" => 'active',
            "notification_icon" => $data['icon'],
            "notification_date" => date('Y-m-d H:i:s')
        );
        $this->db->insert('tb_notification', $user_notification);
    }

    public function my_date($date=null)
    {
        if(!$date) $date=date('Y-m-d');
        return date('d/m/Y', strtotime($date));
    }

    public function get_my_outlet()
    {
        $user_id = $this->ion_auth->user()->row()->id;
        $result = $this->db->select('category_id')->where('terms_type','user_outlet')->where('post_id', $user_id)->get('tb_terms')->result();

        $ids = array();
        $arr = array();
        if( !$this->ion_auth->is_admin() ){
            foreach ($result as $value){
                $ids[] = $value->category_id;
            }
            $this->db->where_in('master_outlet_id', $ids);
            $outlet_result = $this->db->get('tb_master_outlet')->result();
        }else{
            $outlet_result = $this->db->get('tb_master_outlet')->result();
        }
        
        foreach ($outlet_result as $value){
            $arr[] = array(
                'id' => $value->master_outlet_id,
                'value' => $value->master_outlet_name
            );
        }
        return $arr;
    }

    public function get_current_outlet()
    {
        $arr = [];
        $this->db->where('master_outlet_id', $this->session->userdata('outlet_id'));
        $outlet_result = $this->db->get('tb_master_outlet',1)->result();
        foreach ($outlet_result as $value){
            $arr = array(
                'id' => $value->master_outlet_id,
                'value' => $value->master_outlet_name
            );
        }
        return $arr;
    }

    public function increase_stok_item($outlet_id,$item_id,$jumlah=1)
    {
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('item_id', $item_id);
        $stok = (int)$this->db->get('tb_inventory')->row('inventory_stok');
        $stok+=(int)$jumlah;
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('item_id', $item_id);
        return $this->db->update('tb_inventory', ['inventory_stok' => $stok]);
    }

    public function decrease_stok_item($outlet_id,$item_id,$jumlah=1)
    {
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('item_id', $item_id);
        $stok = (int)$this->db->get('tb_inventory')->row('inventory_stok');
        $stok-=(int)$jumlah;
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('item_id', $item_id);
        return $this->db->update('tb_inventory', ['inventory_stok' => $stok]);
    }

    public function increase_stok_dapur($item_id,$jumlah=1)
    {
        $this->db->where('item_id', $item_id);
        $stok = (int)$this->db->get('tb_master_item')->row('item_stok');
        $stok+=(int)$jumlah;
        $this->db->where('item_id', $item_id);
        return $this->db->update('tb_master_item', ['item_stok' => $stok]);
    }

    public function decrease_stok_dapur($item_id,$jumlah=1)
    {
        $this->db->where('item_id', $item_id);
        $stok = (int)$this->db->get('tb_master_item')->row('item_stok');
        $stok-=(int)$jumlah;
        $this->db->where('item_id', $item_id);
        return $this->db->update('tb_master_item', ['item_stok' => $stok]);
    }

    public function get_customer()
    {
        $tmp = $this->db->get('tb_customer')->result_array();
        foreach ($tmp as $key => $item) {
            $tmp[$key]['customer_name_phone'] = $item['customer_name'].' ('.$item['customer_phone'].')';
        }
        return $tmp;
    }

    public function get_supplier()
    {
        $tmp = $this->db->get('tb_supplier')->result_array();
        foreach ($tmp as $key => $item) {
            $tmp[$key]['supplier_name_phone'] = $item['supplier_name'].' ('.$item['supplier_phone'].')';
        }
        return $tmp;
    }

    public function tes($data=array())
    {
        echo '<pre>';
        echo print_r($data);
        echo '</pre>';
        exit();
    }

}
