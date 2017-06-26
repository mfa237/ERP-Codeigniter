<html>
  <head>
  <style>
  .gg {
    border:1px solid;
    }
  </style>
  <title><?= $title[0]['aplikasi'].' '.$title[0]['title_page'].' - '.$title[0]['title_page2'] ?></title>
  </head>
  <body>
	<table>
		<tr>
			<td>
				<b><?= strtoupper($val[0]['cabang']['val2'][0]['text'])?></b>
			</td>
		</tr>
		<tr>
			<td>
				<?= $val[0]['cabang']['val2'][0]['alamat']?>, <?= $val[0]['cabang']['val2'][0]['kota']['val3'][0]['text']?>
			</td>
		</tr>
		<tr>
			<td>
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
      ?>
			</td>
		</tr>
	</table>
	<table width="100%" border="0">
		<tr>
			<th colspan="2" rowspan="2" scope="row" text-size=20px width="67%">NOTA DEBET</th>
			<td">No</td>
			<td align="left">: <?= $val[0]['nota_debet_nomor'] ?></td>
		</tr>
		<tr>
			<td>Tgl</td>
			<td>: <?= $val[0]['nota_debet_tanggal'] ?></td>
		</tr>
    </table>
      <table width="100%" border="0">
        <tr>
          <td width="15%">Nama Supplier</td>
          <td width="2%">:</td>
          <td width="40%"><?= $val[0]['partner']['val2'][0]['text'] ?></td>
          <td width="10%">Kode :</td>
          <td width="24%"><?= $val[0]['partner']['val2'][0]['id'] ?></td>
        </tr>
        <tr>
          <td rowspan="3" valign="top">Alamat</td>
          <td rowspan="3" valign="top">:</td>
          <td rowspan="3" valign="top"><?= $val[0]['partner']['val2'][0]['alamat'] ?></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>Telp/Fax</td>
          <td>:</td>
          <td><?php 
            for($i=0; $i < count($val[0]['partner']['val2'][0]['telp']); $i++)
            {
              if($i == count($val[0]['partner']['val2'][0]['telp'])-1)
              {
                echo $val[0]['partner']['val2'][0]['telp'][$i];
              }
              else
              {
                echo $val[0]['partner']['val2'][0]['telp'][$i].', ';
              }
            }
          ?>
          </td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
    </table>
      
      <table width="100%" border="1" cellspacing="0" cellpadding="6">
  <tr>
    <th width="8%" scope="col">No.</th>
    <th width="13%" scope="col">Kode Barang</th>
    <th width="19%" scope="col">Jenis Barang</th>
    <th width="8%" scope="col">Qty</th>
    <th width="10%" scope="col">Satuan</th>
    <th width="21%" scope="col">Harga Satuan</th>
    <th width="21%" scope="col">Total</th>
  </tr>
  <?php
        $no = 1;
        foreach ($val2 as $barang => $itemBarang) {
          echo '<tr align="left">';
          echo '<td align="center">'.$no.'</td>';
          echo '<td>'.$itemBarang['barang_kode'].'</td>';
          echo '<td>'.$itemBarang['jenis_barang_nama'].'</td>';
          echo '<td align="center">'.$itemBarang['nota_debetdet_qty'].'</td>';
          echo '<td align="center">'.$itemBarang['satuan_nama'].'</td>';
          echo '<td><table width=100%>
              <tr>
                <td align="left"> Rp.
                </td>
                <td align="right">'.number_format($itemBarang['nota_debetdet_harga_satuan'],0,',','.').'
                </td>
              </tr>
            </table></td>';
          echo '<td><table width=100%>
              <tr>
                <td align="left"> Rp.
                </td>
                <td align="right">'.number_format($itemBarang['nota_debetdet_total'],0,',','.').'</td>
              </tr>
            </table></td>';
          echo '</tr>';
          $no++;
        }
      
      ?>
  <tr>
    <td colspan="5" rowspan="3" valign="top">Terbilang : <?= $val[0]['nota_debet_terbilang'] ?> rupiah</td>
    <td>Sub Total</td>
    <td>
      <table width="100%">
        <tr>
          <td>Rp.</td>
          <td align="right"><?= number_format($val[0]['nota_debet_subtotal'],0,',','.') ?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
	<td>PPN <?= $val[0]['nota_debet_ppn'] ?>%</td>
    <td>
      <table width="100%">
        <tr>
          <td align="left">Rp.</td>
          <td align="right"><?= number_format(($val[0]['nota_debet_ppn']*$val[0]['nota_debet_subtotal']/100),"0", ",", ".") ?></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
	<td>Total</td>
    <td>
      <table width="100%">
        <tr>
          <td>Rp.</td>
          <td align="right"><?= number_format($val[0]['nota_debet_total'],0,',','.') ?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<br>
<table align="left" width="50%" height="152" class="gg">
	<tr>
	  <td width="50%">Catatan: </td>
	</tr>
	<tr>
	  <td height="97" valign="top"><?= $val[0]['nota_debet_catatan'] ?></td>
	</tr>
</table>
<table align="right" width="40%" border="0">
	<tr>
		<td>Surabaya,</td>
	</tr>
	<tr>
		<td height="80">&nbsp;</td>
	</tr>
	<tr>
		<td><div align="center"><em>Stempel &amp; Tanda tangan</em></div></td>
	</tr>
</table>
</body>
</html>