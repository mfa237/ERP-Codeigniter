<html>
  <head>
  <style type="text/css">
    .no {
      float: right;
    }
    .barang {
      padding-bottom: 10px;
      padding-top: 10px;
    }
    .tb1{
      text-align: center;
    }
  </style>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
  <body>
  <table width="100%">
    <tr>
      <td><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b></td>
      <td align="right">No :</td>
      <td width="30%"><?= $val[0]['keluar_barang_nomor'] ?></td>
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
      <td width="30%" valign="top"><?= $val[0]['keluar_barang_tanggal'] ?></td>
    </tr>
  </table>
  <h3 align="center">BUKTI KELUAR BARANG</h3>

  <table width="50%">
   <tr>
    <?php 
      if($val[0]['keluar_barang_jenis'] == '1')
      {
        echo '<td width="6%"><input type="checkbox" name="" checked="true"/></td>';
        echo '<td>B.Baku</td>';
        echo '<td width="6%"><input type="checkbox" name=""/></td>';
        echo '<td>B.Penolong</td>';
        echo '<td width="6%"><input type="checkbox" name=""/></td>';
        echo '<td>Lain-lain</td>';
      }
      else if($val[0]['keluar_barang_jenis'] == '2')
      {
        echo '<td width="6%"><input type="checkbox" name=""/></td>';
        echo '<td>B.Baku</td>';
        echo '<td width="6%"><input type="checkbox" name="" checked="true"/></td>';
        echo '<td>B.Penolong</td>';
        echo '<td width="6%"><input type="checkbox" name=""/></td>';
        echo '<td>Lain-lain</td>';
      }
      else
      {
        echo '<td width="6%"><input type="checkbox" name=""/></td>';
        echo '<td>B.Baku</td>';
        echo '<td width="6%"><input type="checkbox" name=""/></td>';
        echo '<td>B.Penolong</td>';
        echo '<td width="6%"><input type="checkbox" name="" checked="true"/></td>';
        echo '<td>Lain-lain</td>';
      }
    
    ?>
  </tr>
  </table>
  
  <table class="barang">
    <tr>
      <td>Untuk Departemen:</td>
      <td><?= $val[0]['m_departemen_id']['val2'][0]['text']?></td>
    </tr>
  </table>

  <table width="100%" border="1" cellspacing="0" cellpadding="6">
    <tr>
      <th>No.</th>
      <th>Artikel</th>
      <th>Jenis Barang</th>
      <th>Nomor Bahan</th>
      <th>Qty</th>
      <th>Satuan</th>
      <th>Keterangan</th>
    </tr>
      <?php
        $no = 1;
        foreach ($val2 as $barang => $itemBarang) {
          echo '<tr align="left">';
          echo '<td>'.$no.'</td>';
          echo '<td>'.$itemBarang['barang_kode'].'</td>';
          echo '<td>'.$itemBarang['jenis_barang_nama'].'</td>';
          echo '<td align="center">'.$itemBarang['barang_nomor'].'</td>';
          echo '<td align="center">'.$itemBarang['keluar_barangdet_qty'].'</td>';
          echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
          echo '<td>'.$itemBarang['keluar_barangdet_keterangan'].'</td>';
          echo '</tr>';
          $no++;
        }
      
      ?>
    
  </table>
  <table width="100%" class="barang">
    <tr>
      <td width="60%">BARANG TERSEBUT DIATAS TELAH DICEK DAN</td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr>
      <td width="60%">DITERIMA DENGAN KONDISI BAIK PADA TANGGAL:</td>
      <td></td>
      <td width="5%">JAM </td>
      <td></td>
    </tr>
  </table>
  <table border="1" rules="all" width="60%" border="1">
    <tr align="center">
      <td width="20%">Diterima,</td>
      <td width="20%">Diserahkan oleh,</td>
      <td width="20%">Dibuat,</td>
    </tr>
    <tr>
      <td height="8%"></td>
      <td></td>
      <td></td>
    </tr>
    <tr align="center">
     
     <td></td>
      <td><?= $val[0]['keluar_barang_penyerah']['val2'][0]['text'] ?></td>
      <td><?= $val[0]['keluar_barang_created_by'] ?></td>
    </tr>
  </table>
  </body>
</html>