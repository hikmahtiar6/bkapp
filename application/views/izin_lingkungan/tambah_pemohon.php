	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5" style="">
						<div style="background:#fff; padding:3%;box-radius:50px; ">
							<form method="POST" action="<?php echo site_url('pemohon/simpan')?>" enctype="multipart/form-data"> 
							      <h4>Tambah Pemohon</h4><br>
							    	<!-- Form Pemohon -->
							    		<table class="table">
								    		<tr>
								    			<th>NIK</th>
								    			<td>:</td>
								    			<td><input type="number" name="nik" class="form-control"></td>
								    		</tr>
								    		<tr>
								    			<th>Nama Lengkap</th>
								    			<td>:</td>
								    			<td><input type="text" name="nama" class="form-control"></td>
								    		</tr>
								    		<tr>
								    			<th>Jabatan</th>
								    			<td>:</td>
								    			<td><input type="text" name="jabatan" class="form-control"></td>
								    		</tr>
								    		<tr>
								    			<th>Alamat</th>
								    			<td>:</td>
								    			<td><textarea name="alamat" class="form-control"></textarea></td>
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
							        					<option></option>
							        				</select>
							        			</td>
							        		</tr>
								    		<tr>
								    			<th>No. Telp</th>
								    			<td>:</td>
								    			<td><input type="number" name="no_telp" class="form-control"></td>
								    		</tr>
								    		<tr>
								    			<th></th>
								    			<td></td>
								    			<td>
								    				<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
													<a href="<?php echo site_url('pemohon') ?>"><div class="btn btn-danger">Batal</div></a>
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

