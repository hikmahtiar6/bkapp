<div class="row">
	<div class="col-md-8 col-sm-8">
		<h2>Perizinan SPPL</h2>
		<p>Permohonan anda saat ini sudah diterima. dengan data sebagai berikut :</p>
		<table class="table table-bordered">
			<tr>
				<td valign="top">Pendaftaran ID</td>
				<td valign="top">:</td>
				<td><?php echo $row['id_pendaftaran'] ?></td>
			</tr>
			<tr>
				<td valign="top">Status Permohonan</td>
				<td valign="top">:</td>
				<td><?php echo $status[$row['status']] ?></td>
			</tr>
			<tr>
				<td valign="top" colspan="3" style="background:#ccc">Biodata</td>
			</tr>
			<tr>
				<td valign="top">Nama</td>
				<td valign="top">:</td>
				<td><?php echo $row['nama'] ?></td>
			</tr>
			<tr>
				<td valign="top">Email</td>
				<td valign="top">:</td>
				<td><?php echo $row['email'] ?></td>
			</tr>
			<tr>
				<td valign="top">Alamat</td>
				<td valign="top">:</td>
				<td><?php echo $row['alamat'] ?></td>
			</tr>
			<tr>
				<td valign="top">Jabatan</td>
				<td valign="top">:</td>
				<td><?php echo $row['jabatan'] ?></td>
			</tr>
			<tr>
				<td valign="top">No Telepon</td>
				<td valign="top">:</td>
				<td><?php echo $row['no_telp'] ?></td>
			</tr>
			<tr>
				<td valign="top" colspan="3"  style="background:#ccc">Permohonan</td>
			</tr>
			<tr>
				<td valign="top">Nama Perusahaan / Usaha</td>
				<td valign="top">:</td>
				<td><?php echo $row['nama_perusahaan'] ?></td>
			</tr>
			<tr>
				<td valign="top">Alamat Perusahaan / Usaha</td>
				<td valign="top">:</td>
				<td><?php echo $row['alamat_perusahaan'] ?></td>
			</tr>
			<tr>
				<td valign="top">Telepon</td>
				<td valign="top">:</td>
				<td><?php echo $row['no_telp_perusahaan'] ?></td>
			</tr>
			<tr>
				<td valign="top">Jenis Usaha / Sifat Usaha</td>
				<td valign="top">:</td>
				<td><?php echo $row['jenis_sifat'] ?></td>
			</tr>
			<tr>
				<td valign="top">Kapasitas Produksi / Unit</td>
				<td valign="top">:</td>
				<td><?php echo $row['kapasitas_produksi'] ?></td>
			</tr>
			<tr>
				<td valign="top">Luas Lahan + Luas Bangunan</td>
				<td valign="top">:</td>
				<td><?php echo $row['luas_lahan'] ?></td>
			</tr>
			<tr>
				<td valign="top">Kondisi Lahan</td>
				<td valign="top">:</td>
				<td><?php echo $row['kondisi_lahan'] ?></td>
			</tr>
		</table>
		<blockquote>Untuk tindak lanjut, silahkan kunjungi Badan Pengelolaan Lingkungan Hidup Kota Bogor dengan membawa berkas berkas yang ditentukan sebagai syaratnya bila status permohoan anda sudah dikonfirmasi oleh pihak kami.</blockquote>
	</div>
	<div class="col-md-4 col-sm-4">
		<div class="bg-orange padding-10">
			<h4>cek status izin anda</h4>
			<form method="post" action="<?php echo site_url('sppl/cari') ?>">
			<div class="input-group input-group-lg margin-y-10">
				<input type="text" name="pendaftaranID" class="form-control" placeholder="ID Pendaftaran..">
				<div class="input-group-btn">
				<button class="btn btn-flat btn-primary input-lg"  style="border-radius:0px;" type="submit"><i class="fa fa-search"></i></button>
				</div>
			</div>
			</form>
			<p>cek status izin anda bila sudah mengirim permohonan izin lewat online dengan cara memasukan ID PENDAFTARAN</p>
		</div>
		<br/>
	</div>
</div>