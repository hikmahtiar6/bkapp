		<div class="row">
			<div class="col-md-8 col-sm-8">
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

			<div class="col-md-4 col-sm-4">
				<h4 class="widget-title"><i class="fa fa-arrow-circle-o-right widget-title-icon"></i> lainnya</h4>
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