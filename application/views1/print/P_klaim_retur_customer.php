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
		  <td><b><?= strtoupper(@$val[0]['cabang']['val2'][0]['text'])?></b></td>
		  <td align="right">No :</td>
		  <td width="30%"><?= @$val[0]['retur_penjualan_nomor'] ?></td>
		</tr>
		<tr>
		  <td><?= @$val[0]['cabang']['val2'][0]['alamat']?>, <?= @$val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?><br>
      Telp. <?php 
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
      ?></td>
		  <td align="right" valign="top">Tgl :</td>
		  <td width="30%" valign="top"><?= @$val[0]['retur_penjualan_tanggal'] ?></td>
		</tr>
  </table>
  <h3 align="center">PERMINTAAN KLAIM/RETUR-CUSTOMER</h3>
   <table width="100%" border="0">
  <tr>
    <td width="20%" align="left">Nama Customer</td>
    <td width="3%">:</td>
    <td width="30%" colspan="2"><?= @$val[0]['t_surat_jalan_id']['val2'][0]['m_partner_id']['val2'][0]['text'] ?></td>
    <td>
      <?php
        if(@$val[0]['retur_penjualan_status_pengembalianbarang'] == '1')
        {
          echo '<td width="10%"><input type="checkbox" name="" checked="true"/></td>';
          echo '<td width="40%">Potong Tagihan</td>';
        }
      ?>
    </td>
  </tr>
  <tr>
    <td scope="row" rowspan="2" valign="top"><div align="left">Alamat Customer</div></td>
    <td rowspan="2" valign="top">:</td>
    <td rowspan="2" valign="top" colspan="2"><?= @$val[0]['t_surat_jalan_id']['val2'][0]['m_partner_id']['val2'][0]['alamat'] ?></td>
    <td>
      <?php
        if(@$val[0]['retur_penjualan_status_pengembalianbarang'] == '1')
        {
          echo '<td width="6%"><input type="checkbox" name=""/></td>';
          echo '<td>......</td>';
        }
      ?>
    </td>
  </tr>
  <tr>
    <td scope="row">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td scope="row" valign="top">No. SJ</td>
    <td valign="top">:</td>
    <td colspan="2" valign="top"><?= @$val[0]['t_surat_jalan_id']['val2'][0]['text'] ?></td>
    <td scope="row" align="right" colspan="2" valign="top">No. SO :</td>
    <td valign="top">
      <?php 
        for($i = 0; $i < sizeof(@$val[0]['t_surat_jalan_id']['val2'][0]['so_customer_id']['val2']); $i++)
        {
          if($i == 0)
          {
            echo @$val[0]['t_surat_jalan_id']['val2'][0]['so_customer_id']['val2'][$i]['text'];
          }
          else
          {
            echo ', '.@$val[0]['t_surat_jalan_id']['val2'][0]['so_customer_id']['val2'][$i]['text'];
          }
        }
      ?>
    </td>
  </tr>
  <tr>
    <td scope="row" valign="top">Tgl. SJ</td>
    <td valign="top">:</td>
    <td colspan="2" valign="top"><?= @$val[0]['t_surat_jalan_id']['val2'][0]['tanggal'] ?></td>
    <td scope="row" align="right" colspan="2" valign="top">Tgl. SO : </td>
    <td>
      <?php 
        for($i = 0; $i < sizeof(@$val[0]['t_surat_jalan_id']['val2'][0]['so_customer_id']['val2']); $i++)
        {
          if($i == 0)
          {
            echo @$val[0]['t_surat_jalan_id']['val2'][0]['so_customer_id']['val2'][$i]['tanggal'];
          }
          else
          {
            echo ', '.@$val[0]['t_surat_jalan_id']['val2'][0]['so_customer_id']['val2'][$i]['tanggal'];
          }
        }
      ?>
    </td>
  </tr>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="4">
  <tr align="center">
    <th scope="col" >No.</th>
    <th scope="col" >Artikel</th>
    <th scope="col" >Uraian dan Spesifikasi Barang/Jasa</th>
    <th scope="col" >Batch No.</th>
    <th scope="col" >Qty</th>
    <th scope="col" >Satuan</th>
  </tr>
  <?php
    $no = 1;
    foreach (@$val2 as $barang => $itemBarang) {
      echo '<tr align="left">';
      echo '<td align="center"  width="5%">'.$no.'</td>';
      echo '<td width="13%">'.$itemBarang['barang_kode'].'</td>';
      echo '<td>'.$itemBarang['barang_uraian'].'</td>';
      echo '<td width="13%">'.$itemBarang['retur_penjualandet_batch_no'].'</td>';
      echo '<td align="center" width="10%">'.$itemBarang['retur_penjualandet_qty'].'</td>';
      echo '<td align="center" width="10%">'.$itemBarang['satuan_nama'].'</td>';
      echo '</tr>';
      $no++;
    }
  ?>
</table>
<table align="left" width="100%" cellspacing="0" cellpadding="6">
    <tr>
      <td valign="top" width="17%">Alasan/maksud : </td>
      <td valign="top" rowspan="2"><?= @$val[0]['retur_penjualan_alasan'] ?></td>
    </tr>
    <tr>
      <td height="8%"></td>
    </tr>
  </table>
  <p>&nbsp;</p><br>
  <table width="40%" border="1" cellspacing="0" align="left">
  <tr>
    <td height="3%" width="15%"><div align="center">Diterima</div></td>
    <td width="15%"><div align="center">Dibuat</div></td>
  </tr>
  <tr>
    <td height="8%">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="3%"><div align="center">Staf Penjualan</div></td>
    <td><div align="center">Pembeli</div></td>
  </tr>
</table>
  <table width="55%" align="right" border="1" cellspacing="0">
  <tr>
    <td height="15%" width="25%" valign="top">Catatan : <br>- Klaim/Retur wajib disertai dengan foto kerusakan produk yang akan diretur.</td>
  </tr>
</table>
</body>
</html>