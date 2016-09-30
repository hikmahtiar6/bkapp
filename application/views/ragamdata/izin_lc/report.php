<div class="pull-right" style="padding:5px;">
	<!-- <a href="<?php echo site_url('ragam_data/export_pengawasan_b3?jenis='.$jenis) ?>" 
	class="btn btn-xs btn-success btn-flat">EXPORT</a> -->
</div>
<table cellpadding="0" cellspacing="0" width="100%" border="1">
	<thead style="background:#3366FF;">
		<tr><th align="center" colspan="2">Filter berdasarkan jenis kegiatan : <?php echo $jenis ?></th></tr>
		
	</thead>
	<tbody>
		<tr>
			<td valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" border="1">
				<tr style="background:#85ADFF">
					<th>JENIS KEGIATAN</th><th>NAMA KEGIATAN</th><th>PIMPINAN</th><th>KONTAK PERSON</th>
					<th>NO IZIN</th><th>STATUS</th><th>MASA BERLAKU</th><th>ALAMAT</th>
				</tr>
				<?php
				if($hasiluji_per1->num_rows()>0) {
					foreach ($hasiluji_per1->result() as $hu1) {
					?>
					<tr style="background:#E0EBFF">
					<td><?php echo $hu1->jenis_kegiatan ?></td><td><?php echo $hu1->nama_kegiatan ?></td>
					<td><?php echo $hu1->pimpinan ?></td><td><?php echo $hu1->kontak ?></td>
					<td><?php echo $hu1->no_izin ?></td><td><?php echo $hu1->status ?></td>
					<td><?php echo $hu1->masa_berlaku ?></td><td><?php echo $hu1->alamat ?></td>
					</tr>
					<?php
					}
				} else {
					echo "<tr><td colspan='8'>Data belum ada, silahkan kembali lagi nanti.</td></tr>";
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
</style>