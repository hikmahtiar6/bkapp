	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5">
						<div style="background:#fff; padding:3%;box-radius:50px;">
							<div class="clearfix" align="justify">
							  <ul class="nav nav-tabs">
							    <li class="active"><a data-toggle="tab" href="#home">Prosedur Perizinan</a></li>
							    <li><a data-toggle="tab" href="#menu1">Identitas Kuasa Pengurusan Izin</a></li>
							    <li><a data-toggle="tab" href="#menu2">Pengurusan Izin</a></li>
							 
							  </ul>

							  <div class="tab-content">
							    <div id="home" class="tab-pane fade in active">
							      <h3>Prosedur Perizinan</h3>
							    	<!-- TAB PROSEDUR PERIZINAN -->
							    		<table class="table table-bordered">
							    			<tr>
							    				<td align="center" colspan="2"><label>Langkah - Langkah</label></td>
							    				<td align="center" colspan="2"><label>Persyaratan Yang Diperlukan</label></td>
							    			</tr>
							    			<tr>
							    				<td>1</td>
							    				<td>Pemohon mengisi data perusahaan</td>

							    				<td>1</td>
							    				<td>Izin Lokasi / Izin Prinsip / HO / IPR</td>
							    			</tr>
							    			<tr>
							    				<td>2</td>
							    				<td>Pemohon mengirim dokumen persyaratan dalam format PDF</td>

							    				<td>2</td>
							    				<td>SIUP / TDP</td>
							    			</tr>
							    			<tr>
							    				<td>3</td>
							    				<td>Pemohon menunggu hingga admin memberi intruksi</td>

							    				<td>3</td>
							    				<td>Surat Permohonan Pembuatan Izin</td>
							    			</tr>
							    			<tr>
							    				<td>4</td>
							    				<td>Jika ada kesalahan file, pemohon mengirim ulang fle yang salah</td>

							    				<td>4</td>
							    				<td>Surat Pernyataan Sanggup Mengelola Lingkungan</td>
							    			</tr>
							    			<tr>
							    				<td>5</td>
							    				<td>Jika sudah benar, pemohon dapat mencetak surat izin yang sudah terbit</td>

							    				<td></td>
							    				<td></td>
							    			</tr>
							    			<tr>
							    				<td>6</td>
							    				<td>Pemohon mendatangi kantor BPLH untuk penandatanganan surat izin</td>

							    				<td></td>
							    				<td></td>
							    			</tr>
							    		</table>
							    	<!-- END TAB -->
							    </div>

							    <div id="menu1" class="tab-pane fade">
							      <h3>Identitas Kuasa Kepengurusan Izin</h3>
							        <!-- TAB PROFIL PERUSAHAAN -->
										<form method="post" action="<?php// echo site_url('perizinan_lingkungan/simpanProfilPerusahaan')?>">
											<?php 
												$identitas_pengurus_izin = $this->supermodel->queryManual('select * from tb_member WHERE id_member = "'.$this->session->userdata('id_member').'"');
												if($identitas_pengurus_izin->num_rows()>0) {
													foreach ($identitas_pengurus_izin->result() as $r) {
											?>
											<table class="table">
												<tr>
													<td><label>Nama Lengkap</label></td>
													<td>:</td>
													<td><input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="form-control" value="<?php echo $r->nama_lengkap ?>"></td>
												</tr>
													<td><label>Alamat</label></td>
													<td>:</td>
													<td><textarea name="alamat" placeholder="Alamat" class="form-control"><?php echo $r->alamat ?></textarea></td>
												</tr>
												<tr>
													<td><label>NIK</label></td>
													<td>:</td>
													<td><input type="number" name="NIK" placeholder="NIK" class="form-control" value="<?php echo $r->nik ?>"></td>
												</tr>

												<tr>
													<td><label>Image KTP</label></td>
													<td>:</td>
													<td><img src="<?php echo base_url('uploads/perizinan/image_ktp/'.$r->image_ktp) ?>" width="250"><input type="file" name="image_ktp" placeholder="Kapasitas Produksi / Unit" class="form-control" value="<?php echo $r->image_ktp ?>"></td>
												</tr>
												<tr>
													<td><label>Alamat Email</label></td>
													<td>:</td>
													<td><input type="text" name="alamat_email" placeholder="Alamat Email" class="form-control" value="<?php echo $r->alamat_email ?>"></td>
												</tr>
												<tr>
													<td></td>
													<td></td>
													<td><input type="submit" name="simpan" value="Simpan" class="btn btn-success"></td>
												</tr>
											</table>
											<?php }} ?>
										</form>
									<!-- END TAB -->
							    </div>

							    <div id="menu2" class="tab-pane fade">
							      <h3>Pilih Perizinan</h3>
							        <!-- TAB PROFIL PERUSAHAAN -->
										<form method="post" action="<?php// echo site_url('perizinan_lingkungan/simpanProfilPerusahaan')?>">
											<div class="perizinan-box">
												<label>SPPL - Kecamatan</label>
											</div>
											<div class="perizinan-box">
												<label>SPPL - Ho BPPTPM</label>
											</div>
											<div class="perizinan-box">
												<label>SPPL - IPPT</label>
											</div>
											<div class="perizinan-box">
												<label>UKL-UPL</label>
											</div>
											<div class="perizinan-box">
												<label>AMDAL</label>
											</div>
										</form>
									<!-- END TAB -->
							    </div>

							    <div id="menu3" class="tab-pane fade">
							      <h3>Identitas Kuasa Kepengurusan Izin</h3>
							        <!-- TAB PROFIL PERUSAHAAN -->
										<form method="post" action="<?php// echo site_url('perizinan_lingkungan/simpanProfilPerusahaan')?>">
											<table class="table">
												<tr>
													<td><label>Nama Perusahaan</label></td>
													<td>:</td>
													<td><input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" class="form-control"></td>
												</tr>
													<td><label>Alamat Perusahaan</label></td>
													<td>:</td>
													<td><textarea name="alamat_perusahaan" placeholder="Alamat Perusahaan" class="form-control"></textarea></td>
												</tr>
												<tr>
													<td><label>Telp Perusahaan</label></td>
													<td>:</td>
													<td><input type="number" name="no_telp_perusahaan" placeholder="Telp Perusahaan" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Jenis Usaha / Sifat Usaha</label></td>
													<td>:</td>
													<td><input type="text" name="jenis_usaha" placeholder="Jenis Usaha / Sifat Usaha" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Kapasitas Produksi / Unit</label></td>
													<td>:</td>
													<td><input type="number" name="kapasitas_produksi" placeholder="Kapasitas Produksi / Unit" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Luas Lahan / Meter</label></td>
													<td>:</td>
													<td><input type="number" name="luas_lahan" placeholder="Luas Lahan" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Luas Bangunan / Meter</label></td>
													<td>:</td>
													<td><input type="number" name="luas_bangunan" placeholder="Luas Bangunan" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Kondisi Lahan Saat ini</label></td>
													<td>:</td>
													<td><input type="text" name="kondisi_lahan_sekarang" placeholder="Kondisi Lahan Saat ini" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Koordinat</label></td>
													<td>:</td>
													<td><input type="text" name="koordinat" placeholder="koordinat" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Nama Pemilik</label></td>
													<td>:</td>
													<td><input type="text" name="nama_pemilik" placeholder="Nama Pemilik" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Alamat Pemilik</label></td>
													<td>:</td>
													<td><textarea name="alamat_pemilik" placeholder="Alamat Pemilik" class="form-control"></textarea></td>
												</tr>
												<tr>
													<td></td>
													<td></td>
													<td><input type="submit" name="simpanProfilPerusahaan" value="Simpan" class="btn btn-success"></td>
												</tr>
											</table>
										</form>
									<!-- END TAB -->
							    </div>

							    <div id="menu4" class="tab-pane fade">
							      <h3>Identitas Kuasa Kepengurusan Izin</h3>
							        <!-- TAB PROFIL PERUSAHAAN -->
										<form method="post" action="<?php// echo site_url('perizinan_lingkungan/simpanProfilPerusahaan')?>">
											<table class="table">
												<tr>
													<td><label>Nama Perusahaan</label></td>
													<td>:</td>
													<td><input type="text" name="nama_perusahaan" placeholder="Nama Perusahaan" class="form-control"></td>
												</tr>
													<td><label>Alamat Perusahaan</label></td>
													<td>:</td>
													<td><textarea name="alamat_perusahaan" placeholder="Alamat Perusahaan" class="form-control"></textarea></td>
												</tr>
												<tr>
													<td><label>Telp Perusahaan</label></td>
													<td>:</td>
													<td><input type="number" name="no_telp_perusahaan" placeholder="Telp Perusahaan" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Jenis Usaha / Sifat Usaha</label></td>
													<td>:</td>
													<td><input type="text" name="jenis_usaha" placeholder="Jenis Usaha / Sifat Usaha" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Kapasitas Produksi / Unit</label></td>
													<td>:</td>
													<td><input type="number" name="kapasitas_produksi" placeholder="Kapasitas Produksi / Unit" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Luas Lahan / Meter</label></td>
													<td>:</td>
													<td><input type="number" name="luas_lahan" placeholder="Luas Lahan" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Luas Bangunan / Meter</label></td>
													<td>:</td>
													<td><input type="number" name="luas_bangunan" placeholder="Luas Bangunan" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Kondisi Lahan Saat ini</label></td>
													<td>:</td>
													<td><input type="text" name="kondisi_lahan_sekarang" placeholder="Kondisi Lahan Saat ini" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Koordinat</label></td>
													<td>:</td>
													<td><input type="text" name="koordinat" placeholder="koordinat" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Nama Pemilik</label></td>
													<td>:</td>
													<td><input type="text" name="nama_pemilik" placeholder="Nama Pemilik" class="form-control"></td>
												</tr>
												<tr>
													<td><label>Alamat Pemilik</label></td>
													<td>:</td>
													<td><textarea name="alamat_pemilik" placeholder="Alamat Pemilik" class="form-control"></textarea></td>
												</tr>
												<tr>
													<td></td>
													<td></td>
													<td><input type="submit" name="simpanProfilPerusahaan" value="Simpan" class="btn btn-success"></td>
												</tr>
											</table>
										</form>
									<!-- END TAB -->
							    </div>

							   
							  </div>
							</div>
						</div>
					</div>
	<!-- END KONTEN -->
