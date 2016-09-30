	<script type="text/javascript">
		var i;
		var o;

		function show_modal(dok_element,file_name_element){
			i = dok_element;
			o = file_name_element;
			console.log(i);
			console.log(o);
		}

		function get_file(dok_element,file_name_element){
			i.val(dok_element);
			o.html(file_name_element);
		}

	</script>


	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5">
						<div style="background:#fff; padding:3%;box-radius:50px;">
							<div class="clearfix" align="justify">
								<form method="POST" id="urus-perizinan" action="<?php echo site_url('upload_syarat/simpan')?>" enctype="multipart/form-data">
								    <input type="hidden" value="<?php echo $permohonan_id; ?>" name="permohonan_id">
								    <input type="hidden" value="<?php echo $pemohon_id; ?>" name="pemohon_id">
								    <input type="hidden" value="<?php echo $perusahaan_id; ?>" name="perusahaan_id">
								    <input type="hidden" value="<?php echo $jenisizin_id; ?>" name="jenisizin_id">
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
									    				<td><?php echo $r->persyaratan?></td>
									    				<td>:</td>
									    				<td>
									    					<input class="dokumen-perizinan" type="hidden" id="dok_<?php echo $no; ?>" name="dok_id[]" required>
									    					<input class="persyaratan-perizinan" type="hidden" value="<?php echo $r->persyaratan_id ?>" name="persyaratan_id[]">
									    					<span id="file_name<?php echo $no; ?>">
									    					</td>
									    				<td>
									    					<a class="btn btn-success" onclick="show_modal($('#dok_<?php echo $no; ?>'),$('#file_name<?php echo $no; ?>'))" data-toggle="modal" data-target="#myModal" >Pilih File</a>
									    				</td>
									    			</tr>
									    		<?php }} ?>
								    		</table>   
								    		<input type="submit" name="simpan" class="btn btn-success" value="Simpan">
								  </div>
								</form>
							</div>
						</div>
					<!-- </div> -->
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
														<table class="table">
									  	    				<tr>
									  	    					<td>
									  	    						<select name="perus" class="form-control" id="perus" ruquired>
									  	    							<?php
									  	    								$sql = $this->supermodel->queryManual("SELECT * FROM perusahaan WHERE member_id = '".$member_id."'");
									  	    								if($sql->num_rows()>0){
									  	    									foreach ($sql->result() as $r) {
									  	    										$s="";
									  	    										if ($perusahaan_id == $r->perusahaan_id) {
									  	    											$s="selected";
									  	    										}
									  	    							?>
									  	    								<option value="<?php echo $r->perusahaan_id ?>" <?php echo $s ?>><?php echo $r->nama ?></option>
									  	    							<?php }} ?>
														        	</select>
									  	    					</td>
									  	    					<td align="right"><a href="<?php echo site_url('dokumen_member/index/'.md5($perusahaan_id)) ?>" class="btn btn-info">Tambah Dokumen Pemohon</a></td>
									  	    				</tr>
									  	    				<tr>
									  	    					<td colspan="2" id="dokumen">
												  	    		</td>
												  	    	</tr>
												  	    </table>
										        </div>
										      </div>
										    </div>
										  </div>
										<!-- END MODAL -->

<script>
$(document).ready(function(){

	$.post("<?php echo site_url('upload_syarat/dokumen') ?>",{perusahaan_id:$("#perus option:selected").val() }, function(dokumen){
					// alert(#optionPemohon.val);
					//console.log("ini dok =>",dokumen);
					$("#dokumen").html(dokumen);
	});

	$("#perus").change(function(){
				$.post("<?php echo site_url('upload_syarat/dokumen') ?>",{perusahaan_id:$("#perus option:selected").val() }, function(dokumen){
					// alert(#optionPemohon.val);
					//console.log("ini dok =>",dokumen);
					$("#dokumen").html(dokumen);
				});
			}); 
});
</script>

<script type="text/javascript" src="<?php echo base_url('asset_app/js/perizinan/index.js'); ?>"></script>
<script type="text/javascript">

	var formEl = 'form#urus-perizinan';
	var dokEl = '.dokumen-perizinan';
	var syaratEl = '.persyaratan-perizinan';

	window.PERIZINAN.handleSavePerizinan(formEl, dokEl, syaratEl);
</script>
