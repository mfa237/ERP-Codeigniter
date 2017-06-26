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
	<h3 align="center"><u>KETIDAKSESUAIAN SPESIFIKASI BAHAN</u></h3>
	<table border="0" width="100%">
  		<tr>
  			<td align="left" width="20%">Tanggal</td>
			<td width="3%">:</td>
			<td width="40%"><?= $val[0]['ketidaksesuaian_spesifikasi_tanggal'] ?></td>
			<td align="left" width="10%">Shift</td>
			<td width="3%">:</td>
			<td><?= $val[0]['jadwal_produksi_shift'] ?></td>
  		</tr>
  		<tr>
  			<td align="left">Jenis Produksi</td>
			<td width="3%">:</td>
			<td><?= $val[0]['jadwal_produksi_jenis']['val2'][0]['text'] ?></td>
			<td align="left">Mesin</td>
			<td width="3%">:</td>
			<td><?= $val[0]['ketidaksesuaian_spesifikasi_mesin'] ?></td>
  		</tr>
  		<tr>
  			<td align="left">Kode Produksi</td>
			<td width="3%">:</td>
			<td><?= $val[0]['t_jadwal_produksi_id']['val2'][0]['text'] ?></td>
			<td align="left">Operator</td>
			<td width="3%">:</td>
			<td><?= $val[0]['ketidaksesuaian_spesifikasi_operator']['val2'][0]['text'] ?></td>
  		</tr>
	</table>
	<br>
	<table border="1" width="100%" rules="all" cellpadding="5">
		<tr>
			<td align="center">Nama Barang</td>
			<td align="center">Jam</td>
			<td align="center">Qty</td>
			<td align="center">Problem Komplain</td>
			<td align="center">Tindakan Perbaikan</td>
			<td align="center">Keterangan</td>
		</tr>
		<?php
			foreach ($val2 as $detail => $itemDetail) {
				echo '<tr align="left">';
				echo '<td align="center">'.$itemDetail['barang_nama'].'</td>';
	        	echo '<td align="center">'.$itemDetail['ketidaksesuaian_spesifikasidet_time'].'</td>';
	        	echo '<td align="center">'.$itemDetail['ketidaksesuaian_spesifikasidet_qty'].'</td>';
	        	echo '<td align="center">'.$itemDetail['ketidaksesuaian_spesifikasidet_komplain'].'</td>';
	        	echo '<td align="center">'.$itemDetail['ketidaksesuaian_spesifikasidet_tindakan'].'</td>';
	        	echo '<td align="center">'.$itemDetail['ketidaksesuaian_spesifikasidet_keterangan'].'</td>';
	        	echo '</tr>';
			}
		?>
	</table>
	<br>
	<table border="1" width="60%" rules="all" align="left">
  		<tr>
			<td align="center" width="20%">Disetujui</td>
			<td align="center" width="20%">Diperiksa</td>
			<td align="center" width="20%">Dibuat</td>
  		</tr>
		<tr>
			<td height="8%"></td>
			<td height="8%"></td>
			<td align="center"><?= $val[0]['ketidaksesuaian_spesifikasi_pembuat'] ?></td>
  		</tr>
		<tr>
			<td align="center">Manajer Operasional</td>
			<td align="center">Kabag PPIC dan QC</td>
			<td></td>
  		</tr>
	</table>
 </body>
</html>