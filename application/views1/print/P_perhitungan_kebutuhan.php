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
	<h3 align="center"><u>PERHITUNGAN KEBUTUHAN BAHAN</u></h3>
	<table border="0" width="50%">
  		<tr>
  			<td align="left" width="10%">Periode</td>
			<td width="3%">:</td>
			<td><?= $val[0]['perhitungan_kebutuhan_periode']['val2'][0]['periode'] ?></td>
  		</tr>
  		<tr>
  			<td align="left">Shift</td>
			<td width="3%">:</td>
			<td><?= $val[0]['perhitungan_kebutuhan_periode']['val2'][0]['shift'] ?></td>
  		</tr>
	</table>
	<br>
	<table border="1" width="100%" rules="all" cellpadding="5">
		<tr>
			<td rowspan="2" align="center">No</td>
			<td rowspan="2" align="center">Nama Barang</td>
			<td rowspan="2" align="center">Jumlah Produksi</td>
			<td rowspan="2" align="center">Satuan</td>
			<td rowspan="2" align="center">Berat (Kg)</td>
			<td rowspan="2" align="center">Total (Kg)</td>
			<td align="center" colspan="3">Bahan Coil</td>
			<td rowspan="2" align="center">Keterangan</td>
		</tr>
		<tr>
			<td>Ukuran Coil (BMT)</td>
			<td>Lebar Coil (m)</td>
			<td>Slittingan Coil (mm)</td>
		</tr>
		<?php
			$no = 1;
			$totalproduksi = 0;
			foreach ($val2 as $barang => $itemBarang) {
				echo '<tr align="left">';
	        	echo '<td align="center">'.$no.'</td>';
	        	echo '<td>'.$itemBarang['barang_nama'].'</td>';
	        	echo '<td align="center">'.$itemBarang['perhitungan_kebutuhandet_qty'].'</td>';
	        	echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
	        	echo '<td align="center">'.$itemBarang['perhitungan_kebutuhandet_berat'].'</td>';
	        	echo '<td align="center">'.$itemBarang['perhitungan_kebutuhandet_total'].'</td>';
	        	echo '<td align="center">'.$itemBarang['perhitungan_kebutuhandet_ukuran'].'</td>';
	        	echo '<td align="center">'.$itemBarang['perhitungan_kebutuhandet_lebar'].'</td>';
	        	echo '<td align="center">'.$itemBarang['perhitungan_kebutuhandet_slitingan'].'</td>';
	        	echo '<td align="center">'.$itemBarang['perhitungan_kebutuhandet_keterangan'].'</td>';
	        	echo '</tr>';
	        	$totalproduksi = $totalproduksi + $itemBarang['perhitungan_kebutuhandet_qty'];
	        	$no++;
			}
		?>
		<tr>
			<td colspan="2">Total</td>
			<td align="center"><?= $totalproduksi ?></td>
			<td></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<br>
	<table border="1" width="40%" rules="all" align="left">
  		<tr>
			<td align="center" width="20%">Disetujui</td>
			<td align="center" width="20%">Dibuat</td>
  		</tr>
		<tr>
			<td height="8%"></td>
			<td align="center"><?= $val[0]['perhitungan_kebutuhan_pembuat'] ?></td>
  		</tr>
		<tr>
			<td align="center">Mgr Operasional</td>
			<td align="center">Kabag PPIC dan QC</td>
  		</tr>
	</table>
 </body>
</html>