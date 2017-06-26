<html>
  <head>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
<table width="100%">
  <tr>
  <td colspan="3"><strong><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></strong> </td>
  <td rowspan="2" valign="top"><strong>SURAT JALAN</strong></td>
  </tr>
  <tr>
    <td colspan="3"><?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?></td>
  </tr>
  <tr>
    <td colspan="3">Telp. <?php 
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
      <td rowspan="5" valign="top"><table border="1" width="100%" cellspacing="0" cellpadding="6">
        <tr>
          <td height="10%" valign="top">Kepada :<br>
            <?= $val[0]['m_partner_id']['val2'][0]['text'] ?><br>
            <?= $val[0]['m_partner_id']['val2'][0]['alamat'] ?><br>
            <?php 
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
            ?><br>
          </td>
        </tr>
      </table></td>
  </tr>
  <tr>
  </tr>
  <tr>
    <td width="13%">Nomor</td>
    <td width="2%" align="center">:</td>
    <td><?= $val[0]['surat_jalan_nomor'] ?></td>
  </tr>
  <tr>
    <td>Tanggal</td>
    <td align="center">:</td>
    <td><?= $val[0]['surat_jalan_tanggal'] ?></td>
  </tr>
  <tr>
    <td>Sales</td>
    <td align="center">:</td>
    <td></td>
  </tr>
  <tr>
    <td>No. PO/SO</td>
    <td align="center">:</td>
    <td><?php 
    for($i = 0; $i < sizeof($val[0]['order_id']['val2']); $i++)
    {
      if($i == 0)
      {
        echo $val[0]['order_id']['val2'][$i]['text'];
      }
      else
      {
        echo ', '.$val[0]['order_id']['val2'][$i]['text'];
      }
      
    }
    ?></td>
  </tr>
  </table>
 <table width="100%" border="1" cellspacing="0" cellpadding="6">
  <tr>
    <th width="15%"><div align="center">Kode Barang</div></th>
    <th colspan="5"><div align="center">Deskripsi</div></th>
    <th width="10%"><div align="center">Qty</div></th>
    <th width="15%"><div align="center">Satuan</div></th>
  </tr>
    <?php
      $no = 1;
      foreach ($val2 as $barang => $itemBarang) 
      {
        echo '<tr align="left">';
        echo '<td align="center">'.$itemBarang['barang_kode'].'</td>';
        echo '<td colspan="5">'.$itemBarang['barang_uraian'].'</td>';
        echo '<td align="center">'.$itemBarang['po_customerdet_qty'].'</td>';
        echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
        echo '</tr>'; 
        $no++;
      }
    ?>
</table>
<p>&nbsp;</p>
<table width="100%">
  <tr>
    <td rowspan="3" width="10%" valign="top">Ket :</td>
    <td rowspan="3" width="50%"></td>
    <td>Surabaya,</td>
  </tr>
  <tr>
    <td>Telah diterima dengan baik </td>
  </tr>
  <tr>
    <td>oleh : </td>
  </tr>
  <tr>
    <td colspan="2">
      <table border="1" cellspacing="0" width="100%">
        <tr>
          <td colspan="2" width="25%"><div align="center">Security</div></td>
          <td width="25%"><div align="center">Sopir</div></td>
          <td width="25%"><div align="center">Gudang</div></td>
          <td width="25%"><div align="center">Admin</div></td>
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
    </td>
    <td align="center" valign="bottom">
      Tanda Tangan dan Stempel
    </td>
  </tr>
</table>

</html>