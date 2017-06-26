<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_surat_jalan extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_surat_jalan';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		// $this->view();
	}

	public function view($type){
		$this->check_session();

		if ($type == 1) {
			$priv = $this->cekUser(41);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Gudang',
				'title_page2' 	=> 'Surat Jalan',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('surat-jalan/V_surat_jalan', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		} else if ($type == 2) {
			$priv = $this->cekUser(66);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Penjualan',
				'title_page2' 	=> 'Surat Jalan',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('surat-jalan/V_surat_jalan2', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		}		
	}

	public function loadData($type){
		$privPembelian = $this->cekUser(41);
		$priv = $this->cekUser(30);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, surat_jalan_nomor, surat_jalan_jenis_nama, surat_jalan_tanggal, nomor_referensi',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_surat_jalan');
		$query_filter = $this->mod->select($select, 'v_surat_jalan', NULL, null, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_surat_jalan', NULL, null, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$button = '';
				if ($type == 1) {
					$button = $button.'
					<a href="'.base_url().'Gudang/Surat-Jalan/Form/'.$val->surat_jalan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Surat Jalan">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Gudang/Surat-Jalan/print-SJ/'.$val->surat_jalan_id.'">
					<button class="btn green-jungle" type="button" title="Print Surat Jalan">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				} else if ($type == 2) {
					$button = $button.'
					<a href="'.base_url().'Penjualan/Surat-Jalan/Form/'.$val->surat_jalan_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Surat Jalan">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Penjualan/Surat-Jalan/print-SJ/'.$val->surat_jalan_id.'">
					<button class="btn green-jungle" type="button" title="Print Surat Jalan">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
					// if($val->order_status_nama == 'WO Disetujui')
					// {
					// 	$button = $button.'
					// 	<button class="btn red-thunderbird" type="button" title="Batalkan Persetujuan WO" onclick="batalkanWO('.$val->order_id.')">
					// 		<i class="icon-power text-center"></i>
					// 	</button>';
					// }
					// $button = $button.'
					// <a href="'.base_url().'Persetujuan/Work-Order/Form/'.$val->order_id.'">
					// <button class="btn blue-ebonyclay" type="button" title="Lihat WO" onclick="checkStatusWO('.$val->order_id.')">
					// 	<i class="icon-eye text-center"></i>
					// </button>
					// <a href="'.base_url().'Persetujuan/Work-Order/print-WO/'.$val->order_id.'">
					// <button class="btn green-jungle" type="button" title="Print WO">
					// 	<i class="icon-printer text-center"></i>
					// </button>
					// </a>
					// ';
				}
				$noRef = '';
				if($val->surat_jalan_jenis == 3)
				{
					$idRef = json_decode($val->so_customer_id);
					for($j=0; $j < sizeof($idRef); $j++)
					{
						if(@$where_noref['data'])
						{
							unset($where_noref['data']);
						}
						$where_noref['data'][] = array(
							'column' => 'so_customer_id',
							'param'	 => $idRef[$j]
						);
						$query_noref = $this->mod->select('*','t_so_customer',NULL,$where_noref);
						if ($query_noref) {
							foreach ($query_noref->result() as $val2) {
								$noRef = $noRef.''.$val2->so_customer_nomor.' <br>';
							}
						}
					}
				}
				else
				{
					$noRef = $val->nomor_referensi;
				}
				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->surat_jalan_nomor,
					$val->surat_jalan_jenis_nama,
					$noRef,
					date("d/m/Y",strtotime($val->surat_jalan_tanggal)),
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

	public function getForm1($id = null){
		$this->check_session();
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Gudang',
			'title_page2' 	=> 'Surat Jalan',
			'id'			=> $id
		);
		$this->open_page('surat-jalan/V_form_surat_jalan', $data);
	}

	public function getForm2($id = null){
		$this->check_session();
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Penjualan',
			'title_page2' 	=> 'Surat Jalan',
			'id'			=> $id
		);
		$this->open_page('surat-jalan/V_form_surat_jalan2', $data);
	}

	public function loadDataWhere(){
		$select = '*';
		$where['data'][] = array(
			'column' => 'surat_jalan_id',
			'param'	 => $this->input->get('id')
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI PARTNER
				$hasil1['val2'] = array();
				$where_partner['data'][] = array(
					'column' => 'partner_id',
					'param'	 => $val->m_partner_id
				);
				$query_partner = $this->mod->select('*','m_partner',NULL,$where_partner);
				if ($query_partner) {
					foreach ($query_partner->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 	=> $val2->partner_id,
							'text' 	=> $val2->partner_nama
						);
					}
				}
				// END CARI PARTNER
				// CARI NOMOR ORDER
				$hasil2['val2'] = array();
				if($val->surat_jalan_jenis == 1)
				{
					$where_order['data'][] = array(
						'column' => 'order_id',
						'param'	 => $val->t_order_id
					);
					$query_order = $this->mod->select('order_id AS id_referensi, order_nomor AS nomor_referensi','t_order',NULL,$where_order);
					if ($query_order) {
						foreach ($query_order->result() as $val2) {
							$hasil2['val2'][] = array(
								'id' 	=> $val2->id_referensi,
								'text' 	=> $val2->nomor_referensi
							);
						}
					}
				}
				else if($val->surat_jalan_jenis == 0)
				{
					$where_order['data'][] = array(
						'column' => 'nota_debet_id',
						'param'	 => $val->t_nota_debet_id
					);
					$query_order = $this->mod->select('nota_debet_id AS id_referensi, nota_debet_nomor AS nomor_referensi','t_nota_debet',NULL,$where_order);
					if ($query_order) {
						foreach ($query_order->result() as $val2) {
							$hasil2['val2'][] = array(
								'id' 	=> $val2->id_referensi,
								'text' 	=> $val2->nomor_referensi
							);
						}
					}
				}
				else if($val->surat_jalan_jenis == 3)
				{
					$idRef = json_decode($val->t_so_customer_id);
					for($k = 0; $k < sizeof($idRef); $k++)
					{
						if(@$where_det['data'])
						{
							unset($where_det['data']);
						}
						if(@$join_det['data'])
						{
							unset($join_det['data']);
						}
						$join_det['data'][] = array(
							'table' => 't_po_customerdet b',
							'join'	=> 'b.po_customerdet_id = a.t_po_customerdet_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 'm_barang c',
							'join'	=> 'c.barang_id = b.m_barang_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 'm_jenis_barang d',
							'join'	=> 'd.jenis_barang_id = c.m_jenis_barang_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 'm_satuan e',
							'join'	=> 'e.satuan_id = c.m_satuan_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 't_po_customer f',
							'join'	=> 'f.po_customer_id = b.t_po_customer_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 't_so_customer g',
							'join'	=> 'g.t_po_customer_id = f.po_customer_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 'm_konversi h',
							'join'	=> 'h.barang_id = b.m_barang_id',
							'type'	=> 'left'
						);
						$where_det['data'][] = array(
							'column' => 'g.so_customer_id',
							'param'	 => $idRef[$k]
						);
						$where_det['data'][] = array(
							'column' => 'a.t_surat_jalan_id',
							'param'	 => $val->surat_jalan_id
						);
						$queryDetail = $this->mod->select('*', 't_surat_jalandet a', $join_det, $where_det);
						if($queryDetail)
						{
							foreach ($queryDetail->result() as $val2) {
								$response['val2'][] = array(
									'po_customerdet_id'					=> $val2->po_customerdet_id,
									't_po_customer_id'					=> $val2->t_po_customer_id,
									'm_barang_id'						=> $val2->m_barang_id,
									'po_customerdet_qty'				=> $val2->po_customerdet_qty,
									'surat_jalandet_qty_kirim'			=> $val2->surat_jalandet_qty_kirim,
									'po_customerdet_harga_satuan'		=> $val2->po_customerdet_harga_satuan,
									'po_customerdet_status'				=> $val2->po_customerdet_status,
									'po_customerdet_keterangan'			=> $val2->po_customerdet_keterangan,
									'barang_kode'						=> $val2->barang_kode,
									'barang_nama'						=> $val2->barang_nama,
									'barang_uraian'						=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
									'satuan_nama'						=> $val2->satuan_nama
								);
							}
						}
					
						if(@$where_order['data'])
						{
							unset($where_order['data']);
						}
						$where_order['data'][] = array(
							'column' => 'so_customer_id',
							'param'	 => $idRef[$k]
						);
						$query_order = $this->mod->select('so_customer_id AS id_referensi, so_customer_nomor AS nomor_referensi','t_so_customer',NULL,$where_order);
						if ($query_order) {
							foreach ($query_order->result() as $val2) {
								$hasil2['val2'][] = array(
									'id' 	=> $val2->id_referensi,
									'text' 	=> $val2->nomor_referensi
								);
							}
						}
					}
					
				}
				
				// END CARI NOMOR ORDER

				$response['val'][] = array(
					'kode' 						=> $val->surat_jalan_id,
					'surat_jalan_nomor' 		=> $val->surat_jalan_nomor,
					'surat_jalan_tanggal'		=> date("d/m/Y",strtotime($val->surat_jalan_tanggal)),
					'surat_jalan_jenis' 		=> $val->surat_jalan_jenis,
					'surat_jalan_status' 		=> $val->surat_jalan_status,
					'm_partner_id' 				=> $hasil1,
					't_order_id' 				=> $hasil2,
					'surat_jalan_tanggal_kirim'	=> date("d/m/Y",strtotime($val->surat_jalan_tanggal_kirim)),

					'surat_jalan_ekspedisi' 	=> $val->surat_jalan_ekspedisi,
				);
			}

			echo json_encode($response);
		}
	}

	public function terbilang($x)
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

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'surat_jalan_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$join_det['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_det['data'][] = array(
					'table' => 'm_satuan d',
					'join'	=> 'd.satuan_id = b.m_satuan_id',
					'type'	=> 'left'
				);
				if($val->surat_jalan_jenis == 1)
				{
					$where_det['data'][] = array(
						'column' => 'a.t_order_id',
						'param'	 => $val->t_order_id
					);
					$namaTbl = 't_orderdet a';
				}
				else if($val->surat_jalan_jenis == 0)
				{
					$join_det['data'][] = array(
						'table' => 't_retur_pembeliandet e',
						'join'	=> 'e.t_retur_pembelian_id = a.t_retur_pembelian_id',
						'type'	=> 'left'
					);
					$where_det['data'][] = array(
						'column' => 'a.t_nota_debet_id',
						'param'	 => $val->t_nota_debet_id
					);
					$namaTbl = 't_nota_debetdet a';
				}
				if(($val->surat_jalan_jenis == 1) || ($val->surat_jalan_jenis == 0))
				{
					$query_det = $this->mod->select('a.*, b.*, c.*, d.*, e.retur_pembeliandet_keterangan',$namaTbl,$join_det,$where_det);
					$response['val2'] = array();

					if ($query_det) {
						foreach ($query_det->result() as $val2) {
							if($val->surat_jalan_jenis == 1)
							{
								$response['val2'][] = array(
									'orderdet_id'				=> $val2->orderdet_id,
									't_order_id'				=> $val2->t_order_id,
									'm_barang_id'				=> $val2->m_barang_id,
									'barang_kode'				=> $val2->barang_kode,
									'barang_nama'				=> $val2->barang_nama,
									'barang_uraian'				=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
									'orderdet_qty'				=> $val2->orderdet_qty,
									'satuan_nama'				=> $val2->satuan_nama,
									'orderdet_harga_satuan'		=> $val2->orderdet_harga_satuan,
									'orderdet_total'			=> $val2->orderdet_total,
								);
							}
							else
							{
								$response['val2'][] = array(
									'orderdet_id'				=> $val2->nota_debetdet_id,
									't_order_id'				=> $val2->t_nota_debet_id,
									'm_barang_id'				=> $val2->m_barang_id,
									'barang_kode'				=> $val2->barang_kode,
									'barang_nama'				=> $val2->barang_nama,
									'barang_uraian'				=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
									'orderdet_qty'				=> $val2->nota_debetdet_qty,
									'satuan_nama'				=> $val2->satuan_nama,
									'keterangan'				=> $val2->retur_pembeliandet_keterangan,
									'orderdet_harga_satuan'		=> $val2->nota_debetdet_harga_satuan,
									'orderdet_total'			=> $val2->nota_debetdet_total,
								);
							}
						}
					}
				}
				else if($val->surat_jalan_jenis == 3)
				{
					$idRef = json_decode($val->t_so_customer_id);
					for($j = 0; $j < sizeof($idRef); $j++)
					{
						if(@$where_det['data'])
						{
							unset($where_det['data']);
						}
						if(@$join_det['data'])
						{
							unset($join_det['data']);
						}
						$join_det['data'][] = array(
							'table' => 't_po_customerdet a',
							'join'	=> 'a.po_customerdet_id = h.t_po_customerdet_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 'm_barang b',
							'join'	=> 'b.barang_id = a.m_barang_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 'm_jenis_barang c',
							'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 'm_satuan d',
							'join'	=> 'd.satuan_id = b.m_satuan_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 't_po_customer e',
							'join'	=> 'e.po_customer_id = a.t_po_customer_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 't_so_customer f',
							'join'	=> 'f.t_po_customer_id = e.po_customer_id',
							'type'	=> 'left'
						);
						$join_det['data'][] = array(
							'table' => 'm_konversi g',
							'join'	=> 'g.barang_id = a.m_barang_id',
							'type'	=> 'left'
						);
						$where_det['data'][] = array(
							'column' => 'f.so_customer_id',
							'param'	 => $idRef[$j]
						);
						$where_det['data'][] = array(
							'column' => 'h.t_surat_jalan_id',
							'param'	 => $val->surat_jalan_id
						);
						$query_det = $this->mod->select('a.*, b.*, c.*, d.*, e.*, f.*, g.*, h.*','t_surat_jalandet h',$join_det,$where_det);

						if ($query_det) {
							foreach ($query_det->result() as $val2) {
								// CARI PENYETUJU
								$hasil1['val2'] = array();
								if(@$where_konversi['data'])
								{
									unset($where_konversi['data']);
								}
								$where_konversi['data'][] = array(
									'column' => 'satuan_id',
									'param'	 => $val2->konversi_akhirsatuan
								);
								$query_konversi = $this->mod->select('*','m_satuan',NULL,$where_konversi);
								if ($query_konversi) {
									foreach ($query_konversi->result() as $val3) {
										$hasil1['val2'][] = array(
											'id' 		=> $val3->satuan_id,
											'text' 		=> $val3->satuan_nama,
										);
									}
								}
								// END CARI PENYETUJU
								$response['val2'][] = array(
									'po_customerdet_id'					=> $val2->po_customerdet_id,
									'm_barang_id'						=> $val2->m_barang_id,
									'po_customerdet_qty'				=> $val2->po_customerdet_qty,
									'surat_jalandet_qty_kirim'			=> $val2->surat_jalandet_qty_kirim,
									'po_customerdet_harga_satuan'		=> $val2->po_customerdet_harga_satuan,
									'po_customerdet_keterangan'			=> $val2->po_customerdet_keterangan,
									'so_customer_nomor'					=> $val2->so_customer_nomor,
									'po_customer_nomor'					=> $val2->po_customer_nomor,
									'barang_kode'						=> $val2->barang_kode,
									'barang_nama'						=> $val2->barang_nama,
									'jenis_barang_nama'					=> $val2->jenis_barang_nama,
									'barang_uraian'						=> $val2->barang_nama.' ('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
									'satuan_nama'						=> $val2->satuan_nama,
									'konversi_akhir'					=> $val2->konversi_akhir,
									'konversi_akhirsatuan'				=> $hasil1,
								);
							}
						}
					}
				}
				// END CARI DETAIL
				// CARI PENYETUJU
				$hasil1['val2'] = array();
				$where_partner['data'][] = array(
					'column' => 'partner_id',
					'param'	 => $val->m_partner_id
				);
				$query_partner = $this->mod->select('*','m_partner',NULL,$where_partner);
				if ($query_partner) {
					foreach ($query_partner->result() as $val2) {
						$hasil1['val2'][] = array(
							'id' 		=> $val2->partner_id,
							'text' 		=> $val2->partner_nama,
							'alamat'	=> $val2->partner_alamat,
							'telp'		=> json_decode($val2->partner_telepon),
						);
					}
				}
				// END CARI PENYETUJU
				// CARI NOMOR WO
				$hasil2['val2'] = array();
				if($val->surat_jalan_jenis == 1)
				{
					$where_order['data'][] = array(
						'column' => 'order_id',
						'param'	 => $val->t_order_id
					);
					$query_order = $this->mod->select('order_id AS id_referensi, order_nomor AS nomor_referensi','t_order',NULL,$where_order);
				}
				else if($val->surat_jalan_jenis == 0)
				{
					$where_order['data'][] = array(
						'column' => 'nota_debet_id',
						'param'	 => $val->t_nota_debet_id
					);
					$query_order = $this->mod->select('nota_debet_id AS id_referensi, nota_debet_nomor AS nomor_referensi','t_nota_debet',NULL,$where_order);
				}
				if(($val->surat_jalan_jenis == 1) || ($val->surat_jalan_jenis == 0))
				{
					if ($query_order) {
						foreach ($query_order->result() as $val2) {
							$hasil2['val2'][] = array(
								'id' 	=> $val2->id_referensi,
								'text' 	=> $val2->nomor_referensi
							);
						}
					}
				}
				else if($val->surat_jalan_jenis == 3)
				{
					$idRef = json_decode($val->t_so_customer_id);
					for($j = 0; $j < sizeof($idRef); $j++)
					{
						if(@$where_det['data'])
						{
							unset($where_det['data']);
						}
						if(@$join_det['data'])
						{
							unset($join_det['data']);
						}
						$where_det['data'][] = array(
							'column' => 'so_customer_id',
							'param'	 => $idRef[$j]
						);
						$join_det['data'][] = array(
							'table'	=> 't_po_customer b',
							'join'	=> 'b.po_customer_id = a.t_po_customer_id',
							'type'	=> 'left'
						);
						$query_order = $this->mod->select('a.*, b.*','t_so_customer a',$join_det,$where_det);
						if ($query_order) {
							foreach ($query_order->result() as $val2) {
								// CARI SALES
								$hasil5['val2'] = array();
								if(@$where_sales['data'])
								{
									unset($where_sales['data']);
								}
								$where_sales['data'][] = array(
									'column' => 'karyawan_id',
									'param'	 => $val2->m_karyawan_id
								);
								$query_sales = $this->mod->select('*','m_karyawan',NULL,$where_sales);
								if ($query_sales) {
									foreach ($query_sales->result() as $val3) {
										$hasil5['val2'][] = array(
											'id' 		=> $val3->karyawan_id,
											'text' 		=> $val3->karyawan_nama,
										);
									}
								}
								// END CARI SALES
								$hasil2['val2'][] = array(
									'id' 	=> $val2->so_customer_id,
									'text' 	=> $val2->so_customer_nomor,
									'so_customer_nama_cetak' 	=> $val2->so_customer_nama_cetak,
									'po_customer_alamat_kirim' 	=> $val2->po_customer_alamat_kirim,
									'sales'	=> $hasil5,
								);
							}
						}
					}
				}
				// END CARI NOMOR WO
				// CARI CABANG
				$hasil3['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI kota
						$hasil4['val3'] = array();
						$where_kota['data'][] = array(
							'column' => 'id',
							'param'	 => $val2->cabang_kota
						);
						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
						if ($query_kota) {
							foreach ($query_kota->result() as $val3) {
								$hasil4['val3'][] = array(
									'id' 		=> $val3->id,
									'text' 		=> $val3->name,
								);
							}
						}
						// END CARI kota
						$hasil3['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil4,
							'telp'	=> json_decode($val2->cabang_telepon)
						);
					}
				}
				// END CARI CABANG
				$name = $val->surat_jalan_nomor;
				if($val->surat_jalan_jenis == 3)
				{
					$url = 'print/P_surat_jalan_customer';
				}
				else
				{
					$url = 'print/P_surat_jalan_retur';
				}
				$response['val'][] = array(
					'kode' 						=> $val->surat_jalan_id,
					'surat_jalan_nomor' 		=> $val->surat_jalan_nomor,
					'surat_jalan_tanggal'		=> date("d/m/Y",strtotime($val->surat_jalan_tanggal)),
					'surat_jalan_tanggal_kirim'	=> date("d/m/Y",strtotime($val->surat_jalan_tanggal_kirim)),
					'surat_jalan_jenis' 		=> $val->surat_jalan_jenis,
					'surat_jalan_status' 		=> $val->surat_jalan_status,
					'm_partner_id' 				=> $hasil1,
					'order_id' 					=> $hasil2,
					'cabang' 					=> $hasil3,
					'surat_jalan_ekspedisi' 	=> $val->surat_jalan_ekspedisi
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Surat-Jalan',
			'title_page2' 	=> 'Print Surat Jalan',
		);
		// echo json_encode($response);
		$this->pdf->load_view($url, $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}


	public function loadData_selectFaktur(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'surat_jalan_jenis',
			'param'	 => 3
		);
		$where['data'][] = array(
			'column' => 'surat_jalan_status',
			'param'	 => 1
		);
		$where_like['data'][] = array(
			'column' => 'surat_jalan_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'surat_jalan_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		$response['query'] = $query;
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->surat_jalan_id,
					'text'	=> $val->surat_jalan_nomor
				);
			}
			$response['status'] = '200';
		}
		echo json_encode($response);
	}

	public function loadData_selectSJRetur(){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		$where['data'][] = array(
			'column' => 'surat_jalan_jenis',
			'param'	 => 3
		);
		$where['data'][] = array(
			'column' => 'surat_jalan_status',
			'param'	 => 2
		);
		$where_like['data'][] = array(
			'column' => 'surat_jalan_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'surat_jalan_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->surat_jalan_id,
					'text'	=> $val->surat_jalan_nomor
				);
			}
			$response['status'] = '200';
		}
		echo json_encode($response);
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
			'column' => 'order_status >= ',
			'param'	 => 3
		);
		$where['data'][] = array(
			'column' => 'order_status <= ',
			'param'	 => 4
		);
		$where_like['data'][] = array(
			'column' => 'order_nomor',
			'param'	 => $this->input->get('q')
		);
		$order['data'][] = array(
			'column' => 'order_nomor',
			'type'	 => 'ASC'
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
		$response['items'] = array();
		if ($query<>false) {
			foreach ($query->result() as $val) {
				$response['items'][] = array(
					'id'	=> $val->order_id,
					'text'	=> $val->order_nomor
				);
			}
			$response['status'] = '200';
		}

		echo json_encode($response);
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'order_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->order_status == 1) {
					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'order_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG
					$data_log = array(
						'referensi_id' 					=> $id,
						'orderlog_status_dari' 			=> 1,
						'orderlog_status_ke' 			=> 2,
						'orderlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'orderlog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_orderlog', NULL, $data_log);
					$response['status'] = '200';
				} else {
					$response['status'] = '204';
				}
			}
		} else {
			$response['status'] = '204';
		}
		echo json_encode($response);
	}

	public function checkStokWO()
	{
		$id = $this->input->get('id');
		$select = 'b.permintaan_pembelian_id';
		$join['data'][] = array(
			'table' => 't_penawaran b',
			'join'	=> 'b.penawaran_id = a.order_referensi_id',
			'type'	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'a.order_id',
			'param'  => $id
		);
		$query = $this->mod->select($select, 't_order a', $join, $where);
		// $response['insert'] = 'masuk';
		if($query<>false)
		{
			foreach ($query->result() as $val) {
				$idSPP = json_decode($val->permintaan_pembelian_id);
				for($i = 0; $i < count($idSPP); $i++)
				{
					$selectGudang = 'm_gudang_id_permintaan';
					$whereGudang['data'][] = array(
						'column' => 'permintaan_pembelian_id',
						'param'  => $idSPP[$i]
					);
					$queryGudang = $this->mod->select($selectGudang, 't_permintaan_pembelian', null, $whereGudang);
					if($queryGudang)
					{
						foreach ($queryGudang->result() as $val2) {
							$response['gudang'] = $val2->m_gudang_id_permintaan;
							// $Gudang = $val2->m_gudang_id_permintaan;
							// $response['gudang'] = $Gudang;
							$wherebarang['data'][] = array(
								'column' => 't_order_id',
								'param'  => $id
							);
							$querybarang = $this->mod->select('m_barang_id', 't_orderdet', null, $wherebarang);
							if($querybarang)
							{
								foreach ($querybarang->result() as $val3) {
									if (@$where_gudang['data']) {
										unset($where_gudang['data']);
									}
									$where_gudang['data'][] = array(
										'column' => 'm_barang_id',
										'param'	 => $val3->m_barang_id
									);
									$where_gudang['data'][] = array(
										'column' => 'm_gudang_id',
										'param'	 => $val2->m_gudang_id_permintaan
									);
									$query_gudang = $this->mod->select('*', 't_stok_gudang', NULL, $where_gudang);
									foreach ($query_gudang->result() as $rowStok) {
										$response['val'][] = array(
											'stok' => $rowStok->stok_gudang_jumlah
										);
									}
								}
							}
						}
					}
				}
			}
		}
		echo json_encode($response);
	}

	public function checkStokNotaDebet()
	{
		$id = $this->input->get('id');
		$select = 'a.m_gudang_id, b.m_barang_id';
		$join['data'][] = array(
			'table' => 't_nota_debetdet b',
			'join'	=> 'b.t_nota_debet_id = a.nota_debet_id',
			'type'	=> 'left'
		);
		$where['data'][] = array(
			'column' => 'a.nota_debet_id',
			'param'  => $id
		);
		$query = $this->mod->select($select, 't_nota_debet a', $join, $where);
		// $response['insert'] = 'masuk';
		if($query<>false)
		{
			$no = 1;
			$response['val'] = array();
			foreach ($query->result() as $val) {
				
				$response['gudang'] = $val->m_gudang_id;
				// $Gudang = $val2->m_gudang_id_permintaan;
				// $response['gudang'] = $Gudang;
				// PENGURANGAN STOK GUDANG
				if (@$where_gudang['data']) {
					unset($where_gudang['data']);
				}
				$where_gudang['data'][] = array(
					'column' => 'm_barang_id',
					'param'	 => $val->m_barang_id
				);
				$where_gudang['data'][] = array(
					'column' => 'm_gudang_id',
					'param'	 => $val->m_gudang_id
				);
				$query_gudang = $this->mod->select('*', 't_stok_gudang', NULL, $where_gudang);
				foreach ($query_gudang->result() as $rowStok) {
					$response['val'][] = array(
						'stok' => $rowStok->stok_gudang_jumlah
					);
				}
				
			}
		}
		echo json_encode($response);
	}

	public function loadDataQtyKirimWhere()
	{
		$response['val'] = array();
		$po_id = $this->input->get('id');
		$sj_id = $this->input->get('sj_id');
		$items = $this->input->get('items');
		$where['data'][] = array(
			'column' => 't_po_customerdet_id',
			'param'	 => $po_id
		);
		// $where['data'][] = array(
		// 	'column' => 't_surat_jalan_id',
		// 	'param'	 => $sj_id
		// );
		$query = $this->mod->select('surat_jalandet_qty_kirim', 't_surat_jalandet', null, $where);
		if($query)
		{
			foreach ($query->result() as $val) {
				$response['val'][] = array(
					'surat_jalandet_qty_kirim'	=> $val->surat_jalandet_qty_kirim,
					'items'						=> $items,
				);
			}
		}
		echo json_encode($response);
	}

	// Function Insert & Update
	public function postData($type){
		$id = $this->input->post('kode');
		$response['type'] = $type;
		if (strlen($id)>0) {
			//UPDATE
			$data = $this->general_post_data(2, $id);
			$where['data'][] = array(
				'column' => 'cabang_id',
				'param'	 => $id
			);
			$update = $this->mod->update_data_table($this->tbl, $where, $data);
			if($update->status) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
		} else if($this->input->post('surat_jalan_jenis', TRUE) == '1'){
			//INSERT
			$data = $this->general_post_data(1);
			$pass = TRUE;
			$select = 'b.permintaan_pembelian_id';
			$join['data'][] = array(
				'table' => 't_penawaran b',
				'join'	=> 'b.penawaran_id = a.order_referensi_id',
				'type'	=> 'left'
			);
			$where['data'][] = array(
				'column' => 'a.order_id',
				'param'  => $this->input->post('t_order_id', TRUE)
			);
			$query = $this->mod->select($select, 't_order a', $join, $where);
			// $response['insert'] = 'masuk';
			if($query<>false)
			{
				foreach ($query->result() as $val) {
					$idSPP = json_decode($val->permintaan_pembelian_id);
					for($i = 0; $i < count($idSPP); $i++)
					{
						$selectGudang = 'm_gudang_id_permintaan';
						$whereGudang['data'][] = array(
							'column' => 'permintaan_pembelian_id',
							'param'  => $idSPP[$i]
						);
						$queryGudang = $this->mod->select($selectGudang, 't_permintaan_pembelian', null, $whereGudang);
						if($queryGudang)
						{
							foreach ($queryGudang->result() as $val2) {
								// $Gudang = $val2->m_gudang_id_permintaan;
								// $response['gudang'] = $Gudang;
								for ($j = 0; $j < sizeof($this->input->post('m_barang_id', TRUE)); $j++) {
									// PENGURANGAN STOK GUDANG
									if (@$where_gudang['data']) {
										unset($where_gudang['data']);
									}
									$where_gudang['data'][] = array(
										'column' => 'm_barang_id',
										'param'	 => $this->input->post('m_barang_id', TRUE)[$j]
									);
									$where_gudang['data'][] = array(
										'column' => 'm_gudang_id',
										'param'	 => $val2->m_gudang_id_permintaan
									);
									$query_gudang = $this->mod->select('*', 't_stok_gudang', NULL, $where_gudang);
									foreach ($query_gudang->result() as $rowStok) {
										// PENGURANGAN KARTU STOK
										$dataKStok = array(
											'm_gudang_id' 				=> $val2->m_gudang_id_permintaan,
											'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$i],
											'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),
											'kartu_stok_referensi' 		=> $data['surat_jalan_nomor'],
											'kartu_stok_saldo' 			=> $rowStok->stok_gudang_jumlah,
											'kartu_stok_masuk' 			=> 0,
											'kartu_stok_keluar' 		=> $this->input->post('orderdet_qty', TRUE)[$i],
											'kartu_stok_penyesuaian'	=> 0,
											'kartu_stok_keterangan' 	=> "Surat Jalan WO",
											'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
											'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),
											'kartu_stok_revised' 		=> 0,
										);
										// END PENGURANGAN KARTU STOK
										$insertKStok = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok);
										if (@$whereStok['data']) {
											unset($whereStok['data']);
										}
										$whereStok['data'][] = array(
											'column' => 'stok_gudang_id',
											'param'	 => $rowStok->stok_gudang_id
										);
										$dataStok = array(
											'stok_gudang_jumlah' 		=> $rowStok->stok_gudang_jumlah - $this->input->post('orderdet_qty', TRUE)[$i],
											'stok_gudang_update_date'	=> date('Y-m-d H:i:s'),
											'stok_gudang_update_by'		=> $this->session->userdata('user_username'),
											'stok_gudang_revised' 		=> $rowStok->stok_gudang_revised + 1,
										);
										$updateStok = $this->mod->update_data_table('t_stok_gudang', $whereStok, $dataStok);
										// END PENGURANGAN STOK GUDANG
									}
									$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
									if($insert->status) {
										$response['status'] = '200';
									} else {
										$response['status'] = '204';
									}
										
								}
							}
						}
					}
				}
			}
		} else if($this->input->post('surat_jalan_jenis', TRUE) == '0'){
			//INSERT
			$data = $this->general_post_data(3);
			$select = 'a.m_gudang_id, b.m_barang_id, a.nota_debet_catatan';
			$join['data'][] = array(
				'table' => 't_nota_debetdet b',
				'join'	=> 'b.t_nota_debet_id = a.nota_debet_id',
				'type'	=> 'left'
			);
			$where['data'][] = array(
				'column' => 'a.nota_debet_id',
				'param'  => $this->input->post('t_order_id')
			);
			$query = $this->mod->select($select, 't_nota_debet a', $join, $where);
			// $response['insert'] = 'masuk';
			if($query<>false)
			{
				$no = 1;
				foreach ($query->result() as $val) {
					// $Gudang = $val2->m_gudang_id_permintaan;
					// $response['gudang'] = $Gudang;
					// PENGURANGAN STOK GUDANG
					if (@$where_gudang['data']) {
						unset($where_gudang['data']);
					}
					$where_gudang['data'][] = array(
						'column' => 'm_barang_id',
						'param'	 => $val->m_barang_id
					);
					$where_gudang['data'][] = array(
						'column' => 'm_gudang_id',
						'param'	 => $val->m_gudang_id
					);
					$query_gudang = $this->mod->select('*', 't_stok_gudang', NULL, $where_gudang);
					if($query_gudang)
					{
						$i =0;
						foreach ($query_gudang->result() as $rowStok) {
							// PENGURANGAN KARTU STOK
							$dataKStok = array(
								'm_gudang_id' 				=> $val->m_gudang_id,
								'm_barang_id' 				=> $this->input->post('m_barang_id', TRUE)[$i],
								'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),
								'kartu_stok_referensi' 		=> $data['surat_jalan_nomor'],
								'kartu_stok_saldo' 			=> $rowStok->stok_gudang_jumlah,
								'kartu_stok_masuk' 			=> 0,
								'kartu_stok_keluar' 		=> $this->input->post('orderdet_qty', TRUE)[$i],
								'kartu_stok_penyesuaian'	=> 0,
								'kartu_stok_keterangan' 	=> "Surat Jalan Retur",
								'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
								'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),
								'kartu_stok_revised' 		=> 0,
							);
							// END PENGURANGAN KARTU STOK
							$insertKStok = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok);
							if (@$whereStok['data']) {
								unset($whereStok['data']);
							}
							$whereStok['data'][] = array(
								'column' => 'stok_gudang_id',
								'param'	 => $rowStok->stok_gudang_id
							);
							$dataStok = array(
								'stok_gudang_jumlah' 		=> $rowStok->stok_gudang_jumlah - $this->input->post('orderdet_qty', TRUE)[$i],
								'stok_gudang_update_date'	=> date('Y-m-d H:i:s'),
								'stok_gudang_update_by'		=> $this->session->userdata('user_username'),
								'stok_gudang_revised' 		=> $rowStok->stok_gudang_revised + 1,
							);
							$updateStok = $this->mod->update_data_table('t_stok_gudang', $whereStok, $dataStok);
							$i++;
							// END PENGURANGAN STOK GUDANG
						}
						$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
						if($insert->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
					
				}
			}
		} else if($this->input->post('surat_jalan_jenis', TRUE) == '3'){
			//INSERT
			$data = $this->general_post_data(4);
			$response['data'] = $data;
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			for($i = 0; $i < sizeof($this->input->post('po_customerdet_id', TRUE)); $i++)
			{
				$dataqty = $this->general_post_data2(1, $i, $insert->output); // $insert->output
				$response['surat_jalandet'][] = $dataqty;
				$insertdet = $this->mod->insert_data_table('t_surat_jalandet', null, $dataqty);
				$qty = $this->input->post('qty_kirim', TRUE)[$i];
				$qty2 = $this->input->post('surat_jalandet_qty_kirim', TRUE)[$i];
				$qty3 = $this->input->post('orderdet_qty', TRUE)[$i];
				if($qty3 == ($qty+$qty2))
				{
					if(@$where_PODet['data'])
					{
						unset($where_PODet['data']);
					}
					$where_PODet['data'][] = array(
						'column' => 'po_customerdet_id',
						'param'	 => $this->input->post('po_customerdet_id', TRUE)[$i]
					);
					$queryPOdet = $this->mod->select('po_customerdet_status, po_customerdet_revised', 't_po_customerdet', null, $where_PODet);
					if($queryPOdet)
					{
						foreach ($queryPOdet->result() as $val) {
							$revised = $val->po_customerdet_revised + 1;
							$data_POdet = array(
								'po_customerdet_status'			=> 5,
								'po_customerdet_revised'		=> $revised,
								'po_customerdet_updated_date'	=> date('Y-m-d H:i:s'),
								'po_customerdet_updated_by'		=> $this->session->userdata('user_username'),
							);
							$response['det'][] = $data_POdet;
							$update_POdet = $this->mod->update_data_table('t_po_customerdet', $where_PODet, $data_POdet);
						}
					}
				}
				if(@$joinStatus['data'])
				{
					unset($joinStatus['data']);
				}
				if(@$whereStatus['data'])
				{
					unset($whereStatus['data']);
				}
				$joinStatus['data'][] = array(
					'table' => 't_so_customer b',
					'join'	=> 'b.t_po_customer_id = a.t_po_customer_id',
					'type'	=> 'left'
				);
				$whereStatus['data'][] = array(
					'column' => 'so_customer_nomor',
					'param'	 => $this->input->post('so_customer_nomor', TRUE)[$i]
				);
				$queryStatus = $this->mod->select('po_customerdet_status', 't_po_customerdet a', $joinStatus, $whereStatus);
				if($queryStatus)
				{
					$dataStatus = array();
					foreach ($queryStatus->result() as $val) {
						array_push($dataStatus, $val->po_customerdet_status);
					}
					if(in_array('4', $dataStatus)){
						$response['status_so'][] = $dataStatus;
					}
					else
					{
						$response['status_so'] = 'ganti';
						$data_so = array(
							'so_customer_status' => 3,
						);
						$update_so = $this->mod->update_data_table('t_so_customer', $whereStatus, $data_so);
					}
				}
				// PENGURANGAN STOK GUDANG
				if (@$join_gudang['data']) {
					unset($join_gudang['data']);
				}
				if (@$where_gudang['data']) {
					unset($where_gudang['data']);
				}
				// STOK
				$join_gudang['data'][] = array(
					'table' => 'm_gudang b',
					'join'	=> 'b.gudang_id = a.m_gudang_id',
					'type'	=> 'left'
				);
				$where_gudang['data'][] = array(
					'column' => 'a.m_barang_id',
					'param'	 => $this->input->post('m_barang_id', TRUE)[$i]
				);
				$where_gudang['data'][] = array(
					'column' => 'b.m_jenis_gudang_id',
					'param'	 => 1
				);
				$where_gudang['data'][] = array(
					'column' => 'b.gudang_status_aktif',
					'param'	 => 'y'
				);
				$query_gudang = $this->mod->select('a.*, b.*', 't_stok_gudang a', $join_gudang, $where_gudang);
				$response['querygudang'] = $query_gudang;
				if($query_gudang)
				{
					$i =0;
					foreach ($query_gudang->result() as $rowStok) {
						// PENGURANGAN KARTU STOK
						$dataKStok = array(
							'm_gudang_id' 				=> $rowStok->m_gudang_id,
							'm_barang_id' 				=> $rowStok->m_barang_id,
							'kartu_stok_tanggal' 		=> date('Y-m-d H:i:s'),
							'kartu_stok_referensi' 		=> $this->input->post('so_customer_nomor', TRUE)[$i],
							'kartu_stok_saldo' 			=> $rowStok->stok_gudang_jumlah,
							'kartu_stok_masuk' 			=> 0,
							'kartu_stok_keluar' 		=> $dataqty['surat_jalandet_qty_kirim'],
							'kartu_stok_penyesuaian'	=> 0,
							'kartu_stok_keterangan' 	=> "SO Customer",
							'kartu_stok_created_date'	=> date('Y-m-d H:i:s'),
							'kartu_stok_created_by' 	=> $this->session->userdata('user_username'),
							'kartu_stok_revised' 		=> 0,
						);
						// END PENGURANGAN KARTU STOK
						$insertKStok = $this->mod->insert_data_table('t_kartu_stok', NULL, $dataKStok);
						if (@$whereStok['data']) {
							unset($whereStok['data']);
						}
						$whereStok['data'][] = array(
							'column' => 'stok_gudang_id',
							'param'	 => $rowStok->stok_gudang_id
						);
						$dataStok = array(
							'stok_gudang_jumlah' 		=> $rowStok->stok_gudang_jumlah - $dataqty['surat_jalandet_qty_kirim'],
							'stok_gudang_update_date'	=> date('Y-m-d H:i:s'),
							'stok_gudang_update_by'		=> $this->session->userdata('user_username'),
							'stok_gudang_revised' 		=> $rowStok->stok_gudang_revised + 1,
						);
						$updateStok = $this->mod->update_data_table('t_stok_gudang', $whereStok, $dataStok);
						$i++;
						// END PENGURANGAN STOK GUDANG
					}
				}
			}	
			if($insert->status) {
				$response['status'] = '200';
			} else {
				$response['status'] = '204';
			}
			
		}
		
		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('surat_jalan_tanggal', TRUE));
		$arrDate2 = explode('/', $this->input->post('surat_jalan_tanggal_kirim', TRUE));
		$where['data'][] = array(
			'column' => 'surat_jalan_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('surat_jalan_status, surat_jalan_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['surat_jalan_revised'] + 1;
			$status = $revised['surat_jalan_status'];
		}
		if ($type == 1) {
			$surat_jalan_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 				=> $this->session->userdata('cabang_id'),
				'surat_jalan_nomor' 		=> $surat_jalan_nomor,
				'surat_jalan_tanggal'		=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'surat_jalan_ekspedisi'		=> $this->input->post('surat_jalan_ekspedisi', TRUE),
				'surat_jalan_jenis' 		=> $this->input->post('surat_jalan_jenis', TRUE),
				'm_partner_id'				=> $this->input->post('m_partner_id', TRUE),
				't_order_id'				=> $this->input->post('t_order_id', TRUE),
				'surat_jalan_tanggal_kirim'	=> $arrDate2[2]."-".$arrDate2[1]."-".$arrDate2[0],
				'surat_jalan_status' 		=> $this->input->post('surat_jalan_status', TRUE),
				'surat_jalan_status_date'	=> date('Y-m-d H:i:s'),
				'surat_jalan_created_date'	=> date('Y-m-d H:i:s'),
				'surat_jalan_update_date'	=> date('Y-m-d H:i:s'),
				'surat_jalan_created_by'	=> $this->session->userdata('user_username'),
				'surat_jalan_revised' 		=> 0,
			);
		} else if ($type == 2) {
			if ($status == $this->input->post('surat_jalan_status', TRUE)) {
				$data = array(
					'surat_jalan_update_date'	=> date('Y-m-d H:i:s'),
					'surat_jalan_update_by'		=> $this->session->userdata('user_username'),
					'surat_jalan_revised' 		=> $rev,
				);
			} else {
				$data = array(
					'surat_jalan_status' 		=> $this->input->post('surat_jalan_status', TRUE),
					'surat_jalan_update_date'	=> date('Y-m-d H:i:s'),
					'surat_jalan_update_by'		=> $this->session->userdata('user_username'),
					'surat_jalan_revised' 		=> $rev,
				);
			}
		} else if ($type == 3) {
			$surat_jalan_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 				=> $this->session->userdata('cabang_id'),
				'surat_jalan_nomor' 		=> $surat_jalan_nomor,
				'surat_jalan_tanggal'		=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'surat_jalan_ekspedisi'		=> $this->input->post('surat_jalan_ekspedisi', TRUE),
				'surat_jalan_jenis' 		=> $this->input->post('surat_jalan_jenis', TRUE),
				'm_partner_id'				=> $this->input->post('m_partner_id', TRUE),
				't_nota_debet_id'			=> $this->input->post('t_order_id', TRUE),
				'surat_jalan_tanggal_kirim'	=> $arrDate2[2]."-".$arrDate2[1]."-".$arrDate2[0],
				'surat_jalan_status' 		=> $this->input->post('surat_jalan_status', TRUE),
				'surat_jalan_status_date'	=> date('Y-m-d H:i:s'),
				'surat_jalan_created_date'	=> date('Y-m-d H:i:s'),
				'surat_jalan_update_date'	=> date('Y-m-d H:i:s'),
				'surat_jalan_created_by'	=> $this->session->userdata('user_username'),
				'surat_jalan_revised' 		=> 0,
			);
		} else if ($type == 4) {
			$surat_jalan_nomor = $this->get_kode_transaksi2();
			$data = array(
				'm_cabang_id' 				=> $this->session->userdata('cabang_id'),
				'surat_jalan_nomor' 		=> $surat_jalan_nomor,
				'surat_jalan_tanggal'		=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'surat_jalan_ekspedisi'		=> $this->input->post('surat_jalan_ekspedisi', TRUE),
				'surat_jalan_jenis' 		=> $this->input->post('surat_jalan_jenis', TRUE),
				'm_partner_id'				=> $this->input->post('m_partner_id', TRUE),
				't_so_customer_id'			=> json_encode($this->input->post('id', TRUE)),
				'surat_jalan_tanggal_kirim'	=> $arrDate2[2]."-".$arrDate2[1]."-".$arrDate2[0],
				'surat_jalan_status' 		=> $this->input->post('surat_jalan_status', TRUE),
				'surat_jalan_status_date'	=> date('Y-m-d H:i:s'),
				'surat_jalan_created_date'	=> date('Y-m-d H:i:s'),
				'surat_jalan_update_date'	=> date('Y-m-d H:i:s'),
				'surat_jalan_created_by'	=> $this->session->userdata('user_username'),
				'surat_jalan_revised' 		=> 0,
			);
		}
		return $data;
	}

	function general_post_data2($type, $seq, $idHdr)
	{
		if($type == 1)
		{
			$data = array(
				't_surat_jalan_id'				=> $idHdr,
				't_po_customerdet_id'			=> $this->input->post('po_customerdet_id', TRUE)[$seq],
				'surat_jalandet_qty_kirim'		=> $this->input->post('surat_jalandet_qty_kirim',TRUE)[$seq],
				'surat_jalandet_created_date'	=> date('Y-m-d H:i:s'),
				'surat_jalandet_created_by'		=> $this->session->userdata('user_username'),
				'surat_jalandet_revised'		=> 0,
			);
		}
		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(surat_jalan_nomor,9,5) as id';
		$where['data'][] = array(
			'column' => 'MID(surat_jalan_nomor,1,8)',
			'param'	 => 'SJ'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'surat_jalan_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('SJ',$query);
		return $kode_baru;
	}
	function get_kode_transaksi2(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(surat_jalan_nomor,11,5) as id';
		// $where['data'][] = array(
		// 	'column' => 'surat_jalan_jenis',
		// 	'param'	 => 3
		// );
		$where['data'][] = array(
			'column' => 'MID(surat_jalan_nomor,1,10)',
			'param'	 => 'SJSO'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'surat_jalan_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('SJSO',$query);
		return $kode_baru;
	}
	/* end Function */

}