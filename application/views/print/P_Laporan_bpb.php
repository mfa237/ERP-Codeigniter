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

	<h3 align="center">LAPORAN BPB</h3>

	<table border="0" width="50%" align="center">

  		<tr>

  			<td align="right">Tanggal</td>

			<td>:</td>

			<td><?= $from_tanggal ?> - <?= $to_tanggal ?></td>

  		</tr>

	</table>

	<br>

	<table border="1" width="100%" rules="all" cellpadding="5">

		<thead>
			<tr>
				<td align="center">No</td>
				<td align="center">Tanggal</td>
				<td align="center">No PO</td>
				<td align="center">No BPB</td>
				<td align="center">Nama Barang</td>
				<td align="center">Qty PO</td>
				<td align="center">Qty BPB</td>
				<td align="center">Qty Kurang</td>
			</tr>
		</thead>

		<?php
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
			// die;
			$no = 1;

			$total = 0;

			foreach ($data as $key => $value) {

				echo '<tr align="left">';

	        	if (strip_tags($value[1]) == "subtotal") {
	        		echo '<td align="center"></td>';
	        		echo '<td align="center" colspan="4">'.$value['1'].'</td>';
	        		echo '<td align="center"><b>'.$value['5'].'</b></td>';

	        		echo '<td align="center"><b>'.$value['6'].'</b></td>';

	        		echo '<td align="center"><b>'.$value['7'].'</b></td>';
	        	}
	        	else{
	        		echo '<td align="center">'.$no.'</td>';
	        		echo '<td align="center">'.$value['1'].'</td>';
	        		echo '<td align="center">'.$value['2'].'</td>';	

	        		echo '<td align="center">'.$value['3'].'</td>';

	        		echo '<td align="center">'.$value['4'].'</td>';

	        		echo '<td align="center">'.$value['5'].'</td>';

	        		echo '<td align="center">'.$value['6'].'</td>';

	        		echo '<td align="center">'.$value['7'].'</td>';
	        	$no++;
	        	}

	        	echo '</tr>';


			}

		?>

		<!-- <tr>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

			<td>&nbsp;</td>

		</tr> -->

<!-- 		<tr>

			<td colspan="6" align="center">Total</td>

			<td align="center"><?= $total ?></td>

			<td colspan="2"></td>

		</tr>
 -->
	</table>

	<br>

	<table border="1" width="40%" rules="all" align="left">

  		<tr>

			<td align="center" width="20%">Disetujui</td>

			<td align="center" width="20%">Dibuat</td>

  		</tr>

		<tr>

			<td height="8%"></td>

			<td></td>

  		</tr>

		<tr>

			<td align="center">Mgr Operasional</td>

			<td align="center">Gudang Bahan</td>

  		</tr>

	</table>

 </body>

</html>