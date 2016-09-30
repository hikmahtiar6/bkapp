


	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5">
						<div style="background:#fff; padding:3%;box-radius:50px;">
							<div class="clearfix" align="justify">
							<br>
								<form method="POST" action="<?php echo site_url('perizinan_lingkungan/update')?>" enctype="multipart/form-data">

									<div style="text-align:right">
										<a href="<?php echo site_url('dashboard_member/index'); ?>" class="btn btn-danger">Batal</a>
										<input type='submit' class='btn btn-success' name='simpan' value='Simpan' id='simpan'>
									</div>
									<br>
									<input type="hidden" name="jenisizin_id" value="<?php echo $jenisizin_id; ?>">
									<input type="hidden" name="permohonan_id" value="<?php echo $permohonan_id; ?>">
									<input type="hidden" name="tabel" value="<?php echo $tabel; ?>">
									<table class="table">
										<tr>
											<th>Kode Permohonan</th>
											<td>:</td>
											<th><?php echo $permohonan_id ?></th>
										</tr>
										<tr>
											<th>Nama Kegiatan</th>
											<td>:</td>
											<td><input type="text" name="nama_kegiatan" value="<?php echo $nama_kegiatan ?>" class="form-control" required></td>
										</tr>
										<tr>
											<th>Rencana Lokasi</th>
											<td>:</td>
											<td><input type="text" name="rencana_lokasi" value="<?php echo $rencana_lokasi ?>" class="form-control" required></td>
										</tr>
									</table>
								  	<ul class="nav nav-tabs nav-justified">
								    	<li class="active"><a data-toggle="tab" href="#dataPemohon" style="color:black;">Data Pemohon</a></li>
								   	 	<li><a data-toggle="tab" href="#dataPerusahaan" style="color:black;">Data Perusahaan</a></li>
								  	</ul>
									<div class="tab-content">

									  	    <div id="dataPemohon" class="tab-pane fade in active">
											      <h3></h3>
											    	<!-- TAB DATA PEMOHON -->
											    		<table class="table">
											    			<tr>
											    				<td><label>Pilih Data Pemohon / Pemrakarsa</label></td>
											    				<td>:</td>
											    				<td>
											    					<select name="pemohon" class="form-control" id="optionPemohon" ruquired>
											    						<option value=""></option>
														        		<?php 
														        			$id = $this->session->userdata('member_id');
																        	$sql = $this->supermodel->queryManual("SELECT * FROM pemohon WHERE member_id = '".$id."' ORDER BY pemohon_id DESC");
																        	if($sql->num_rows()>0) {
																				foreach ($sql->result() as $r) {
																					$s = "";
																					if($pemohon_id == $r->pemohon_id){
																						$s ="selected";
																					}
																       	?>
																       	<option value="<?php echo $r->pemohon_id ?>" <?php echo $s ?>><?php echo $r->nama; ?></option>
																       	<?php }} ?>
														        	</select>
											    				</td>
											    				<td><a class="btn btn-info" data-toggle="modal" data-target="#modalTambahPemohon"><i class="fa fa-plus"> </i>Tambah Baru</a></td>
											    			</tr>
											    			<tr>
											    				<td colspan="4">
											    					<div id="detailPemohon">
											    					</div>
														    			<!-- <input type="submit" class="btn btn-success" name="simpanPemohon" value="Simpan"> -->
														    	</td>
													    	</tr>
												    	</table>
											    	<!-- END TAB -->
										    </div>

										    <div id="dataPerusahaan" class="tab-pane fade">
											    	<!-- TAB DATA PERUSAHAAN -->
										    		<table class="table">
										    			<tr>
										    				<td><label>Pilih Perusahaan</label></td>
										    				<td>:</td>
										    				<td>
										    					<select name="perusahaan" class="form-control" id="optionPerusahaan" required>
										    						<option value=""></option>
													        		<?php 
													        			$id = $this->session->userdata('member_id');
															        	$sql = $this->supermodel->queryManual("SELECT * FROM perusahaan WHERE member_id = '".$id."' ORDER BY perusahaan_id DESC");
															        	if($sql->num_rows()>0) {
																			foreach ($sql->result() as $r) {
																				$s = "";
																					if($perusahaan_id == $r->perusahaan_id){
																						$s ="selected";
																					}
															       	?>
															       	<option value="<?php echo $r->perusahaan_id ?>" <?php echo $s ?>><?php echo $r->nama; ?></option>
															       	<?php }} ?>
													        	</select>
										    				</td>
										    				<td><a class="btn btn-info" data-toggle="modal" data-target="#modalTambahPerusahaan"><i class="fa fa-plus"> </i>Tambah Baru</a></td>
										    			</tr>
										    			<tr>
										    				<td colspan="4">
										    					<div id="detailPerusahaan">
											    				</div>
													    	</td>
												    	</tr>
											    	</table>
										    	<!-- END TAB -->
										    </div>  
									</div>
								</form>
			
							</div>
						</div>
					</div>
	<!-- END KONTEN -->

	<!-- MODAL TAMBAH PEMOHON-->
	  <div class="modal fade" id="modalTambahPemohon" role="dialog">
	    <div class="modal-dialog">
	    <!-- <form method="POST" action="<?php echo site_url('perizinan_lingkungan/tambahPemohon')?>" enctype="multipart/form-data"> -->
	    	<input type="hidden" name="jenisizin_id" value="<?php echo $jenisizin_id; ?>">
			<input type="hidden" name="permohonan_id" value="<?php echo $permohonan_id; ?>">
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title"><b>Tambah Pemohon</b></h4>
	        </div>
	        <div class="modal-body">
	        	<table class="table">
	        		<tr>
	        			<td><label>Nama Lengkap</label></td>
	        			<td>:</td>
	        			<td><input type="text" class="form-control" name="nama" id="nama" required></td>
	        		</tr>
	        		<tr>
	        			<td><label>Jabatan di perusahaan</label></td>
	        			<td>:</td>
	        			<td><input type="text" class="form-control" name="jabatan" id="jabatan"></td>
	        		</tr>
	        		<tr>
	        			<td><label>Alamat</label></td>
	        			<td>:</td>
	        			<td><textarea class="form-control" name="alamat" id="alamat"></textarea></td>
	        		</tr>
	        		<tr>
	        			<td><label>Kecamatan</label></td>
	        			<td>:</td>
	        			<td>
	        				<select name="kec" id="kec" class="form-control">
	        					<option></option>
			        			<?php 
									$sql = $this->supermodel->queryManual('select * from kecamatan');
									if($sql->num_rows()>0) {
										foreach ($sql->result() as $r) {
								 ?>
								<option value="<?php echo $r->kecamatan_id ?>"><?php echo $r->kecamatan_nama ?></option>
								<?php }} ?>
							</select>
	        			</td>
	        		</tr>
	        		<tr>
	        			<td><label>Kelurahan</label></td>
	        			<td>:</td>
	        			<td>
	        				<select name="kelurahan" id="kel" class="form-control">
	        				</select>
	        			</td>
	        		</tr>
	        		<tr>
	        			<td><label>NIK</label></td>
	        			<td>:</td>
	        			<td><input type="number" class="form-control" name="nik" id="nik" required></td>
	        		</tr>
	        		<tr>
	        			<td><label>No. Telp</label></td>
	        			<td>:</td>
	        			<td><input type="number" class="form-control" name="no_telp" id="no_telp" required></td>
	        		</tr>
	        	</table>
	        </div>
	        <div class="modal-footer">
	          <botton class="btn btn-success" data-dismiss="modal" name="tambahPemohon" id="tambahPemohon">Simpan</botton>
	        </div>
	      </div>
	      <!-- </form>  -->
	    </div>
	  </div>
	<!-- END MODAL -->

	<!-- MODAL TAMBAH PERUSAHAAN-->
	  <div class="modal fade" id="modalTambahPerusahaan" role="dialog">
	    <div class="modal-dialog">
	    <!-- <form method="POST" action="<?php echo site_url('perizinan_lingkungan/tambahPerusahaan')?>" enctype="multipart/form-data"> -->
	    	<input type="hidden" name="jenisizin_id" value="<?php echo $jenisizin_id; ?>">
			<input type="hidden" name="permohonan_id" value="<?php echo $permohonan_id; ?>">
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title"><b>Tambah Perusahaan</b></h4>
	        </div>
	        <div class="modal-body">
	        	<table class="table">
		   			<tr>
		  				<td><label>Nama Perusahaan</label></td>
		 				<td>:</td>
		   				<td><input type="text" name="nama" class="form-control" id="nama2"></td>
		   			</tr>
		 			<tr>
						<td><label>Status Perusahaan</label></td>
						<td>:</td>
						<td>
							<select name="status" class="form-control" id="status">
								<?php 
								$stat = array(	'' => '',
												'Milik Pemerintah' => 'Milik Pemerintah',
												'Milik Yayasan' => 'Milik Yayasan',
												'Milik Perusahaan' => 'Milik Perusahaan',
												'Milik Perorangan' => 'Milik Perorangan');
								foreach ($stat as $r) {
								?>
	        					<option value="<?php echo $r ?>"><?php echo $r ?></option>
	        					<?php } ?>
	        				</select>
						</td>
	    			</tr>
	    			<tr>
						<td><label>Alamat Perusahaan</label></td>
						<td>:</td>
						<td><textarea name="alamat" class="form-control" id="alamat2"></textarea></td>
					</tr>
	    			<tr>
	        			<td><label>Kecamatan</label></td>
	        			<td>:</td>
	        			<td>
	        				<select name="kec" id="kec2" class="form-control">
	        					<option></option>
			        			<?php 
									$sql = $this->supermodel->queryManual('select * from kecamatan');
									if($sql->num_rows()>0) {
										foreach ($sql->result() as $r) {
								 ?>
								<option value="<?php echo $r->kecamatan_id ?>"><?php echo $r->kecamatan_nama ?></option>
								<?php }} ?>
							</select>
	        			</td>
	        		</tr>
	        		<tr>
	        			<td><label>Kelurahan</label></td>
	        			<td>:</td>
	        			<td>
	        				<select name="kelurahan" id="kel2" class="form-control">
	        				</select>
	        			</td>
	        		</tr>
		   			<tr>
	    				<td><label>No. Telp</label></td>
	    				<td>:</td>
	    				<td><input type="number" name="no_telp" class="form-control" id="no_telp2"></td>
	    			</tr>
	    			<tr>
	    				<td><label>Jenis usaha</label></td>
	    				<td>:</td>
	    				<td><input type="text" name="jenis_usaha" class="form-control" id="jenis_usaha"></td>
	    			</tr>
	    			<tr>
		 				<td><label>Kapasitas Produksi / Unit</label></td>
	    				<td>:</td>
	    				<td><input type="text" name="kapasitas_produksi" class="form-control" id="kapasitas_produksi"></td>
	    			</tr>
	    			<tr>
	    				<td><label>Luas Lahan</label></td>
		   				<td>:</td>
		   				<td><input type="number" name="luas_lahan" class="form-control" id="luas_lahan"></td>
	    			</tr>
	    			<tr>
	    				<td><label>Luas Bangunan</label></td>
	    				<td>:</td>
	    				<td><input type="number" name="luas_bangunan" class="form-control" id="luas_bangunan"></td>
	    			</tr>
	    			<tr>
	    				<td><label>Kondisi Lahan Saat Ini</label></td>
	    				<td>:</td>
	    				<td><input type="text" name="kondisi" class="form-control" id="kondisi"></td>
	    			</tr>
	    			<tr>
	    				<td><label>Latitude</label></td>
	    				<td>:</td>
	    				<td><input type="number" name="lat" class="form-control" id="lat"></td>
	    			</tr>
	    			<tr>
	    				<td><label>Longitude</label></td>
	    				<td>:</td>
	    				<td><input type="number" name="lng" class="form-control" id="lng"></td>
	    			</tr>
				</table>
	        </div>
	        <div class="modal-footer">
	          <button type="submit" data-dismiss="modal" class="btn btn-success" name="tambahPerusahaan" id="tambahPerusahaan">Simpan</button>
	        </div>
	      </div>
	      <!-- </form>  -->
	    </div>
	  </div>
	<!-- END MODAL -->

	<script>
		$("#kec").change(function(){
 				var id = $("#kec").val();
 				$("#kel").load("<?php echo site_url('perizinan_lingkungan/kel') ?>/"+id);
 			});

		$("#kec2").change(function(){
 				var id = $("#kec2").val();
 				$("#kel2").load("<?php echo site_url('perizinan_lingkungan/kel') ?>/"+id);
 			});

		$(document).ready(function(){

			$.post("<?php echo site_url('perizinan_lingkungan/detailPemohon') ?>",{pemohon_id:$("#optionPemohon option:selected").val() }, function(detail){
				// alert(#optionPemohon.val);
				console.log("ini pem =>",detail);
				$("#detailPemohon").html(detail);
			});

			$.post("<?php echo site_url('perizinan_lingkungan/detailPerusahaan') ?>",{perusahaan_id:$("#optionPerusahaan option:selected").val() }, function(detail){
				// alert(#optionPerusahaan.val);
				console.log("ini perusa =>",detail);
				$("#detailPerusahaan").html(detail);
			});


			$("#optionPemohon").change(function(){
				$.post("<?php echo site_url('perizinan_lingkungan/detailPemohon') ?>",{pemohon_id:$("#optionPemohon option:selected").val() }, function(detail){
					// alert(#optionPemohon.val);
					console.log("ini pem =>",detail);
					$("#detailPemohon").html(detail);
				});
			});

			$("#optionPerusahaan").change(function(){
				$.post("<?php echo site_url('perizinan_lingkungan/detailPerusahaan') ?>",{perusahaan_id:$("#optionPerusahaan option:selected").val() }, function(detail){
					// alert(#optionPerusahaan.val);
					console.log("ini perusa =>",detail);
					$("#detailPerusahaan").html(detail);
				});
			});

			$("#tambahPemohon").click(function(){
				$.post("<?php echo site_url('perizinan_lingkungan/tambahPemohon') ?>",{
						nik:$("#nik").val(),
						nama:$("#nama").val(),
						jabatan:$("#jabatan").val(),
						alamat:$("#alamat").val(),
						kel:$("#kel option:selected").val(),
						no_telp:$("#no_telp").val()},
						function(){

							$("#optionPemohon").load("<?php echo site_url('perizinan_lingkungan/getPemohon') ?>/");
							$("#detailPemohon").html("");

							$("#nik").val("");
							$("#nama").val("");
							$("#jabatan").val("");
							$("#alamat").val("");
							$("#kec").val("");
							$("#kel").val("");
							$("#no_telp").val("");
						});
			});

			$("#tambahPerusahaan").click(function(){
				$.post("<?php echo site_url('perizinan_lingkungan/tambahPerusahaan') ?>",{
						nama:$("#nama2").val(),
						status:$("#status").val(),
						alamat:$("#alamat2").val(),
						kel2:$("#kel2 option:selected").val(),
						no_telp:$("#no_telp2").val(),
						jenis_usaha:$("#jenis_usaha").val(),
						kapasitas_produksi:$("#kapasitas_produksi").val(),
						luas_lahan:$("#luas_lahan").val(),
						luas_bangunan:$("#luas_bangunan").val(),
						kondisi:$("#kondisi").val(),
						lat:$("#lat").val(),
						lng:$("#lng").val()},
						function(){

							$("#optionPerusahaan").load("<?php echo site_url('perizinan_lingkungan/getPerusahaan') ?>/");
							$("#detailPerusahaan").html("");

							$("#nama2").val("");
							$("#status").val("");
							$("#alamat2").val("");
							$("#kel2").val("");
							$("#kec2").val("");
							$("#no_telp2").val("");
							$("#jenis_usaha").val("");
							$("#kapasitas_produksi").val("");
							$("#luas_lahan").val("");
							$("#luas_bangunan").val("");
							$("#kondisi").val("");
							$("#lat").val("");
							$("#lng").val("");

						});
			});

		});


	</script>

