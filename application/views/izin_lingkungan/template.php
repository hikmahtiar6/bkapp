<!DOCTYPE HTML>
<html>
	<head>
		<link rel="icon" href="<?php echo base_url('assets/css/image/kotabogor.png') ?>">
	    <!-- Bootstrap 3.3.2 -->
	    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	    <!-- Font Awesome Icons -->
	    <link href="<?php echo base_url()?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    	<!-- DATA TABLES -->
    	<link href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	    <link href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
		
		<script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('asset_app/js/app.js'); ?>"></script>
		<script type="text/javascript">
			window.APP.baseUrl("<?php echo base_url(); ?>");
		</script>

		<!-- Map -->
		<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>assets/gmaps/css/style.css"/>
	    <link type="text/css" rel="stylesheet" href="<?php echo base_url()?>assets/gmaps/css/jquery-position-picker.css"/>
		<script src="<?php echo base_url()?>assets/gmaps/js/OpenLayers.js"></script>
	   	<script src="<?php echo base_url()?>assets/gmaps/js/jquery-position-picker.debug.js"></script>
	

	   	<style>
	    	a{
	    		text-decoration: none;
	    		color: white;
	    	}

	    	.perizinan-box{
	    		width:30%;
	    		height:100%; 
	    		background-color:green; 	    		
	    		text-align:center; 
	    		padding :4%;    		
	    		margin:1%;
	    		float:left;
	    	}
	    	.menu{
	    		float: left;
	    		height: 100%;
	    		padding:1%;
	    	}
	    	.menu:hover{
				background-color: green;
				transition: all ease 0.5s;
			}
	    </style>
		<title>Form Perizinan Lingkungan</title>
	</head>
	<body style="background:#f4f4f4">
	<!-- HEADER -->
		<div class="section" style="background:#15A531;" >
		<div class="container" id="header">
		    <div class="col-md-9 col-sm-8 col-xs-10">
		      <div class="logo clearfix" style="margin:1% 0%;">
		      <?php echo "<img src='".base_url('uploads/logo.png')."' class='img-responsive pull-left' style='width:40%;'/>"; ?>
		      </div>
		    </div>
		</div>
		</div>
	<!-- END HEADER -->


	<div class="section" style="background:#f4f4f4">
		<div class="container">
			<div class="row" style="padding-top:20px;">
				<!-- HEAD -->
					<div class="col-md-12 col-sm-14 right-padding-2 section" style="margin-bottom:1%;" >
						<div style="background:#15A531; padding-left:2%;color:white; box-shadow:0px 4px 0px 0px yellow; height:45px;">
							<div class="menu">
								<a href="<?php echo site_url('dashboard_member');?>">Dashboard</a>
							</div>
							<div class="menu">
								<a href="<?php echo site_url('pemohon');?>">Pemohon</a>
							</div>
							<div class="menu">
								<a href="<?php echo site_url('perusahaan');?>">Perusahaan</a>
							</div>
							<!-- <div class="menu">
								<a href="<?php echo site_url('dokumen_pemohon/index/'.md5(0));?>">Dokumen Pemohon</a>
							</div>
							<div class="menu">
								<a href="<?php echo site_url('dokumen_perusahaan/index/'.md5(0));?>">Dokumen Perusahaan</a>
							</div> -->
							<div class="menu">
								<a href="<?php echo site_url('dokumen_member/index/'.md5(0));?>">Dokumen Member</a>
							</div>              
							<div class="menu" style="float:right;">
								<a href="<?php echo site_url('login_daftar_member/logout') ?>"><b>Logout</b></a>
							</div>
							
						</div>
					</div>
				<!-- END HEAD -->

				<!-- KONTEN -->
						<?php $this->load->view($konten) ; ?>
				<!-- END KONTEN -->

				<!-- SIDE BAR -->
					<!-- <div style="float:right;"> -->
						<div class="col-md-4 col-sm-4 left-padding-5" style="float:right;">
							<div style="background:#15A531; padding:1%; padding-left:5%; margin-bottom:7px; color:white;box-shadow:0px 3px 0px 0px yellow;">
								<h4><b>User</b></h4>
							</div>
							<div style="background:#fff; padding:3%; margin-bottom:2px;" >
								<table class="table table-bordered table-striped">

									<?php
										$id = $this->session->userdata('member_id');
										$sql = $this->supermodel->queryManual("select * from member WHERE member_id = '".$id."'");
										if($sql->num_rows()>0) {
											$no=1;
											foreach ($sql->result() as $r) {
									?>
									<tr>
										<th>Nama Lengkap</th>
										<td>:</td>
										<th><?php echo $r->nama ?></th>
									</tr>
									<tr>
										<th>Alamat</th>
										<td>:</td>
										<td><?php echo $r->alamat ?></td>
									</tr>
									<tr>
										<th>NIK</th>
										<td>:</td>
										<td><?php echo $r->nik ?></td>
									</tr>
									<tr>
										<th>Alamat Email</th>
										<td>:</td>
										<td><?php echo $r->email ?></td>
									</tr>
									<?php }} ?>
								</table>
							</div>
						</div>

						<div class="col-md-4 col-sm-4 left-padding-5" style="margin-top:1%;float:right;">
							<div style="background:#15A531; padding:1%; padding-left:5%; margin-bottom:7px; color:white;box-shadow:0px 3px 0px 0px yellow;">
								<h4><b>Notifikasi</b></h4>
							</div>
							<div style="background:#fff; padding:3%; margin-bottom:2px;">
								<table>
									<tr>
										<td><h5><mark>*<small>Belum dibaca</small></mark></h5></td>
									</tr>
									<tr>
										<td>Kesalahan Pada Berkas Yang ke bla bla bla bla bla bla bla bla | 24-02-2016 11:30 </td>
									</tr>
								</table>
							</div>

							<div style="background:#fff; padding:3%;">
								<table>
									<tr>
										<td>Kesalahan Pada Berkas Yang ke bla bla bla bla bla bla bla bla | 24-02-2016 11:30 </td>
									</tr>
								</table>
							</div>
						</div>
					<!-- </div> -->
				<!-- END SIDE BAR -->
			</div>
			<div class="row padding-y-10"></div>
	</div>


<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/dist/js/app.min.js" type="text/javascript"></script>


<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
      });

      $(function () {
        $("#example2").dataTable();
      });

      $(function () {
        $("#example3").dataTable();
      });
    </script>
	</body>
</html>