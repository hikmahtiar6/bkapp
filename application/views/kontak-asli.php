		<div class="row">
			<div class="col-md-8 col-sm-8">
				<h2>Kontak Kami</h2>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5811589556606!2d106.79710499999999!3d-6.574425000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c438553ddca9%3A0xde062f00636a4afa!2sBadan+Pengelolaan+Lingkungan+Hidup!5e0!3m2!1sen!2sid!4v1436772340460" width="100%" height="270" frameborder="0" style="border:0" allowfullscreen></iframe>
				<div class="clearfix">
				<p>Alamat : Jl. Senam No. 1 Bogor</p>
				<p>Telp. (0251) 8340057</p>
				<p>Email : bplh@kotabogor.go.id</p>
				</div>
				<form action="#" method="post">
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nama</label>
						<input class="form-control" name="nama" type="text">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input class="form-control" name="email" type="text">
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label>Pesan</label>
						<textarea name="pesan" class="form-control" rows="8"></textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-flat btn-primary" type="submit">Kirim Pesan</button>
					</div>
				</div>
				</div>
				</form>
			</div>

			<div class="col-md-4 col-sm-4">
				<h4 class="widget-title"><i class="fa fa-arrow-circle-o-right widget-title-icon"></i> terpopuler</h4>
			<?php
			if ($populer) {
				foreach ($populer->result() as $p) {
			?>
				<div class="widget-content">
					<div class="content-meta">
						<small><i class="fa fa-calendar"></i> <?php echo convert_tanggal($p->date_publish) ?> </small>
						<small class="margin-x-10"><i class="fa fa-eye"></i> Views : <?php echo $p->view ?></small>
						<small><i class="fa fa-user"></i> By <a><?php echo $p->user_name ?></a></small>
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