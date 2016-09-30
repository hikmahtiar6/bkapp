<!DOCTYPE html>
<html>
<title>BPLH Kota Bogor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="<?php echo base_url('assets/css/image/kotabogor.png') ?>">
<!--
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3-theme-blue-grey.css">
-->
<link href="<?php echo base_url()?>assets/css/w3.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/w3-theme-blue-grey.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/cldr.css" rel="stylesheet" type="text/css" />

<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>


    <link href="<?php echo base_url('asset/css/metro-bootstrap.css')?>" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('asset/css/bootstrap.css')?>" rel="stylesheet">
    <!-- Add custom CSS here -->
    <link href="<?php echo base_url('asset/css/style.css')?>" rel="stylesheet">
     <link href="<?php echo base_url('asset/css/nivo-slider.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/css/default/default.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('asset/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <script src="<?php echo base_url('asset/js/jquery-1.10.2.js')?>"></script>
    <script src="<?php echo base_url('asset/js/bootstrap.js')?>"></script>
    <script src="<?php echo base_url('asset/js/jquery/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('asset/js/jquery/jquery.widget.min.js')?>"></script>
    <script src="<?php echo base_url('asset/js/metro.min.js')?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('asset/js/fancybox/jquery.fancybox.css?v=2.1.5')?>" media="screen" />
    <script type="text/javascript" src="<?php echo base_url('asset/js/fancybox/jquery.fancybox.js?v=2.1.5')?>"></script>




<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <ul class="w3-navbar w3-theme-d2 w3-left-align w3-medium">
  <li class="w3-hide-medium w3-hide-medium w3-opennav w3-right">
    <a class="w3-padding-medium w3-hover-white w3-medium w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  </li>
  <li>
		<a href="#" class="w3-padding-medium w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>
  </li>
  
  <li class="w3-hide-medium w3-dropdown-hover">
    <a href="#" class="w3-padding-medium w3-hover-white">Profil</a>
    <div class="w3-dropdown-content w3-white w3-card-4">
		  <a href="#">Sekapur Sirih</a>
		  <a href="#">Struktur Organisasi</a>
		  <a href="#">Data Pejabat</a>
		  <a href="#">Tugas Pokok dan Fungsi</a>
		  <a href="#">Renstra</a>
		  <a href="#">Visi dan Misi</a>		  
    </div>
  </li>  
  <li class="w3-hide-medium">
		<a href="<?php echo site_url() ?>" class="w3-padding-medium w3-hover-white">Berita</a>
  </li>
  <li class="w3-hide-medium w3-dropdown-hover">
    <a href="#" class="w3-padding-medium w3-hover-white">Laporan</a>
    <div class="w3-dropdown-content w3-white w3-card-4">
		  <a href="#">Hasil Sidak Pemantauan Air Tanah</a>
		  <a href="#">Buku SLHD 2012</a>
		  <a href="#">Buku SLHD 2013</a>
		  <a href="#">Buku SLHD 2014</a>
		  <a href="#">Buku SLHD 2015</a>	  
    </div>
  </li>   
  <li class="w3-hide-medium w3-dropdown-hover">
    <a href="#" class="w3-padding-medium w3-hover-white">Peraturan</a>
    <div class="w3-dropdown-content w3-white w3-card-4">
		  <a href="#">Undang-Undang</a>
		  <a href="#">Peraturan Pemerintah</a>
		  <a href="#">Peraturan Menteri</a>
		  <a href="#">Keputusan Menteri</a>
		  <a href="#">KEPKA BAPEDAL</a>	  
		  <a href="#">Peraturan Daerah</a>	  		  
    </div>
  </li>   
  <li class="w3-hide-medium">
		<a href="<?php echo site_url() ?>" class="w3-padding-medium w3-hover-white">Prosedur Perizinan</a>
  </li>
  <li class="w3-hide-medium w3-dropdown-hover">
    <a href="#" class="w3-padding-medium w3-hover-white">Izin Lingkungan</a>
    <div class="w3-dropdown-content w3-white w3-card-4">
		  <a href="#">Pengumuman</a>
		  <a href="#">SPPL</a>
		  <a href="#">UKL-UPL</a>
		  <a href="#">AMDAL</a>		  
    </div>
  </li>  
  <li class="w3-hide-medium">
		<a href="<?php echo site_url() ?>" class="w3-padding-medium w3-hover-white">Ragam Data</a>
  </li>
  <li class="w3-hide-medium">
		<a href="<?php echo base_url()?>/gis" class="w3-padding-medium w3-hover-white">Web GIS</a>
  </li>
  <li class="w3-hide-medium">
		<a href="<?php echo site_url() ?>" class="w3-padding-medium w3-hover-white">Kontak Kami</a>
  </li>  
</ul>
 
 
</div>

<!-- Navbar on small screens 
<div id="navDemo" class="w3-hide w3-hide-medium w3-hide-medium w3-top" style="margin-top:51px">
  <ul class="w3-navbar w3-left-align w3-large w3-theme">
    <li><a class="w3-padding-medium" href="#">Link 1</a></li>
    <li><a class="w3-padding-medium" href="#">Link 2</a></li>
    <li><a class="w3-padding-medium" href="#">Link 3</a></li>
    <li><a class="w3-padding-medium" href="#">My Profile</a></li>
  </ul>
</div>
-->
<!-- Page Container -->
<div class="w3-container w3-content center" style="max-width:1400px;margin-top:30px">

<!-- Slider -->
	<div class="w3-card-2 w3-section w3-content w3-round w3-white" style="max-width:1350px;">
	  <div class="w3-container" style="padding-top:10px;padding-bottom:15px;">
		<img class="mySlides w3-animate-left" src="<?php echo base_url()?>assets/css/image/1.jpg" style="width:100%">
		<img class="mySlides w3-animate-left" src="<?php echo base_url()?>assets/css/image/2.jpg" style="width:100%">
	  </div>
	</div>

  <!-- The Grid -->
  <div class="w3-row m12">

    <!-- Middle Column -->
    <div class="w3-col m9">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
          <div class="w3-card-2 w3-round w3-white">
            <div class="w3-container w3-padding">
			<!--BARU AWAL-->
			<?php
			if($sambutan) {
				foreach ($sambutan->result() as $s) {
			?>
				<div class="w3-container">
					<h2 class="w3-xlarge"><?php echo $s->title ?></h2>
					<div class="w3-content w3-justify" >
					<?php echo $s->body; ?>
					</div>
				</div>
			<?php
				}
			}
			?>	
			<!--BARU AKHIR-->			
          </div>
        </div>
      </div>
      </div>
      
      <div class="w3-container w3-card-2 w3-white w3-round w3-margin">
	  <!--BARU AWAL-->
				<h5>Terbaru</h5>
				<?php
				if ($terbaru) {
					foreach ($terbaru->result() as $row) {
				?>
				
				<a href="<?php echo linked($row->post_id, $row->title) ?>"></a>
<!--				
				<div class="w3-container w3-card-2" style="width:105px">
				<img src="<?php echo get_image($row->body, $row->image) ?>" alt="<?php echo $row->title ?>">
				</div>
-->			
					<h4></a><a href="<?php echo linked($row->post_id, $row->title) ?>"><?php echo $row->title ?></a></h4>

							<small><i class="fa fa-calendar"></i> <?php echo convert_tanggal($row->date_publish) ?> </small>
							<small class="margin-x-10"><i class="fa fa-eye"></i> Views : <?php echo $row->view ?></small>
							<small><i class="fa fa-user"></i> By <a><?php echo $row->user_name ?></a></small>
				<div class="">
							<?php echo strip_tags(substr($row->body, 0,350))?>..
				</div>
				<?php
					}
				}
				?>
				<h4><a href="<?php echo site_url('kategori/kode/'.$row->category_id) ?>" class="more">Berita sebelumnya <i class="fa fa-angle-right"></i></a></h4>
	<!--BARU AKHIR -->			
      </div>
      
      <div class="w3-container w3-card-2 w3-white w3-round w3-margin">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>	
      </div>

      <div class="w3-container w3-card-2 w3-white w3-round w3-margin">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>	
      </div>
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="w3-col m3">
      
      <div class="w3-card-2 w3-round w3-white w3-center">
        <div class="w3-container"><h4>Kalender</h4>
          <div class="w3-row w3-opacity">




        <div class="metro">
        <div id="kalender" class="calendar small" style="width:100%"></div>
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
	  
          </div>
        </div>
      </div>
      <br>
      
      <div class="w3-card-2 w3-round w3-white w3-padding-16 w3-center">
	  <!--BARU AWAL-->
				<h4 class="widget-title"><i class="fa fa-arrow-circle-o-right widget-title-icon"></i> banner</h4>
				<?php
				if($banner) {
					foreach ($banner->result() as $b) {
					echo "<p><a href='".$b->link."' target='_blank'><img src='".base_url('uploads/banner/'.$b->banner_file)."' alt='".$b->title."' width='100%'/></a></p>";
					}
				}
				?>
	<!--BARU AKHIR-->			
      </div>
      <br>
      
      <div class="w3-card-2 w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i></p>
      </div>
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
<!--BARU AWAL -->
	<div class="w3-container w3-third">
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
	</div>
	<div class="w3-container w3-third">
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

	</div>
	<div class="w3-container w3-third">	

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
<!--BARU AKHIR -->			
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="http://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 5500);
}

</script>

</body>
</html>

