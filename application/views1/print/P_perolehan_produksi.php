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
      padding-top: 10px;    
    }@page { margin: 5px; }
    body { margin: 5px; font-size: 12px; }
  </style>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
  <body>
    <table width="100%">
    <tr>
      <td><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b></td>
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
    </tr>
  </table>
  <h3><u>PEROLEHAN PRODUKSI</u></h4>
  <table width="50%" border="0">
    <tr>
      <td width="25%">Hari/Tanggal</td>
      <td width="3%">:</td>
      <td><?php
      $hari = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
      );      
      echo $hari[$val[0]['perolehan_produksi_hari']].', ';
      ?><?= $val[0]['perolehan_produksi_tanggal'] ?></td>
    </tr>
    <tr>
      <td>Nama Produk</td>
      <td>:</td>
      <td></td>
    </tr>
  </table>

  <table width="100%" border="1" rules="all" cellpadding="6">
  <tr>
    <th rowspan="3" scope="col"><p>No</p></th>
    <th colspan="7" scope="col"><p>BAHAN</p></th>
    <th colspan="10" scope="col">HASIL BARANG JADI</th>
  </tr>
  <tr align="center">
    <td rowspan="2">No. Coil</td>
    <td colspan="5">Berat Coil</td>
    <td rowspan="2">Uraian Coil</td>
    <td rowspan="2">Kode Barang</td>
    <td rowspan="2">Berat (Kg)</td>
    <td rowspan="2">Panjang (m)</td>
    <td rowspan="2">Tebal (mm)</td>
    <td rowspan="2">Micro meter (mm)</td>
    <td rowspan="2">Qty</td>
    <td rowspan="2">NS (Qty)</td>
    <td rowspan="2">Qty Rusak</td>
    <td rowspan="2">Konversi</td>
    <td rowspan="2">Keterangan</td>
  </tr>
  <tr>
    <td>Berat Coil Gross</td>
    <td>Berat Coil Net</td>
    <td>Berat Timbang</td>
    <td>Berat Kulit</td>
    <td>Berat Tong</td>
  </tr>
    <?php
      $noBarang = 1;
      $lengthBahan = sizeof($val2);
      $lengthBarang = sizeof($val3);
      if($lengthBarang > $lengthBahan)
      {
        for($i = 0; $i < $lengthBarang; $i++)
        {
          if($i < $lengthBahan)
          {
            echo '<tr align="center">';
            echo '<td align="center">'.$noBarang.'</td>';
            echo '<td>'.$val2[$i]['jadwal_produksi_awaldet_no_seri'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahangross'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahannet'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahantimbang'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahankulit'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahantong'].'</td>';
            echo '<td>'.$val2[$i]['barang_uraian'].'</td>';
            echo '<td>'.$val3[$i]['barang_kode'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_berat'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_panjang'].'</td>';
            echo '<td align="center">'.$val3[$i]['perolehan_produksi_akhirdet_tebal'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_micro'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_qty'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_ns'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_qty_rusak'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_konversi'].'</td>';
            echo '<td align="center">'.$val3[$i]['perolehan_produksi_akhirdet_keterangan'].'</td>';
            echo '</tr>';
            $noBarang++;
          }
          else
          {
            echo '<tr align="center">';
            echo '<td align="center">'.$noBarang.'</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td>'.$val3[$i]['barang_kode'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_berat'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_panjang'].'</td>';
            echo '<td align="center">'.$val3[$i]['perolehan_produksi_akhirdet_tebal'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_micro'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_qty'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_ns'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_qty_rusak'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_konversi'].'</td>';
            echo '<td align="center">'.$val3[$i]['perolehan_produksi_akhirdet_keterangan'].'</td>';
            echo '</tr>';
            $noBarang++;
          }
        }
      } else
      {
        for($i = 0; $i < $lengthBahan; $i++)
        {
          if($i < $lengthBarang)
          {
            echo '<tr align="center">';
            echo '<td align="center">'.$noBarang.'</td>';
            echo '<td>'.$val2[$i]['jadwal_produksi_awaldet_no_seri'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahangross'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahannet'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahantimbang'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahankulit'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahantong'].'</td>';
            echo '<td>'.$val2[$i]['barang_uraian'].'</td>';
            echo '<td>'.$val3[$i]['barang_kode'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_berat'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_panjang'].'</td>';
            echo '<td align="center">'.$val3[$i]['perolehan_produksi_akhirdet_tebal'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_micro'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_qty'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_ns'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_qty_rusak'].'</td>';
            echo '<td>'.$val3[$i]['perolehan_produksi_akhirdet_konversi'].'</td>';
            echo '<td align="center">'.$val3[$i]['perolehan_produksi_akhirdet_keterangan'].'</td>';
            echo '</tr>';
            $noBarang++;
          }
          else
          {
            echo '<tr align="center">';
            echo '<td align="center">'.$noBarang.'</td>';
            echo '<td>'.$val2[$i]['jadwal_produksi_awaldet_no_seri'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahangross'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahannet'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahantimbang'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahankulit'].'</td>';
            echo '<td>'.$val2[$i]['perolehan_produksi_awaldet_bahantong'].'</td>';
            echo '<td>'.$val2[$i]['barang_uraian'].'</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td align="center"></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td align="center"></td>';
            echo '</tr>';
            $noBarang++;
          }
        }
      }
      // foreach ($val2 as $barang => $itemBarang) {
        
      //   echo '<td>'.$itemBarang['barang_nama'].'</td>';
      //  
      // }
    ?>
    <tr>
      <td colspan="2">Total</td>
      <td colspan="11"></td>
      <td align="center"><?= $val[0]['perolehan_produksi_total'] ?></td>
      <td colspan="4"></td>
    </tr>
    <tr>
      <td colspan="2">Afalan (Kg)</td>
      <td colspan="12"></td>
      <td align="center"><?= $val[0]['perolehan_produksi_afalan'] ?></td>
      <td colspan="3"></td>
    </tr>
    <tr>
      <td colspan="2">Rusak</td>
      <td colspan="13"></td>
      <td align="center"><?= $val[0]['perolehan_produksi_rusak'] ?></td>
      <td colspan="2"></td>
    </tr>
</table><br>

<table border="1" rules="all" align="left" width="30%" >
    <tr align="center">
      <td width="15%">Diperiksa</td>
      <td width="15%">Dibuat</td>
    </tr>
    <tr align="center">
      <td height="12%"></td>
      <td><?= $val[0]['perolehan_produksi_created_by'] ?></td>
    </tr>
    <tr>
      <td align="center">Kabag Produksi</td>
      <td align="center">Produksi</td>
    </tr>
  </table>
  
  </body>
</html>