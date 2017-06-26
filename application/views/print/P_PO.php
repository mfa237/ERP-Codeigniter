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
    /*table.tb-border tbody,*/
    table.tb-border tr > td
    {
        border: 1px solid;
    }

    .center{
      text-align: center;
    }
    .border{
      border: 1px solid;
    }
    .no-border
    {
      border: none !important;
    }

    .table-print-PO {
      margin-left: 5px;
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
  </table>
  <table style="width: 100%; margin-top: 10px;">
    <tbody>
      <tr>
        <td style="width: 30%;"></td>
        <td style="text-align: center; font-size: 25px;"><b>ORDER PEMBELIAN</b></td>
        <td rowspan="2" style="width: 30%; padding-left: 50px;">
           No   : <?php echo $val[0]['order_nomor'] ?>
           <br>
           Tgl  : <?php echo $val[0]['order_tanggal'] ?>
        </td>
      </tr>
      <tr>
        <td style="width: 30%; font-size: 22px;"></td>
        <td style="text-align: center;"><b>(PURCHASE ORDER)</b></td>
        <!-- <td style="border: 1px solid;width: 30%;"></td> -->
      </tr>
    </tbody>
  </table>
  <br>
  <table class="table-print-PO" width="100%" border="" cellspacing="0" rules="all" cellpadding="6">
    <tbody>
      <tr>
        <td class="center" style="width: 48%;">SUPPLIER</td>
        <td class="no-border"></td>
        <td class="center" style="width: 48%;">KIRIM KE</td>
      </tr>
      <tr>
        <td valign="top">
          <table style="width: 100%;">
             <tbody>
               <tr>
                 <th style="width: 20%;" valign="top">Nama :</th>
                 <td valign="top" style="white-space:normal !important;word-wrap: break-word; ">
                   <?php echo $val[0]['m_supplier_id']['val2'][0]['text'] ?>
                 </td>
                 <th style="text-align: right;" valign="top">Kode : </th>
                 <td valign="top"><?php echo $val[0]['m_supplier_id']['val2'][0]['id'] ?></td>
               </tr>

               <tr>
                 <th>
                   Telp / Fax :
                 </th>
                 <td valign="top" style="white-space:normal !important;word-wrap: break-word; text-align:left;">
                   <?= $val[0]['m_supplier_id']['val2'][0]['telp'] ?>
                 </td>
               </tr>
             </tbody>
          </table>
        </td>
        <td class="no-border"></td>
        <td valign="top">
          <table class="table-print-PO" style="width: 100%;">
            <tbody>
              <tr>
                <th style="width: 20%;" valign="top">Nama :</th>
                <td valign="top" style="white-space:normal !important;word-wrap: break-word; ">
                  <?php echo $val[0]['order_nama_dikirim'] ?>
                </td>
                <th style="text-align: right;" valign="top">Alamat : </th>
                <td valign="top"><?php echo $val[0]['order_alamat_dikirim'] ?></td>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <table width="100%" border="1" cellspacing="0" rules="all" cellpadding="6">
	<tr>
		<th width="2%" scope="col">No.</th>
		<th width="5%" scope="col">Artikel</th>
		<th width="10%" scope="col">Uraian dan Spesifikasi Barang/Jasa</th>
		<th width="3%" scope="col">Qty</th>
		<th width="3%" scope="col">Satuan</th>
		<th width="5%" scope="col">Harga Satuan</th>
    <th width="3%" scope="col">Disc <br></th>
    <th width="3%" scope="col">PPN<br>(<?php echo $val[0]['order_ppn'];?>%)</th>
    <th width="10%" scope="col">Total</th>
	</tr>
  <?php
      $no = 1;
      $subtotal = 0;
      $hargasatuan = 0;
      $totalallppn = 0;
      $totalppnperbarang = 0;
      $totalppnperbarangall = 0;
      $totalhargabarangtanpappn = 0;
      $totalhargabarangtanpappnall = 0;
      foreach ($val2 as $barang => $itemBarang)
      {
        if ($val[0]['ppnstatus']==2) {
          $hrgsebelumppn = 100+$val[0]['order_ppn'];
          $hargasatuan = intval(100/$hrgsebelumppn*$itemBarang['orderdet_harga_satuan']);
          $totalppnperbarang = intval($itemBarang['orderdet_harga_satuan']-$hargasatuan);
          $totalhargabarangtanpappn = $hargasatuan*$itemBarang['orderdet_qty'];
          $totalhargabarangtanpappnall = $totalhargabarangtanpappnall+$totalhargabarangtanpappn;
          $totalallppn = $totalallppn + ($totalppnperbarang*$itemBarang['orderdet_qty']);
        } else {
          $totalppnperbarang = $val[0]['order_ppn']*$itemBarang['orderdet_harga_satuan']/100;
          $totalppnperbarangall = $totalppnperbarang*$itemBarang['orderdet_qty'];
          $totalallppn = $totalallppn+$totalppnperbarangall;
          $hargasatuan = $itemBarang['orderdet_harga_satuan'];
          $totalhargabarangtanpappn = $hargasatuan*$itemBarang['orderdet_qty'];
          $totalhargabarangtanpappnall = $totalhargabarangtanpappnall+$itemBarang['orderdet_harga_satuan']*$itemBarang['orderdet_qty'];
        }

        echo '<tr align="left">';
        echo '<td align="center">'.$no.'</td>';
        echo '<td>'.$itemBarang['barang_nomor'].'</td>';
        echo '<td valign="top" style="white-space:normal !important;word-wrap:
        break-word;">'.$itemBarang['barang_uraian'].'</td>';
        // echo '<td></td>';
        echo '<td align="center">'.$itemBarang['orderdet_qty'].'</td>';
        echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
        echo '<td>
                  <table width="100%">
                    <tr>
                      <td align="left">Rp.</td>
                      <td align="right">'.$hargasatuan.'</td>
                    </tr>
                  </table>
              </td> ';
        $order_totdisc = $itemBarang['orderdet_total'];
        if ($itemBarang['orderdet_disc']>0) {
          $order_totdisc = $itemBarang['orderdet_total']-($itemBarang['orderdet_disc']/100*$hargasatuan*$itemBarang['orderdet_qty']);
        }
        $disknominal = $hargasatuan*$itemBarang['orderdet_disc']/100;
        echo '<td align="center">'.number_format($disknominal,"0", ",", ".").'</td>';
        echo '<td align="center">'.$totalppnperbarang.'</td>';
        echo '<td>
                <table width="100%">
                  <tr>
                    <td align="left">Rp.</td>
                    <td align="right">'.number_format($totalhargabarangtanpappn, "0", ",", ".").'</td>
                  </tr>
                </table>
            </td>';
        echo '</tr>';
        $no++;
      }
    ?>
	<tr>
		<td colspan="9"><small>Catatan: Jika tidak sesuai pesanan, barang/jasa akan dikembalikan/dibatalkan untuk
		setiap pengiriman, harap mencantumkan no. PO di surat jalan</small></td>
	</tr>
	<tr>
		<td colspan="7" rowspan="3">
			Terbilang : <?= $val[0]['order_terbilang'] ?> rupiah
		</td>
		<td>Sub Total</td>
    <td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?php echo number_format($totalhargabarangtanpappnall,"0", ",", ".") ?></td>
      </tr>
    </table></td>

	</tr>
	<tr>
		<td>PPN <?php echo $val[0]['order_ppn'] ?>%</td>
    <td><table width="100%">
      <tr>
        <td align="left">Rp.</td>
        <td align="right"><?php echo number_format($totalallppn,"0", ",", ".") ?></td>
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
<p>&nbsp;</p>
<table width="50%" border="0">
  <tr>
    <td width="28%">Tanggal Kirim</td>
    <td width="2%">:</td>
    <td width="70%"><?= $val[0]['order_tanggal'] ?></td>
  </tr>
  <tr>
    <td>Pembayaran</td>
    <td>:</td>
    <td><?php
    if($val[0]['order_pembayaran'] == 0)
    {
      echo 'Tunai';
    }
    else
    {
      echo 'Term of Payment';
    }
    ?></td>
  </tr>
  <?php
    if($val[0]['order_pembayaran'] == 1)
    {
      echo "<tr>
          <td>Term of Payment</td>
          <td>:</td>
          <td>".$val[0]['order_top']." Hari</td>
        </tr>";
    }
    ?>

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
