<table cellpadding="0" cellspacing="0" width="100%" border="1">
	<thead style="background:#3366FF;">
		<tr><th align="center" colspan="2">Data Perusahaan Pengguna Air Tanah Tahun <?php echo $thn ?></th></tr>
	</thead>
	<tbody>
		<tr>
			<td valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" border="1">
				<tr style="background:#85ADFF; text-align:center">
					<th rowspan="2">No</th><th rowspan="2">Nama Kepemilikan</th>
					<th rowspan="2">Tahun</th><th rowspan="2">Debit Air</th>
					<th rowspan="2">No Izin</th>
					<th colspan="2">Lokasi</th><th colspan="2">Titik Kordinat</th>
				</tr>
				<tr style="background:#85ADFF">
					<th>Kelurahan</th><th>Kecamatan</th>
					<th>Lat</th><th>Lng</th>
				</tr>
				<?php
				if($listdata->num_rows()>0) {
					$no = 1;
					foreach ($listdata->result() as $hu1) {
					?>
					<tr style="background:#E0EBFF">
					<td><?php echo $no ?></td>
					<td><?php echo $hu1->nama_kepemilikan ?></td>
					<td><?php echo $hu1->thn ?></td>
					<td><?php echo $hu1->debit_air ?></td>
					<td><?php echo $hu1->no_izin ?></td>
					<td><?php echo kelurahan($hu1->kelurahan_id) ?></td><td><?php echo kecamatan($hu1->kelurahan_id) ?></td>
					<td><?php echo $hu1->lat ?></td><td><?php echo $hu1->lng ?></td>
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
			<th align="right" colspan="2">Total Data:<?php echo $listdata->num_rows() ?></th>
		</tr>
	</thead>
</table>

<style type="text/css">
	td,th {
		padding:5px;
	}
	th {
		text-align: center;
	}
</style>