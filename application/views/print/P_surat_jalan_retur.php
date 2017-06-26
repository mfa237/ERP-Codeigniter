<html>
  <head>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
<table align="center">
  <tr>
  <th><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></th>
  </tr>
  <tr>
    <td><center><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?></center></td>
  </tr>
  <tr>
    <td><center>Telp. <?php 
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
      ?></center></td>
  </tr>
  </table>
<table width="100%" border="1" cellspacing="0" cellpadding="6">
  <tr>
    <td width="4%" rowspan="4">&nbsp;</td>
    <td colspan="5"><b>SURAT JALAN-RETUR BELI/MAKLON<b></td>
    <td width="10%">No</td>
    <td width="16%"><?= $val[0]['surat_jalan_nomor'] ?></td>
  </tr>
  <tr>
    <td valign="top" colspan="5" rowspan="3">
      <table>
        <tr>
          <td>Kepada:</td>
          <td><?= $val[0]['m_partner_id']['val2'][0]['text'] ?></td>
        </tr>
        <tr>
          <td></td>
          <td><?= $val[0]['m_partner_id']['val2'][0]['alamat'] ?></td>
        </tr>
      </table>
    </td>
    <td>Tgl Kirim</td>
    <td><?= $val[0]['surat_jalan_tanggal_kirim'] ?></td>
  </tr>
  <tr>
    <td>No. <?php if($val[0]['surat_jalan_jenis'] == 1)
    {
      echo 'WO';
    }
    else
    {
      echo 'PO';
    } 
    ?></td>
    <td><?= $val[0]['order_id']['val2'][0]['text'] ?></td>
  </tr>
  <tr>
    <td>Ekspedisi</td>
    <td><?= $val[0]['surat_jalan_ekspedisi'] ?></td>
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
          echo '<td align="center">'.$itemBarang['orderdet_qty'].'</td>';
          echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
          if($val[0]['surat_jalan_jenis'] == 0)
          {
            echo '<td colspan="2">'.$itemBarang['keterangan'].'</td>';
          }
          else if($val[0]['surat_jalan_jenis'] == 1)
          {
            echo '<td colspan="2">Barang WO</td>';
          }
          
          echo '</tr>'; 
          $no++;
        }
      ?>
  <tr>
    <td colspan="2"><div align="center">Security</div></td>
    <td width="15%"><div align="center">Sopir</div></td>
    <td width="15%"><div align="center">Gudang</div></td>
    <td><div align="center">Admin</div></td>
    <td colspan="3" rowspan="3" valign="top"><dl>
      <dt>Surabaya, </dt>
      <dt>Telah diterima dengan baik oleh:</dt>
    </dl>    </td>
  </tr>
  <tr>
    <td height="75" colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="23" colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</html>