<h3>Detail</h3>
<div class="wrap">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr class="add">
			<td>Lokasi Pengujian</td>
			<td>:</td>
			<td><?php echo $dt['nama_lokasi'];?></td>
		</tr>
		<tr class="odd">
			<td>Alamat Lokasi</td>
			<td>:</td>
			<td><?php echo $dt['alamat'];?></td>
		</tr>
		<tr class="add">
			<td>Kecamatan</td>
			<td>:</td>
			<td><?php echo kecamatan($dt['kelurahan_id']);?></td>
		</tr>
		<tr class="odd">
			<td>Kelurahan</td>
			<td>:</td>
			<td><?php echo kelurahan($dt['kelurahan_id']);?></td>
		</tr>
		<tr class="add">
			<td>Latitude</td>
			<td>:</td>
			<td><?php echo $dt['lat'];?></td>
		</tr>
		<tr class="odd">
			<td>Longtitude</td>
			<td>:</td>
			<td><?php echo $dt['lng'];?></td>
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