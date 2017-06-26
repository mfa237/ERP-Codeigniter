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
	  width: 40%; 
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
  <h3 align="center"><u>FORM SERAH TERIMA</u></h3>
  <table width="100%">
    <tr>
      <td width="10%">No</td>
      <td width="3%">:</td>
      <td width="32%"><?= $val[0]['serah_terima_nomor'] ?></td>
      <td width="20%">Dari Bagian/ Shift</td>
      <td width="3%">:</td>
      <td width="32%"><?= $val[0]['serah_terima_daribagian']['val2'][0]['text'].'/'.$val[0]['serah_terima_darishift'] ?></td>
    </tr>
	<tr>
      <td>Tanggal</td>
      <td>:</td>
      <td><?= $val[0]['serah_terima_created_date'] ?></td>
      <td>Ke Bagian/ Shift</td>
      <td>:</td>
      <td><?= $val[0]['serah_terima_kebagian']['val2'][0]['text'].'/'.$val[0]['serah_terima_keshift'] ?></td>
    </tr>
  </table>
	<br>
  <table class="tb1" border="1" rules="all" cellpadding="5">
    <tr>
      <td> No </td>
      <td> Kode Barang </td>
	    <td> Nama Barang </td>
      <td> Kode Produksi </td>
      <td> Berat (Kg) </td>
	    <td> Panjang (m) </td>
	    <td> Tebal (mm) </td>
      <td> Unit </td>
      <td> Satuan </td>
	    <td> Keterangan </td>
    </tr>
    <?php
      $no = 1;
      foreach ($val2 as $awal => $itemBarang) {
        echo '<tr align="left">';
            echo '<td align="center">'.$no.'</td>';
            echo '<td>'.$itemBarang['barang_kode'].'</td>';
            echo '<td>'.$itemBarang['barang_nama'].'</td>';
            echo '<td>'.$itemBarang['pengubahan_bahan_nomor'].'</td>';
            echo '<td align="center">'.$itemBarang['perolehan_produksi_akhirdet']['val2'][0]['perolehan_produksi_akhirdet_berat'].'</td>';
            echo '<td align="center">'.$itemBarang['perolehan_produksi_akhirdet']['val2'][0]['perolehan_produksi_akhirdet_panjang'].'</td>';
            echo '<td align="center">'.$itemBarang['perolehan_produksi_akhirdet']['val2'][0]['perolehan_produksi_akhirdet_tebal'].'</td>';
            echo '<td align="center">'.$itemBarang['pengubahan_bahanakhir_qty'].'</td>';
            echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
            echo '<td align="center">'.$itemBarang['serah_terimadet_keterangan'].'</td>';
            echo '</tr>';
            $no++;
      }
    ?>
  </table>


  <table class="tb2" border="1" rules="all" align="left" width="40%">
    <tr>
      <td width="20%">Yang Menerima,</td>
      <td width="20%">Yang Menyerahkan,</td>
    </tr>
    <tr>
      <td height="7%"></td>
      <td></td>
    </tr>
    <tr>
      <td><?= $val[0]['serah_terimalog_status_update_by'] ?></td>
      <td height="2%"><?= $val[0]['serah_terima_created_by'] ?></td>
    </tr>
  </table>

  </body>
</html>