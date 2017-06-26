<html>
  <head>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
<table align="left">
  <tr>
  <th><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></th>
  </tr>
  <tr>
    <td><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?></td>
  </tr>
  <tr>
    <td>Telp. <?php 
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
  <p>&nbsp;</p>
  <p>&nbsp;</p>
 <table width="100%" border="1" cellspacing="0" cellpadding="6" align="left">
  <tr>
    <td width="4%" rowspan="5">&nbsp;</td>
    <td colspan="5" align="center"><b>SURAT JALAN RETUR JUAL<b></td>
    <td width="15%">No</td>
    <td width="16%"><?= $val[0]['sj_retur_nomor'] ?></td>
  </tr>
  <tr>
    <td valign="top" colspan="5" rowspan="4">
      <table>
        <tr>
          <td><b>Kepada :</b></td>
        </tr>
        <tr>
          <td><?= $val[0]['t_surat_jalan_id']['val2'][0]['m_partner_id']['val2'][0]['text'] ?></td>
        </tr>
        <tr>
          <td><?= $val[0]['t_surat_jalan_id']['val2'][0]['m_partner_id']['val2'][0]['alamat'] ?></td>
        </tr>
        <tr>
          <td>Telp. <?php 
            for($i=0; $i < count($val[0]['t_surat_jalan_id']['val2'][0]['m_partner_id']['val2'][0]['telp']); $i++)
            {
              if($i == count($val[0]['t_surat_jalan_id']['val2'][0]['m_partner_id']['val2'][0]['telp'])-1)
              {
                echo $val[0]['t_surat_jalan_id']['val2'][0]['m_partner_id']['val2'][0]['telp'][$i];
              }
              else
              {
                echo $val[0]['t_surat_jalan_id']['val2'][0]['m_partner_id']['val2'][0]['telp'][$i].', ';
              }
            }
          ?></td>
        </tr>
      </table>
    </td>
    <td>Tgl</td>
    <td><?= $val[0]['sj_retur_tanggal'] ?></td>
  </tr>
  <tr>
    <td>No. SJ</td>
    <td><?= $val[0]['t_surat_jalan_id']['val2'][0]['text'] ?></td>
  </tr>
  <tr>
    <td>No. Invoice</td>
    <td><?= $val[0]['t_faktur_penjualan_id']['val2'][0]['text'] ?></td>
  </tr>
  <tr>
    <td>Ekspedisi</td>
    <td><?= $val[0]['t_surat_jalan_id']['val2'][0]['ekspedisi'] ?></td>
  </tr>
  <tr>
    <td><div align="center">No</div></td>
    <td ><div align="center">Kode Barang</div></td>
    <td colspan="2"><div align="center">Nama Barang</div>      <div align="center"></div></td>
    <td><div align="center">Qty</div></td>
    <td><div align="center">SAT</div></td>
    <td colspan="2"><div align="center">Keterangan</div></td>
  </tr>
  <?php
        $no = 1;
        foreach ($val2 as $barang => $itemBarang) 
        {
          echo '<tr align="left">';
          echo '<td align="center">'.$no.'</td>';
          echo '<td>'.$itemBarang['barang_kode'].'</td>';
          echo '<td colspan="2">'.$itemBarang['barang_nama'].'</td>';
          echo '<td align="center">'.$itemBarang['sj_returdet_qty_retur'].'</td>';
          echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
          echo '<td colspan="2">'.$itemBarang['po_customerdet_keterangan'].'</td>';
          echo '</tr>'; 
          $no++;
        }
  ?>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p> 
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table align="left" width="100%" cellspacing="0" cellpadding="6">
    <tr>
      <td valign="top" width="17%">Alasan/maksud : </td>
      <td valign="top"><?= $val[0]['sj_retur_alasan'] ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <table width="45%" border="1" cellspacing="0" align="left">
  <tr>
    <td height="3%" width="15%"><div align="center">Gudang</div></td>
    <td width="15%"><div align="center">Sopir</div></td>
    <td width="15%"><div align="center">Admin Penjualan</div></td>
  </tr>
  <tr>
    <td height="8%">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="3%"><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"></div></td>
  </tr>
</table>
  <table width="50%" align="right" border="1" cellspacing="0">
  <tr>
    <td height="15%" width="25%" valign="top">Catatan : <br><?= $val[0]['sj_retur_catatan'] ?></td>
  </tr>
</table>

</html>