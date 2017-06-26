<html>
<head>
	<style>
	.gg {
    border:1px solid;
    }
    .tb1 {
      text-align: center;
    }
	</style>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
</head>
 <body>
 <h2 align="center">KARTU STOK BARANG</h2>
  <table border="0" width="100%">
  		<tr>
  			<td>Nama Barang:</td>
  			<td colspan="2"><?= @$barang_nama ?></td>
  			<td align="right">Kartu No</td>
  			<td colspan="2" class="gg" width="30%"></td>
  		</tr>
  		<tr>
  			<td>Satuan:</td>
  			<td colspan="2"><?= @$satuan ?></td>
  			<td colspan="3"></td>
  			
  		</tr>
  		<tr>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  			<td></td>
  		</tr>
  </table>
  <table border="1" width="100%" rules="all" class="tb1" cellpadding="5">	
  	<thead>
   		<tr align="center">
  			<th>Tgl</th>
  			<th>No Bukti</th>
  			<th>Keterangan</th>
  			<th>Masuk</th>
  			<th>Keluar</th>
  			<th>Sisa</th>
  		</tr>
  	</thead>
  	<tbody>
      <?php
        foreach ($val as $barang => $itemBarang) {
          echo '<tr align="left">';
          echo '<td align="center">'.$itemBarang['tanggal_kartu_stok'].'</td>';
          echo '<td >'.$itemBarang['referensi'].'</td>';  
          echo '<td >'.$itemBarang['keterangan'].'</td>';
          echo '<td align="right">'.$itemBarang['qty_masuk'].'</td>';
          echo '<td align="right">'.$itemBarang['qty_keluar'].'</td>';
          echo '<td align="right">'.$itemBarang['sisa'].'</td>';
          echo '</tr>';
        }
      ?>
  	</tbody>
  </table>
 </body>
</html>