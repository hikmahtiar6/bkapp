<table cellpadding="0" cellspacing="0" width="100%" border="1">
	<thead style="background:#3366FF;">
		<tr>
			<th align="center" colspan="2">Data SPPL tahun <?php echo $thn ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" border="1">
				<tr style="background:#85ADFF">
					<th rowspan="2">No</th>
					<th rowspan="2">Tanggal SPPL</th>
					<th rowspan="2">Nomor SPPL</th>
					<th rowspan="2">Tahun</th>
					<th colspan="2">Lokasi</th>
					<th rowspan="2">Nama Pemilik</th>
				</tr>
				<tr style="background:#85ADFF">
					<th>Kelurahan</th>
					<th>Kecamatan</th>
				</tr>
				<?php
				if($listdata->num_rows()>0) {
					$no = 1;
					foreach ($listdata->result() as $hu1) {
					?>
					<tr style="background:#E0EBFF">
					<td><?php echo $no ?></td>
					<td><?php echo $hu1->tgl_sppl ?></td>
					<td><?php echo $hu1->nomor_sppl ?></td>
					<td><?php echo $hu1->thn ?></td>
					<td><?php echo kelurahan($hu1->kelurahan_id) ?></td>
					<td><?php echo kecamatan($hu1->kelurahan_id) ?></td>
					<td><?php echo $hu1->nama_pemilik ?></td>
					</tr>
					<?php
					$no++;
					}
				} else {
					echo "<tr><td colspan='4'>Data belum ada, silahkan kembali lagi nanti.</td></tr>";
				}
				?>
			</table>
			</td>
		</tr>	
	</tbody>
	<thead style="background:#CCC;">
		<tr>
			<th align="right" colspan="2">Total Data:<?php echo $listdata->num_rows()?></th>
		</tr>
	</thead>
</table>

<style type="text/css">
	td,th {
		padding:5px;
	}
</style>