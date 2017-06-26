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
	<h3 align="center">LAPORAN HARIAN KELUAR BARANG - GUDANG BAHAN</h3>
	<table border="0" width="50%" align="center">
  		<tr>
  			<td align="right">Tanggal</td>
			<td>:</td>
			<td><?= $from_tanggal ?> - <?= $to_tanggal ?></td>
  		</tr>
	</table>
	<br>
	<table border="1" width="100%" rules="all" cellpadding="5">
		<tr>
			<td align="center">No</td>
			<td align="center">No. BKB</td>
			<td align="center">Tgl BKB</td>
			<td align="center">Departement</td>
			<td align="center">Artikel</td>
			<td align="center">Nama Barang</td>
			<td align="center">Qty</td>
			<td align="center">Satuan</td>
			<td align="center">Keterangan</td>
		</tr>
		<?php
			$no = 1;
			$total = 0;
			foreach ($val as $barang => $itemBarang) {
				echo '<tr align="left">';
	        	echo '<td align="center">'.$no.'</td>';
	        	echo '<td align="center">'.$itemBarang['referensi_bkb'].'</td>';
	        	echo '<td align="center">'.$itemBarang['tanggal_bkb'].'</td>';	
	        	echo '<td align="center">'.$itemBarang['departemen'].'</td>';
	        	echo '<td align="center">'.$itemBarang['barang_kode'].'</td>';
	        	echo '<td align="center">'.$itemBarang['barang_nama'].'</td>';
	        	echo '<td align="center">'.$itemBarang['qty'].'</td>';
	        	echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
	        	echo '<td align="center">'.$itemBarang['keterangan'].'</td>';
	        	echo '</tr>';
	        	$total = $total + $itemBarang['qty'];
	        	$no++;
			}
		?>
		<!-- <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr> -->
		<tr>
			<td colspan="6" align="center">Total</td>
			<td align="center"><?= $total ?></td>
			<td colspan="2"></td>
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
			<td></td>
  		</tr>
		<tr>
			<td align="center">Mgr Operasional</td>
			<td align="center">Gudang Bahan</td>
  		</tr>
	</table>
 </body>
</html>