	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5">
						<div style="background:#fff; padding:3%;box-radius:50px;">
							<div class="clearfix" align="justify">
							  <div class="tab-content">
							      <h3>Dashboard</h3>
							    	<!-- Dashboard -->
							    		<div style="text-align:right; margin-bottom:2%; margin-top:2%;">
							    			<a data-toggle="modal" data-target="#myModal" class="btn btn-success">Buat Izin Baru</a>
							    		</div>

							    		<ul class="nav nav-tabs nav-justified">
								    		<li class="active"><a data-toggle="tab" href="#sppl" style="color:black;">SPPL</a></li>
								   	 		<li><a data-toggle="tab" href="#uklupl" style="color:black;">UKL-UPL</a></li>
								   	 		<li><a data-toggle="tab" href="#amdal" style="color:black;">AMDAL</a></li>
								  		</ul>
								  		<?php
								  		// $a = $this->supermodel->queryManual("SELECT permohonan_id FROM ukl_upl ORDER BY permohonan_id DESC LIMIT 1");
										// foreach ($a as $r) {
										// 	$c = is_int(substr($r->permohonan_id,-4));
										// }
										// 	$z = $c++;
								  // 			echo $z;
								  		?>

								  		<div class="tab-content">
									  	    <div id="sppl" class="tab-pane fade in active">
									    		<table class="table">
									    			<tr>
										    			<td align="center"><label>Permohonan SPPL yang sedang di urus</label></td>
										    		</tr>
										    		<tr>
										    			<td>
												    		<table class="table table-bordered table-striped" id="example1">
													    		<thead>
													    			<tr>
													    				<th>No</th>
													    				<th>Kode Permohonan Izin</th>
													    				<th>Pemohon Izin</th>
													    				<th>Perusahaan</th>
													    				<th>Jenis Izin</th>
													    				<th>Aksi</th>
													    			</tr>
													    		</thead>
													    		<?php
													    			$id = $this->session->userdata('member_id');
													    			$sql = $this->supermodel->queryManual("select 
													    													a.*,
																											b.nama as nama_pemohon,
																											c.nama as nama_perusahaan,
																											d.*
													    													from 
													    													sppl a,pemohon b,perusahaan c,jenisizin d 
													    													WHERE 
													    													a.pemohon_id = b.pemohon_id AND
													    													a.perusahaan_id = c.perusahaan_id AND
													    													a.jenisizin_id = d.jenisizin_id AND
													    													a.member_id = '".$id."' ORDER BY a.permohonan_id DESC");
																	if($sql->num_rows()>0) {
																		$no=1;
																		foreach ($sql->result() as $r) {
													    		?>
													    			<tr>
													    				<td><?php echo $no++ ?></td>
													    				<td><?php echo $r->permohonan_id ?></td>
													    				<td><?php echo $r->nama_pemohon ?></td>
													    				<td><?php echo $r->nama_perusahaan ?></td>
													    				<td><?php echo $r->nama_perizinan; ?></td>
													    				<td><a href="<?php echo site_url()."/upload_syarat2/index/sppl"."/".$r->permohonan_id?>"  class="btn btn-info">Buka</a></td>
													    			</tr>
													    		<?php }} ?>
												    		</table>
												    	</td>
										    		</tr>
												</table>
											</div>

											<div id="uklupl" class="tab-pane fade">
												<table class="table">
									    			<tr>
										    			<td align="center"><label>Permohonan UKL-UPL yang sedang di urus</label></td>
										    		</tr>
										    		<tr>
										    			<td>
															<table class="table">
													    		<tr>
													    			<td>
															    		<table class="table table-bordered table-striped" id="example2">
																    		<thead>
																    			<tr>
																    				<th>No</th>
																    				<th>Kode Permohonan Izin</th>
																    				<th>Pemohon Izin</th>
																    				<th>Perusahaan</th>
																    				<th>Jenis Izin</th>
																    				<th>Aksi</th>
																    			</tr>
																    		</thead>
																    		<?php
																    			$id = $this->session->userdata('member_id');
																    			$sql = $this->supermodel->queryManual("select 
																    													a.*,
																														b.nama as nama_pemohon,
																														c.nama as nama_perusahaan,
																														d.*
																    													from 
																    													ukl_upl a,pemohon b,perusahaan c,jenisizin d 
																    													WHERE 
																    													a.pemohon_id = b.pemohon_id AND
																    													a.perusahaan_id = c.perusahaan_id AND
																    													a.jenisizin_id = d.jenisizin_id AND
																    													a.member_id = '".$id."' ORDER BY a.permohonan_id DESC");
																				if($sql->num_rows()>0) {
																					$no=1;
																					foreach ($sql->result() as $r) {
																    		?>
																    			<tr>
																    				<td><?php echo $no++ ?></td>
																    				<td><?php echo $r->permohonan_id ?></td>
																    				<td><?php echo $r->nama_pemohon ?></td>
																    				<td><?php echo $r->nama_perusahaan ?></td>
																    				<td><?php echo $r->nama_perizinan; ?></td>
																    				<td><a href="<?php echo site_url()."/upload_syarat2/index/ukl_upl"."/".$r->permohonan_id?>"  class="btn btn-info">Buka</a></td>
																    			</tr>
																    		<?php }} ?>
															    		</table>
															    	</td>
															    </tr>
															</table>
														</td>
													</tr>
												</table>
											</div>

											<div id="amdal" class="tab-pane fade">
												<table class="table">
									    			<tr>
										    			<td align="center"><label>Permohonan AMDAL yang sedang di urus</label></td>
										    		</tr>
										    		<tr>
										    			<td>
												    		<table class="table table-bordered table-striped" id="example3">
													    		<thead>
													    			<tr>
													    				<th>No</th>
													    				<th>Kode Permohonan Izin</th>
													    				<th>Pemohon Izin</th>
													    				<th>Perusahaan</th>
													    				<th>Jenis Ijin</th>
													    				<th>Aksi</th>
													    			</tr>
													    		</thead>
													     		<?php
													    			$id = $this->session->userdata('member_id');
													    			$sql = $this->supermodel->queryManual("select 
													    													a.*,
																											b.nama as nama_pemohon,
																											c.nama as nama_perusahaan,
																											d.*
													    													from 
													    													amdal a,pemohon b,perusahaan c,jenisizin d 
													    													WHERE 
													    													a.pemohon_id = b.pemohon_id AND
													    													a.perusahaan_id = c.perusahaan_id AND
													    													a.jenisizin_id = d.jenisizin_id AND
													    													a.member_id = '".$id."' ORDER BY a.permohonan_id DESC");
																	if($sql->num_rows()>0) {
																		$no=1;
																		foreach ($sql->result() as $r) {
													    		?>
													    			<tr>
													    				<td><?php echo $no++ ?></td>
													    				<td><?php echo $r->permohonan_id ?></td>
													    				<td><?php echo $r->nama_pemohon ?></td>
													    				<td><?php echo $r->nama_perusahaan ?></td>
													    				<td><?php echo $r->nama_perizinan; ?></td>
													    				<td><a href="<?php echo site_url()."/upload_syarat2/index/amdal"."/".$r->permohonan_id?>"  class="btn btn-info">Buka</a></td>
													    			</tr>
													    		<?php }} ?>
												    		</table>
												    	</td>
												    </tr>
												</table>
											</div>
										</div>				   
							  </div>
							</div>
						</div>
					</div>
	<!-- END KONTEN -->

	<!-- MODAL -->
	  <div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">
	    <form method="POST" action="<?php echo site_url('perizinan_lingkungan/index')?>" enctype="multipart/form-data">
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title"><b>Pilih Jenis Izin</b></h4>
	        </div>
	        <div class="modal-body">
	        	<select name="jenisizin_id" class="form-control">
	        		<?php 
			        	$sql = $this->supermodel->queryManual('select * from jenisizin');
			        	if($sql->num_rows()>0) {
							foreach ($sql->result() as $r) {
			       	?>
			       	<option value="<?php echo $r->jenisizin_id ?>"><?php echo $r->nama_perizinan; ?></option>
			       	<?php }} ?>
	        	</select>

	        </div>
	        <div class="modal-footer">
	          <input type="submit" class="btn btn-success" name="buat" value="Buat">
	          <input type="text" name="permohonan_id" value="<?php echo $permohonan_id?>">
	        </div>
	      </div>
	      </form> 
	    </div>
	  </div>
	<!-- END MODAL -->
