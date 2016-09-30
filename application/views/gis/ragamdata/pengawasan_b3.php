<h3>Data Pengawasan Limbah B3</h3>
<div class="wrap">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr class="add">
			<td>Jenis Kegiatan</td>
			<td>:</td>
			<td><?php echo $dt['jenis_kegiatan'];?></td>
		</tr>
		<tr class="odd">
			<td>Nama Kegiatan</td>
			<td>:</td>
			<td><?php echo $dt['nama_kegiatan'];?></td>
		</tr>
		<tr class="add">
			<td>Pimpinan</td>
			<td>:</td>
			<td><?php echo $dt['pimpinan'];?></td>
		</tr>
		<tr class="odd">
			<td>No Izin</td>
			<td>:</td>
			<td><?php echo $dt['no_izin'];?></td>
		</tr>
		<tr class="add">
			<td>Tanggal Terbit Izin</td>
			<td>:</td>
			<td><?php echo $dt['tgl_terbitizin'];?></td>
		</tr>
		<tr class="odd">
			<td>No Izin</td>
			<td>:</td>
			<td><?php echo $dt['masa_berlaku'];?></td>
		</tr>
		<tr class="add">
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $dt['alamat'];?></td>
		</tr>
		<tr class="odd">
			<td>Kelurahan</td>
			<td>:</td>
			<td><?php echo kelurahan($dt['kelurahan_id']);?></td>
		</tr>
		<tr class="add">
			<td>Kecamatan</td>
			<td>:</td>
			<td><?php echo kecamatan($dt['kelurahan_id']);?></td>
		</tr>
	</table>
</div>
<style type="text/css">
	.wrap {
		background: #FFFFFF;
	}
	.wrap:after {
		clear: both;
		content: '';
	}
	.image {
		float: left;
		margin-right: 10px;
	}
	.table {
		float: left;
	}
	td {
		padding: 5px;
		font-family: arial;
		font-size: 12px;
	}
	tr.odd {
		background: #F2E9E1;
	}
	h3{
		padding: 10px 5px;
		margin: 0;
		background: #CBE86B;
		color: #1C140D;
		font-family: arial;
	}
</style>