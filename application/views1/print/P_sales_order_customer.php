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
		  <td><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b></td>
		  <td align="right">Supply :</td>
		  <td width="30%">Galvalume Roll, Genteng Metal</td>
		</tr>
		<tr>
		  <td valign="top"><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?><br>
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
		  <td align="right" valign="top"></td>
		  <td width="30%" valign="top">Ganal C, Reng<br>Atap Gelombang 5 (Trimdek)<br>Hollow, Wall Angel</td>
		</tr>
  </table>
   <h3 align="center">SALES ORDER (SO)</h3>
  <table width="30%" border="0" align="right">
    <tr>
      <td width="10%" align="left">No.</td>
      <td width="4%">:</td>
      <td ><?= $val[0]['so_customer_nomor'] ?></td>
    </tr>
    <tr>
      <td scope="row"><div align="left">Tanggal</div></td>
      <td>:</td>
      <td><?= $val[0]['so_customer_tanggal'] ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="100%" border="0" align="left">
  <tr>
    <td width="10%" align="left">Nama Customer</td>
    <td width="2%">:</td>
    <td width="66%">
      <table border="0" width="100%">
        <tr>
          <td width="80%"> <?= $val[0]['m_partner_id']['val2'][0]['text'] ?> </td>
          <td align="right"> Baru / Lama*</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td scope="row"><div align="left">Alamat</div></td>
    <td>:</td>
    <td>
      <table border="0" width="100%">
        <tr>
          <td width="75%"> <?= $val[0]['m_partner_id']['val2'][0]['alamat'] ?> </td>
          <td width="7%"> Kota : </td>
          <td align="right"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td scope="row"><div align="left">No. Telp/ HP</div></td>
    <td>:</td>
    <td><?php 
      for($i=0; $i < count($val[0]['m_partner_id']['val2'][0]['telp']); $i++)
      {
        if($i == count($val[0]['m_partner_id']['val2'][0]['telp'])-1)
        {
          echo $val[0]['m_partner_id']['val2'][0]['telp'][$i];
        }
        else
        {
          echo $val[0]['m_partner_id']['val2'][0]['telp'][$i].', ';
        }
      }
      ?></td>
  </tr>
  <tr>
    <td scope="row"><div align="left">No. PO</div></td>
    <td>:</td>
    <td><?= $val[0]['po_customer_nomor'] ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="100%" border="1" cellspacing="0" cellpadding="4" align="left">
  <tr align="center">
    <th scope="col" >No.</th>
    <th scope="col" >Kode Barang</th>
    <th scope="col" >Jenis Barang</th>
    <th scope="col" >Qty</th>
    <th scope="col" >Satuan</th>
    <th scope="col" >Harga Satuan</th>
    <th scope="col" >Jumlah</th>
    <th scope="col" >Keterangan</th>
  </tr>
  <?php
    $no = 1;
    foreach ($val2 as $barang => $itemBarang) {
      echo '<tr align="left">';
      echo '<td align="center" width="3%">'.$no.'</td>';
      echo '<td align="center" width="12%">'.$itemBarang['barang_kode'].'</td>';
      echo '<td width="30%">'.$itemBarang['barang_uraian'].'</td>';
      echo '<td align="center" width="5%">'.$itemBarang['po_customerdet_qty'].'</td>';
      echo '<td align="center" width="10%">'.$itemBarang['satuan_nama'].'</td>';
      echo '<td><table width="100%">
              <tr>
                <td align="left">Rp.</td>
                <td align="right">'.number_format($itemBarang['po_customerdet_harga_satuan'], "0", ",", ".").'</td>
              </tr>
            </table></td>';
      echo '<td><table width="100%">
              <tr>
                <td align="left">Rp.</td>
                <td align="right">'.number_format(($itemBarang['po_customerdet_qty']*$itemBarang['po_customerdet_harga_satuan']), "0", ",", ".").'</td>
              </tr>
            </table></td>';
      echo '<td>'.$itemBarang['po_customerdet_keterangan'].'</td>';
      echo '</tr>';
      $no++;
    }
  ?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="100%" border="0" cellpadding="5">
  <tr>
    <td width="13%">Perjanjian Bayar</td>
    <td width="2%">:</td>
    <td><?= $val[0]['po_customer_perjanjian_bayar'] ?> hari</td>
  </tr>
  <tr>
    <td valign="top">Jasa Angkut</td>
    <td valign="top">:</td>
    <td valign="top"><?php
      if($val[0]['po_customer_jasaangkut_jenis'] == 1)
      {
        echo 'Ekspedisi ( '.$val[0]['po_customer_ekspedisi'].' ) / <strike> Kirim Sendiri </strike>* <br>';
      }
      else
      {
        echo '<strike> Ekspedisi</strike> ( ................ ) / Kirim Sendiri* <br>';
      }
      if($val[0]['po_customer_jasaangkut_bayar'] == 1)
      {
        echo 'Ditanggung oleh : '.$val[0]['cabang']['val2'][0]['text'].' / <strike> Bayar Toko </strike>*';
      }
      else
      {
        echo 'Ditanggung oleh : <strike> '.$val[0]['cabang']['val2'][0]['text'].' </strike> / Bayar Toko*';
      }
    ?></td>
  </tr>
</table>
<p>&nbsp;</p>
*coret salah satu<br>
<table border="1" cellspacing="0" align="right" width="45%" >
    <tr align="center">
      <td width="20%"> Disetujui, </td>
      <td width="20%"> Disetujui, </td>
      <td width="20%"> Dibuat, </td>
    </tr>
    <tr>
      <td height="8%"></td>
      <td></td>
      <td align="center"><?= $val[0]['so_customer_created_by'] ?></td>
    </tr>
    <tr align="center">
      <td height="2%">Customer</td>
      <td>Mgr Marketing</td>
      <td>Admin Penjualan</td>
    </tr>
    </table>
</table>
<table width="50%" align="left" border="1" rules="all">
    <tr>
      <td valign="top" width="10%">Catatan:</td>
    </tr>
	<tr>
		<td rowspan="2" height="10%"></td>
	</tr>
	<tr>
	
	</tr>
</table>
</body>
</html>