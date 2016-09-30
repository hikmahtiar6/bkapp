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

<div class="section" style="background:#15A531;" >
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
			<form method="post" class="box-search" action="" >
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
	<div class="container">
		<ol class="breadcrumb bc">
			<li class="home"><a href="<?php echo site_url() ?>">Beranda</a></li>
			<?php 
			if ($category['category_id']!='') {
				echo navigate($category['category_id']);
			} else {
				echo "<li>".$breadcrumb."</li>";
			}
			
			?>
		</ol>
	</div>
</div>

<div class="section">
	<div class="container padding-y-10">
		<?php $this->load->view($konten) ?>
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
				if ($galeri->num_rows()>0) {
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