<html>
  <head>
  <style type="text/css">
    .tb1{
      text-align: center;
      width: 100%;
      padding-bottom: 10px;
      padding-top: 10px;
    }
    .tb2{
      padding-top: 10px;
      
      width: 50%;
      text-align: center;
    }
    .catatan {
      padding-top: 4px;   
	  width: 35%; 
    }
  </style>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
  <body>
  <table width="100%">
    <tr>
      <td><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b></td>
      <td align="right">No :</td>
      <td width="30%"><?= $val[0]['permintaan_pembelian_nomor'] ?></td>
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
      <td width="30%" valign="top"><?= $val[0]['permintaan_pembelian_tanggal'] ?></td>
    </tr>
  </table>
  <h4 align="center">PERMINTAAN PEMBELIAN BARANG</h4>
  <table width="100%">
    <tr>
      <td>Tanggal Dibutuhkan:</td>
      <td width="44%"><?= $val[0]['permintaan_pembelian_tanggal_dibutuhkan'] ?></td>
      <?php
        if($val[0]['permintaan_pembelian_jenis'] == '1')
        {
          echo '<td width="3%"><input type="checkbox" name="" checked = "true"/></td>';
          echo '<td>Penting</td>';
          echo '<td width="3%"><input type="checkbox" name=""/></td>';
          echo '<td>Biasa</td>';
        }
        else
        {
          echo '<td width="3%"><input type="checkbox" name=""/></td>';
          echo '<td>Penting</td>';
          echo '<td width="3%"><input type="checkbox" name="" checked = "true"/></td>';
          echo '<td>Biasa</td>';
        }
      ?>
    </tr>
  </table>

  <table class="tb1" border="1" rules="all" cellpadding="6">
    <tr>
      <th>No</th>
      <th>Kode Barang</th>
      <th>Uraian dan Spesifikasi Barang/Jasa</th>
      <th>Qty</th>
      <th>Satuan</th>
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
        echo '<td align="center">'.$itemBarang['permintaan_pembeliandet_qty'].'</td>';
        echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
        echo '</tr>';
        $no++;
      }
    ?>
  </table>

  <table width="100%">
    <tr>
      <td rowspan="2" width="10%" valign="top">Alasan/maksud:</td>
      <td rowspan="2" valign="top" style="word-wrap: break-word;"><?= $val[0]['permintaan_pembelian_alasan'] ?></td>
    </tr>
  </table>

  <table rules="all" align="left" width="60%">
    <tr align="center">
      <td width="20%">Diterima</td>
      <td width="20%">Disetujui</td>
      <td width="20%">Dibuat</td>
    </tr>
    <tr>
      <td height="8%"></td>
      <td></td>
      <td align="center"><?= $val[0]['permintaan_pembelian_pembuat']['val2'][0]['text'] ?></td>
    </tr>
    <tr>
      <td> &nbsp;</td>
      <td></td>
      <td></td>
    </tr>
  </table>
  <table border="1" align="right" rules="all" width="35%">
    <tr>
		<td>Catatan : </td>
	</tr>
	<tr>
		<td rowspan=2 height=10% valign="top"><?= $val[0]['permintaan_pembelian_catatan'] ?></td>
    </tr>
	<tr>
	
	</tr>
  </table>

  </body>
</html>