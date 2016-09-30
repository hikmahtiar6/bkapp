	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5" style="">
						<div style="background:#fff; padding:3%;box-radius:50px; ">
							      <h4>Dokumen Member</h4><br>
							    	<!-- Form perusahaan -->
							    		<form method="POST" action="<?php echo site_url('dokumen_member/tampil')?>" enctype="multipart/form-data"> 
								    		<table class="table">
								    			<tr>
								    				<th>Pilih Perusahaan</th>
								    				<td>:</td>
								    				<td>
								    					<select name="perusahaan" class="form-control" id="optionPerusahaan">
												    		<option value=""></option>
															<?php 
															 	$id = $this->session->userdata('member_id');
																$sql = $this->supermodel->queryManual("SELECT * FROM perusahaan WHERE member_id = '".$id."' ORDER BY perusahaan_id DESC");
														       	if($sql->num_rows()>0) {
																	foreach ($sql->result() as $r) {
																		$s = "";
																		if ($perusahaan_id == md5($r->perusahaan_id)) {
																			$s = "selected";
																		}
														   	?>
														    	<option value="<?php echo $r->perusahaan_id ?>" <?php echo $s; ?>><?php echo $r->nama; ?></option>
															<?php }} ?>
														</select>
								    				</td>
								    			</tr>
									    		<tr>
									    			<td colspan="3"></td>
									    		</tr>
								    		</table>
								    	</form>
								    	<div id="aksiPerusahaan"></div>
								    	
						</div>
					</div>
	<!-- END KONTEN -->



	<script>
		$(document).ready(function(){
			$.post("<?php echo site_url('dokumen_member/tampil') ?>",{perusahaan_id:$("#optionPerusahaan option:selected").val() }, function(aksi){
				$("#aksiPerusahaan").html(aksi);
			});

			$("#optionPerusahaan").change(function(){
				$.post("<?php echo site_url('dokumen_member/tampil') ?>",{perusahaan_id:$("#optionPerusahaan option:selected").val() }, function(aksi){
					$("#aksiPerusahaan").html(aksi);
				});
			});

		});
	</script>
