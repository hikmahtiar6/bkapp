<table cellpadding="0" cellspacing="0" width="100%" border="1">
	<thead style="background:#3366FF;">
		<tr>
			<th align="center" colspan="2">Data UKL-UPL <?php echo $thn ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td valign="top">
			<table cellpadding="0" cellspacing="0" width="100%" border="1">
				<tr style="background:#85ADFF">
					<th >No</th>
					<th >Tanggal Surat</th>
					<th >Nomor Surat</th>
					<th >Jenis Kegiatan/Usaha</th>
					<th >Alamat Usaha</th>
					<th >Nama Pemilik</th>
					<th >Alamat Pemilik</th>
				</tr>
				<?php
				if($listdata->num_rows()>0) {
					$no = 1;
					foreach ($listdata->result() as $hu1) {
					?>
					<tr style="background:#E0EBFF">
					<td><?php echo $no ?></td>
					<td><?php echo $hu1->tgl_surat ?></td>
					<td><?php echo $hu1->nomor_surat ?></td>
					<td><?php echo $hu1->jenis_kegiatanusaha ?></td>
					<td><?php echo $hu1->alamat_usaha ?></td>
					<td><?php echo $hu1->nama_pemilik ?></td>
					<td><?php echo $hu1->alamat_pemilik ?></td>
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