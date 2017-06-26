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
  <table width="100%">
    <tr>
      <td rowspan="2"><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b><br><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?><br>
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
      <td align="right">No :</td>
      <td width="30%"><?= $val[0]['pengembalian_barang_nomor'] ?></td>
    </tr>
    <tr>
      <td align="right" valign="top">Tgl :</td>
      <td width="30%" valign="top"><?= $val[0]['pengembalian_barang_tanggal'] ?></td>
    </tr>
  </table>
  <h3 align="center"><u>FORM PENGEMBALIAN BARANG</U></h3>
  <table width="100%">
    <tr>
      <td width="10%">Dari</td>
      <td width="3%">:</td>
      <td><?= $val[0]['pengembalian_barang_awal']['val2'][0]['text'] ?></td>
    </tr>
	<tr>
	  <td>Ke</td>
      <td width="3%">:</td>
      <td><?= $val[0]['pengembalian_barang_tujuan']['val2'][0]['text'] ?></td>
	</tr>
  </table>

  <table class="tb1" border="1" rules="all" cellpadding="5">
    <tr>
      <th>No</th>
      <td>Kode Barang</td>
      <td>Jenis Barang</td>
      <td>Qty</td>
      <td>Satuan</td>
	  <td>Alasan Pengembalian</td>
    </tr>
    <?php
      $no = 1;
      foreach ($val2 as $barang => $itemBarang) {
        echo '<tr align="left">';
            echo '<td align="center">'.$no.'</td>';
            echo '<td>'.$itemBarang['barang_kode'].'</td>';
            echo '<td>'.$itemBarang['jenis_barang_nama'].'</td>';
            echo '<td align="center">'.$itemBarang['pengembalian_barangdet_qty'].'</td>';
            echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
            echo '<td>'.$itemBarang['pengembalian_barangdet_keterangan'].'</td>';
            echo '</tr>';
            $no++;
      }
    ?>
  </table>

  <table class="tb2" border="1" rules="all" align="left" width="100%">
    <tr>
      <td width="30%">Diterima Oleh,</td>
      <td width="30%">Diserahkan Oleh,</td>
      <td width="30%">Dibuat</td>
    </tr>
    <tr>
      <td height="7%"></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td><?= $val[0]['pengembalian_barang_penerima'] ?></td>
      <td></td>
      <td height="2%"><?= $val[0]['pengembalian_barang_created_by'] ?></td>
    </tr>
  </table>

  </body>
</html>