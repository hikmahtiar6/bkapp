	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5" style="">
						<div style="background:#fff; padding:3%;box-radius:50px; ">
							<form method="POST" action="<?php echo site_url('perusahaan/update')?>" enctype="multipart/form-data"> 
							      <h4>Edit Data Perusahaan</h4><br>
							    	<!-- Form Pemohon -->
							    	<input type="hidden" name="perusahaan_id" value="<?php echo $perusahaan_id; ?>">
							    		<table class="table">
								    		<tr>
								    			<th>Nama Perusahaan</th>
								    			<td>:</td>
								    			<td><input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>"></td>
								    		</tr>
								    		<tr>
												<td><label>Status Perusahaan</label></td>
												<td>:</td>
												<td>
													<select name="status" class="form-control">
														<?php 
														$stat = array(	'' => '',
																		'Milik Pemerintah' => 'Milik Pemerintah',
																		'Milik Yayasan' => 'Milik Yayasan',
																		'Milik Perusahaan' => 'Milik Perusahaan',
																		'Milik Perorangan' => 'Milik Perorangan');
														foreach ($stat as $r) {
															$s="";
															if ($status == $r) {
																$s="selected";
															}
														?>
							        					<option value="<?php echo $r ?>"<?php echo $s ?>><?php echo $r ?></option>
							        					<?php } ?>
							        				</select>
												</td>
							    			</tr>
								    		<tr>
								    			<th>Alamat</th>
								    			<td>:</td>
								    			<td><textarea name="alamat" class="form-control"><?php echo $alamat; ?></textarea></td>
								    		</tr>
								    		<tr>
							        			<td><label>Kecamatan</label></td>
							        			<td>:</td>
							        			<td>
							        				<select name="kecamatan" id="kec" class="form-control">
							        					<option></option>
									        			<?php 
															$sql = $this->supermodel->queryManual('select * from kecamatan');
															if($sql->num_rows()>0) {
																foreach ($sql->result() as $r) {
																	$s="";
																	if ($kec==$r->kecamatan_id) {
																		$s="selected";
																	}
														 ?>
														<option value="<?php echo $r->kecamatan_id ?>" <?php echo $s ?>><?php echo $r->kecamatan_nama ?></option>
														<?php }} ?>
													</select>
							        			</td>
							        		</tr>
							        		<tr>
							        			<td><label>Kelurahan</label></td>
							        			<td>:</td>
							        			<td>
							        				<select name="kelurahan" id="kel" class="form-control">
							        					<option></option>
							        					<?php 
															$sql = $this->supermodel->queryManual('select * from kelurahan');
															if($sql->num_rows()>0) {
																foreach ($sql->result() as $r) {
																	$s="";
																	if ($kel == $r->kelurahan_id) {
																		$s="selected";
																	}
														 ?>
														<option value="<?php echo $r->kelurahan_id ?>" <?php echo $s ?>><?php echo $r->kelurahan_nama ?></option>
														<?php }} ?>
							        				</select>
							        			</td>
							        		</tr>
								    		<tr>
								    			<th>No. Telp</th>
								    			<td>:</td>
								    			<td><input type="number" name="no_telp" class="form-control" value="<?php echo $no_telp; ?>"></td>
								    		</tr>
								    		<tr>
								    			<th>Jenis Usaha</th>
								    			<td>:</td>
								    			<td><input type="text" name="jenis_usaha" class="form-control" value="<?php echo $jenis_usaha; ?>"></td>
								    		</tr>
								    		<tr>
								    			<th>Kapasitas Produksi</th>
								    			<td>:</td>
								    			<td><input type="number" name="kapasitas_produksi" class="form-control" value="<?php echo $kapasitas_produksi; ?>"></td>
								    		</tr>
								    		<tr>
								    			<th>Luas Lahan</th>
								    			<td>:</td>
								    			<td><input type="number" name="luas_lahan" class="form-control" value="<?php echo $luas_lahan; ?>"></td>
								    		</tr>
								    		<tr>
								    			<th>Luas Bangunan</th>
								    			<td>:</td>
								    			<td><input type="number" name="luas_bangunan" class="form-control" value="<?php echo $luas_bangunan; ?>"></td>
								    		</tr>
								    		<tr>
								    			<th>Kondisi Lahan Saat Ini</th>
								    			<td>:</td>
								    			<td><input type="text" name="kondisi" class="form-control" value="<?php echo $kondisi; ?>"></td>
								    		</tr>
								    		<tr>
								    			<td colspan="3">
								    			 	<div class="gllpLatlonPicker" align="center" >
											        <div class="gllpMap"><b>Lokasi</b></div><br><br>
											        	<input type="text" name="lat" class="gllpLatitude" value="<?php echo $lat; ?>" placeholder="Latitude" Required>
														<input type="text" name="lng" class="gllpLongitude" value="<?php echo $lng; ?>" placeholder="Longitude" Required>
											       </div>
											    </td>
											 </tr>
								    		<tr>
								    			<th></th>
								    			<td></td>
								    			<td>
								    				<input type="submit" name="update" value="Update" class="btn btn-success">
													<a href="<?php echo site_url('perusahaan') ?>"><div class="btn btn-danger">Batal</div></a>
												</td>
								    		</tr>
							    		</table>
							</form>	<!-- END -->		
						</div>
					</div>
	<!-- END KONTEN -->

				<script>
					$("#kec").change(function(){
			 				var id = $("#kec").val();
			 				$("#kel").load("<?php echo site_url('pemohon/kel') ?>/"+id);
			 			});
				</script>

