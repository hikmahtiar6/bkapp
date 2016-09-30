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
					<th rowspan="2">Tahun</th>
					<th rowspan="2">Jenis Kegiatan/Usaha</th>
					<th rowspan="2">Alamat</th>
					<th colspan="2">Rekomendasi</th>
				</tr>
				<tr style="background:#85ADFF">
					<th>KA-ANDAL</th>
					<th>AMDAL</th>
				</tr>
				<?php
				if($listdata->num_rows()>0) {
					$no = 1;
					foreach ($listdata->result() as $hu1) {
					?>
					<tr style="background:#E0EBFF">
					<td><?php echo $no ?></td>
					<td><?php echo $hu1->thn ?></td>
					<td><?php echo $hu1->jenis_kegiatanusaha ?></td>
					<td><?php echo $hu1->alamat ?></td>	
					<td><?php echo $hu1->rekom_kaamdal ?></td>
					<td><?php echo $hu1->rekom_amdal?></td>
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