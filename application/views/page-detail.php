	<!-- left column -->
	<!-- DETAIL -->
	<div class="w3-content w3-twothird w3-white w3-padding">
	    <!-- DETAIL -->
	    <div class="w3-card-2 w3-round w3-white">
			<div class="w3-container w3-padding">
				<?php
				if($content['image']!="") {
					?>
					<img src="<?php echo base_url('uploads/post/'.$content['image'])?>" width="100%" class="img-responsive">
					<hr/>
					<?php
				}
				?>
				<h2><?php echo $content['title'] ?></h2>
				<div class="content-meta margin-y-5">
					<small><i class="fa fa-calendar"></i> <?php echo convert_tanggal($content['date_publish']) ?> </small>
					<small class="margin-x-10"><i class="fa fa-eye"></i> Views : <?php echo $content['view'] ?></small>
					<small><i class="fa fa-user"></i> By <a><?php echo $content['user_name'] ?></a></small>
				</div>
				<div align="justify">
					<?php echo $content['body'] ?>
				</div>
			</div>	
		</div>	
	</div>
	<!-- end of left column -->
	<!-- right column -->
	<div class="w3-content w3-third w3-white w3-padding">
		<!-- KALENDER -->
		<div class="w3-card-2 w3-round w3-white">
			<div class="w3-container">
			<h4>Kalender</h4>
				<div class="metro">
				<div id="kalender" class="calendar small"></div>
				</div>
					<script type="text/javascript">
					$(function() {
						$("#kalender").calendar({
							click:false,
							getDates:false,
							weekStart:0
						});
					});
					</script>
			</div><br>
		</div><br>
		<!--BANNER -->
		<div class="w3-card-2 w3-round w3-white">
			  <div class="w3-container">
				<h4>Banner</h4>
						<?php
						if($banner) {
							foreach ($banner->result() as $b) {
							echo "<p><a href='".$b->link."' target='_blank'><img src='".base_url('uploads/banner/'.$b->banner_file)."' alt='".$b->title."' width='100%'/></a></p>";
							}
						}
						?>	
			</div><br>
		</div><br>
		<!--- LAIN LAIN -->
		<div class="w3-card-2 w3-round w3-white">
			  <div class="w3-container">
				<h3>Kontak Kami</h3>
					<?php echo $embed_map ?>
					<p>Alamat : <?php echo $alamat ?><br>
					Telp. <?php echo $no_telp ?><br>
					Email : <?php echo $mail_site ?><br>
					</p>
					Sosial Media :<br/>
					Facebook (<?php echo $fb_site ?>)<br/>
					Twitter (<?php echo $twitter_site ?>)
			</div><br>		
		</div>
	</div>		
		
	<!-- end of right column -->