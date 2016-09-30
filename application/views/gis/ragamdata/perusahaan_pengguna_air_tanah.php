<h3>Data Perusahaan Pengguna Air Tanah</h3>
<div class="wrap">
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr class="odd">
			<td>Nama Kepemilikan</td>
			<td>:</td>
			<td><?php echo $dt['nama_kepemilikan'];?></td>
		</tr>
		<tr class="add">
			<td>Tahun Pengawasan</td>
			<td>:</td>
			<td><?php echo date("Y", strtotime($dt['tahun_pengawasan']));?></td>
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
		<tr class="odd">
			<td valign="top">Alamat</td>
			<td valign="top">:</td>
			<td><?php echo $dt['alamat'];?></td>
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