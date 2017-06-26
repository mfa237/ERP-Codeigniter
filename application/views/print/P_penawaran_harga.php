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
  </style>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
  <body>
    <table width="100%">
    <tr>
      <td><b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b></td>
      <td align="right">No :</td>
      <td width="30%"><?= $val[0]['penawaran_nomor'] ?></td>
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
      <td width="30%" valign="top"><?= $val[0]['penawaran_tanggal'] ?></td>
    </tr>
  </table>
  <h3 align="center">FORM PENAWARAN HARGA</h4>

  <table width="100%" border="1" rules="all" cellpadding="6">
  <tr>
    <th colspan="5" rowspan="6" scope="col"><p>Daftar perbandingan penawaran dari Supplier</p></th>
    <th scope="col">&nbsp;</th>
    <?php
      $i = 0;
      foreach ($step2 as $supplier => $detSupplier)
      {
        $i++;
        echo '<th scope="col"><div align="center">Supplier '.$i.'</div></th>';
      }
    ?>
  </tr>
  <tr>
    <td>Nama Supplier</td>
    <?php
      foreach ($step2 as $supplier => $detSupplier)
      {
        echo '<td align="center">'.$detSupplier['partner_nama'].'</td>';
      }
    ?>
    <!-- <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td> -->
  </tr>
  <tr>
    <td>Nama yang dihubungi</td>
    <?php
      foreach ($step2 as $supplier => $detSupplier)
      {
        echo '<td align="center">'.$detSupplier['penawaran_supplier_kontak'].'</td>';
      }
    ?>
  </tr>
  <tr>
    <td rowspan="2" valign="top">Alamat</td>
    <?php
      foreach ($step2 as $supplier => $detSupplier)
      {
        echo '<td valign="top" rowspan="2">'.$detSupplier['partner_alamat'].'</td>';
      }
    ?>
  </tr>
  <tr>
  </tr>
  <tr>
    <td>No. Telp/Fax</td>
    <?php
      $suppPemenang = '';
      $alasan = '';
      foreach ($step2 as $supplier => $detSupplier)
      {
        echo '<td align="center">'.$detSupplier['partner_telepon'].'</td>';
        if($detSupplier['penawaran_supplier_pemenang'] == '1')
        {
          $suppPemenang = $detSupplier['partner_nama'];
          $alasan = $detSupplier['penawaran_supplier_alasan'];
        }
      }
    ?>
  </tr>
  <tr>
    <td rowspan="2"><div align="center">No.</div></td>
    <td rowspan="2"><div align="center">Artikel</div></td>
    <td rowspan="2"><div align="center">Uraian dan Spesifikasi Barang/Jasa</div></td>
    <td rowspan="2"><div align="center">Qty</div></td>
    <td rowspan="2"><div align="center">Satuan</div></td>
    <td>Tanggal Kirim</td>
    <?php
      foreach ($step2 as $supplier => $detSupplier)
      {
        echo '<td  align="center">'.date("d-m-Y", strtotime($detSupplier['penawaran_supplier_tanggal_kirim'])).'</td>';
      }
    ?>
  </tr>
  <tr>
    <td>Diskon yang diberikan</td>
    <?php
      foreach ($step2 as $supplier => $detSupplier)
      {
        echo '<td align="center">'.$detSupplier['penawaran_supplier_diskon'].'%</td>';
      }
    ?>
  </tr>

    <?php
      $noBarang = 1;
      foreach ($step1 as $barang => $itemBarang) {
        $penawaran = $itemBarang['penawaran_barang_id'];
        echo '<tr>';
        echo '<td align="center">'.$noBarang.'</td>';
        echo '<td>'.$itemBarang['barang_nomor'].'</td>';
        echo '<td>'.$itemBarang['barang_uraian'].'</td>';
        echo '<td align="center">'.$itemBarang['penawaran_barang_qty'].'</td>';
        echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
        echo '<td></td>';
        if(isset($step3))
        {
          foreach ($step3 as $harga => $itemHarga) {
            if($itemHarga['barang_nomor'] == $penawaran)
            {
              echo '<td><table width="100%">
                <tr>
                  <td align="left">Rp.</td>
                  <td align="right">'.number_format($itemHarga['harga'], "0", ",", ".").'</td>
                </tr>
                  </table></td>';

            }
          }
        }
        else
        {
          for($j = 0; $j < $i; $j++)
          {
            echo "<td></td>";
          }
        }
        echo '</tr>';
        $noBarang++;
      }
    ?>
</table>

<table border="0">
  <tr>
    <th>Supplier yang dipilih :</th>
    <td><?= $suppPemenang ?></td>
  </tr>
  <tr>
    <th align="right" valign="top">Alasan :</th>
    <td rowspan="2" valign="top"><?= $alasan ?></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>

<table border="1" rules="all" align="left" width="50%" >
    <tr align="center">
      <td width="20%">Diterima</td>
      <td width="20%">Disetujui</td>
      <td width="20%">Dibuat</td>
    </tr>
    <tr align="center">
      <td height="12%"></td>
      <td></td>
      <td><?= $val[0]['penawaran_create_by'] ?></td>
    </tr>
    <tr>
      <td align="center">Direktur</td>
      <td align="center">Kabag Pembelian</td>
      <td align="center">Staff Pembelian</td>
    </tr>
  </table>
  <table width="35%" align="right" border="1" cellspacing="0">
    <tr>
      <td >Catatan:</td>
    </tr>
	<tr>
		<td height="15%" ></td>
	</tr>
  </table>
  </body>
</html>
