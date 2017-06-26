<html>
  <head>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
<table width="100%">
  <tr>
  <td width="80%"><strong><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></strong> </td>
  <td width="20%" valign="top"><strong>FAKTUR PENJUALAN</strong></td>
  </tr>
  <tr>
    <td><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?> Telp. <?php 
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
      <td>NO : <?= $val[0]['faktur_penjualan_nomor'] ?></td>
  </tr>
</table>
<hr>
<table width="100%">
  <tr>
    <td width="10%">Nama</td>
    <td width="2%" align="center">:</td>
    <td width="50%"><?= $val[0]['t_po_customer']['val2'][0]['m_partner_id']['val2'][0]['text'] ?></td>
    <td width="13%">Tanggal</td>
    <td width="2%" align="center">:</td>
    <td><?= $val[0]['faktur_penjualan_tanggal'] ?></td>
  </tr>
  <tr>
    <td rowspan="2" valign="top">Alamat</td>
    <td rowspan="2" align="center" valign="top">:</td>
    <td rowspan="2" valign="top"><?= $val[0]['t_po_customer']['val2'][0]['m_partner_id']['val2'][0]['alamat'] ?></td>
    <td>No SJ</td>
    <td align="center">:</td>
    <td><?= $val[0]['t_surat_jalan']['val2'][0]['text'] ?></td>
  </tr>
  <tr>
    <td>Jatuh Tempo</td>
    <td align="center">:</td>
    <td><?= $val[0]['faktur_penjualan_jatuh_tempo'] ?></td>
  </tr>
  <tr>
    <td>Kota</td>
    <td align="center">:</td>
    <td></td> 
    <td>Sales</td>
    <td align="center">:</td>
    <td></td> 
  </tr>
  </table>
 <table width="100%" border="1" cellspacing="0" cellpadding="6">
  <tr>
    <th width="15%"><div align="center">Qty</div></th>
    <th colspan="5"><div align="center">Uraian / Nama Barang</div></th>
    <th width="10%"><div align="center">% Disc</div></th>
    <th width="15%"><div align="center">Harga Satuan</div></th>
    <th width="15%"><div align="center">Jumlah</div></th>
  </tr>
    <?php
      $no = 1;
      $total = 0;
      foreach ($val2 as $barang => $itemBarang) 
      {
        echo '<tr align="left">';
        echo '<td align="center">'.$itemBarang['po_customerdet_qty'].'</td>';
        echo '<td colspan="5">'.$itemBarang['barang_uraian'].'</td>';
        echo '<td align="center">'.$itemBarang['faktur_penjualandet_discount'].'%</td>';
        echo '<td align="center"><table width="100%">
          <tr>
            <td align="left" valign="top">Rp.</td>
            <td align="right" valign="top">'.number_format($itemBarang['po_customerdet_harga_satuan'],"0", ",", ".").'</td>
          </tr>
        </table></td>';
        $subtotal = 0;
        $subtotal = $itemBarang['po_customerdet_qty'] * $itemBarang['po_customerdet_harga_satuan'] - ($itemBarang['po_customerdet_qty'] * $itemBarang['po_customerdet_harga_satuan'] * $itemBarang['faktur_penjualandet_discount'] / 100);
        $total = $total + $subtotal;
        echo '<td align="center"><table width="100%">
          <tr>
            <td align="left" valign="top">Rp.</td>
            <td align="right" valign="top">'.number_format($subtotal,"0", ",", ".").'</td>
          </tr>
        </table></td>';
        echo '</tr>'; 
        $no++;
      }
    ?>
  <tr>
    <td colspan="6" rowspan="4" valign="top"><u>Catatan :</u><br>Pembayaran Giro/Cek diakui apabila Cek/Giro tersebut cair /<br>telah masuk ke rekening kami<br><b>Terima kasih</b></td>
    <td colspan="2">Harga Jual Netto</td>
    <td>
      <table width="100%">
        <tr>
          <td align="left" valign="top">Rp.</td>
          <td align="right" valign="top"><?= number_format($total,"0", ",", ".") ?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="2">Potongan Harga</td>
    <td>
      <table width="100%">
        <tr>
          <td align="left" valign="top">Rp.</td>
          <td align="right" valign="top"><?= number_format($val[0]['faktur_penjualan_potongan'],"0", ",", ".") ?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="2">Uang Muka Yang Telah Diterima</td>
    <td>
      <table width="100%">
        <tr>
          <td align="left" valign="top">Rp.</td>
          <td align="right" valign="top"><?= number_format($val[0]['faktur_penjualan_uang_muka'],"0", ",", ".") ?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td colspan="2">Total</td>
    <td>
      <table width="100%">
        <tr>
          <td align="left" valign="top">Rp.</td>
          <td align="right" valign="top"><?= number_format($val[0]['faktur_penjualan_total'],"0", ",", ".") ?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<i>Harga sudah termasuk PPN 10%</i><br>
<table width="100%">
  <tr>
    <td></td>
    <td></td>
    <td align="center">Surabaya, ...................................................</td>
  </tr>
  <tr>
    <td colspan="2">
      Pembayaran harap ditransfer ke:
      <table border="1" cellspacing="0" width="100%">
        <tr>
          <td height="15%"><?php
            for($i = 0; $i < sizeof($val[0]['faktur_penjualan_tujuan_transfer']['val2']); $i++)
            {
              echo '&nbsp;'.$val[0]['faktur_penjualan_tujuan_transfer']['val2'][$i]['nama'].'<br>';
              echo '&nbsp;A/n. '.$val[0]['faktur_penjualan_tujuan_transfer']['val2'][$i]['atasnama'].'<br>';
              echo '&nbsp;No. Rek. '.$val[0]['faktur_penjualan_tujuan_transfer']['val2'][$i]['norek'].'<br><br>';
            }
          ?></td>
        </tr>
      </table>
    </td>
    <td align="center" valign="bottom">
      <i>Stempel & Tanda Tangan</i>
    </td>
  </tr>
</table>

</html>