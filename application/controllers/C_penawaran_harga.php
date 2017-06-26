<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_penawaran_harga extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_penawaran';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		$this->view();
	}

	public function view(){
		$this->check_session();
		$priv = $this->cekUser(23);
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Pembelian',
			'title_page2' 	=> 'Penawaran Harga',
			'priv_add'		=> $priv['create']
			);
		if($priv['read'] == 1)
		{
			$this->open_page('penawaran-harga/V_penawaran_harga', $data);
		}
		else
		{
			$this->load->view('layout/V_404', $data);
		}
	}

	public function loadData($type){
		$priv = $this->cekUser(23);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, penawaran_nomor, penawaran_jenis_nama, penawaran_tanggal, penawaran_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_penawaran');
		$query_filter = $this->mod->select($select, 'v_penawaran', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_penawaran', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				// $button = '';
				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Pembelian/Penawaran-Harga/Form/'.$val->penawaran_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Penawaran">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Pembelian/Penawaran-Harga/print-Penawaran/'.$val->penawaran_id.'">
					<button class="btn green-jungle" type="button" title="Print Penawaran">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
					if ($val->penawaran_status < 5) {
						$button .= '
						<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->penawaran_id.')" title="Hapus Data">
							<i class="icon-close text-center"></i>
						</button>';
					}
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Pembelian/Penawaran-Harga/Form/'.$val->penawaran_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat Penawaran">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Pembelian/Penawaran-Harga/print-Penawaran/'.$val->penawaran_id.'">
					<button class="btn green-jungle" type="button" title="Print Penawaran">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				}

				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->penawaran_nomor,
					$val->penawaran_jenis_nama,
					date("d/m/Y",strtotime($val->penawaran_tanggal)),
					$val->penawaran_status_nama,
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
 		$this->load->view("penawaran-harga/V_form_penawaran_harga");
	}

	public function getForm1($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Pembelian',
			'title_page2' => 'Penawaran Harga',
			'id'					=> $id
		);
		$this->open_page('penawaran-harga/V_form_penawaran_harga', $data);
	}

	public function loadDataWhere($type){
		$select = '*';
		if ($this->input->post('id')) {
			$penawaran_id = $this->input->post('id');
		} else {
			$penawaran_id = $this->input->get('id');
		}
		$where['data'][] = array(
			'column' => 'penawaran_id',
			'param'	 => $penawaran_id
		);

		// var_dump($where);

		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $val) {
				// CARI DETAIL
				// BARANG
				$join_brg['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type'	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_satuan d',
					'join'	=> 'd.satuan_id = b.m_satuan_id',
					'type'	=> 'left'
				);
				$where_brg['data'][] = array(
					'column' => 't_penawaran_id',
					'param'	 => $val->penawaran_id
				);
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_penawaran_barang a', $join_brg, $where_brg);
				$response['step1'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val2) {

						$response['step1'][] = array(
							'penawaran_barang_id'				=> $val2->penawaran_barang_id,
							't_permintaan_pembelian'			=> $val2->t_permintaan_pembelian,
							'm_barang_id'						=> $val2->m_barang_id,
							'barang_nomor'						=> $val2->barang_nomor,
							'barang_uraian'						=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'penawaran_barang_qty'				=> $val2->penawaran_barang_qty,
							'satuan_nama'						=> $val2->satuan_nama,
						);
					}
					// echo $this->db->last_query();
				}

				// SUPPLIER
				$join_sup['data'][] = array(
					'table' => 'm_partner b',
					'join'	=> 'b.partner_id = a.m_partner_id',
					'type'	=> 'left'
				);
				$where_sup['data'][] = array(
					'column' => 't_penawaran_id',
					'param'	 => $val->penawaran_id
				);
				$query_sup = $this->mod->select('a.*, b.*', 't_penawaran_supplier a', $join_sup, $where_sup);
				$response['step2'] = array();
				$response['step4'] = 0;
				if ($query_sup) {
					foreach ($query_sup->result() as $val2) {
						$response['step4'] += $val2->penawaran_supplier_pemenang;
						$response['step2'][] = array(
							'penawaran_supplier_id'			=> $val2->penawaran_supplier_id,
							'm_partner_id'					=> $val2->m_partner_id,
							'partner_nama'					=> $val2->partner_nama,
							'penawaran_supplier_kontak'		=> $val2->penawaran_supplier_kontak,
							'partner_alamat'				=> $val2->partner_alamat,
							'penawaran_supplier_pemenang'	=> $val2->penawaran_supplier_pemenang,
							'partner_telepon' 				=> implode(', ', json_decode($val2->partner_telepon)),
							'penawaran_supplier_tanggal_kirim'	=> date("d/m/Y",strtotime($val2->penawaran_supplier_tanggal_kirim)),
							'penawaran_supplier_diskon'		=> $val2->penawaran_supplier_diskon,
							'penawaran_supplier_ppn'		=> $val2->penawaran_supplier_ppn,
						);
					}
				}

				// HARGA
				$where_hrg['data'][] = array(
					'column' => 't_penawaran_id',
					'param'	 => $val->penawaran_id
				);
				$query_hrg = $this->mod->select('*', 't_penawaran_harga', NULL, $where_hrg);
				$response['step3'] = 0;
				$response['step5'] = array();
				if ($query_hrg) {
					$response['step3'] = 1;
					foreach ($query_hrg->result() as $val2) {
						$response['step5'][] = array(
							't_penawaran_id' 						=> $val2->t_penawaran_id,
							't_penawaran_supplier_id' 				=> $val2->t_penawaran_supplier_id,
							't_penawaran_barang_id' 				=> $val2->t_penawaran_barang_id,
							'penawaran_harga_qty_ditawarkan'		=> $val2->penawaran_harga_qty_ditawarkan,
							'diskon_perbarang' 						=> $val2->diskon_perbarang,
							'penawaran_harga_nominal' 				=> $val2->penawaran_harga_nominal
						);
					}
				}
				// CARI SPP
				$sppID = json_decode($val->permintaan_pembelian_id);
				$hasil1['val1'] = array();
				for($j = 0; $j < count($sppID); $j++)
				{
					if (@$where_spp['data']) {
						unset($where_spp['data']);
					}
					$where_spp['data'][] = array(
						'column' => 'permintaan_pembelian_id',
						'param'	 => $sppID[$j]
					);
					$query_spp = $this->mod->select('*','t_permintaan_pembelian',NULL,$where_spp);
					// $response['spp'][] = $sppID[$j];
					foreach ($query_spp->result() as $val1) {
						$response['spp'][] 	= $val1->permintaan_pembelian_id;
						$hasil1['val1'][] 	= array(
							'id' 			=> $val1->permintaan_pembelian_id,
							'text' 			=> $val1->permintaan_pembelian_nomor
						);
					}
				}

				// END CARI SPP
				$response['val'][] = array(
					'kode' 							=> $val->penawaran_id,
					'penawaran_nomor' 				=> $val->penawaran_nomor,
					'penawaran_tanggal'				=> date("d/m/Y",strtotime($val->penawaran_tanggal)),
					'penawaran_jenis' 				=> $val->penawaran_jenis,
					'penawaran_status' 				=> $val->penawaran_status,
					'permintaan_pembelian_id' 		=> $hasil1,
					'penawaran_step' 				=> $val->penawaran_step,
				);
			}
			// echo $this->db->last_query();
			echo json_encode($response);
		}
	}

	public function loadData_select($type){
		if ($type == 1) {

			$param = $this->input->get('q');

			if ($param!=NULL) {
				$param = $this->input->get('q');
			} else {
				$param = "";
			}

			$select = '*';
			$where['data'][] = array(
				'column' => 'penawaran_status',
				'param'	 => 4
			);

			$where_like['data'][] = array(
				'column' => 'penawaran_nomor',
				'param'	 => $this->input->get('q')
			);

			$order['data'][] = array(
				'column' => 'penawaran_nomor',
				'type'	 => 'ASC'
			);

			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			$response['items'] = array();

			if ($query<>false) {

				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->penawaran_id,
						'text'	=> $val->penawaran_nomor
					);
				}
				$response['status'] = '200';
			}

		} else if ($type == 2) {

			$select = '*';
			$join['data'][] = array(
				'table' => 't_penawaran_supplier b',
				'join'	=> 'b.t_penawaran_id = a.penawaran_id',
				'type'	=> 'inner'
			);

			$where['data'][] = array(
				'column' => 'a.penawaran_status',
				'param'	 => 4
			);

			$where['data'][] = array(
				'column' => 'a.penawaran_jenis',
				'param'	 => 1
			);

			$where['data'][] = array(
				'column' => 'b.m_partner_id',
				'param'	 => $this->input->get('id')
			);

			$where['data'][] = array(
				'column' => 'b.penawaran_supplier_pemenang',
				'param'	 => 1
			);

			$order['data'][] = array(
				'column' => 'penawaran_nomor',
				'type'	 => 'ASC'
			);

			$query = $this->mod->select('a.*, b.*', 't_penawaran a', $join, $where, NULL, NULL, $order);

			$response['items'] = array();
			if ($query<>false) {

				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->penawaran_id,
						'text'	=> $val->penawaran_nomor
					);
				}
				$response['status'] = '200';
			}

		} else if ($type == 3) {
			$select = '*';
			$join['data'][] = array(
				'table' => 't_penawaran_supplier b',
				'join'	=> 'b.t_penawaran_id = a.penawaran_id',
				'type'	=> 'inner'
			);
			$where['data'][] = array(
				'column' => 'a.penawaran_status',
				'param'	 => 4
			);
			$where['data'][] = array(
				'column' => 'a.penawaran_jenis',
				'param'	 => 2
			);
			$where['data'][] = array(
				'column' => 'b.m_partner_id',
				'param'	 => $this->input->get('id')
			);
			$where['data'][] = array(
				'column' => 'b.penawaran_supplier_pemenang',
				'param'	 => 1
			);
			$order['data'][] = array(
				'column' => 'penawaran_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select('a.*, b.*', 't_penawaran a', $join, $where, NULL, NULL, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->penawaran_id,
						'text'	=> $val->penawaran_nomor
					);
				}
				$response['status'] = '200';
			}
		}
		// echo $this->db->last_query();
		echo json_encode($response);
	}

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'penawaran_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				// BARANG
				$join_brg['data'][] = array(
					'table' => 'm_barang b',
					'join'	=> 'b.barang_id = a.m_barang_id',
					'type'	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_jenis_barang c',
					'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
					'type'	=> 'left'
				);
				$join_brg['data'][] = array(
					'table' => 'm_satuan d',
					'join'	=> 'd.satuan_id = b.m_satuan_id',
					'type'	=> 'left'
				);
				$where_brg['data'][] = array(
					'column' => 't_penawaran_id',
					'param'	 => $val->penawaran_id
				);
				$query_brg = $this->mod->select('a.*, b.*, c.*, d.*', 't_penawaran_barang a', $join_brg, $where_brg);
				$response['step1'] = array();
				if ($query_brg) {
					foreach ($query_brg->result() as $val2) {

						$response['step1'][] = array(
							'penawaran_barang_id'		=> $val2->penawaran_barang_id,
							't_permintaan_pembelian'	=> $val2->t_permintaan_pembelian,
							'm_barang_id'				=> $val2->m_barang_id,
							'barang_nomor'				=> $val2->barang_nomor,
							'barang_uraian'				=> $val2->barang_nama.'('.$val2->barang_nomor.', '.$val2->jenis_barang_nama.')',
							'penawaran_barang_qty'		=> $val2->penawaran_barang_qty,
							'satuan_nama'				=> $val2->satuan_nama,
						);
					}
				}

				// SUPPLIER
				$join_sup['data'][] = array(
					'table' => 'm_partner b',
					'join'	=> 'b.partner_id = a.m_partner_id',
					'type'	=> 'left'
				);
				$where_sup['data'][] = array(
					'column' => 't_penawaran_id',
					'param'	 => $val->penawaran_id
				);
				$query_sup = $this->mod->select('a.*, b.*', 't_penawaran_supplier a', $join_sup, $where_sup);
				$response['step2'] = array();
				$response['step4'] = 0;
				if ($query_sup) {
					foreach ($query_sup->result() as $val2) {
						$response['step4'] += $val2->penawaran_supplier_pemenang;
						$response['step2'][] = array(
							'penawaran_supplier_id'				=> $val2->penawaran_supplier_id,
							'm_partner_id'						=> $val2->m_partner_id,
							'partner_nama'						=> $val2->partner_nama,
							'penawaran_supplier_kontak'			=> $val2->penawaran_supplier_kontak,
							'partner_alamat'					=> $val2->partner_alamat,
							'penawaran_supplier_pemenang'		=> $val2->penawaran_supplier_pemenang,
							'penawaran_supplier_alasan'			=> $val2->penawaran_supplier_alasan,
							'penawaran_supplier_tanggal_kirim'	=> $val2->penawaran_supplier_tanggal_kirim,
							'penawaran_supplier_diskon'			=> $val2->penawaran_supplier_diskon,
							'partner_telepon' 					=> implode(', ', json_decode($val2->partner_telepon)),
						);
					}
				}

				// HARGA
				$where_hrg['data'][] = array(
					'column' => 't_penawaran_id',
					'param'	 => $val->penawaran_id
				);
				$query_hrg = $this->mod->select('*', 't_penawaran_harga', NULL, $where_hrg);
				if ($query_hrg) {
					// $response['step3'] = 1;
					foreach ($query_hrg->result() as $val4) {
						$response['step3'][] = array(
							'supplier_kode'				=> $val4->t_penawaran_supplier_id,
							'barang_nomor'				=> $val4->t_penawaran_barang_id,
							'harga'								=> $val4->penawaran_harga_nominal
						);
					}
				}
				//END CARI HARGA
				// CARI CABANG
				$hasil6['val2'] = array();
				$where_cabang['data'][] = array(
					'column' => 'cabang_id',
					'param'	 => $val->m_cabang_id
				);
				$query_cabang = $this->mod->select('*','m_cabang',NULL,$where_cabang);
				if ($query_cabang) {
					foreach ($query_cabang->result() as $val2) {
						// CARI KOTA
						$hasil7['val2'] = array();
						$where_kota['data'][] = array(
							'column' => 'id',
							'param'	 => $val2->cabang_kota
						);
						$query_kota = $this->mod->select('*','regencies',NULL,$where_kota);
						if ($query_kota) {
							foreach ($query_kota->result() as $val3) {
								$hasil7['val3'][] = array(
									'id' 		=> $val3->id,
									'text' 		=> $val3->name,
								);
							}
						}
						// END CARI KOTA
						$hasil6['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil7,
							'telp'  => json_decode($val2->cabang_telepon)
						);
					}
				}
				// END CARI CABANG
				$name = $val->penawaran_nomor;
				$response['val'][] = array(
					'kode' 							=> $val->penawaran_id,
					'penawaran_nomor' 				=> $val->penawaran_nomor,
					'penawaran_tanggal'				=> date("d/m/Y",strtotime($val->penawaran_tanggal)),
					'cabang'									=> $hasil6,
					'penawaran_jenis' 				=> $val->penawaran_jenis,
					'penawaran_status' 				=> $val->penawaran_status,
					'penawaran_step' 					=> $val->penawaran_step,
					'penawaran_create_by' 		=> $val->penawaran_create_by
				);
			}
		}
		$response['title'][] = array(
		'aplikasi'		=> $this->app_name,
		'title_page' 	=> 'Penawaran Harga',
		'title_page2' 	=> 'Print Penawaran',
		);
		// echo json_encode($response);
		$this->pdf->set_paper('A4', 'landscape');
		$this->pdf->load_view('print/P_penawaran_harga', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	public function loadDataHarga($type){
		$id = $this->input->get('id');
		// CARI DETAIL BARANG
		$join_det['data'][] = array(
			'table' => 'm_barang b',
			'join'	=> 'b.barang_id = a.m_barang_id',
			'type'	=> 'inner'
		);
		$join_det['data'][] = array(
			'table' => 'm_jenis_barang c',
			'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
			'type'	=> 'inner'
		);
		$join_det['data'][] = array(
			'table' => 'm_satuan d',
			'join'	=> 'd.satuan_id = b.m_satuan_id',
			'type'	=> 'inner'
		);
		$where_det['data'][] = array(
			'column' => 'a.t_penawaran_id',
			'param'	 => $id
		);
		$data['barang'] = $this->mod->select('a.*, b.*, c.*, d.*','t_penawaran_barang a', $join_det, $where_det);

		// CARI DETAIL SUPPLIER
		$join_det2['data'][] = array(
			'table' => 'm_partner b',
			'join'	=> 'b.partner_id = a.m_partner_id',
			'type'	=> 'inner'
		);
		$where_det2['data'][] = array(
			'column' => 'a.t_penawaran_id',
			'param'	 => $id
		);
		$data['supplier'] = $this->mod->select('a.*, b.*','t_penawaran_supplier a', $join_det2, $where_det2);
		$data['mata_uang'] = $this->mod->select('*','m_mata_uang');
		if ($type == 1) {
			$this->load->view("penawaran-harga/V_form_penawaran_harga_tabel", $data);
		} else if ($type == 2) {
			$this->load->view("penawaran-harga/V_form_penawaran_harga_tabel_value", $data);
		}
	}

	public function loadDataPemenang($type){
		$id = $this->input->get('id');
		// CARI DETAIL BARANG
		$join_det['data'][] = array(
			'table' => 'm_barang b',
			'join'	=> 'b.barang_id = a.m_barang_id',
			'type'	=> 'inner'
		);
		$join_det['data'][] = array(
			'table' => 'm_jenis_barang c',
			'join'	=> 'c.jenis_barang_id = b.m_jenis_barang_id',
			'type'	=> 'inner'
		);
		$join_det['data'][] = array(
			'table' => 'm_satuan d',
			'join'	=> 'd.satuan_id = b.m_satuan_id',
			'type'	=> 'inner'
		);
		$where_det['data'][] = array(
			'column' => 'a.t_penawaran_id',
			'param'	 => $id
		);
		$data['barang'] = $this->mod->select('a.*, b.*, c.*, d.*','t_penawaran_barang a', $join_det, $where_det);

		// CARI DETAIL SUPPLIER
		$join_det2['data'][] = array(
			'table' => 'm_partner b',
			'join'	=> 'b.partner_id = a.m_partner_id',
			'type'	=> 'inner'
		);
		$where_det2['data'][] = array(
			'column' => 'a.t_penawaran_id',
			'param'	 => $id
		);

		$data['supplier'] = $this->mod->select('a.*, b.*','t_penawaran_supplier a', $join_det2, $where_det2);
		$data['mata_uang'] = $this->mod->select('*','m_mata_uang');

		if ($type == 1) {
			$this->load->view("penawaran-harga/V_form_penawaran_pemenang_tabel", $data);
		} else if ($type == 2) {
			$this->load->view("penawaran-harga/V_form_penawaran_pemenang_tabel_value", $data);
		}
	}

	// Function Insert & Update
	public function postData($type)
	{
		$id = $this->input->post('kode');
		$response['test'] = $type;
		$response['step'] = $this->input->post('step', TRUE);

		if (strlen($id)>0) {
			if ($type == 2) {

			} else {
				//UPDATE
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'penawaran_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if (@$data['penawaran_step'] == 2 && $this->input->post('statusSupplier', TRUE) == 0) {
					if($update->status) {
						$response['status'] = '200';
						$wheredelete['data'][] = array(
							'column' => 't_penawaran_id',
							'param'	 => $id
						);
						$delete = $this->mod->delete_data_table('t_penawaran_supplier', $wheredelete);

						// INSERT DETAIL SUPPLIER
						for ($i = 0; $i < sizeof($this->input->post('m_partner_id', TRUE)); $i++) {
							$data_det = $this->general_post_data3(1, $id, $i);
							$insert_det = $this->mod->insert_data_table('t_penawaran_supplier', NULL, $data_det);
							if($insert_det->status) {
								$response['status'] = '200';

							} else {
								$response['status'] = '204';

							}
						}
						// END INSERT DETAIL SUPPLIER
					} else {
						$response['status'] = '204';
					}
				} else if (@$data['penawaran_step'] == 3 && $this->input->post('statusHarga', TRUE) == 0) {
					// echo "3";
					if($update->status) {
						// $response['test'] = 'OK';
						$response['status'] = '200';
						$response['data_post'] = $_POST;

						// for ($i = 0; $i < sizeof($this->input->post('t_penawaran_barang_id', TRUE)); $i++) {
						// 	// UPDATE BARANG
						// 	$data_brg = array(
						// 		'penawaran_barang_qty_ditawarkan' => $this->input->post('penawaran_barang_qty_ditawarkan', TRUE)[$i],
						// 	);
						// 	if (@$where_brg['data']) {
						// 		unset($where_brg['data']);
						// 	}
						// 	$where_brg['data'][] = array(
						// 		'column' => 'penawaran_barang_id',
						// 		'param'	 => $this->input->post('t_penawaran_barang_id', TRUE)[$i]
						// 	);
						// 	$update_brg = $this->mod->update_data_table('t_penawaran_barang', $where_brg, $data_brg);
						// 	// END UPDATE BARANG
						// }

						// UPDATE DETAIL SUPPLIER
						for ($i = 0; $i < sizeof($this->input->post('t_penawaran_supplier_id', TRUE)); $i++) {
							$data_det = $this->general_post_data3(2, $id, $i);
							if (@$where_det['data']) {
								unset($where_det['data']);

							}
							$where_det['data'][] = array(
								'column' => 'penawaran_supplier_id',
								'param'	 => $this->input->post('t_penawaran_supplier_id', TRUE)[$i]
							);
							$update_det = $this->mod->update_data_table('t_penawaran_supplier', $where_det, $data_det);
							if($update_det->status) {
								$response['status'] = '200';

							} else {
								$response['status'] = '204';

							}
						}
						// END UPDATE DETAIL SUPPLIER

						// INSERT DETAIL HARGA
						for ($i = 0; $i < sizeof($this->input->post('penawaran_harga_nominal', TRUE)); $i++) {
							$data_det2 = $this->general_post_data4(1, $id, $i);
							$insert_det2 = $this->mod->insert_data_table('t_penawaran_harga', NULL, $data_det2);
							// echo $this->db->last_query();
							if($insert_det2->status) {
								$response['status'] = '200';

							} else {
								$response['status'] = '204';

							}
						}
						// END INSERT DETAIL HARGA

					} else {
						$response['status'] = '204';

					}

				} else if (@$data['penawaran_step'] == 4) {
					if($update->status) {
						$response['status'] = '200';
						// print_r($_POST);

						// UPDATE DETAIL SUPPLIER
						for ($i = 0; $i < sizeof($this->input->post('t_penawaran_supplier_id_pemenang', TRUE)); $i++) {
							$data_det = $this->general_post_data3(3, $id, $i);
							if (@$where_det['data']) {
								unset($where_det['data']);
							}
							$where_det['data'][] = array(
								'column' => 'penawaran_supplier_id',
								'param'	 => $this->input->post('t_penawaran_supplier_id_pemenang', TRUE)[$i]
							);
							$update_det = $this->mod->update_data_table('t_penawaran_supplier', $where_det, $data_det);
							if($update_det->status) {
								$response['status'] = '200';
							} else {
								$response['status'] = '204';
							}
						}
						// END UPDATE DETAIL SUPPLIER

					} else {
						$response['status'] = '204';
					}
				}
				// echo "12";
				$response['data'] 	= $data;
				$response['id'] 	= $id;
				$response['status'] = '200';
			}
		} else {
			//INSERT

			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';

				// CHANGE STATUS SPP
				for ($i = 0; $i < sizeof($this->input->post('id', TRUE)); $i++) {
					$data_spp = array(
						'permintaan_pembelian_status' 		=> 3,
						'permintaan_pembelian_status_date' 	=> date('Y-m-d H:i:s'),
					);
					if (@$where_spp['data']) {
						unset($where_spp['data']);
					}
					$where_spp['data'][] = array(
						'column' => 'permintaan_pembelian_id',
						'param'	 => $this->input->post('id', TRUE)[$i]
					);

					// INSERT t_permintaan_pembelianlog
					$query_spp = $this->mod->select('*', 't_permintaan_pembelian', NULL, $where_spp);
					if ($query_spp) {
						foreach ($query_spp->result() as $row) {
							$data_log = array(
								'referensi_id' 									=> $row->permintaan_pembelian_id,
								'permintaan_pembelianlog_status_dari' 			=> $row->permintaan_pembelian_status,
								'permintaan_pembelianlog_status_ke' 			=> 3,
								'permintaan_pembelianlog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'permintaan_pembelianlog_status_update_by'		=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_permintaan_pembelianlog', NULL, $data_log);
						}
					}
					// END INSERT t_permintaan_pembelianlog
					// UPDATE STATUS t_permintaan_pembelian
					$update_spp = $this->mod->update_data_table('t_permintaan_pembelian', $where_spp, $data_spp);
					// END UPDATE STATUS t_permintaan_pembelian
				}
				// END CHANGE STATUS SPP

				// INSERT DETAIL BARANG
				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) {

					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_penawaran_barang', NULL, $data_det);

					if($insert_det->status) {

						$response['status'] = '200';
						$data_sppdet = array(
							'permintaan_pembeliandet_status' => 1,
						);

						if (@$where_sppdet['data']) {
							unset($where_sppdet['data']);
						}

						$where_sppdet['data'][] = array(
							'column' => 't_permintaan_pembelian_id',
							'param'	 => $this->input->post('t_permintaan_pembelian', TRUE)[$i]
						);

						$where_sppdet['data'][] = array(
							'column' => 'm_barang_id',
							'param'	 => $this->input->post('m_barang_id', TRUE)[$i]
						);
						// UPDATE STATUS t_permintaan_pembeliandet
						$update_sppdet = $this->mod->update_data_table('t_permintaan_pembeliandet', $where_sppdet, $data_sppdet);
						// END UPDATE STATUS t_permintaan_pembeliandet
					} else {
						$response['status'] = '204';
					}

				}
				// END INSERT DETAIL BARANG

			} else {
				$response['status'] = '204';
			}
			$response['data'] = $data;
			$response['id'] = $insert->output;
		}
		// $response['ID'] = $this->input->post("id");
		echo json_encode($response);
	}

	public function deleteData(){
		$response['id'] = $this->input->post('id', TRUE);
		$where['data'][] = array(
			'column' => 'penawaran_id',
			'param'	 => $this->input->post('id')
		);
		$query = $this->mod->select('*', $this->tbl, NULL, $where);
		if ($query) {
			foreach ($query->result() as $row) {
				$permintaan_pembelian_id = json_decode($row->permintaan_pembelian_id);
				for ($i = 0; $i < sizeof($permintaan_pembelian_id); $i++) {
					$data_permintaan = array(
						'permintaan_pembelian_status' => 2,
					);

					$data_permintaan_det = array(
						'permintaan_pembeliandet_status' => 0,
					);

					if (@$where_permintaan['data']) {
						unset($where_permintaan['data']);
					}
					$where_permintaan['data'][] = array(
						'column' => 'permintaan_pembelian_id',
						'param'	 => $permintaan_pembelian_id[$i]
					);

					$where_permintaandet['data'][] = array(
						'column' => 't_permintaan_pembelian_id',
						'param'	 => $permintaan_pembelian_id[$i]
					);

					$update_permintaan = $this->mod->update_data_table('t_permintaan_pembelian', $where_permintaan, $data_permintaan);
					$update_permintaandet = $this->mod->update_data_table('t_permintaan_pembeliandet', $where_permintaandet, $data_permintaan_det);
				}
			}
			// HAPUS PENERIMAAN
			$where_penawaran_hdr['data'][] = array(
				'column' => 'penawaran_id',
				'param'	 => $this->input->post('id')
			);
			$query_penawaran_hdr = $this->mod->delete_data_table('t_penawaran', $where_penawaran_hdr);
			$where_penawaran_dtl['data'][] = array(
				'column' => 't_penawaran_id',
				'param'	 => $this->input->post('id')
			);
			$query_penawaran_dtl = $this->mod->delete_data_table('t_penawaran_barang', $where_penawaran_dtl);
			$query_penawaran_dtl = $this->mod->delete_data_table('t_penawaran_harga', $where_penawaran_dtl);
			$query_penawaran_dtl = $this->mod->delete_data_table('t_penawaran_supplier', $where_penawaran_dtl);
			// END HAPUS PENERIMAAN
			$response['status'] = '200';
		} else {
			$response['status'] = '204';
		}
		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('penawaran_tanggal', TRUE));
		$where['data'][] = array(
			'column' => 'penawaran_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('penawaran_status, penawaran_revised', $this->tbl, NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['penawaran_revised'] + 1;
			$status = $revised['penawaran_status'];
		}
		if ($type == 1) {
			$penawaran_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 					=> $this->session->userdata('cabang_id'),
				'penawaran_nomor' 				=> $penawaran_nomor,
				'penawaran_tanggal'				=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'penawaran_jenis' 				=> $this->input->post('penawaran_jenis', TRUE),
				'penawaran_step' 				=> $this->input->post('step', TRUE),
				'permintaan_pembelian_id' 		=> json_encode($this->input->post('id', TRUE)),
				'penawaran_status' 					=> 1,
				'penawaran_status_date'			=> date('Y-m-d H:i:s'),
				'penawaran_create_date'			=> date('Y-m-d H:i:s'),
				'penawaran_update_date'			=> date('Y-m-d H:i:s'),
				'penawaran_create_by'				=> $this->session->userdata('user_username'),
				'penawaran_revised' 				=> 0,
			);
		} else if ($type == 2) {
			if (@$status) {
				if ($status != 4) {
					$data = array(
						'penawaran_status' 			=> $this->input->post('step', TRUE),
						'penawaran_step' 			=> $this->input->post('step', TRUE),
						'penawaran_update_date'		=> date('Y-m-d H:i:s'),
						'penawaran_update_by'		=> $this->session->userdata('user_username'),
						'penawaran_revised' 		=> $rev,
					);
				} else {
					$data = array(
						'penawaran_update_date'		=> date('Y-m-d H:i:s'),
						'penawaran_update_by'		=> $this->session->userdata('user_username'),
						'penawaran_revised' 		=> $rev,
					);
				}
			}
		} else if ($type == 3) {
			if ($status != 4) {
				$data = array(
					'penawaran_status' 			=> $this->input->post('step', TRUE),
					'penawaran_step' 				=> $this->input->post('step', TRUE),
					'penawaran_update_date'	=> date('Y-m-d H:i:s'),
					'penawaran_update_by'		=> $this->session->userdata('user_username'),
					'penawaran_revised' 		=> $rev,
				);
			} else {
				$data = array(
					'penawaran_update_date'	=> date('Y-m-d H:i:s'),
					'penawaran_update_by'		=> $this->session->userdata('user_username'),
					'penawaran_revised' 		=> $rev,
				);
			}
		}

		return $data;
	}

	// DATA BARANG
	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'penawaran_barang_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('penawaran_barang_revised', 't_penawaran_barang', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['penawarandet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_penawaran_id' 				=> $idHdr,
				't_permintaan_pembelian'		=> $this->input->post('t_permintaan_pembelian', TRUE)[$seq],
				'm_barang_id' 					=> $this->input->post('m_barang_id', TRUE)[$seq],
				'penawaran_barang_qty' 			=> $this->input->post('penawaran_barang_qty', TRUE)[$seq],
				'penawaran_barang_create_date'	=> date('Y-m-d H:i:s'),
				'penawaran_barang_create_by'	=> $this->session->userdata('user_username'),
				'penawaran_barang_update_date'	=> date('Y-m-d H:i:s'),
				'penawaran_barang_revised' 		=> 0,
			);
		}

		return $data;
	}

	// DATA SUPPLIER
	function general_post_data3($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'penawaran_supplier_id',
			'param'	 => $this->input->post('t_penawaran_supplier_id', TRUE)[$seq]
		);
		$queryRevised = $this->mod->select('penawaran_supplier_revised', 't_penawaran_supplier', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['penawaran_supplier_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_penawaran_id' 					=> $idHdr,
				'm_partner_id' 						=> $this->input->post('m_partner_id', TRUE)[$seq],
				'penawaran_supplier_kontak' 		=> $this->input->post('penawaran_supplier_kontak', TRUE)[$seq],
				'penawaran_supplier_create_date'	=> date('Y-m-d H:i:s'),
				'penawaran_supplier_create_by'		=> $this->session->userdata('user_username'),
				'penawaran_supplier_update_date'	=> date('Y-m-d H:i:s'),
				'penawaran_supplier_revised' 		=> 0,
			);
		} else if ($type == 2) {
			$arrDate = explode('/', $this->input->post('penawaran_supplier_tanggal_kirim', TRUE)[$seq]);
			$data = array(
				'penawaran_supplier_diskon' 		=> $this->input->post('penawaran_supplier_diskon', TRUE)[$seq],
				'penawaran_supplier_ppn' 			=> $this->input->post('penawaran_supplier_ppn', TRUE)[$seq],
				'penawaran_supplier_tanggal_kirim' 	=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'penawaran_supplier_update_by'		=> $this->session->userdata('user_username'),
				'penawaran_supplier_update_date'	=> date('Y-m-d H:i:s'),
				'penawaran_supplier_revised' 		=> $rev,
			);
		} else if ($type == 3) {
			if ($this->input->post('penawaran_supplier_pemenang', TRUE)[$seq]) {
				$pemenang = 1;
			} else {
				$pemenang = 0;
			}
			$data = array(
				'penawaran_supplier_pemenang' 		=> $pemenang,
				'penawaran_supplier_alasan' 		=> $this->input->post('penawaran_supplier_alasan', TRUE)[$seq],
				'penawaran_supplier_update_by'		=> $this->session->userdata('user_username'),
				'penawaran_supplier_update_date'	=> date('Y-m-d H:i:s'),
				'penawaran_supplier_revised' 		=> $rev,
			);
		}

		return $data;
	}

	// DATA HARGA
	function general_post_data4($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		if ($type == 1) {
			$data = array(
				't_penawaran_id' 									=> $idHdr,
				't_penawaran_supplier_id' 				=> $this->input->post('t_penawaran_supplier_id2', TRUE)[$seq],
				't_penawaran_barang_id' 					=> $this->input->post('t_penawaran_barang_id2', TRUE)[$seq],
				'm_mata_uang_id' 									=> $this->input->post('m_mata_uang', TRUE)[$seq],
				'penawaran_harga_qty_ditawarkan'	=> $this->input->post('penawaran_harga_qty_ditawarkan', TRUE)[$seq],
				'penawaran_harga_nominal' 				=> $this->input->post('penawaran_harga_nominal', TRUE)[$seq],
				'diskon_perbarang' 								=> $this->input->post('t_penawaran_barang_diskon_id2', TRUE)[$seq],
				'penawaran_harga_ppn' 						=> $this->input->post('penawaran_harga_ppn'.$this->input->post('t_penawaran_barang_id2', TRUE)[$seq].$this->input->post('t_penawaran_supplier_id2', TRUE)[$seq], TRUE),
			);
		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(penawaran_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(penawaran_nomor,1,9)',
			'param'	 => 'SRC'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'penawaran_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('SRC',$query);
		return $kode_baru;
	}
	/* end Function */

}
