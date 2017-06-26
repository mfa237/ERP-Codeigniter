<html>
<head>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
</head>
<body>
	<table width="100%" border="0">
		<tr>
			<th colspan="2" scope="row" valign="baseline" rowspan="2"><div align="left"><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b><br><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?><br>
      Telp. <?php 
      for($i=0; $i < count($val[0]['cabang']['val2'][0]['telp']); $i++)
      {
        if($i == count($val[0]['cabang']['val2'][0]['telp'])-1)
        {
          echo $val[0]['cabang']['val2'][0]['telp'][$i];
        }
        else
        {
          echo $val[0]['cabang']['val2'][0]['telp'][$i].', ';
        }
      }
      ?></div></th>
			<td width="4%" valign="top">No</td>
			<td width="1%" valign="top">:</td>
			<td width="27%" valign="top"><?= $val[0]['retur_pembelian_nomor'] ?></td>
		</tr>
		<tr>
			<td valign="top">Tgl</td>
			<td valign="top">:</td>
			<td valign="top"><?= $val[0]['retur_pembelian_tanggal'] ?></td>
		</tr>
		<tr>
			<th colspan="5" scope="row"><h3>NOTA RETUR PEMBELIAN</h3></th>
        </tr>
    </table>
	<table width="65%" border="0">
        <tr>
			<td width="20%">Nama Supplier</td>
			<td width="3%">:</td>
			<td width="63%"><?= $val[0]['supplier']['val2'][0]['text'] ?></td>
        </tr>
        <tr>
          <td>No. BPB</td>
          <td>:</td>
          <td><?= $val[0]['nomor_bpb'] ?></td>
        </tr>
        <tr>
          <td>Tgl. BPB</td>
          <td>:</td>
          <td><?= $val[0]['tanggal_bpb'] ?></td>
        </tr>
      </table>
      <table width="100%" border="1" cellspacing="0" cellpadding="6">
        <tr>
          <th width="8%" scope="col">No.</th>
          <th width="19%" scope="col">Kode Barang</th>
          <th width="25%" scope="col">Jenis Barang</th>
          <th width="10%" scope="col">Qty</th>
          <th width="12%" scope="col">Satuan</th>
          <th width="26%" scope="col">Keterangan</th>
        </tr>
        <?php
        $no = 1;
        foreach ($val2 as $barang => $itemBarang) {
          echo '<tr align="left">';
          echo '<td align="center">'.$no.'</td>';
          echo '<td>'.$itemBarang['barang_kode'].'</td>';
          echo '<td>'.$itemBarang['jenis_barang_nama'].'</td>';
          echo '<td align="center">'.$itemBarang['retur_pembeliandet_qty'].'</td>';
          echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
          echo '<td>'.$itemBarang['retur_pembeliandet_keterangan'].'</td>';
          echo '</tr>';
          $no++;
        }
      
      ?>
      </table>
	  <br>
      <table width="50%" border="1" cellspacing="0">
        <tr>
          <td width="25%"><div align="center">Disetujui</div></td>
          <td width="25%"><div align="center">Dibuat</div></td>
        </tr>
        <tr>
          <td height="8%"><div align="center"></div></td>
          <td><div align="center"><?= $val[0]['retur_pembelian_created_by'] ?></div></td>
        </tr>
        <tr>
          <td><div align="center">Mgr Operasional</div></td>
          <td><div align="center">Gudang Bahan</div></td>
        </tr>
     </table>
</body>
</html>