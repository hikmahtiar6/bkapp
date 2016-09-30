<div class="row">
	<div class="col-md-8 col-sm-8">
	<?php
	if($this->session->flashdata('info')) {
		echo "<div class='alert alert-info'>".$this->session->flashdata('info')."</div>";
	}
	?>
	<form method="post" action="<?php echo site_url('sppl/index') ?>">
		<h2>Perizinan SPPL</h2>
		<p>Isi form berikut dengan lengkap untuk mengajukan perijinan SURAT PERNYATAAN KESANGGUPAN PENGELOLAAN DAN PEMANTAUAN LINGKUNGAN HIDUP (SPPL)</p>
		<div class="padding-20" style="background:#f4f4f4">
		<h4>Form Biodata</h4>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
					<label>Nama*</label>
					<input type="text" class="form-control" name="nama">
					</div>
					<div class="form-group">
					<label>Email*</label>
					<input type="text" class="form-control" name="email">
					</div>
					<div class="form-group">
					<label>Alamat*</label>
					<input type="text" class="form-control" name="alamat">
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
					<label>Jabatan</label>
					<input type="text" class="form-control" name="jabatan">
					</div>
					<div class="form-group">
					<label>No Telp</label>
					<input type="text" class="form-control" name="no_telp">
					</div>
				</div>
			</div>
		</div>
		<div class="padding-20 margin-y-10" style="background:#f4f4f4;">
			<h4>Form Pelengkap</h4>
			<div class="form-group">
				<label>Nama Perusahaan / Usaha</label>
				<input type="text" class="form-control" name="nama_perusahaan">
			</div>
			<div class="form-group">
				<label>Alamat Perusahaan / Usaha</label>
				<input type="text" class="form-control" name="alamat_perusahaan">
			</div>
			<div class="form-group">
				<label>Telp Perusahaan</label>
				<input type="text" class="form-control" name="telp_perusahaan">
			</div>
			<div class="form-group">
				<label>Jenis Usaha / Sifat Usaha</label>
				<input type="text" class="form-control" name="jenis_usaha">
			</div>
			<div class="form-group">
				<label>Kapasitas Produksi / Unit</label>
				<input type="text" class="form-control" name="kapasitas">
			</div>
			<div class="form-group">
				<label>Luas Lahan + Luas Bangunan</label>
				<input type="text" class="form-control" name="luas">
			</div>
			<div class="form-group">
				<label>Kondisi Lahan Saat Ini</label>
				<input type="text" class="form-control" name="kondisi">
			</div>
			<div class="form-group">
				<label><input type="checkbox" value="1" name="syarat"> Pada prinsipnya bersedia untuk dengan sungguh-sungguh untuk melaksanakan seluruh pengelolaan dan
				pemanfaatan	dampak lingkungan dari kegiatan tersebut, dan bersedia untuk diawasi oleh instansi yang berwenang.</label>
			</div>
		</div>
		<button class="btn btn-flat btn-lg btn-primary" type="submit">Kirim Permohonan</button>
	</form>
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
		<div class="callout callout-info">
			<h4>Catatan*</h4>
			<p>Data yang diinputkan adalah data yang benar.</p>
		</div>
	</div>
</div>