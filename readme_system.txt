MY_Model

1. Penggunaan function select()
- Aturan Urutan Parameter 
	1. Select (String)
		Contoh :
		$select = '*';
	2. Nama tabel (String)
		Contoh :
		$tabel = '*';
	3. Join tabel (Array)
		Contoh :
		$join['data'][] = array(
			'table' => 'tbl_bahan_mentah b',
			'join'	=> 'b.id_bahan_mentah = a.tbl_bahan_id_bahan',
			'type'	=> 'left'
		);
	4. Where (Aturan DB CI) (Array)
		Contoh :
		$where['data'][] = array(
			'column' => 'cabang_id',
			'param'	 => $this->input->get('id')
		);
	5. Where (Aturan Where SQL) (String)
		Contoh :
		$where = ' id = 1 ';
	6. Where Like (Concat) (Array)
		Contoh :
		$where_like['data'][] = array(
			'column' => 'cabang_nama,cabang_status_aktif',
			'param'	 => $this->input->get('search[value]')
		);
	7. Order (Array)
		Contoh :
		$order['data'][] = array(
			'column' => $this->input->get('columns['.$index_order.'][name]'),
			'type'	 => $this->input->get('order[0][dir]')
		);
	8. Limit (Array)
		Contoh :
		$limit = array(
			'start'  => $this->input->get('start'),
			'finish' => $this->input->get('length')
		);

