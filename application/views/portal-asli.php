<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>BPLH Kota Bogor</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

	<link rel="icon" href="<?php echo base_url('assets/css/image/kotabogor.png') ?>">
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="section" style="background:#15A531;">
<div class="container" id="header">
	<div class="row padding-y-10">
		<div class="col-md-9 col-sm-8 col-xs-10">
			<div class="logo clearfix">
			<?php
			/*
			if($icon_site!="") {				
				echo "<img src='".base_url('uploads/'.$icon_site)."' class='img-responsive pull-left hidden-xs'/>";
			}
			*/
			echo "<img src='".base_url('uploads/logo.png')."' class='img-responsive pull-left hidden-xs'/>";
			?>
			<!--
				<div class="pull-left judul-web">
					<h2><a href="<?php echo site_url() ?>"><?php echo $name_site ?></a></h2>
					<h4><?php echo $sub_title ?></h4>
				</div>
			-->
			</div>
		</div>
		<div class="col-md-3 col-sm-4 col-xs-12">
			<form method="post" class="box-search" action="#" >
			<div class="form-group has-feedback">
				<input type="text" name="search" class="form-control box-search-input" placeholder="Cari..">
				<span class="form-control-feedback"><i class="fa fa-search"></i></span>
			</div>
			</form>
		</div>
	</div>
	<nav class="navbar no-margin no-padding">
		<div class="navbar-header" style="background:#2FCF4E">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menus">
	      	<i class="fa fa-bars"></i>
	      </button>
		  <a href="<?php echo site_url() ?>" class="navbar-brand brand"><i class="fa fa-home"></i></a>
	    </div>
	    <div class="collapse navbar-collapse" id="menus" style="background:#2FCF4E">
	    	  <?php echo menus() ?>
	    </div>
	</nav>
</div>
</div>
<!-- Slide -->
<div class="section" style="background:#f4f4f4">
	<div class="container hidden-xs">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	        <div class="carousel-inner">
	        <?php
	        if($slide->num_rows()>0) {
	        	$no = 1;
	        	foreach ($slide->result() as $rows) {
	        	$cls = "";
	        	if($no==1) {
	        		$cls = "active";
	        	}
	        ?>
	        <div class="item <?php echo $cls ?>">
	            <img src="<?php echo base_url('uploads/slide/'.$rows->slide_file)?>" class="img-slide">
	         </div>
	        <?php
	        	$no++;
	        	}
	        } else {
	        ?>
	        	<div class="item active">
	            <img src="<?php echo base_url('uploads/slide/red.jpg')?>" class="img-slide">
	          </div>
	        <?php
	        }
	        ?>
	          
	        </div>
	        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
	          <span class="fa fa-angle-left"></span>
	        </a>
	        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
	          <span class="fa fa-angle-right"></span>
	        </a>
	      </div>
	</div><!-- End Slide -->

	<div class="container">
		<div class="row" style="padding-top:20px;">
			<!-- Atas -->
			<div class="col-md-8 col-sm-8 right-padding-5">
			<?php
			if($sambutan) {
				foreach ($sambutan->result() as $s) {
			?>
				<div class="sambutan jumbotron">
					<h2 class="text-primary"><?php echo $s->title ?></h2>
					<div class="clearfix" align="justify">
					<?php echo $s->body; ?>
					</div>
				</div>
			<?php
				}
			}
			?>
			</div>
			<div class="col-md-4 col-sm-4 left-padding-5">
				<div class="widget bg-green">
					<h3>Terpopuler</h3>
				</div>
			<?php
			if ($populer) {
			$no = 1;
				foreach ($populer->result() as $p) {
			?>
				<div class="clearfix list-populer">
					<div class="num"><?php echo $no ?></div>
					<div class="judul">
						<a href="<?php echo linked($p->post_id, $p->title) ?>"><?php echo $p->title ?></a>
					</div>
				</div>
			<?php
			$no++;
				}
			}
			?>
			</div>
			<!-- Atas -->
		</div>
		<div class="row padding-y-10"></div>
	</div>
</div>

<div class="section">
	<div class="container padding-y-10">
		<div class="row">
			<div class="col-md-8 col-sm-8">
				<h4 class="widget-title"><i class="fa fa-arrow-circle-o-right widget-title-icon"></i> Terbaru</h4>
				<?php
				if ($terbaru) {
					foreach ($terbaru->result() as $row) {
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
				}
				?>

				<div class="clearfix padding-y-10">
					<div class="pull-right"><h4><a href="<?php echo site_url('kategori/kode/'.$row->category_id) ?>" class="more">Berita sebelumnya <i class="fa fa-angle-right"></i></a></h4></div>
				</div>
			</div>

			<div class="col-md-4 col-sm-4">
				<div class="bg-orange padding-10">
					<h4>cek status izin anda</h4>
					<form method="post" action="<?php echo site_url('sppl/cari') ?>">
					<div class="input-group input-group-lg margin-y-10">
						<input type="text" name="pendaftaranID" class="form-control" placeholder="ID Pendaftaran..">
						<div class="input-group-btn">
						<button class="btn btn-flat btn-primary input-lg"  style="border-radius:0px;" type="submit"><i class="fa fa-search"></i></button>
						</div>
					</div>
					</form>
					<p>cek status izin anda bila sudah mengirim permohonan izin lewat online dengan cara memasukan ID PENDAFTARAN</p>
				</div>
				<br/>
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
</div>

<div class="section" style="background-color:#CBE86B">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<h3><i class="fa fa-download"></i> Unduh</h3>
				<ul class="list-link">
				<?php
				if ($unduh->num_rows()>0) {
					foreach ($unduh->result() as $u) {
				?>
				<li><a href="<?php echo linked($u->post_id, $u->title) ?>"><?php echo $u->title ?></a></li>
				<?php
					}
				}
				?>
				</ul>
			</div>

			<div class="col-md-4 col-sm-4 col-xs-6">
				<h3><i class="fa fa-picture-o"></i> Galeri</h3>
				<div class="clearfix">
				<?php
				if ($galeri) {
					foreach ($galeri->result() as $g) {
				?>
					<div class="galeri-wrap"><img src="<?php echo base_url('uploads/galeri/thumb/'.$g->image)?>"></div>
				<?php
					}
				}
				?>
				</div>
				<div class="text-right">
					<a href="#" style="text-transform:uppercase; margin-right:10px;">Selengkapnya</a>
				</div>
			</div>

			

			<div class="col-md-4 col-sm-4 col-xs-6">
				<h3><i class="fa fa-phone-square"></i> Kontak Kami</h3>
				<?php echo $embed_map ?>
				<p>Alamat : <?php echo $alamat ?></p>
				<p>Telp. <?php echo $no_telp ?></p>
				<p>Email : <?php echo $mail_site ?></p>
				<p>
				Sosial Media :<br/>
				Facebook (<?php echo $fb_site ?>)<br/>
				Twitter (<?php echo $twitter_site ?>)
				</p>
			</div>
		</div>
	</div>
</div>
<div class="section" style="background-color:#1C140D">
	<div class="container">
		<h5 style="color:#F2E9E1">copyright &copy; 2015. BPLH Kota Bogor. All Right Reserved.</h5>
	</div>
</div>

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

</body>
</html>