<html>
<head>
	<style>
	.gg {
    border:1px solid;
    }
	</style>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
</head>
 <table width="100%">
    <tr>
      <td><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b></td>
      <td align="right">No :</td>
      <td width="30%"><?= $val[0]['permintaan_jasa_nomor'] ?></td>
    </tr>
    <tr>
      <td><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?><br>
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
      ?></td>
      <td align="right" valign="top">Tgl :</td>
      <td width="30%" valign="top"><?= $val[0]['permintaan_jasa_tanggal'] ?></td>
    </tr>
  </table>
 <h3><center>PERMINTAAN JASA</center></h3> 
  <table border="0" width="100%">
      <tr>
  			<td width="30%">DEPARTEMEN</td>
			  <td width="3%">:</td>
			  <td><?= $val[0]['m_departemen_id']['val2'][0]['text'] ?></td>
  		</tr>
  		<tr>
  			<td>TANGGAL DIBUTUHKAN</td>
			<td>:</td>
			<td><?= $val[0]['permintaan_jasa_tanggal_dibutuhkan'] ?></td>
  		</tr>
  </table>

  <table border="1" width="100%" rules="all" cellpadding="6">	
  	<thead>
   		<tr>
  			<td><center>No</center></td>
  			<td><center>Kode Jasa</center></td>
  			<td><center>Jenis Data</center></td>
  			<td><center>Qty</center></td>
  			<td><center>Satuan</center></td>
  			<td><center>Keterangan</center></td>
  		</tr>
      <?php
        $no = 1;
        foreach ($val2 as $barang => $itemBarang) 
        {
          echo '<tr align="left">';
          echo '<td align="center">'.$no.'</td>';
          echo '<td>'.$itemBarang['barang_kode'].'</td>';
          echo '<td>'.$itemBarang['barang_nama'].'('.$itemBarang['barang_nomor'].', '.$itemBarang['jenis_barang_nama'].')</td>'; // UNTUK URAIAN DAN SPESIFIKASI BARANG/JASA!
          // echo '<td></td>';
          echo '<td align="center">'.$itemBarang['permintaan_jasadet_qty'].'</td>';
          echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
          echo '<td>'.$itemBarang['permintaan_jasadet_keterangan'].'</td>';
          echo '</tr>'; 
          $no++;
        }
      ?>		
  	</thead>
  	<tbody>
  	</tbody>
  </table>
 <p>&nbsp;</p>
  
    </table>
  <table border="1" width="45%" rules="all" valign="bottom">	
  	<thead>
   		<tr>
  			<td width="20%" align="center">Disetujui,</td>
  			<td width=3 align="center">Dibuat,</td>
	    </tr>
	<tr>
  			<td width=5 height=50>&nbsp;</td>
  			<td width=5 height=50 align="center"><?= $val[0]['permintaan_jasa_created_by'] ?></td>
	    </tr>
	<tr>
  			<td width=3 align="center">Ka. Bagian</td>
			<td>&nbsp;</td>
	</tr>
   </tabel>
 </body>
</html>