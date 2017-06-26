<html>
<head>
	<style>
	.gg {
    border:1px solid;
    }
	</style>
	<title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
</head>
<body>
	<h3 align="left"><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?><br><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?><br>
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
      ?></h3>
	<h2 align="center"><u>PENGUBAHAN BAHAN</u></h2>
	<table border="0" width="50%">
  		<tr>
  			<td align="left" width="10%">Tanggal</td>
			<td width="3%">:</td>
			<td><?= $val[0]['pengubahan_bahan_tanggal'] ?></td>
  		</tr>
  		<tr>
  			<td align="left">Nomor</td>
			<td width="3%">:</td>
			<td><?= $val[0]['pengubahan_bahan_nomor'] ?></td>
  		</tr>
	</table>
	<br>
	<h3><u>BAHAN</u></h3>
	<table border="1" width="100%" rules="all" cellpadding="5">
		<tr>
			<td align="center">No</td>
			<td align="center">Kode Barang</td>
			<td align="center">Deksripsi</td>
			<td align="center">Qty</td>
			<td align="center">Satuan</td>
			<td align="center">Gudang</td>
		</tr>
		<?php
			$no = 1;
			foreach ($val2 as $awal => $itemAwal) {
				echo '<tr align="left">';
	        	echo '<td align="center">'.$no.'</td>';
	        	echo '<td>'.$itemAwal['barang_kode'].'</td>';
	        	echo '<td>'.$itemAwal['barang_uraian'].'</td>';
	        	echo '<td align="center">'.$itemAwal['pengubahan_bahanawal_qty'].'</td>';
	        	echo '<td align="center">'.$itemAwal['satuan_nama'].'</td>';
	        	echo '<td align="center">'.$itemAwal['pengubahan_bahanawal_gudang_nama'].'</td>';
	        	echo '</tr>';
	        	$no++;
			}
		?>
	</table>
	<br>
	<h3><u>HASIL</u></h3>
	<table border="1" width="100%" rules="all" cellpadding="5">
		<tr>
			<td align="center">No</td>
			<td align="center">Kode Barang</td>
			<td align="center">Deksripsi</td>
			<td align="center">Qty</td>
			<td align="center">Satuan</td>
			<td align="center">Gudang</td>
		</tr>
		<?php
			$no = 1;
			foreach ($val3 as $hasil => $itemHasil) {
				echo '<tr align="left">';
	        	echo '<td align="center">'.$no.'</td>';
	        	echo '<td>'.$itemHasil['barang_kode'].'</td>';
	        	echo '<td>'.$itemHasil['barang_uraian'].'</td>';
	        	echo '<td align="center">'.$itemHasil['pengubahan_bahanakhir_qty'].'</td>';
	        	echo '<td align="center">'.$itemHasil['satuan_nama'].'</td>';
	        	echo '<td align="center">'.$itemHasil['pengubahan_bahanakhir_gudang_nama'].'</td>';
	        	echo '</tr>';
	        	$no++;
			}
		?>
	</table>
	<br>
	<table border="1" width="45%" rules="all" align="left">
		<tr>
			<td height="12%" valign="top">Keterangan :<br></td>
  		</tr>
	</table>
	<table border="1" width="40%" rules="all" align="right">
  		<tr>
			<td align="center" width="20%">Disetujui</td>
			<td align="center" width="20%">Dibuat</td>
  		</tr>
		<tr>
			<td height="8%"></td>
			<td align="center"><?= $val[0]['pengubahan_bahan_pembuat'] ?></td>
  		</tr>
		<tr>
			<td align="center">Kabag Produksi</td>
			<td align="center">Admin Produksi</td>
  		</tr>
	</table>
 </body>
</html>