	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5">
						<div style="background:#fff; padding:3%;box-radius:50px;">
							<div class="clearfix" align="justify">
							  <div class="tab-content">
							      <h3>Pengurusan Izin</h3>
							    	<!-- Pengurusan Izin -->
							    	<form method="POST" action="<?php echo site_url('upload_syarat2/simpan')?>" enctype="multipart/form-data"> 
							    				
							    		<table class="table">
							    			<?php
							    			$sql = $this->supermodel->queryManual("select 
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
							    				<th><?php echo $permohonan_id; ?><input type="hidden" value="<?php echo $permohonan_id; ?>"></th>
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
								    				<th>File</th>
								    			</tr>
								    		</thead>
								    		<?php
								    			$sql = $this->supermodel->queryManual("SELECT 
								    													a.*,b.*,c.* 
								    													FROM izin_persyaratan a,jenisizin b, persyaratan c
								    												 	WHERE 
								    												 	a.jenisizin_id = b.jenisizin_id AND 
								    												 	a.persyaratan_id = c.persyaratan_id AND
								    												 	a.jenisizin_id = '1'");

								    			// $sql = $this->supermodel->queryManual("select 
								    			// 										a.*,b.*,c.* 
								    			// 										from sppl a,jenisizin b, persyaratan c
								    			// 									 	WHERE 
								    			// 									 	a.jenisizin_id = b.jenisizin_id AND 
								    			// 									 	b.jenisizin_id = c.jenisizin_id AND
								    			// 									 	a.jenisizin_id = '1'");
												if($sql->num_rows()>0) {
													$no=0;
													foreach ($sql->result() as $r) {
														$no++;
								    		?>
								    			<tr>
								    				<td><?php echo $no ?></td>
								    				<td><?php echo $r->persyaratan ?></td>
								    				<td>:</td>
								    				<td>
								    					<input type="file" name="<?php echo $r->persyaratan_id; ?>">
								    					<input type="hidden" name="persyaratan_id" value="<?php echo $r->persyaratan_id; ?>">
								    					<input type="text" id="syarat_<?php echo $no ?>" value="<?php echo $no ?>">
								    					<a data-toggle="modal" data-target="#myModal" onclick="a(">Mendaftar</a>
								    				</td>
								    			</tr>
								    		<?php }} ?>
							    		</table>   
							    		<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
							    	</form>
							  </div>
							</div>
						</div>
					</div>
	<!-- END KONTEN -->


<!-- MODAL -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <form method="POST" action="<?php echo site_url('login_daftar_member/daftar')?>" enctype="multipart/form-data">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Mendaftar</b></h4>
        </div>
        <div class="modal-body">
        tes

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="daftar">Daftar</button>
        </div>
      </div>
      </form> 
    </div>
  </div>
<!-- END MODAL -->
