	<!-- KONTEN -->
					<div class="col-md-8 col-sm-8 right-padding-5" style="">
						<div style="background:#fff; padding:3%;box-radius:50px; ">

							      <h4>Data Pemohon</h4><br>
							    	<!-- Form Pemohon -->
							    		<table class="table">
							    			<tr>
							    				<form method="POST" action="<?php echo site_url('pemohon/tambah')?>" enctype="multipart/form-data"> 
							    					<td align="right"><input type="submit" name="tambah" value="Tambah Data" class="btn btn-primary"></td>
							    				</form>
							    			</tr>
							    			<tr>
							    				<td></td>
										    </tr>
										</table>
												<div style="height:auto;width:auto; overflow:scroll;">
										    		<table class="table table-bordered table-striped" id="example1">
											    		<thead>
											    			<tr>
											    				<th>No</th>
											    				<th>Nama Lengkap</th>
											    				<th>Jabatan</th>
											    				<th>Alamat</th>
											    				<th>Kecamatan</th>
											    				<th>Kelurahan</th>
											    				<th>NIK</th>
											    				<th>No Telp</th>
											    				<th>Aksi</th>
											    			</tr>
											    		</thead>
											    		<?php
															if($sql->num_rows()>0) {
																$no=1;
																foreach ($sql->result() as $r) {
											    		?>
											    			<tr>
											    				<td><?php echo $no++ ?></td>
											    				<td><?php echo $r->nama ?></td>
											    				<td><?php echo $r->jabatan ?></td>
											    				<td><?php echo $r->alamat ?></td>
											    				<td><?php echo $r->kecamatan_nama ?></td>
											    				<td><?php echo $r->kelurahan_nama ?></td>
											    				<td><?php echo $r->nik ?></td>
											    				<td><?php echo $r->no_telp ?></td>
											    				<td><a href="<?php echo site_url()."/pemohon/edit/".$r->pemohon_id?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a></td>
											    			</tr>
											    		<?php }} ?>
										    		</table>
										    		</div>
							    	<!-- END -->		


														</div>
													</div>
									<!-- END KONTEN -->
									