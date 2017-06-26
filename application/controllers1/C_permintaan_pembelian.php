<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_permintaan_pembelian extends MY_Controller {
	private $any_error = array();
	// Define Main Table
	public $tbl = 't_permintaan_pembelian';

	public function __construct() {
        parent::__construct();
	}

	public function index(){
		// $this->view();
	}

	public function view($type){
		$this->check_session();

		if ($type == 1) {
			$priv = $this->cekUser(20);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Gudang',
				'title_page2' 	=> 'Permintaan Pembelian Barang',
				'priv_add'		=> $priv['create']
				);
			if($priv['read'] == 1)
			{
				$this->open_page('permintaan-pembelian/V_surat_permintaan_pembelian', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		} else if ($type == 2) {
			$priv = $this->cekUser(22);
			$data = array(
				'aplikasi'		=> $this->app_name,
				'title_page' 	=> 'Pembelian',
				'title_page2' 	=> 'Permintaan Pembelian Barang',
				);
			if($priv['read'] == 1)
			{
				$this->open_page('permintaan-pembelian/V_surat_permintaan_pembelian2', $data);
			}
			else
			{
				$this->load->view('layout/V_404', $data);
			}
		}
	}

	public function loadData($type){
		// $privGudang = $this->cekUser(21);
		// $priv = $this->cekUser(22);
		$select = '*';
		//LIMIT
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);
		//WHERE LIKE
		$where_like['data'][] = array(
			'column' => 'cabang_nama, permintaan_pembelian_nomor, permintaan_pembelian_jenis_nama, permintaan_pembelian_tanggal, permintaan_pembelian_status_nama',
			'param'	 => $this->input->get('search[value]')
		);
		//ORDER
		$index_order = $this->input->get('order[0][column]');
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);

		$query_total = $this->mod->select($select, 'v_permintaan_pembelian');
		$query_filter = $this->mod->select($select, 'v_permintaan_pembelian', NULL, NULL, NULL, $where_like, $order);
		$query = $this->mod->select($select, 'v_permintaan_pembelian', NULL, NULL, NULL, $where_like, $order, $limit);

		$response['data'] = array();
		if ($query<>false) {
			$no = $limit['start']+1;
			foreach ($query->result() as $val) {
				$status = '';
				$button2 = '';
				if ($val->permintaan_pembelian_status >= 4) {
					$status = 'disabled';
				}

				if ($type == 1) {
					$button = '
					<a href="'.base_url().'Gudang/Surat-Permintaan-Pembelian/Form/'.$val->permintaan_pembelian_id.'">
					<button class="btn blue-ebonyclay" type="button" title="Lihat SPP">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Gudang/Surat-Permintaan-Pembelian/print-SPP/'.$val->permintaan_pembelian_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
					if ($val->permintaan_pembelian_status == 1) {
						$button .= '
						<button class="btn red-thunderbird" type="button" onclick="deleteData('.$val->permintaan_pembelian_id.')" title="Hapus Data">
							<i class="icon-close text-center"></i>
						</button>';
					}
				} else if ($type == 2) {
					$button = '
					<a href="'.base_url().'Pembelian/Surat-Permintaan-Pembelian/Form/'.$val->permintaan_pembelian_id.'">
					<button class="btn blue-ebonyclay" type="button" onclick="checkStatusSPP('.$val->permintaan_pembelian_id.')" title="Lihat SPP">
						<i class="icon-eye text-center"></i>
					</button>
					</a>
					<a href="'.base_url().'Pembelian/Surat-Permintaan-Pembelian/print-SPP/'.$val->permintaan_pembelian_id.'">
					<button class="btn green-jungle" type="button" title="Print PDF">
						<i class="icon-printer text-center"></i>
					</button>
					</a>';
				}
				if($val->permintaan_pembelian_jenis_nama == 'Penting')
				{
					$status = '<span class="label bg-red-thunderbird bg-font-red-thunderbird">'.$val->permintaan_pembelian_jenis_nama.' </span>';
				}
				else
				{
					$status = $val->permintaan_pembelian_jenis_nama;
				}
				$response['data'][] = array(
					$no,
					$val->cabang_nama,
					$val->permintaan_pembelian_nomor,
					$status,
					date("d/m/Y",strtotime($val->permintaan_pembelian_tanggal)),
					$val->permintaan_pembelian_status_nama,
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
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Gudang',
			'title_page2'	=> 'Permintaan Pembelian Barang',
			'id'					=> $id
		);
		$this->open_page('permintaan-pembelian/V_form_surat_permintaan_pembelian', $data);
	}

	public function getForm2($id = null){
		$data = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Pembelian',
			'title_page2' 	=> 'Permintaan Pembelian Barang',
			'id'			=> $id
		);
		$this->open_page('permintaan-pembelian/V_form_surat_permintaan_pembelian2', $data);
	}

	public function loadDataWhere($type){
		$select = '*';
		$permintaan_pembelian_id = $this->input->get('id');

		if ($permintaan_pembelian_id==null) {
			$permintaan_pembelian_id = $this->input->post('id');
		}

		$where['data'][] = array(
			'column' => 'permintaan_pembelian_id',
			'param'	 => $permintaan_pembelian_id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		// echo $this->db->last_query();
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$where_det['data'][] = array(
					'column' => 't_permintaan_pembelian_id',
					'param'	 => $val->permintaan_pembelian_id
				);
				$query_det = $this->mod->select('*','t_permintaan_pembeliandet',NULL,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						// CARI BARANG DAN STOK
						if (@$join_brg['data']) {
							unset($join_brg['data']);
						}
						if (@$where_brg['data']) {
							unset($where_brg['data']);
						}
						$join_brg['data'][] = array(
							'table' => 'm_jenis_barang c',
							'join'	=> 'c.jenis_barang_id = a.m_jenis_barang_id',
							'type'	=> 'left'
						);
						$join_brg['data'][] = array(
							'table' => 'm_satuan d',
							'join'	=> 'd.satuan_id = a.m_satuan_id',
							'type'	=> 'left'
						);
						$where_brg['data'][] = array(
							'column' => 'a.barang_id',
							'param'	 => $val2->m_barang_id
						);
						$query_brg = $this->mod->select('a.*, c.jenis_barang_nama, d.satuan_nama','m_barang a',$join_brg,$where_brg);
						if ($query_brg) {
							foreach ($query_brg->result() as $val3) {
								$response['val2'][] = array(
									'permintaan_pembeliandet_id'			=> $val2->permintaan_pembeliandet_id,
									'barang_kode'							=> $val3->barang_kode,
									'barang_nama'							=> $val3->barang_nama,
									'barang_nomor'							=> $val3->barang_nomor,
									'jenis_barang_nama'						=> $val3->jenis_barang_nama,
									'satuan_nama'							=> $val3->satuan_nama,
									'permintaan_pembeliandet_qty'			=> $val2->permintaan_pembeliandet_qty,
									'permintaan_pembeliandet_qty_realisasi'	=> $val2->permintaan_pembeliandet_qty_realisasi,
									'permintaan_pembeliandet_status'		=> $val2->permintaan_pembeliandet_status,
									'm_barang_id'							=> $val2->m_barang_id,
								);
							}
						}
						// CARI BARANG DAN STOK
					}
				}
				// END CARI DETAIL
				// CARI GUDANG PERMINTAAN
				$hasil2['val2'] = array();
				$where_gudang['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->m_gudang_id_permintaan
				);
				$query_gudang = $this->mod->select('*','m_gudang',NULL,$where_gudang);
				foreach ($query_gudang->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->gudang_id,
						'text' 	=> $val2->gudang_nama
					);
				}
				// END CARI GUDANG PERMINTAAN
				// CARI PENERIMA
				$hasil3['val2'] = array();
				$where_pj['data'][] = array(
					'column' => 'permintaan_jasa_id',
					'param'	 => $val->t_permintaan_jasa
				);
				$query_pj = $this->mod->select('*','t_permintaan_jasa',NULL,$where_pj);
				if ($query_pj) {
					foreach ($query_pj->result() as $val2) {
						$hasil3['val2'][] = array(
							'id' 	=> $val2->permintaan_jasa_id,
							'text' 	=> $val2->permintaan_jasa_nomor
						);
					}
				}
				// END CARI PENERIMA
				// CARI PENYETUJU
				$hasil4['val2'] = array();
				$where_penyetuju['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->permintaan_pembelian_penyetuju
				);
				$query_penyetuju = $this->mod->select('*','m_karyawan',NULL,$where_penyetuju);
				if ($query_penyetuju) {
					foreach ($query_penyetuju->result() as $val2) {
						$hasil4['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama
						);
					}
				}
				// END CARI PENYETUJU
				// CARI PENERIMA
				$hasil5['val2'] = array();
				$where_penerima['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->permintaan_pembelian_penerima
				);
				$query_penerima = $this->mod->select('*','m_karyawan',NULL,$where_penerima);
				if ($query_penerima) {
					foreach ($query_penerima->result() as $val2) {
						$hasil5['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama
						);
					}
				}
				// END CARI PENERIMA

				$response['val'][] = array(
					'kode' 										=> $val->permintaan_pembelian_id,
					'permintaan_pembelian_nomor' 				=> $val->permintaan_pembelian_nomor,
					'permintaan_pembelian_tanggal'				=> date("d/m/Y",strtotime($val->permintaan_pembelian_tanggal)),
					'permintaan_pembelian_tanggal_dibutuhkan'	=> date("d/m/Y",strtotime($val->permintaan_pembelian_tanggal_dibutuhkan)),
					'permintaan_pembelian_type' 				=> $val->permintaan_pembelian_type,
					'permintaan_pembelian_jenis' 				=> $val->permintaan_pembelian_jenis,
					'm_gudang_id_permintaan'					=> $hasil2,
					't_permintaan_jasa'							=> $hasil3,
					'permintaan_pembelian_status' 				=> $val->permintaan_pembelian_status,
					'permintaan_pembelian_penyetuju' 			=> $hasil4,
					'permintaan_pembelian_penerima' 			=> $hasil5,
					'permintaan_pembelian_alasan' 				=> $val->permintaan_pembelian_alasan,
					'permintaan_pembelian_catatan' 				=> $val->permintaan_pembelian_catatan,
					'permintaan_pembelian_konsinyasi'			=> $val->permintaan_pembelian_konsinyasi
				);
			}

			echo json_encode($response);
		}
	}

	public function checkStatus(){
		$id = $this->input->get('id');
		$select = '*';
		$where['data'][] = array(
			'column' => 'permintaan_pembelian_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {
			foreach ($query->result() as $row) {
				if ($row->permintaan_pembelian_status == 1) {

					$data = $this->general_post_data(3, $id);
					$where['data'][] = array(
						'column' => 'permintaan_pembelian_id',
						'param'	 => $id
					);
					$update = $this->mod->update_data_table($this->tbl, $where, $data);
					// INSERT LOG);
					$data_log = array(
						'referensi_id' 									=> $id,
						'permintaan_pembelianlog_status_dari' 			=> 1,
						'permintaan_pembelianlog_status_ke' 			=> 2,
						'permintaan_pembelianlog_status_update_date' 	=> date('Y-m-d H:i:s'),
						'permintaan_pembelianlog_status_update_by'		=> $this->session->userdata('user_username'),
					);
					$insert_log = $this->mod->insert_data_table('t_permintaan_pembelianlog', NULL, $data_log);
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

	public function loadData_select($type, $status = NULL){
		$param = $this->input->get('q');
		if ($param!=NULL) {
			$param = $this->input->get('q');
		} else {
			$param = "";
		}
		$select = '*';
		if($type == 1)
		{
			if ($status) {
				$where['data'][] = array(
					'column' => 'permintaan_pembelian_status <',
					'param'	 => 3
				);
			}
			$where['data'][] = array(
				'column' => 't_permintaan_jasa ',
				'param'	 => null
			);
			$where_like['data'][] = array(
				'column' => 'permintaan_pembelian_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'permintaan_pembelian_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
			// echo $this->db->last_query();
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->permintaan_pembelian_id,
						'text'	=> $val->permintaan_pembelian_nomor
					);
				}
				$response['status'] = '200';
			}
		}
		if($type == 2)
		{
			if ($status) {
				$where['data'][] = array(
					'column' => 'permintaan_pembelian_status <',
					'param'	 => 3
				);
			}
			$where = "(t_permintaan_jasa IS NOT NULL) ";
			$where_like['data'][] = array(
				'column' => 'permintaan_pembelian_nomor',
				'param'	 => $this->input->get('q')
			);
			$order['data'][] = array(
				'column' => 'permintaan_pembelian_nomor',
				'type'	 => 'ASC'
			);
			$query = $this->mod->select($select, $this->tbl, NULL, NULL, $where, $where_like, $order);
			$response['items'] = array();
			if ($query<>false) {
				foreach ($query->result() as $val) {
					$response['items'][] = array(
						'id'	=> $val->permintaan_pembelian_id,
						'text'	=> $val->permintaan_pembelian_nomor
					);
				}
				$response['status'] = '200';
			}
		}

		echo json_encode($response);
	}

	public function cetakPDF($id)
	{
		$this->load->library('pdf');
		$name = '';
		$select = '*';
		$where['data'][] = array(
			'column' => 'permintaan_pembelian_id',
			'param'	 => $id
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where);
		if ($query<>false) {

			foreach ($query->result() as $val) {
				// CARI DETAIL
				$where_det['data'][] = array(
					'column' => 't_permintaan_pembelian_id',
					'param'	 => $val->permintaan_pembelian_id
				);
				$query_det = $this->mod->select('*','t_permintaan_pembeliandet',NULL,$where_det);
				$response['val2'] = array();

				if ($query_det) {
					foreach ($query_det->result() as $val2) {
						// CARI BARANG DAN STOK
						if (@$join_brg['data']) {
							unset($join_brg['data']);
						}
						if (@$where_brg['data']) {
							unset($where_brg['data']);
						}
						$join_brg['data'][] = array(
							'table' => 'm_jenis_barang c',
							'join'	=> 'c.jenis_barang_id = a.m_jenis_barang_id',
							'type'	=> 'left'
						);
						$join_brg['data'][] = array(
							'table' => 'm_satuan d',
							'join'	=> 'd.satuan_id = a.m_satuan_id',
							'type'	=> 'left'
						);
						$where_brg['data'][] = array(
							'column' => 'a.barang_id',
							'param'	 => $val2->m_barang_id
						);
						$query_brg = $this->mod->select('a.*, c.jenis_barang_nama, d.satuan_nama','m_barang a',$join_brg,$where_brg);
						if ($query_brg) {
							foreach ($query_brg->result() as $val3) {
								$response['val2'][] = array(
									'permintaan_pembeliandet_id'		=> $val2->permintaan_pembeliandet_id,
									'barang_kode'						=> $val3->barang_kode,
									'barang_nama'						=> $val3->barang_nama,
									'barang_nomor'						=> $val3->barang_nomor,
									'jenis_barang_nama'					=> $val3->jenis_barang_nama,
									'satuan_nama'						=> $val3->satuan_nama,
									'permintaan_pembeliandet_qty'		=> $val2->permintaan_pembeliandet_qty,
									'm_barang_id'						=> $val2->m_barang_id,
								);
							}
						}
						// CARI BARANG DAN STOK
					}
				}
				// END CARI DETAIL
				// CARI CABANG
				$hasil1['val2'] = array();
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
						$hasil1['val2'][] = array(
							'id' 	=> $val2->cabang_id,
							'text' 	=> $val2->cabang_nama,
							'alamat'=> $val2->cabang_alamat,
							'kota'	=> $hasil7,
							'telp'  => json_decode($val2->cabang_telepon)
						);
					}
				}
				// END CARI CABANG
				// CARI GUDANG PERMINTAAN
				$hasil2['val2'] = array();
				$where_gudang['data'][] = array(
					'column' => 'gudang_id',
					'param'	 => $val->m_gudang_id_permintaan
				);
				$query_gudang = $this->mod->select('*','m_gudang',NULL,$where_gudang);
				foreach ($query_gudang->result() as $val2) {
					$hasil2['val2'][] = array(
						'id' 	=> $val2->gudang_id,
						'text' 	=> $val2->gudang_nama
					);
				}
				// END CARI GUDANG PERMINTAAN
				// CARI PENYETUJU
				$hasil4['val2'] = array();
				$where_penyetuju['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->permintaan_pembelian_penyetuju
				);
				$query_penyetuju = $this->mod->select('*','m_karyawan',NULL,$where_penyetuju);
				if ($query_penyetuju) {
					foreach ($query_penyetuju->result() as $val2) {
						$hasil4['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama
						);
					}
				}
				// END CARI PENYETUJU
				// CARI PENERIMA
				$hasil5['val2'] = array();
				$where_penerima['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->permintaan_pembelian_penerima
				);
				$query_penerima = $this->mod->select('*','m_karyawan',NULL,$where_penerima);
				if ($query_penerima) {
					foreach ($query_penerima->result() as $val2) {
						$hasil5['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama
						);
					}
				}
				// END CARI PENERIMA
				// CARI PEMBUAT
				$hasil6['val2'] = array();
				$where_pembuat['data'][] = array(
					'column' => 'karyawan_id',
					'param'	 => $val->permintaan_pembelian_pembuat
				);
				$query_pembuat = $this->mod->select('*','m_karyawan',NULL,$where_pembuat);
				if ($query_pembuat) {
					foreach ($query_pembuat->result() as $val2) {
						$hasil6['val2'][] = array(
							'id' 	=> $val2->karyawan_id,
							'text' 	=> $val2->karyawan_nama
						);
					}
				}
				// END CARI PEMBUAT

				$name = $val->permintaan_pembelian_nomor;
				$response['val'][] = array(
					'cabang'									=> $hasil1,
					'kode' 										=> $val->permintaan_pembelian_id,
					'permintaan_pembelian_nomor' 				=> $val->permintaan_pembelian_nomor,
					'permintaan_pembelian_tanggal'				=> date("d/m/Y",strtotime($val->permintaan_pembelian_tanggal)),
					'permintaan_pembelian_tanggal_dibutuhkan'	=> date("d/m/Y",strtotime($val->permintaan_pembelian_tanggal_dibutuhkan)),
					'permintaan_pembelian_jenis' 				=> $val->permintaan_pembelian_jenis,
					'm_gudang_id_permintaan'					=> $hasil2,
					'permintaan_pembelian_status' 				=> $val->permintaan_pembelian_status,
					'permintaan_pembelian_penyetuju' 			=> $hasil4,
					'permintaan_pembelian_penerima' 			=> $hasil5,
					'permintaan_pembelian_pembuat' 				=> $hasil6,
					'permintaan_pembelian_alasan' 				=> $val->permintaan_pembelian_alasan,
					'permintaan_pembelian_catatan' 				=> $val->permintaan_pembelian_catatan,
				);
			}
		}
		$response['title'][] = array(
			'aplikasi'		=> $this->app_name,
			'title_page' 	=> 'Permintaan Pembelian Barang',
			'title_page2' 	=> 'Print Permintaan Pembelian Barang',
		);

		$this->pdf->load_view('print/P_spp', $response);
		$this->pdf->render();
		$this->pdf->stream($name,array("Attachment"=>false));
	}

	// public function loadData_select(){
	// 	$param = $this->input->get('q');
	// 	if ($param!=NULL) {
	// 		$param = $this->input->get('q');
	// 	} else {
	// 		$param = "";
	// 	}
	// 	$select = '*';
	// 	$where['data'][] = array(
	// 		'column' => 'barang_status_aktif',
	// 		'param'	 => 'y'
	// 	);
	// 	$where_like['data'][] = array(
	// 		'column' => 'barang_nama',
	// 		'param'	 => $this->input->get('q')
	// 	);
	// 	$order['data'][] = array(
	// 		'column' => 'barang_nama',
	// 		'type'	 => 'ASC'
	// 	);
	// 	$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, $where_like, $order);
	// 	$response['items'] = array();
	// 	if ($query<>false) {
	// 		foreach ($query->result() as $val) {
	// 			$response['items'][] = array(
	// 				'id'	=> $val->barang_id,
	// 				'text'	=> $val->barang_nama
	// 			);
	// 		}
	// 		$response['status'] = '200';
	// 	}

	// Function Insert & Update
	public function postData($type){

		$id = $this->input->post('kode');
		$response['test'] = $type;
		if (strlen($id)>0) {
			if ($type == 2) {
				//UPDATE
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'permintaan_pembelian_id',
					'param'	 => $id
				);

				$update = $this->mod->update_data_table($this->tbl, $where, $data);

				if($update->status) {

					$response['status'] = '200';
					// INSERT LOG
					if (@$data['permintaan_pembelian_status']) {

						if ($data['permintaan_pembelian_status'] == 4){

							$data_log = array(
								'referensi_id' 																=> $id,
								'permintaan_pembelianlog_status_dari' 				=> 2,
								'permintaan_pembelianlog_status_ke' 					=> 4,
								'permintaan_pembelianlog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'permintaan_pembelianlog_status_update_by' 		=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_permintaan_pembelianlog', NULL, $data_log);

						} else if ($data['permintaan_pembelian_status'] == 5){

							$data_log = array(
								'referensi_id' 																=> $id,
								'permintaan_pembelianlog_status_dari' 				=> 4,
								'permintaan_pembelianlog_status_ke' 					=> 5,
								'permintaan_pembelianlog_status_update_date' 	=> date('Y-m-d H:i:s'),
								'permintaan_pembelianlog_status_update_by' 		=> $this->session->userdata('user_username'),
							);
							$insert_log = $this->mod->insert_data_table('t_permintaan_pembelianlog', NULL, $data_log);

						}
					}
					// UPDATE DETAIL
					for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) {

						if (@$where_det['data']) {
							unset($where_det['data']);
						}

						$where_det['data'][] = array(
							'column' => 'permintaan_pembeliandet_id',
							'param'	 => $this->input->post('permintaan_pembeliandet_id', TRUE)[$i]
						);

						$data_det 	= $this->general_post_data2(2, $id, $i, $this->input->post('permintaan_pembeliandet_id', TRUE)[$i]);
						$update_det = $this->mod->update_data_table('t_permintaan_pembeliandet', $where_det, $data_det);

						if($update_det->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}

					}
					// END FOR DETAIL
				} else {
					$response['status'] = '204';
				}

			} else {
				//UPDATE
				$data = $this->general_post_data(2, $id);
				$where['data'][] = array(
					'column' => 'permintaan_pembelian_id',
					'param'	 => $id
				);
				$update = $this->mod->update_data_table($this->tbl, $where, $data);
				if($update->status) {
					$response['status'] = '200';
					// UPDATE DETAIL
					for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) {
						if (@$where_det['data']) {
							unset($where_det['data']);
						}
						$where_det['data'][] = array(
							'column' => 'permintaan_pembeliandet_id',
							'param'	 => $this->input->post('permintaan_pembeliandet_id', TRUE)[$i]
						);
						$data_det = $this->general_post_data2(2, $id, $i, $this->input->post('permintaan_pembeliandet_id', TRUE)[$i]);
						$update_det = $this->mod->update_data_table('t_permintaan_pembeliandet', $where_det, $data_det);
						if($update_det->status) {
							$response['status'] = '200';
						} else {
							$response['status'] = '204';
						}
					}
					// END FOR DETAIL
				} else {
					$response['status'] = '204';
				}
			}
		} else {
			//INSERT
			$data = $this->general_post_data(1);
			$insert = $this->mod->insert_data_table($this->tbl, NULL, $data);
			if($insert->status) {
				$response['status'] = '200';
				// INSERT DETAIL
				for ($i = 0; $i < sizeof($this->input->post('m_barang_id', TRUE)); $i++) {
					$data_det = $this->general_post_data2(1, $insert->output, $i);
					$insert_det = $this->mod->insert_data_table('t_permintaan_pembeliandet', NULL, $data_det);
					if($insert_det->status) {
						$response['status'] = '200';
					} else {
						$response['status'] = '204';
					}
				}
			} else {
				$response['status'] = '204';
			}
		}
		echo json_encode($response);
	}

	public function deleteData(){
		// HAPUS PENERIMAAN
		$where_permintaan_hdr['data'][] = array(
			'column' => 'permintaan_pembelian_id',
			'param'	 => $this->input->post('id')
		);
		$query_permintaan_hdr = $this->mod->delete_data_table('t_permintaan_pembelian', $where_permintaan_hdr);
		$where_permintaan_dtl['data'][] = array(
			'column' => 't_permintaan_pembelian_id',
			'param'	 => $this->input->post('id')
		);
		$query_permintaan_dtl = $this->mod->delete_data_table('t_permintaan_pembeliandet', $where_permintaan_dtl);
		// END HAPUS PENERIMAAN
		$response['status'] = '200';
		echo json_encode($response);
	}

	/* Saving $data as array to database */
	function general_post_data($type, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$arrDate = explode('/', $this->input->post('permintaan_pembelian_tanggal', TRUE));
		$arrDate2 = explode('/', $this->input->post('permintaan_pembelian_tanggal_dibutuhkan', TRUE));

		$where['data'][] = array(
			'column' => 'permintaan_pembelian_id',
			'param'	 => $id
		);

		$queryRevised = $this->mod->select('permintaan_pembelian_status, permintaan_pembelian_revised', $this->tbl, NULL, $where);

		if ($queryRevised) {

			$revised = $queryRevised->row_array();
			$rev = $revised['permintaan_pembelian_revised'] + 1;
			$status = $revised['permintaan_pembelian_status'];

		}

		if ($type == 1) {
			$permintaan_pembelian_nomor = $this->get_kode_transaksi();
			$data = array(
				'm_cabang_id' 														=> $this->session->userdata('cabang_id'),
				'permintaan_pembelian_nomor' 							=> $permintaan_pembelian_nomor,
				'permintaan_pembelian_tanggal'						=> $arrDate[2]."-".$arrDate[1]."-".$arrDate[0],
				'permintaan_pembelian_tanggal_dibutuhkan'	=> $arrDate2[2]."-".$arrDate2[1]."-".$arrDate2[0],
				'permintaan_pembelian_type' 							=> $this->input->post('permintaan_pembelian_type', TRUE),
				'permintaan_pembelian_jenis' 							=> $this->input->post('permintaan_pembelian_jenis', TRUE),
				'm_gudang_id_permintaan' 									=> $this->input->post('m_gudang_id_permintaan', TRUE),
				't_permintaan_jasa' 											=> $this->input->post('t_permintaan_jasa_id', TRUE),
				'permintaan_pembelian_status' 						=> $this->input->post('permintaan_pembelian_status', TRUE),
				'permintaan_pembelian_status_date'				=> date('Y-m-d H:i:s'),
				'permintaan_pembelian_pembuat'						=> $this->session->userdata('karyawan_id'),
				'permintaan_pembelian_alasan' 						=> $this->input->post('permintaan_pembelian_alasan', TRUE),
				'permintaan_pembelian_catatan'						=> $this->input->post('permintaan_pembelian_catatan', TRUE),
				'permintaan_pembelian_created_date'				=> date('Y-m-d H:i:s'),
				'permintaan_pembelian_update_date'				=> date('Y-m-d H:i:s'),
				'permintaan_pembelian_created_by'					=> $this->session->userdata('user_username'),
				'permintaan_pembelian_revised' 						=> 0,
				'permintaan_pembelian_konsinyasi'					=> $this->input->post('jenis_barang', TRUE)
			);
		} else if ($type == 2) {
			if ($status == $this->input->post('permintaan_pembelian_status', TRUE)) {
				if ($this->input->post('m_karyawan_id_penyetuju', TRUE)) {
					$data = array(
						'permintaan_pembelian_penyetuju' 		=> $this->input->post('m_karyawan_id_penyetuju', TRUE),
						'permintaan_pembelian_jenis' 				=> $this->input->post('permintaan_pembelian_jenis', TRUE),
						'permintaan_pembelian_alasan' 			=> $this->input->post('permintaan_pembelian_alasan', TRUE),
						'permintaan_pembelian_catatan'			=> $this->input->post('permintaan_pembelian_catatan', TRUE),
						'permintaan_pembelian_update_date'	=> date('Y-m-d H:i:s'),
						'permintaan_pembelian_update_by'		=> $this->session->userdata('user_username'),
						'permintaan_pembelian_revised' 			=> $rev,
					);
				} else if ($this->input->post('m_karyawan_id_penerima', TRUE)) {
					$data = array(
						'permintaan_pembelian_penerima' 		=> $this->input->post('m_karyawan_id_penerima', TRUE),
						'permintaan_pembelian_jenis' 				=> $this->input->post('permintaan_pembelian_jenis', TRUE),
						'permintaan_pembelian_alasan' 			=> $this->input->post('permintaan_pembelian_alasan', TRUE),
						'permintaan_pembelian_catatan'			=> $this->input->post('permintaan_pembelian_catatan', TRUE),
						'permintaan_pembelian_update_date'	=> date('Y-m-d H:i:s'),
						'permintaan_pembelian_update_by'		=> $this->session->userdata('user_username'),
						'permintaan_pembelian_revised' 			=> $rev,
					);
				} else {
					$data = array(
						'permintaan_pembelian_jenis' 				=> $this->input->post('permintaan_pembelian_jenis', TRUE),
						'permintaan_pembelian_alasan' 			=> $this->input->post('permintaan_pembelian_alasan', TRUE),
						'permintaan_pembelian_catatan'			=> $this->input->post('permintaan_pembelian_catatan', TRUE),
						'permintaan_pembelian_update_date'	=> date('Y-m-d H:i:s'),
						'permintaan_pembelian_update_by'		=> $this->session->userdata('user_username'),
						'permintaan_pembelian_revised' 			=> $rev,
					);
				}
			} else {
				if ($this->input->post('m_karyawan_id_penyetuju', TRUE)) {
					$data = array(
						'permintaan_pembelian_penyetuju' 		=> $this->input->post('m_karyawan_id_penyetuju', TRUE),
						'permintaan_pembelian_jenis' 				=> $this->input->post('permintaan_pembelian_jenis', TRUE),
						'permintaan_pembelian_alasan' 			=> $this->input->post('permintaan_pembelian_alasan', TRUE),
						'permintaan_pembelian_catatan'			=> $this->input->post('permintaan_pembelian_catatan', TRUE),
						'permintaan_pembelian_status' 			=> $this->input->post('permintaan_pembelian_status', TRUE),
						'permintaan_pembelian_update_date'	=> date('Y-m-d H:i:s'),
						'keluar_berang_update_by'						=> $this->session->userdata('user_username'),
						'permintaan_pembelian_revised' 			=> $rev,
					);
				} else if ($this->input->post('m_karyawan_id_penerima', TRUE)) {
					$data = array(
						'permintaan_pembelian_status' 			=> $this->input->post('permintaan_pembelian_status', TRUE),
						'permintaan_pembelian_jenis' 				=> $this->input->post('permintaan_pembelian_jenis', TRUE),
						'permintaan_pembelian_alasan' 			=> $this->input->post('permintaan_pembelian_alasan', TRUE),
						'permintaan_pembelian_catatan'			=> $this->input->post('permintaan_pembelian_catatan', TRUE),
						'permintaan_pembelian_penerima' 		=> $this->input->post('m_karyawan_id_penerima', TRUE),
						'permintaan_pembelian_update_date'	=> date('Y-m-d H:i:s'),
						'keluar_berang_update_by'						=> $this->session->userdata('user_username'),
						'permintaan_pembelian_revised' 			=> $rev,
					);
				} else {
					$data = array(
						'permintaan_pembelian_status' 			=> $this->input->post('permintaan_pembelian_status', TRUE),
						'permintaan_pembelian_jenis' 				=> $this->input->post('permintaan_pembelian_jenis', TRUE),
						'permintaan_pembelian_alasan' 			=> $this->input->post('permintaan_pembelian_alasan', TRUE),
						'permintaan_pembelian_catatan'			=> $this->input->post('permintaan_pembelian_catatan', TRUE),
						'permintaan_pembelian_status_date'	=> date('Y-m-d H:i:s'),
						'permintaan_pembelian_update_date'	=> date('Y-m-d H:i:s'),
						'keluar_berang_update_by'						=> $this->session->userdata('user_username'),
						'permintaan_pembelian_revised' 			=> $rev,
					);
				}
			}
		} else if ($type == 3) {
			$data = array(
				'permintaan_pembelian_status'				=> 2,
				'permintaan_pembelian_status_date'	=> date('Y-m-d H:i:s'),
				'permintaan_pembelian_update_date'	=> date('Y-m-d H:i:s'),
				'permintaan_pembelian_update_by'		=> $this->session->userdata('user_username'),
				'permintaan_pembelian_revised' 			=> $rev,
			);
		}

		return $data;
	}

	function general_post_data2($type, $idHdr, $seq, $id = null){
		// 1 Insert, 2 Update, 3 Delete / Non Aktif
		$where['data'][] = array(
			'column' => 'permintaan_pembeliandet_id',
			'param'	 => $id
		);
		$queryRevised = $this->mod->select('permintaan_pembeliandet_revised', 't_permintaan_pembeliandet', NULL, $where);
		if ($queryRevised) {
			$revised = $queryRevised->row_array();
			$rev = $revised['permintaan_pembeliandet_revised'] + 1;
		}
		if ($type == 1) {
			$data = array(
				't_permintaan_pembelian_id' 					=> $idHdr,
				'm_barang_id' 												=> $this->input->post('m_barang_id', TRUE)[$seq],
				'permintaan_pembeliandet_qty' 				=> $this->input->post('permintaan_pembeliandet_qty', TRUE)[$seq],
				'permintaan_pembeliandet_create_date'	=> date('Y-m-d H:i:s'),
				'permintaan_pembeliandet_create_by'		=> $this->session->userdata('user_username'),
				'permintaan_pembeliandet_update_date'	=> date('Y-m-d H:i:s'),
				'permintaan_pembeliandet_revised' 		=> 0,
			);
		} else if ($type == 2) {
			$data = array(
				't_permintaan_pembelian_id' 					=> $idHdr,
				'm_barang_id' 												=> $this->input->post('m_barang_id', TRUE)[$seq],
				'permintaan_pembeliandet_qty' 				=> $this->input->post('permintaan_pembeliandet_qty', TRUE)[$seq],
				'permintaan_pembeliandet_update_date'	=> date('Y-m-d H:i:s'),
				'permintaan_pembeliandet_update_by'		=> $this->session->userdata('user_username'),
				'permintaan_pembeliandet_revised' 		=> 0,
			);
			// if ($status == $this->input->post('permintaan_pembeliandet_status', TRUE)[$seq]) {
			// 	$data = array(
			// 		'permintaan_pembeliandet_qty_realisasi'	=> ($this->input->post('permintaan_pembeliandet_qty_realisasi', TRUE)[$seq] + $this->input->post('permintaan_pembeliandet_qty_kirim', TRUE)[$seq]),
			// 		'permintaan_pembeliandet_update_date'		=> date('Y-m-d H:i:s'),
			// 		'permintaan_pembeliandet_update_by'		=> $this->session->userdata('user_username'),
			// 		'permintaan_pembeliandet_revised' 			=> $rev,
			// 	);
			// } else {
			// 	$data = array(
			// 		'permintaan_pembeliandet_qty_realisasi'	=> ($this->input->post('permintaan_pembeliandet_qty_realisasi', TRUE)[$seq] + $this->input->post('permintaan_pembeliandet_qty_kirim', TRUE)[$seq]),
			// 		'permintaan_pembeliandet_status' 			=> $this->input->post('permintaan_pembeliandet_status', TRUE)[$seq],
			// 		'permintaan_pembeliandet_status_date'		=> date('Y-m-d H:i:s'),
			// 		'permintaan_pembeliandet_update_date'		=> date('Y-m-d H:i:s'),
			// 		'permintaan_pembeliandet_update_by'		=> $this->session->userdata('user_username'),
			// 		'permintaan_pembeliandet_revised' 			=> $rev,
			// 	);
			// }
		} else if ($type == 3) {
			$data = array(
				'm_barang_id' 												=> $this->input->post('m_barang_id', TRUE)[$seq],
				'permintaan_pembeliandet_update_date'	=> date('Y-m-d H:i:s'),
				'permintaan_pembeliandet_update_by'		=> $this->session->userdata('user_username'),
				'permintaan_pembeliandet_revised' 		=> $rev,
			);

		}

		return $data;
	}

	function get_kode_transaksi(){
		$bln = date('m');
		$thn = date('Y');
		$select = 'MID(permintaan_pembelian_nomor,10,5) as id';
		$where['data'][] = array(
			'column' => 'MID(permintaan_pembelian_nomor,1,9)',
			'param'	 => 'SPP'.$thn.''.$bln
		);
		$order['data'][] = array(
			'column' => 'permintaan_pembelian_nomor',
			'type'	 => 'DESC'
		);
		$limit = array(
			'start'  => 0,
			'finish' => 1
		);
		$query = $this->mod->select($select, $this->tbl, NULL, $where, NULL, NULL, $order, $limit);
		$kode_baru = $this->format_kode_transaksi('SPP',$query);
		return $kode_baru;
	}
	/* end Function */

}
