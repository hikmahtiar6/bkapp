	<script type="text/javascript">
		var i;
		var o;

		function show_modal(file_element,file_name_element){
			i = file_element;
			o = file_name_element;
		}

		function get_file(file_element,file_name_element){
			i.val(file_element);
			o.html(file_name_element);
		}

	</script>


	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5">
						<div style="background:#fff; padding:3%;box-radius:50px;">
							<div class="clearfix" align="justify">
							  <div class="tab-content">
							      <h3>Pengurusan Izin</h3>
							    	<!-- Pengurusan Izin -->
							    		<table class="table">
							    			<?php
							    			$sql = $this->supermodel->queryManual("SELECT 
													    							a.*,
																					b.nama as nama_pemohon,
																					c.nama as nama_perusahaan,
																					d.*
													    							from 
													    							".$tabel." a,pemohon b,perusahaan c,jenisizin d 
													    							WHERE 
													    							a.pemohon_id = b.pemohon_id AND
													    							a.perusahaan_id = c.perusahaan_id AND
													    							a.jenisizin_id = d.jenisizin_id AND
													    							a.permohonan_id = '".$permohonan_id."'");
							    			if($sql->num_rows()>0) {
												$no=1;
												foreach ($sql->result() as $r) {
							    			?>
							    			<tr>
							    				<th>Kode Permohonan Izin</th>
							    				<td>:</td>
							    				<th><?php echo $permohonan_id; ?></th>
							    			</tr>
							    			<tr>
							    				<th>Nama Pemohon</th>
							    				<td>:</td>
							    				<td><?php echo $r->nama_pemohon; ?></td>
							    			</tr>
							    			<tr>
							    				<th>Nama Perusahaan</th>
							    				<td>:</td>
							    				<td><?php echo $r->nama_perusahaan; ?></td>
							    			</tr>
							    			<tr>
							    				<th>Nama Perizinan</th>
							    				<td>:</td>
							    				<td><?php echo $r->nama_perizinan; ?></td>
							    			</tr>
							    			<tr>
							    				<th>Nama Kegiatan</th>
							    				<td>:</td>
							    				<td><?php echo $r->nama_kegiatan; ?></td>
							    			</tr>
							    			<tr>
							    				<th>Rencana Lokasi</th>
							    				<td>:</td>
							    				<td><?php echo $r->rencana_lokasi; ?></td>
							    			</tr>
							    			<?php }} ?>
							    		</table>

							    		<table class="table table-bordered table-striped">
								    		<thead>
								    			<tr>
								    				<th>No</th>
								    				<th>Persyaratan</th>
								    				<th></th>
								    				<th colspan="2">File</th>
								    			</tr>
								    		</thead>
								    		<?php
								    			$sql = $this->supermodel->queryManual("SELECT
								    													a.*,b.*,c.* 
								    													FROM izin_persyaratan a,jenisizin b, persyaratan c
								    												 	WHERE 
								    												 	a.jenisizin_id = b.jenisizin_id AND 
								    												 	a.persyaratan_id = c.persyaratan_id AND
								    												 	a.jenisizin_id = '".$jenisizin_id."'");
												if($sql->num_rows()>0) {
													$no=0;
													foreach ($sql->result() as $r) {
								    				$no++
								    		?>
								    			<tr>
								    				<td><?php echo $no ?></td>
								    				<td><?php echo $r->persyaratan ?></td>
								    				<td>:</td>
								    				<td><input type="text" id="file_<?php echo $no; ?>" name="dok_id"><span id="file_name<?php echo $no; ?>"></td>
								    				<td>
								    					<button class="btn btn-success" onclick="show_modal($('#file_<?php echo $no; ?>'),$('#file_name<?php echo $no; ?>'))" data-toggle="modal" data-target="#myModal" >Pilih File</button>
								    				</td>
								    			</tr>
								    		<?php }} ?>
							    		</table>   
							    		<button class="btn btn-success">Simpan</button>
							  </div>
							</div>
						</div>
					</div>
	<!-- END KONTEN -->



							    		<!-- MODAL -->
										  <div class="modal fade" id="myModal" role="dialog">
										    <div class="modal-dialog"><!-- Modal content-->
										      <div class="modal-content">
										        <div class="modal-header">
										          <button type="button" class="close" data-dismiss="modal">&times;</button>
										          <h4 class="modal-title"><b>Pilih File</h4>
										        </div>
										        <div class="modal-body">

										        <ul class="nav nav-tabs nav-justified">
										    		<li class="active"><a data-toggle="tab" href="#pemohon" style="color:black;">Dokumen Pemohon</a></li>
										   	 		<li><a data-toggle="tab" href="#perusahaan" style="color:black;">Dokumen Perusahaan</a></li>
										  		</ul>

										  		<div class="tab-content">
									  	    		<div id="pemohon" class="tab-pane fade in active">
									  	    			<table class="table">
									  	    				<tr>
									  	    					<td align="right"><a href="<?php echo site_url('dokumen_pemohon/index/'.md5($pemohon_id)) ?>" class="btn btn-info">Tambah Dokumen Pemohon</a></td>
									  	    				</tr>
									  	    				<tr>
									  	    					<td>
									  	    						<table class="table table-striped table-bordered">
												  	    				<tr>
												  	    					<td>No</td>
												  	    					<td>Nama File</td>
												  	    					<td></td>
												  	    				</tr>
												  	    				<?php 
												  	    				$sql = $this->supermodel->queryManual("SELECT 
																												d.*,
																												s.*
																												FROM 
																												direktori_pemohon d, persyaratan s
																												WHERE
																												d.persyaratan_id = s.persyaratan_id AND
																												d.pemohon_id = '".$pemohon_id."'");
												  	    				if($sql->num_rows()>0) {
																			$no=0;
																			foreach ($sql->result() as $r) {
														    					$no++

												  	    				?>
												  	    				<tr>
												  	    					<td><?php echo $no; ?></td>
												  	    					<td><?php echo $r->file_name; ?></td>
												  	    					<td>
												  	    						<a href="<?php echo site_url()."/dokumen_pemohon/view_dok/".$r->file?>" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>
																    			<a onclick="get_file('<?php echo $r->dokumen_id ?>','<?php echo $r->file_name ?>');" data-dismiss="modal" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
																    		</td>
												  	    				</tr>
												  	    				<?php }} ?>
												  	    			</table>
												  	    		</td>
												  	    	</tr>
												  	    </table>
													</div>
													<div id="perusahaan" class="tab-pane fade">
														<table class="table">
									  	    				<tr>
									  	    					<td align="right"><a href="<?php echo site_url('dokumen_perusahaan/index/'.md5($perusahaan_id)) ?>" class="btn btn-info">Tambah Dokumen Pemohon</a></td>
									  	    				</tr>
									  	    					<td>
															        <table class="table table-striped table-bordered">
												  	    				<tr>
												  	    					<td>No</td>
												  	    					<td>Nama File</td>
												  	    					<td></td>
												  	    				</tr>
												  	    				<?php 
												  	    				$sql = $this->supermodel->queryManual("SELECT 
																												d.*,
																												s.*
																												FROM 
																												direktori_perusahaan d, persyaratan s
																												WHERE
																												d.persyaratan_id = s.persyaratan_id AND
																												d.perusahaan_id = '".$perusahaan_id."'");
												  	    				if($sql->num_rows()>0) {
																			$no=0;
																			foreach ($sql->result() as $r) {
														    					$no++

												  	    				?>
												  	    				<tr>
												  	    					<td><?php echo $no; ?></td>
												  	    					<td><?php echo $r->file_name; ?></td>
												  	    					<td>
												  	    						<a href="<?php echo site_url()."/dokumen_pemohon/view_dok/".$r->file?>" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-search"></i></a>
																    			<a onclick="get_file('<?php echo $r->dokumen_id ?>','<?php echo $r->file_name ?>');" data-dismiss="modal" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
																    		</td>	
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
										<!-- END MODAL -->

