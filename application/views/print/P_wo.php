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
    }
    .s {
      float: left;
    }
    .k {
      float: right;
    }
  </style>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
  <body>
    <table width="100%">
    <tr>
      <td><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b></td>
      <td align="right">No :</td>
      <td width="30%"><?= $val[0]['order_nomor'] ?></td>
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
      <td width="30%" valign="top"><?= $val[0]['order_tanggal'] ?></td>
    </tr>
  </table>

  <h3 align="center">WORK ORDER (WO)</h3>
  
<table width="45%" border="1" align="left" rules="all">
  <tr>
    <td height="23"><div align="center"><strong>SUPPLIER</strong></div></td>
  </tr>
  <tr>
    <td height="10%">
		<table width="100%" border="0">
			<tr>
				<th width="25%" scope="row"><div align="left">Nama</div></th>
				<td width="4%">:</td>
				<td width="41%"><?= $val[0]['m_supplier_id']['val2'][0]['text'] ?></td>
				<td width="17%"><div align="left">Kode:</div></td>
				<td width="13%"><?= $val[0]['m_supplier_id']['val2'][0]['id'] ?></td>
			</tr>
			<tr>
				<th scope="row" valign="top"><div align="left">Alamat</div></th>
				<td valign="top">:</td>
				<td colspan="3" rowspan="3" valign="top"><?= $val[0]['m_supplier_id']['val2'][0]['alamat'] ?></td>
			</tr>
      <tr> 
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
      </tr>
			<tr>
				<th scope="row"><div align="left">Telp/Fax</div></th>
				<td>:</td>
				<td colspan="3"><?= $val[0]['m_supplier_id']['val2'][0]['telp'] ?></td>
			</tr>
		</table>
	</td>
  </tr>
</table>

<table width="40%" border="1" rules="all" align="right">
  <tr>
    <th height="23"><div align="center">KIRIM KE</div></th>
  </tr>
  <tr>
    <td height="10%"><table width="100%" border="0">
      <tr>
        <th width="25%" scope="row"><div align="left">Nama</div></th>
        <td width="4%">:</td>
        <td><div align="left"><?= $val[0]['order_nama_dikirim'] ?></div></td>
        </tr>
      <tr>
        <th scope="row"><div align="left">Alamat</div></th>
        <td valign="top">:</td>
        <td valign="top" rowspan="3"><?= $val[0]['order_alamat_dikirim'] ?></td>
        </tr>
        <tr>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <th scope="row"><div align="left">Telp/Fax</div></th>
        <td width="4%">:</td>
        <td align="left"><?= $val[0]['order_hp_fax'] ?></td>
        </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="101%" border="1" cellspacing="0" rules="all" cellpadding="6">
	<tr>
		<th width="5%" scope="col">No.</th>
		<th width="14%" scope="col">Kode Barang</th>
		<th width="35%" scope="col">Uraian dan Spesifikasi Barang/Jasa</th>
		<th width="5%" scope="col">Qty</th>
		<th width="8%" scope="col">Satuan</th>
		<th width="14%" scope="col">Harga Satuan</th>
		<th width="19%" scope="col">Total</th>
	</tr>
	<?php
      $no = 1;
      foreach ($val2 as $barang => $itemBarang) 
      {
        echo '<tr align="left">';
        echo '<td>'.$no.'</td>';
        echo '<td>'.$itemBarang['barang_kode'].'</td>';
        echo '<td>'.$itemBarang['barang_uraian'].'</td>';
        // echo '<td></td>';
        echo '<td>'.$itemBarang['orderdet_qty'].'</td>';
        echo '<td>'.$itemBarang['satuan_nama'].'</td>';
        echo '<td><table width="100%">
                  <tr>
                  <td align="left">Rp.</td>
                  <td align="right">'.number_format($itemBarang['orderdet_harga_satuan'],"0", ",", ".").'</td>
                  </tr>
              </table></td> ';
                 
        echo '<td><table width="100%">
                <tr>
                  <td align="left">Rp.</td>
                  <td align="right">'.number_format($itemBarang['orderdet_total'],"0", ",", ".").'</td>
                </tr>
              </table></td>';
        
        echo '</tr>';
        $no++;
      }
    ?>
	<tr>
		<td colspan="7"><small>Catatan: Jika tidak sesuai pesanan, barang/jasa akan dikembalikan/dibatalkan untuk 
		setiap pengiriman, harap mencantumkan no. WO di surat jalan</small></td>
	</tr>
	<tr>
		<td colspan="5" rowspan="3"> 
			Terbilang : <?= $val[0]['order_terbilang'] ?> rupiah
		</td>
		<td>Sub Total</td>
		<td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?= number_format($val[0]['order_subtotal'],"0", ",", ".") ?></td>
      </tr>
    </table></td>
	</tr>
	<tr>
		<td>PPN <?= $val[0]['order_ppn'] ?>%</td>
		<td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?= number_format(($val[0]['order_ppn']*$val[0]['order_subtotal']/100),"0", ",", ".") ?></td>
      </tr>
    </table></td>
	</tr>
	<tr>
		<td>TOTAL</td>
		<td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?= number_format($val[0]['order_total'],"0", ",", ".") ?></td>
      </tr>
    </table></td>
	</tr>
</table>
<table width="50%" border="0">
  <tr>
    <td width="28%">Tanggal Kirim</td>
    <td width="2%">:</td>
    <td width="70%"><?= $val[0]['order_tanggal_kirim'] ?></td>
  </tr>
  <tr>
    <td>Pembayaran</td>
    <td>:</td>
    <td><?php
    if($val[0]['order_pembayaran'] == 1)
    {
      echo 'Tunai';
    }
    else
    {
      echo 'Kredit';
    }
    ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="81%" border="1" cellspacing="0">
  <tr>
    <td width="25%"><div align="center">Disetujui</div></td>
    <td width="25%"><div align="center">Disetujui</div></td>
    <td width="25%"><div align="center">Disetujui</div></td>
    <td width="25%"><div align="center">Disetujui</div></td>
  </tr>
  <tr>
    <td height="8%">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center">Supplier</div></td>
    <td><div align="center">Direktur</div></td>
    <td><div align="center">Kabag Pembelian</div></td>
    <td><div align="center">Staf Pembelian</div></td>
  </tr>
</table>


  </body>
</html>