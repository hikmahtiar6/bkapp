<table cellpadding="0" cellspacing="0" width="100%" border="1">
	<thead style="background:#3366FF;">
		<tr><th align="center" colspan="2">Data Sumur Resapan Tahun <?php echo $thn ?></th></tr>
	</thead>
	<tbody>
		<tr>
			<td valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" border="1">
				<tr style="background:#85ADFF;" align="center">
					<th rowspan="2">No</th>
					<th rowspan="2">Komponen</th>
					<th rowspan="2">Nama Lokasi</th>
					<th rowspan="2">Tahun</th>
					<th colspan="2">Lokasi</th>
					<th rowspan="2">Alamat</th>
				</tr>
				<tr style="background:#85ADFF">
					<th>Kelurahan</th><th>Kecamatan</th>
				</tr>
				<?php
				if($listdata->num_rows()>0) {
					$no = 1;
					foreach ($listdata->result() as $hu1) {
					?>
					<tr style="background:#E0EBFF">
					<td><?php echo $no ?></td>
					<td><?php echo $hu1->komponen ?></td>
					<td><?php echo $hu1->nama_lokasi ?></td>
					<td><?php echo $hu1->thn ?></td>
					<td><?php echo kelurahan($hu1->kelurahan_id) ?></td><td><?php echo kecamatan($hu1->kelurahan_id) ?></td>
					<td><?php echo $hu1->alamat ?></td>
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
</table>

<style type="text/css">
	td,th {
		padding:5px;
	}
	th {
		text-align: center;
	}
</style>