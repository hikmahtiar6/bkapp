	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5" style="">
						<div style="background:#fff; padding:3%;box-radius:50px; ">
							      <h4>Dokumen Pemohon</h4><br>
							    	<!-- Form Pemohon -->
							    		<form method="POST" action="<?php echo site_url('dokumen_pemohon/tampil')?>" enctype="multipart/form-data"> 
								    		<table class="table">
								    			<tr>
								    				<th>Pilih Pemohon</th>
								    				<td>:</td>
								    				<td>
								    					<select name="pemohon" class="form-control" id="optionPemohon">
												    		<option value=""></option>
															<?php 
															 	$id = $this->session->userdata('member_id');
																$sql = $this->supermodel->queryManual("SELECT * FROM pemohon WHERE member_id = '".$id."' ORDER BY pemohon_id DESC");
														       	if($sql->num_rows()>0) {
																	foreach ($sql->result() as $r) {
																		$s="";
																		if ($pemohon_id == md5($r->pemohon_id)) {
																			$s ="selected";
																		}
														   	?>
														    	<option value="<?php echo $r->pemohon_id ?>"<?php echo $s ?>><?php echo $r->nama; ?></option>
															<?php }} ?>
														</select>
								    				</td>
								    			</tr>
								    		</table>
								    	</form>
								    	<div id="aksiPemohon">
								    	</div>
						</div>
					</div>
	<!-- END KONTEN -->



	<script>

		$(document).ready(function(){
			
			$.post("<?php echo site_url('dokumen_pemohon/tampil') ?>",{pemohon_id:$("#optionPemohon option:selected").val() }, function(aksi){
					$("#aksiPemohon").html(aksi);
				});

			$("#optionPemohon").change(function(){
				$.post("<?php echo site_url('dokumen_pemohon/tampil') ?>",{pemohon_id:$("#optionPemohon option:selected").val() }, function(aksi){
					$("#aksiPemohon").html(aksi);
				});
			});

		});

	</script>
