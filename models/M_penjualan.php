<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penjualan extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_all_item_($cabang, $Gudangdisplay)
  {
    $query = $this->db->query("SELECT a.*, b.det_promo_status_aktif, c.*, IFNULL(f.stok_gudang_jumlah, 0) as stockgudang,
                                IFNULL(g.stok_gudang_jumlah, 0) as stockdisplay
                                FROM m_barang a
                                LEFT JOIN m_detail_promo b ON b.barang_id = a.barang_id
                                LEFT JOIN m_promo c ON c.promo_id = b.promo_id
                                left join (
                                	select a.stok_gudang_jumlah, a.m_barang_id from t_stok_gudang a
                                	left join m_gudang b on b.gudang_id = a.m_gudang_id
                                	where b.m_cabang_id = '$cabang'
                                	and b.gudang_id = '$Gudangdisplay'
                                	) as f on f.m_barang_id = a.barang_id
                                left join (
                                	select a.stok_gudang_jumlah, a.m_barang_id from t_stok_gudang a
                                	left join m_gudang b on b.gudang_id = a.m_gudang_id
                                	where b.m_cabang_id = '$cabang'
                                	and b.gudang_id != '$Gudangdisplay'
                                	) as g on g.m_barang_id = a.barang_id");
    return $query;
  }

   function get_all_item($cabang, $Gudangdisplay)
  {
    $query = $this->db->query("SELECT a.*, b.det_promo_status_aktif, c.*, IFNULL(g.stok_gudang_jumlah, 0) AS stockgudang FROM m_barang a LEFT JOIN m_detail_promo b ON b.barang_id = a.barang_id LEFT JOIN m_promo c ON c.promo_id = b.promo_id LEFT JOIN ( SELECT a.stok_gudang_jumlah, a.m_barang_id FROM t_stok_gudang a LEFT JOIN m_gudang b ON b.gudang_id = a.m_gudang_id
WHERE b.m_cabang_id = '$cabang' AND b.gudang_id != '$Gudangdisplay' ) AS g ON g.m_barang_id = a.barang_id");
    return $query;
  }

  function getgudangstok($barang_id, $gudang_id){
    $query = $this->db-query("select * from t_stok_gudang where m_barang_id = '$barang_id' and m_gudang_id = '$gudang_id'");
    return $query;
  }

  function get_item($where_barang_id){
    $query = $this->db->query("SELECT a.*, b.det_promo_status_aktif, c.*,
                              IFNULL(d.stok_gudang_jumlah, 0) AS stok_gudang_jumlah
                              FROM m_barang a
                              LEFT JOIN m_detail_promo b ON b.barang_id = a.barang_id
                              LEFT JOIN m_promo c ON c.promo_id = b.promo_id
                              LEFT JOIN t_stok_gudang d ON d.m_barang_id = a.barang_id
                              $where_barang_id
                               ");
    return $query;
  }

  function select_transaction($where=NULL)
  {
    $this->db->from('tb_penjualan');
    $this->db->select('tb_penjualan.*, m_cabang.cabang_nama, m_partner.partner_nama');
    $this->db->join('m_cabang', 'm_cabang.cabang_id = tb_penjualan.branch', 'left');
    $this->db->join('s_user', 's_user.user_id = tb_penjualan.user', 'left');
    $this->db->join('m_partner', 'm_partner.partner_id = tb_penjualan.customer', 'left');
    if ($where!=NULL) {
      $this->db->where($where);
    }
    // $this->db->group_by('tb_penjualan.penjualan_id');
    $query = $this->db->get();
    return $query;
  }

  function select2($select, $table, $where, $param = NULL){
    $this->db->select($select);
    $this->db->from($table);
    if ($param) {
      $this->db->join('tb_penjualan_details b', 'b.penjualan = a.penjualan_id', 'left');
    }
    if ($where!=NULL) {
      $this->db->where($where);
      }
    $query = $this->db->get();
    return $query;
  }

  function select_transaction_details($select = NULL, $table = NULL, $join = NULL, $where = NULL, $where2 = NULL, $like = NULL, $order = NULL, $limit = NULL)
  {
    $this->db->select('tb_penjualan.*, tb_penjualan_details.*, m_cabang.cabang_nama, m_barang.barang_nama');
    $this->db->from('tb_penjualan');
    $this->db->join('tb_penjualan_details', 'tb_penjualan_details.penjualan = tb_penjualan.penjualan_id', 'left');
    $this->db->join('m_cabang', 'm_cabang.cabang_id = tb_penjualan.branch', 'left');
    $this->db->join('s_user', 's_user.user_id = tb_penjualan.user', 'left');
    $this->db->join('m_partner', 'm_partner.partner_id = tb_penjualan.customer', 'left');
    $this->db->join('m_barang', 'm_barang.barang_id = tb_penjualan_details.barang', 'left');
    if ($where!=NULL) {
      $this->db->where($where);
    }
    $query = $this->db->get();
    return $query;
  }

  function getgudangCabang($cabang_id)
  {
    $query = $this->db->query("SELECT b.m_gudang_id, b.stok_gudang_jumlah FROM m_cabang a
                                LEFT JOIN t_stok_gudang b ON b.m_gudang_id != a.cabang_gudangdisplay
                                WHERE a.cabang_id ='$cabang_id'");
    return $query;
  }


  function getitemingudang($cabang, $barang_id){
    $query = $this->db->query("SELECT a.stok_gudang_jumlah AS result FROM t_stok_gudang a
                                LEFT JOIN m_gudang b ON b.gudang_id = a.m_gudang_id
                                LEFT JOIN m_cabang c ON c.cabang_id = b.m_cabang_id
                                WHERE b.m_cabang_id = '$cabang_id'
                                AND a.m_barang_id = '$barang_id'");
    // $result = $query->row();
    // $stok = $result[0]->result;
    return $query;

  }

  function select_promodetail(){
    $query = $this->db->query("SELECT a.*, b.*, c.jml
                              FROM m_promo a
                              LEFT JOIN m_promodetail b ON b.promo = a.promo_id
                              LEFT JOIN (
                              	SELECT COUNT(a.promo_detail_id) AS jml, a.promo_detail_id FROM m_promodetail a GROUP BY a.promo
                              ) AS c ON c.promo_detail_id = b.promo_detail_id
                              WHERE promo_status_aktif = 'y'");
    return $query;
  }

  function select_promo(){
    $query = $this->db->query("SELECT a.*, c.jml
                               FROM m_promo a
                               LEFT JOIN (
                                	SELECT COUNT(a.promo_detail_id) AS jml, a.promo FROM m_promodetail a GROUP BY a.promo
                                ) AS c ON c.promo = a.promo_id
                               WHERE promo_status_aktif = 'y'");
    return $query;
  }

  function select_promostruk($promo){

    $promo = explode("|",$promo);

    $i = 1;
    $this->db->select('m_promo.*');
    $this->db->from('m_promo');
    if ($promo[1]) {
      foreach ($promo as $key => $value) {
        if ($promo[$i] != FALSE) { $this->db->or_where('m_promo.promo_id', $promo[$i]); }
        $i++;
      }
    }

    $query = $this->db->get();

    return $query;
  }

  function selectpenjualan($select, $id){
    $this->db->select('tb_penjualan.*, tb_penjualan_details.*, m_cabang.cabang_id, m_cabang.cabang_gudangdisplay, m_gudang.gudang_id');
    $this->db->from('tb_penjualan');
    $this->db->join('tb_penjualan_details', 'tb_penjualan_details.penjualan = tb_penjualan.penjualan_id', 'left');
    $this->db->join('m_cabang', 'm_cabang.cabang_id = tb_penjualan.branch', 'left');
    $this->db->join('m_gudang', 'm_gudang.m_cabang_id = tb_penjualan.branch', 'left');
    $this->db->where('tb_penjualan.penjualan_id', $id);
    $this->db->group_by('tb_penjualan_details.penjualan_detail_id');
    $query = $this->db->get();

    return $query;
  }

}
