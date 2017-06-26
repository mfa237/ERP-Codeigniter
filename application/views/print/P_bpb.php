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

      width: 50%;
      text-align: center;
    }
    .catatan {
      padding-top: 10px;
    }
    .s {
      float: left;
    }
    .k {
      float: right;
    }
    .left{

      float: left;
    }
    .right{
      float: right;
    }
  </style>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
  <body>
  <table width="100%">
    <tr>
      <td colspan="3" align="center"><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?><br>
      <?php
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
      ?>
      </td>
    </tr>
    <tr>
      <td align="right" width="80%">No :</td>
      <td width="20%"><?= $val[0]['penerimaan_barang_nomor'] ?></td>
    </tr>
    <tr>
      <td align="right" width="80%">Tgl :</td>
      <td width="20%"><?= $val[0]['penerimaan_barang_tanggal'] ?></td>
    </tr>
  </table>
  <h3 align="center"><?php
  if($val[0]['penerimaan_barang_jenis'] == 0)
  {
    echo 'BUKTI PENERIMAAN BARANG';
  }
  else
  {
    echo 'BUKTI PENERIMAAN BARANG JADI';
  }
  ?></h3>
  <table width="57%" border="0">
  <tr>
    <td width="30%" align="left">Nama Supplier</th>
    <td width="4%">:</td>
    <td width="66%"><?= $val[0]['penerimaan_barang_supplier']['val2'][0]['supplier'] ?></td>
  </tr>
  <tr>
    <td scope="row"><div align="left">No SJ</div></th>
    <td>:</td>
    <td><?= $val[0]['penerimaan_barang_sj'] ?></td>
  </tr>
  <tr>
    <td scope="row"><div align="left">No PO</div></th>
    <td>:</td>
    <td><?= $val[0]['penerimaan_barang_supplier']['val2'][0]['id'] ?></td>
  </tr>
</table>
<br>
<table width="100%" border="1" cellspacing="0" cellpadding="4">
  <tr align="left">
    <th scope="col" >No.</th>
    <th scope="col" >Artikel</th>
    <th scope="col" style="text-align:center;">Uraian dan Spesifikasi Barang/Jasa</th>
    <th scope="col" >Qty</th>
    <th scope="col" >Satuan</th>
    <!-- <th scope="col" >Harga Satuan</th>
    <th scope="col" >PPN</th>
    <th scope="col" >Total</th> -->
    <th scope="col" >Keterangan</th>
  </tr>
  <?php
    $no = 1;
    foreach ($val2 as $barang => $itemBarang) {
      echo '<tr align="left">';
      echo '<td style="text-align: center;">'.$no.'</td>';
      echo '<td>'.$itemBarang['barang_nomor'].'</td>';
      echo '<td>'.$itemBarang['barang_nama'].'</td>';
      echo '<td>'.$itemBarang['penerimaan_barangdet_qty'].'</td>';
      echo '<td>'.$itemBarang['satuan_nama'].'</td>';
      // echo '<td><table width="100%">
      //         <tr>
      //           <td align="left">Rp.</td>
        //           <td align="right">'.number_format($itemBarang['penerimaan_barangdet_harga_satuan'], "0", ",", ".").'</td>
      //         </tr>
      //       </table></td>';

      // echo '<td>'.$val[0]['penerimaan_barang_ppn'].'</td>';
      // echo '<td>'.$itemBarang['penerimaan_barangdet_total'].'</td>';
      echo '<td>'.$itemBarang['penerimaan_barangdet_keterangan'].'</td>';
      echo '</tr>';
      $no++;
    }
  ?>
</table>
<table width="100%" border="0">
  <tr>
    <td width="60%">BARANG TERSEBUT DIATAS TELAH DICEK DAN</td>
    <td width="17%">&nbsp;</td>
    <td width="6%">&nbsp;</td>
    <td width="17%">&nbsp;</td>
  </tr>
  <tr>
    <td>DITERIMA DENGAN KONDISI BAIK PADA TANGGAL:</td>
    <td><?= $val[0]['penerimaan_barang_tanggal_terima'] ?></td>
    <td>JAM</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?php
  if($val[0]['penerimaan_barang_jenis'] == 0)
  {
    echo '<table border="1" cellspacing="0" align="left" width="60%" >
    <tr align="center">
      <td width="20%">Diterima</td>
      <td width="20%">Disetujui</td>
      <td width="20%">Dibuat</td>
    </tr>
    <tr>
      <td height="8%"></td>
      <td></td>
      <td></td>
    </tr>
    <tr align="center">
      <td>'.$val[0]['penerimaan_barang_pemeriksa']['val2'][0]['text'].'</td>
      <td>'.$val[0]['penerimaan_barang_penyetuju']['val2'][0]['text'].'</td>
      <td>'.$val[0]['penerimaan_barang_pembuat'].'</td>
    </tr>
    </table>';
  }
  else
  {
    echo '<table border="1" cellspacing="0" align="left" width="60%" >
    <tr align="center">
      <td width="20%">Diterima</td>
      <td width="20%">Disetujui</td>
      <td width="20%">Dibuat</td>
    </tr>
    <tr align="center">
      <td height="8%">'.$val[0]['penerimaan_barang_pemeriksa']['val2'][0]['text'].'</td>
      <td>'.$val[0]['penerimaan_barang_penyetuju']['val2'][0]['text'].'</td>
      <td>'.$val[0]['penerimaan_barang_pembuat'].'</td>
    </tr>
    <tr align="center">
      <td></td>
      <td align="center">QC</td>
      <td align="center">Gudang BJ</td>
    </tr>
    </table>';
  }
?>
</table>
<table width="35%" align="right" border="1" rules="all">
    <tr>
      <td valign="top" width="10%">Catatan:</td>
    </tr>
	<tr>
		<td rowspan="2" height="10%"><?= $val[0]['penerimaan_barang_catatan'] ?></td>
	</tr>
	<tr>

	</tr>
</table>
</body>
</html>
