<html>
	<head>
		<style>
			table{
				font-size: 10px;
			}
			.head{
				border-bottom: 1px solid;
			}
		</style>
	</head>
	<body onload="window.print()">
		<table style="width: 8cm;">
			<tr>
				<td colspan="5" align="left">
					<img src="<?php echo base_url('assets/logo.jpg'); ?>" height="30" />
				</td>
			</tr>
			<tr>
				<td colspan="5"><?php echo $outlet->master_outlet_alamat?></td>
			</tr>
			<tr>
				<td colspan="5" class="head"></td>
			</tr>
			<tr>
				<td colspan="5">
					<table>
						<tr>
							<td>Tanggal Transaksi</td>
							<td><?php echo date("d M Y h:i:s",strtotime($header->sales_date)); ?></td>
						</tr>
						<tr>
							<td>Jenis Pembayaran</td>
							<td><?php echo strtoupper(str_replace("_", " ", $header->sales_type)); ?></td>
						</tr>
						<tr>
							<td>No Nota</td>
							<td><?php echo sprintf("%06s", $header->sales_id); ?></td>
						</tr>
						<?php if( $header->sales_type == 'cash' ):?>
				
						<?php elseif( $header->sales_type == 'kredit' ):?>
			                
						<?php elseif( $header->sales_type == 'transfer' ):?>
			                
							<tr>
								<td>Atas Nama</td>
								<td><?php echo ucfirst($header->sales_nama); ?></td>
							</tr>
							<tr>
								<td>Nama Bank</td>
								<td><?php echo $header->sales_nama_bank?></td>
							</tr>
							<tr>
								<td>No. Rek</td>
								<td><?php echo $header->sales_nomor_rekening?></td>
							</tr>
						<?php elseif( $header->sales_type == 'kartu_kredit' ):?>
			                
							<tr>
								<td>Atas Nama</td>
								<td><?php echo ucfirst($header->sales_nama); ?></td>
							</tr>
							<tr>
								<td>Nama Bank</td>
								<td><?php echo $header->sales_nama_bank?></td>
							</tr>
							<tr>
								<td>No. Rek</td>
								<td><?php echo $header->sales_nomor_kartu?></td>
							</tr>
						<?php endif; ?>

					</table>
				</td>
			</tr>
			<!--<tr>
				<td colspan="3"><?php echo $header->sales_date?></td>
				<td colspan="2" align="right"><?php echo $header->first_name?></td>
			</tr>-->
			
			
            <tr>
                <td class="head" align="center"></td>
                <td class="head" align="center"></td>
                <td class="head" align="center"></td>
                <td class="head" align="center"></td>
                <td class="head" align="center"></td>
            </tr>
			<tr>
				<td class="head" align="center">ITEM</td>
				<td class="head" align="center">HARGA</td>
				<td class="head" align="center">QTY</td>
				<td class="head" align="center">DISC</td>
				<td class="head" align="center">SUBTOTAL</td>
			</tr>
			<?php foreach($data as $dt){?>
				<tr>
					<td align="center"><?php echo $dt->item_name?></td>
					<td align="right"><?php echo number_format($dt->sales_detail_price, 0, ',', '.');?></td>
					<td align="right"><?php echo $dt->sales_detail_qty?></td>
					<td align="right"><?php echo number_format($dt->sales_detail_disc, 0, ',', '.')?></td>
					<td align="right"><?php echo number_format($dt->sales_detail_total, 0, ',', '.')?></td>
				</tr>
			<?php }?>
				<tr>
					<td class="head" align="center"></td>
					<td class="head" align="center"></td>
					<td class="head" align="center"></td>
					<td class="head" align="center"></td>
					<td class="head" align="center"></td>
				</tr>
			<?php if( $header->sales_discount > 0 ):?>
				<tr>
					<td colspan="2"></td>
					<td align="left">DISKON</td>
					<td align="right" colspan="2"><?php echo number_format($header->sales_discount, 0, ',', '.')?></td>
				</tr>
			<?php endif;?>
			<?php if( $header->sales_fee > 0 ):?>
				<tr>
					<td colspan="2"></td>
					<td align="left">BIAYA TAMBAHAN</td>
					<td align="right" colspan="2"><?php echo number_format($header->sales_fee, 0, ',', '.')?></td>
				</tr>
			<?php endif;?>
				<tr>
					<td colspan="2"></td>
					<td align="left">GRAND TOTAL</td>
					<td align="right" colspan="2"><?php echo number_format($header->sales_total, 0, ',', '.')?></td>
				</tr>

			<?php if( $header->sales_type == 'cash' ):?>
				<tr>
					<td colspan="2"></td>
					<td align="left">BAYAR</td>
					<td align="right" colspan="2"><?php echo number_format($header->sales_pay, 0, ',', '.')?></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td align="left">KEMBALI</td>
					<td align="right" colspan="2"><?php echo number_format($header->sales_cashback, 0, ',', '.')?></td>
				</tr>
			<?php elseif( $header->sales_type == 'kredit' ):?>
				<tr>
					<td colspan="2"></td>
					<td align="left">UANG MUKA</td>
					<td align="right" colspan="2"><?php echo number_format($header->sales_dp, 0, ',', '.')?></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td align="left">KURANG BAYAR</td>
					<td align="right" colspan="2"><?php echo number_format($header->sales_total - $header->sales_dp, 0, ',', '.')?></td>
				</tr>
			<?php endif; ?>

			<tr>
				<td colspan="5" align="center" class="head"></td>
			</tr>
			<tr>
				<td colspan="5" align="center">
					Terima Kasih Atas Kunjungan Anda<br>
					Kami Tunggu Kedatangan Anda Kembali
				</td>
			</tr>
		</table>
	</body>
</html>