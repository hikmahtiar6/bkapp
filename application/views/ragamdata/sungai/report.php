<div class="pull-right" style="padding:5px;"><a href="<?php echo site_url('ragam_data/export_sungai?thn='.$thn.'&lks='.$lks) ?>" class="btn btn-xs btn-success btn-flat">EXPORT</a></div>
<table cellpadding="0" cellspacing="0" width="100%" border="1">
	<thead style="background:#3366FF;">
		<tr><th align="center" colspan="2">Pengujian Sungai Tahun <?php echo $thn ?> Lokasi <?php echo nama_lokasi('lokasiuji_sungai',$lks,'nama_lokasi') ?></th></tr>
		<tr><th>Periode I (Musim Kemarau)</th><th>Periode II (Musim Penghujan)</th></tr>
	</thead>
	<tbody>
		<tr>
			<td valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" border="1">
				<tr style="background:#85ADFF">
					<th>Parameter</th><th>Baku Mutu</th><th>Nilai</th><th>Keterangan</th>
				</tr>
				<?php
				if($hasiluji_per1->num_rows()>0) {
					foreach ($hasiluji_per1->result() as $hu1) {
					?>
					<tr style="background:#E0EBFF">
					<td><?php echo $hu1->parameter ?></td><td><?php echo $hu1->baku_mutu ?></td>
					<td><?php echo $hu1->tandabaca.''.$hu1->hasil_uji ?></td><td><?php echo $hu1->ket_akhir ?></td>
					</tr>
					<?php
					}
				} else {
					echo "<tr><td colspan='4'>Data belum ada, silahkan kembali lagi nanti.</td></tr>";
				}
				?>
				<tr>
					<th align="right" colspan="4">Jumlah Parameter yang diuji : <?php echo $hasiluji_per1->num_rows() ?></th>
				</tr>
			</table>
			</td>
			<td valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" border="1">
				<tr style="background:#85ADFF">
					<th>Parameter</th><th>Baku Mutu</th><th>Nilai</th><th>Keterangan</th>
				</tr>
				<?php
				if($hasiluji_per2->num_rows()>0) {
					foreach ($hasiluji_per2->result() as $hu2) {
					?>
					<tr style="background:#E0EBFF">
					<td><?php echo $hu2->parameter ?></td><td><?php echo $hu2->baku_mutu ?></td>
					<td><?php echo $hu2->tandabaca.''.$hu2->hasil_uji ?></td><td><?php echo $hu2->ket_akhir ?></td>
					</tr>
					<?php
					}
				} else {
					echo "<tr><td colspan='4'>Data belum ada, silahkan kembali lagi nanti.</td></tr>";
				}
				?>
				<tr>
					<th align="right" colspan="4">Jumlah Parameter yang diuji : <?php echo $hasiluji_per2->num_rows() ?></th>
				</tr>
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