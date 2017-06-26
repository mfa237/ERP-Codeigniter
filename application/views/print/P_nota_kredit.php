<html>
  <head>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
<table align="center">
  <tr>
  <th><?= strtoupper(@$val[0]['cabang']['val2'][0]['text'])?></th>
  </tr>
  <tr>
    <td><center><?= @$val[0]['cabang']['val2'][0]['alamat']?>, <?= @$val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?></center></td>
  </tr>
  <tr>
    <td><center>Telp. <?php 
      for($i=0; $i < count(@$val[0]['cabang']['val2'][0]['telp']); $i++)
      {
        if($i == count(@$val[0]['cabang']['val2'][0]['telp'])-1)
        {
          echo @$val[0]['cabang']['val2'][0]['telp'][$i];
        }
        else
        {
          echo @$val[0]['cabang']['val2'][0]['telp'][$i].', ';
        }
      }
      ?></center></td>
  </tr>
  </table>
 <table width="100%" border="1" cellspacing="0" cellpadding="6">
  <tr>
    <td width="4%" rowspan="6">&nbsp;</td>
    <td colspan="7"><b>NOTA KREDIT</b></td>
  </tr>
  <tr>
    <td valign="top" colspan="4" rowspan="3">
      <table>
        <tr>
          <td>Kepada Yth. :</td>
          <td></td>
        </tr>
        <tr>
          <td><?= @@$val[0]['t_faktur_penjualan_id']['val2'][0]['m_partner_id']['val2'][0]['text'] ?></td>
          <td></td>
        </tr>
        <tr>
          <td><?= @@$val[0]['t_faktur_penjualan_id']['val2'][0]['m_partner_id']['val2'][0]['alamat'] ?></td>
          <td></td>
        </tr>
        <tr>
          <td>Telp. <?php 
            for($i=0; $i < count(@$val[0]['t_faktur_penjualan_id']['val2'][0]['m_partner_id']['val2'][0]['telp']); $i++)
            {
              if($i == count(@$val[0]['t_faktur_penjualan_id']['val2'][0]['m_partner_id']['val2'][0]['telp'])-1)
              {
                echo @$val[0]['t_faktur_penjualan_id']['val2'][0]['m_partner_id']['val2'][0]['telp'][$i];
              }
              else
              {
                echo @$val[0]['t_faktur_penjualan_id']['val2'][0]['m_partner_id']['val2'][0]['telp'][$i].', ';
              }
            }
          ?></td>
          <td></td>
        </tr>
      </table>
    </td>
    <td width="10%">No. CN</td>
    <td width="16%" colspan="2"><?= @$val[0]['nota_kredit_nomor'] ?></td>
  </tr>
  <tr>
    <td>Tgl. CN</td>
    <td colspan="2"><?= @$val[0]['nota_kredit_tanggal'] ?></td>
  </tr>
  <tr>
    <td>No. Inv</td>
    <td colspan="2"><?= @$val[0]['t_faktur_penjualan_id']['val2'][0]['text'] ?></td>
  </tr>
  <tr>
    <td colspan="4"></td>
    <td>Tgl. Inv</td>
    <td colspan="2"><?= @$val[0]['t_faktur_penjualan_id']['val2'][0]['tanggal'] ?></td>
  </tr>
  <tr>
    <td colspan="4"></td>
    <td>NPWP</td>
    <td colspan="2"><?= @$val[0]['t_faktur_penjualan_id']['val2'][0]['ekspedisi'] ?></td>
  </tr>
  <tr>
    <td ><div align="center"><b> Kode </b></div></td>
    <td colspan="2"><div align="center"><b>Nama Barang</b></div></td>
    <td width="10%"><div align="center"><b>Qty</b></div></td>
    <td width="10%"><div align="center"><b>Sat</b></div></td>
    <td><div align="center"><b>Harga Per</b></div></td>
    <td><div align="center"><b>Disc.</b></div></td>
    <td><div align="center"><b>Harga Netto</b></div></td>
  </tr>
  <?php
        foreach (@$val2 as $barang => $itemBarang) 
        {
          echo '<tr align="left">';
          echo '<td>'.$itemBarang['barang_kode'].'</td>';
          echo '<td colspan="2">'.$itemBarang['barang_nama'].'</td>';
          echo '<td align="center">'.$itemBarang['nota_kreditdet_qty'].'</td>';
          echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
          echo '<td>
            <table border="0" width="100%">
              <tr>
                <td align="left">Rp.</td>
                <td align="right">'.number_format($itemBarang['nota_kreditdet_harga_satuan'], "0", ",", ".").'</td>
              </tr>
            </table>
          </td>'; 
          echo '<td align="right">'.$itemBarang['nota_kreditdet_discount'].'%</td>';
          echo '<td>
            <table border="0" width="100%">
              <tr>
                <td align="left">Rp.</td>
                <td align="right">'.number_format(($itemBarang['nota_kreditdet_harga_satuan'] - ($itemBarang['nota_kreditdet_harga_satuan']*$itemBarang['nota_kreditdet_discount']/100)), "0", ",", ".").'</td>
              </tr>
            </table>
          </td>'; 
          echo '</tr>'; 
        }
      ?>
  <tr>
    <td colspan="3" rowspan="7" valign="top">Catatan :</td>
    <td colspan="4" valign="top">Harga Jual Netto</td>
    <?php 
      $total = @$val[0]['nota_kredit_netto'];
      echo '<td>
        <table border="0" width="100%">
          <tr>
            <td align="left">Rp.</td>
            <td align="right">'.number_format(@$val[0]['nota_kredit_netto'], "0", ",", ".").'</td>
          </tr>
        </table>
      </td>';
    ?>
  </tr>
  <tr>
    <td colspan="4" valign="top">Potongan Harga</td>
    <?php 
      $total = $total - @$val[0]['nota_kredit_potongan_harga'];
      echo '<td>
        <table border="0" width="100%">
          <tr>
            <td align="left">Rp.</td>
            <td align="right">'.number_format(@$val[0]['nota_kredit_potongan_harga'], "0", ",", ".").'</td>
          </tr>
        </table>
      </td>';
    ?>
  </tr>
  <tr>
    <td colspan="4" valign="top">Uang Muka Yang Telah Diterima</td>
    <?php 
      $total = $total - @$val[0]['nota_kredit_uang_muka'];
      echo '<td>
        <table border="0" width="100%">
          <tr>
            <td align="left">Rp.</td>
            <td align="right">'.number_format(@$val[0]['nota_kredit_uang_muka'], "0", ",", ".").'</td>
          </tr>
        </table>
      </td>';
    ?>
  </tr>
  <tr>
    <td colspan="4" valign="top">Total setelah Potongan & Uang Muka</td>
    <?php 
      echo '<td>
        <table border="0" width="100%">
          <tr>
            <td align="left">Rp.</td>
            <td align="right">'.number_format($total, "0", ",", ".").'</td>
          </tr>
        </table>
      </td>';
    ?>
  </tr>
  <tr>
    <td colspan="4" valign="top">PPN <?= @$val[0]['nota_kredit_ppn']?>%</td>
    <?php 
      $ppn = $total*@$val[0]['nota_kredit_ppn']/100;
      echo '<td>
        <table border="0" width="100%">
          <tr>
            <td align="left">Rp.</td>
            <td align="right">'.number_format($ppn, "0", ",", ".").'</td>
          </tr>
        </table>
      </td>';
    ?>
  </tr>
  <tr>
    <td colspan="4" valign="top">&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td colspan="4" valign="top">TOTAL</td>
    <?php 
      echo '<td>
        <table border="0" width="100%">
          <tr>
            <td align="left">Rp.</td>
            <td align="right">'.number_format(@$val[0]['nota_kredit_total'], "0", ",", ".").'</td>
          </tr>
        </table>
      </td>';
    ?>
  </tr>
</table>
<p>&nbsp;</p>
<table border="0" align="right" width="30%">
  <tr>
    <td align="center">Surabaya, <?= @$val[0]['nota_kredit_tanggal'] ?></td>
  </tr>
  <tr>
    <td><br><br><br><br><br><br><center><hr><i>Stempel & Tanda Tangan</i></center></td> 
  </tr>
</table>
</html>