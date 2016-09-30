	<!-- left column -->
	<!-- DETAIL -->
	<div class="w3-content w3-twothird w3-white w3-padding">
	    <!-- DETAIL -->
	    <div class="w3-card-2 w3-round w3-white">
			<div class="w3-container w3-padding">
			<?php
				if ($all->num_rows()>0) {
					foreach ($all->result() as $row) {
				?>
				<div class="list-content clearfix">
					<div class="col-md-4 no-left-padding">
						<div class="image-container">
							<a href="<?php echo linked($row->post_id, $row->title) ?>">
							<img src="<?php echo get_image($row->body, $row->image) ?>" alt="<?php echo $row->title ?>">
							</a>
						</div>
					</div>
					<div class="col-md-8 no-left-padding">
						<h4 class="no-margin"><a href="<?php echo linked($row->post_id, $row->title) ?>"><?php echo $row->title ?></a></h4>
						<div class="content-meta margin-y-5">
							<small><i class="fa fa-calendar"></i> <?php echo convert_tanggal($row->date_publish) ?> </small>
							<small class="margin-x-10"><i class="fa fa-eye"></i> Views : <?php echo $row->view ?></small>
							<small><i class="fa fa-user"></i> By <a><?php echo $row->user_name ?></a></small>
						</div>
						<div align="justify">
							<?php echo strip_tags(substr($row->body, 0,350))?>..
						</div>
					</div>
				</div>
				<?php
				}
			} else {
				echo "Belum ada data diinputkan!! Silahkan kembali lagi nanti.";
			}
			?>
				<div class="clearfix padding-y-10">
					<div class="pull-right">
					<?php echo $this->pagination->create_links(); ?>
					</div>
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
			<h4>Terpopuler</h4>
			<?php
			if ($populer) {
				foreach ($populer->result() as $p) {
			?>
				<div class="widget-content">
					<div class="content-meta">
						<small class="author"><i class="fa fa-user"></i> By <a><?php echo $p->user_name ?></a></small>
	                    <small class="date"><i class="fa fa-calendar"></i> On <?php echo convert_tanggal($p->date_publish) ?></small>
	                    <small class="tag"><i class="fa fa-tag"></i> <a><?php echo $p->category_name ?></a></small>
					</div>
					<h4><a href="<?php echo linked($p->post_id, $p->title) ?>"><?php echo $p->title ?></a></h4>
					<div align="justify" style="font-size:12px;">
					<?php echo strip_tags(substr($p->body, 0,120))?>..
					</div>
				</div>
			<?php
				}
			}
			?>
				<h4 class="widget-title"><i class="fa fa-arrow-circle-o-right widget-title-icon"></i> banner</h4>
				<?php
				if($banner) {
					foreach ($banner->result() as $b) {
					echo "<p><a href='".$b->link."' target='_blank'><img src='".base_url('uploads/banner/'.$b->banner_file)."' alt='".$b->title."' width='100%'/></a></p>";
					}
				}
				?>
			</div>
		</div>
	</div>