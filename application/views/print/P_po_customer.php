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
    </tr>
  </table>
  <hr>
  <h3 align="center">PURCHASE ORDER  (PO) CUSTOMER</h3>
  <hr>
  
<table width="100%" border="0" cellpadding="5">
  <tr>
    <td width="20%">Tanggal</td>
    <td width="3%">:</td>
    <td width="44%"><?= $val[0]['po_customer_tanggal'] ?></td>
    <td width="10%">No. PO</td>
    <td width="3%">:</td>
    <td width="20%"><?= $val[0]['po_customer_nomor'] ?></td>
  </tr>
  <tr>
    <td>Nama Toko</td>
    <td>:</td>
    <td colspan="4"><?= $val[0]['m_partner_id']['val2'][0]['text'] ?></td>
  </tr>
  <tr>
    <td>Sejarah Customer</td>
    <td>:</td>
    <td colspan="4"></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td>:</td>
    <td colspan="4"><?= $val[0]['m_partner_id']['val2'][0]['alamat'] ?></td>
  </tr>
  <tr>
    <td>Kota</td>
    <td>:</td>
    <td colspan="4"></td>
  </tr>
  <tr>
    <td>Telepon</td>
    <td>:</td>
    <td colspan="4"><?php 
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
    <td>Kontak Person</td>
    <td>:</td>
    <td colspan="4"><?= $val[0]['po_customer_kontak_person'] ?></td>
  </tr>
  <tr>
    <td>Nama Pelanggan</td>
    <td>:</td>
    <td colspan="4"><?= $val[0]['po_customer_nama_pelanggan'] ?></td>
  </tr>
  <tr>
    <td valign="top">Barang yang Dipesan</td>
    <td valign="top">:</td>
    <td colspan="4">
     <table border="0" cellpadding="5" width="100%">
        <?php
          foreach ($val2 as $barang => $itemBarang) 
          {
            echo '<tr align="left">';
            echo '<td valign="top" width="20%">'.$itemBarang['barang_kode'].'</td>';
            echo '<td valign="top" width="50%">'.$itemBarang['barang_uraian'].'</td>';
            echo '<td valign="top">'.$itemBarang['po_customerdet_qty'].'</td>';
            echo '<td valign="top"><table width="100%">
                    <tr>
                      <td align="left" valign="top">@Rp.</td>
                      <td align="right" valign="top">'.number_format($itemBarang['po_customerdet_harga_satuan'],"0", ",", ".").'</td>
                    </tr>
                  </table></td> ';            
            echo '</tr>';
          }
        ?>
      </table>
    </td>
  </tr>
  <tr>
    <td>Perjanjian Bayar</td>
    <td>:</td>
    <td colspan="4"><?= $val[0]['po_customer_perjanjian_bayar'] ?> hari</td>
  </tr>
  <tr>
    <td valign="top">Jasa Angkut</td>
    <td valign="top">:</td>
    <td colspan="4"><?php
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
        echo 'Bayar Kantor / <strike> Bayar Toko </strike>*';
      }
      else
      {
        echo '<strike> Bayar Kantor </strike> / Bayar Toko*';
      }
    ?></td>
  </tr>
</table>

<p>&nbsp;</p>
*coret salah satu
<table width="50%" align="left" border="1" cellspacing="0">
  <tr>
    <td height="15%" width="25%" valign="top">Catatan : </td>
  </tr>
</table>
<table width="45%" border="1" cellspacing="0" align="right">
  <tr>
    <td height="3%" width="15%"><div align="center">Disetujui</div></td>
    <td width="15%"><div align="center">Diperiksa</div></td>
    <td width="15%"><div align="center">Dibuat</div></td>
  </tr>
  <tr>
    <td height="8%">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="3%"><div align="center"></div></td>
    <td><div align="center"></div></td>
    <td><div align="center"><?= $val[0]['po_customer_created_by'] ?></div></td>
  </tr>
</table>


  </body>
</html>