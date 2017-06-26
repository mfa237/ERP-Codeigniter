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
	<h4 align="left"><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?><br><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?><br>
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
      ?></h4>
	<h3 align="center">LAPORAN SURAT PERMINTAAN PEMBELIAN (SPP) YANG BELUM TEREALISASI</h3>
	<table border="0" width="50%" align="center">
  		<tr>
  			<td width="30%"" align="right">Periode</td>
			<td width="3%">:</td>
			<td><?= $from_tanggal ?> - <?= $to_tanggal ?></td>
  		</tr>
	</table>
	<br>
	<table border="1" width="100%" rules="all" cellpadding="5" cellspacing="0">
		<tr>
			<td align="center" width="4%">No</td>
			<td align="center" width="13%">No. SPP</td>
			<td align="center" width="13%">Tgl SPP</td>
			<td align="center" width="13%">Kode Barang</td>
			<td align="center" width="18%">Nama Barang/Jasa</td>
			<td align="center" width="13%">Qty</td>
			<td align="center" width="13%">Satuan</td>
			<td align="center" width="13%">Keterangan</td>
		</tr>
		<?php
			$total = 0;
			foreach ($data as $barang => $itemBarang) {
				echo '<tr align="left">';
	        	echo '<td align="center">'.$itemBarang['no'].'</td>';
	        	echo '<td align="center">'.$itemBarang['permintaan_pembelian_nomor'].'</td>';
	        	echo '<td align="center">'.$itemBarang['permintaan_pembelian_tanggal'].'</td>';	
	        	echo '<td align="center">'.$itemBarang['barang_kode'].'</td>';
	        	echo '<td align="center">'.$itemBarang['barang_nama'].'</td>';
	        	echo '<td align="center">'.$itemBarang['permintaan_pembelian_qty'].'</td>';
	        	echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
	        	echo '<td align="center">'.$itemBarang['permintaan_pembelian_alasan'].'</td>';
	        	echo '</tr>';
	        	$total++;
			}
		?>
		<tr>
			<td colspan="7" align="center">Total</td>
			<td align="center"><?= $total ?></td>
		</tr>
	</table>
	<br>
	<table border="1" width="45%" rules="all" align="left">
  		<tr>
			<td align="center" width="15%">Diperiksa</td>
			<td align="center" width="15%">Dibuat</td>
  		</tr>
		<tr>
			<td height="7%"></td>
			<td height="7%"></td>
  		</tr>
		<tr>
			<td align="center">Kabag Pembelian</td>
			<td align="center">Staff Pembelian</td>
  		</tr>
	</table>
 </body>
</html>