<?php
/*
$outprint = "Just the test printer";
$printer = printer_open("58 Printer(1)");
printer_set_option($printer, PRINTER_MODE, "RAW");
printer_start_doc($printer, "Tes Printer");
printer_start_page($printer);
printer_write($printer, $outprint);
printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
*/
?>
<style media="screen">
body {
  background: rgb(204,204,204);
}

page[size="Struk"] {
  background: white;
  width: 21cm;
  height: 100%;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	padding: 20px;
}

.frame{
	border:1px solid #000;
	width:10%;
	margin-left:auto;
	margin-right:auto;
	padding:10px;
}
table{
	font-size:14px;

}
.header{
	text-align:center;
	font-weight:bold;
	font-size:11px;

}
.header_img{

	width:164px;
	height:79px;
	margin-left:auto;
	margin-right:auto;
	margin-bottom:10px;
}

.back_to_order{
	width:130px;
	margin-left:auto;
	margin-right:auto;
	color:#fff;
	font-weight:bold;
	background:#09F;
	text-align:center;
	border-radius:10px;
	margin-top:10px;
	padding:5px;
	height:30px;
}

.back_to_order:hover{
	background:#069;
}

.logo-print{
	width: 120px;
	height: auto;
}

@media print {
  /*body, page[size="Struk"] {
    margin: 0;
    box-shadow: 0;
		background-color: #fff;
  }*/

	button.back_to_order {
		display: none!important;
	}
	.div-btn {
		display: none!important;
	}

	.header,
	.logo-print {
	    text-align: center;
	}
}
</style>

<!-- E:\penting\htdocs\proyek-jsw-master\assets\tangs-logo.jpg -->

<body onload=print()>
	<page size="Struk">
	  <div class="header" style="text-align: center;">
			<!-- <img class="logo-print" src="<?php echo base_url();?>assets/tangs-logo.jpg" alt="">
			<span style="font-size:14px;"></span><br>
			<span style="font-size:14px;"></span><br>
			<span style="font-size:14px;"></span><br> -->
      <span style="font-size:26px;">TANGS</span><br>
      <span style="font-size:12px;">PT. TEKNIK ANDHALAN NUSANTARA GLOBAL</span><br>
			<span style="font-size:12px;">JL. RA. Kartini 41-45</span><br>
      <span style="font-size:14px;">GRESIK</span><br>
		</div>
    <hr style="border: 1px solid;">
			<table style="width:100%;">
        <tr>
          <td>NO.</td>
          <td> : <?php echo $transaksi->penjualan_code?></td>
        </tr>
				<tr>
					<td valign="top" style="width:20%;">
					Customer
					</td>
					<td valign="top">: <?php echo $transaksi->partner_nama?></td>
				</tr>
				<tr>
					<td valign="top">
						Kasir.
					</td>
					<td valign="top">: <?php echo $transaksi->user_username?></td>
				</tr>
        <tr>
          <td valign="top">Tanggal</td>
          <td valign="top">: <?php echo date("d-m-Y H:m:s",strtotime($transaksi->penjualan_date)) ?></td>
        </tr>
			</table>
			<hr style="border: 1px solid;">
			<table style="width:100%;">
			  <?php
			    $no_item = 1;
			    $total_price = 0;
  				$total_diskon_item = 0;
  				$totalhargitem = 0;
          $totalhargatanpappn = 0;
			    foreach ($transaksi_detail->result() as $r_transaksi_detail) {
            $totalhargatanpappn = $totalhargatanpappn + $r_transaksi_detail->barang_price
            ?>
						<tr>
							<td valign="top" style="text-align:center;width:5%;" rowspan="2"><?php echo $no_item; ?></td>
							<td><?php echo $r_transaksi_detail->barang_nomor?></td>
							<td colspan="2"></td>
						</tr>
						<tr>
							<td colspan="5"><?php echo $r_transaksi_detail->barang_nama?></td>
			      </tr>
						<tr>
							<td></td>
							<td colspan="" align="center">
								<?php if ($r_transaksi_detail->booking_status): ?>
									Booking
								<?php endif; ?>
							</td>
							<td style="text-align:right;" colspan="3">
								Total :
								<strong><?php echo number_format($r_transaksi_detail->barang_price*($r_transaksi_detail->barang_qty+$r_transaksi_detail->item_getFromGudang), "0", ",", ".")?></strong>
							</td>
						</tr>
			            <tr valign="top">
							<td></td>
							<td style="text-align:center;">Jumlah :<br>
                                <?php $barang_qty = $r_transaksi_detail->barang_qty ? $r_transaksi_detail->barang_qty : $r_transaksi_detail->item_getFromGudang?>
								<?php echo $barang_qty?>
							</td>
							<td style="text-align:center;">Harga Satuan :<br>
								<?php echo number_format($r_transaksi_detail->barang_price,"0", ",", ".")?>
							</td>
							<?php
							$discount = $r_transaksi_detail->barang_discount_nominal ? $r_transaksi_detail->barang_discount_nominal : 0;
                            $discpersen = 0;
                            if ($discount) {
                            $discpersen = $r_transaksi_detail->barang_discount_nominal/$r_transaksi_detail->barang_price*100;
                            }
							?>
							<td style="text-align:center;">
								<?php echo "Diskon<br>(".round($discpersen, 2)." %)"?>
								<br>
								<?php echo number_format($discount, "0", ",", ".")?>
							</td>
							<?php
							$potongandisc = 0;
							if ($discount) {$potongandisc=$discount;}
							 ?>
							<td style="text-align:right;" colspan="">
								<?php echo number_format($potongandisc, "0", ",", ".")?>
							</td>
			      </tr>
			    <?php
			        $totalhargitem = $totalhargitem+$r_transaksi_detail->barang_price*($r_transaksi_detail->barang_qty+$r_transaksi_detail->item_getFromGudang);
					$total_diskon_item = $total_diskon_item + $r_transaksi_detail->barang_discount_nominal;
					$no_item++;} ?>
			</table>
  <hr style="border: 1px solid;">
	<table style="width:100%;">
		<tr>
			<td>Total Pembelian</td>
			<td align="right"><?php echo number_format($totalhargitem , "0", ",", ".")?></td>
		</tr>
    <tr>
      <td><strong>Pembayaran</strong></td>
      <td  align="right">
        <strong>
      <?php if ($transaksi->penjualan_payment_method == 1){
        echo "Cash";
      } else if ($transaksi->penjualan_payment_method == 2){
        echo "DEBIT";
      }?>
        </strong>
      </td>
      <?php if ($transaksi->penjualan_payment_method == 2){
        echo "<strong><td>Nomor </td><td>".strtoupper($transaksi->bank_atas_name)."/".$transaksi->bank_number." </td></strong>";
      } ?>
    </tr>
    <?php
    $promo_harga = 0;
     if ($transaksi->promo): ?>
      <?php foreach ($promo->result() as $key => $value): ?>
        <tr>
          <td style="font-size: 18px">
            <strong>Promo</strong>
          </td>
          <td align="right"><strong><?php echo number_format($value->promo_harga,"0", ",", ".")?></strong></td>
        </tr>
      <?php $promo_harga = $promo_harga + $value->promo_harga;
    endforeach; ?>
    <?php endif; ?>
  </table>
  <hr style="border: 1px solid;">
  <table style="width:100%;">
    <tr style="font-size: 18px">
      <td><strong>Grand Total</strong></td>
      <td align="right"><strong><?php echo number_format($transaksi->penjualan_grand_total-$promo_harga,"0", ",", ".")?></strong></td>
    </tr>
    <tr>
			<td><strong>Total Pembayaran</strong></td>
			<td align="right"><strong><?php echo number_format($transaksi->penjualan_payment,"0", ",", ".")?></strong></td>
		</tr>
    <tr>
			<td><strong>Nilai Kembalian</strong></td>
			<td align="right"><strong><?php echo number_format($transaksi->penjualan_change,"0", ",", ".")?></strong></td>
		</tr>
  </table>
  <hr style="border: 1px solid;">
  <table style="width:100%;">
    <tr>
			<td><strong>BKP</strong></td>
			<td align="right"><strong><?php echo number_format($totalhargitem,"0", ",", ".")?></strong></td>
		</tr>
    <tr>
			<td><strong>DISC</strong></td>
			<td align="right"><strong><?php echo number_format($discount+$transaksi->penjualan_all_discount,"0", ",", ".")?></strong></td>
		</tr>
    <tr>
			<td><strong>DPP</strong></td>
			<td align="right"><strong><?php echo number_format($totalhargatanpappn,"0", ",", ".")?></strong></td>
		</tr>
    <tr>
			<td><strong>PPN</strong></td>
			<td align="right"><strong><?php echo number_format($totalhargitem-$totalhargatanpappn,"0", ",", ".")?></strong></td>
		</tr>
  </table>
	</page>
</body>
<script type="text/javascript">
	function back_to_order(){
		window.close();
	}
</script>
