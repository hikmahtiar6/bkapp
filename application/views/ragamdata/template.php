<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BPLH Kota Bogor</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" href="<?php echo base_url('uploads/'.$icon_site) ?>">
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/css/admin.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  </head>
  <body class="skin-green">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <header class="main-header">
        <div class="bg-green atas clearfix">
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
            <h2 class="title-top"><a href="<?php echo site_url() ?>">BADAN PENGELOLAAN LINGKUNGAN HIDUP</a></h2>
            <p>KOTA BOGOR</p>
          </div>
          -->
        </div>
      </header>


      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar side-gis">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <ul class="sidebar-menu menu">
            <li class="header">NAVIGASI</li>
            <li><a href="<?php echo site_url() ?>"><i class="fa fa-home"></i> Beranda</a></li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-angle-double-right"></i> <span>Pengendalian PLH</span>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="#"><i class="fa fa-angle-right"></i> Hasil Pengujian</a>
                  <ul class="treeview-menu">
                    <li><a href="#" id="sungai"><i class="fa fa-circle-o"></i> Air Sungai</a></li>
                    <li><a href="#" id="sumur"><i class="fa fa-circle-o"></i> Air Sumur</a></li>
                    <li><a href="#" id="situ"><i class="fa fa-circle-o"></i> Air Situ</a></li>
                    <li><a href="#" id="ambien"><i class="fa fa-circle-o"></i> Ambien</a></li>
                    <li><a href="#" id="cerobong"><i class="fa fa-circle-o"></i> Emisi Cerobong</a></li>
                    <li><a href="#" id="kendaraan"><i class="fa fa-circle-o"></i> Emisi Kendaraan</a></li>
                    <li><a href="#" id="tanah"><i class="fa fa-circle-o"></i> Tanah</a></li>

                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Upaya Pengendalian</a>
                  <ul class="treeview-menu">
                    <li><a href="#" id="pengawasan_b3"><i class="fa fa-circle-o"></i> Pengawasan B3</a></li>
                    <li><a href="#" id="pembangun_limbah_cair"><i class="fa fa-circle-o"></i> Pengawasan Limbah Cair</a></li>
                    <li><a href="#" id="pembangunan_biogas"><i class="fa fa-circle-o"></i> Pembangunan Biogas</a></li>
                  </ul>
                </li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-angle-double-right"></i> <span>Konservasi Sumber Daya Alam </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" id="mata_air"><i class="fa fa-circle-o"></i> Mata Air</a></li>
                <li><a href="#" id="sumur_pantau"><i class="fa fa-circle-o"></i> Sumur Pantau</a></li>
                <li><a href="#" id="perusahaan_pengguna_air_tanah"><i class="fa fa-circle-o"></i> Perusahaan Penggunaan Air Tanah</a></li>
                <li><a href="#" id="sumur_imbuhan"><i class="fa fa-circle-o"></i> Sumur Imbuhan</a></li>
                <li><a href="#" id="hutan_kota"><i class="fa fa-circle-o"></i> Hutan Kota (Arboretrum)</a></li>
                <li><a href="#" id="sehati"><i class="fa fa-circle-o"></i> SEHATI</a></li>
                <li><a href="#" id="kehati"><i class="fa fa-circle-o"></i> KEHATI</a></li>
                <li><a href="#" id="pemerhati"><i class="fa fa-circle-o"></i> PEMERHATI</a></li>
                <li><a href="#" id="sumur_resapan"><i class="fa fa-circle-o"></i> Sumur Resapan</a></li>
              </ul>
            </li>

            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-angle-double-right"></i> <span>Kemitraan Lingkungan Hidup</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" id="adipura"><i class="fa fa-circle-o"></i> Titik Pantau Adipura</a></li>
                <li><a href="#" id="sekolah_adiwiyata"><i class="fa fa-circle-o"></i> Sekolah Adiwiyata</a></li>
              </ul>
            </li>
             <li class="treeview">
              <a href="#">
                <i class="fa fa-angle-double-right"></i> <span>Perizinan</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" id="sppl"><i class="fa fa-circle-o"></i> Data SPPL</a></li>
                <li><a href="#" id="amdal"><i class="fa fa-circle-o"></i> Data Amdal</a></li>
                <li><a href="#" id="ukl-upl"><i class="fa fa-circle-o"></i> Data UKL-UPL</a></li>
                <li><a href="#" id="izin_lc"><i class="fa fa-circle-o"></i> Data Izin Limbah Cair</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-angle-double-right"></i> <span>Trend Pengujian</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" id="trend_sungai"><i class="fa fa-circle-o"></i> Sungai</a></li>
                <li><a href="#" id="trend_situ"><i class="fa fa-circle-o"></i> Situ</a></li>
                <li><a href="#" id="trend_sumur"><i class="fa fa-circle-o"></i> Sumur</a></li>
                <li><a href="#" id="trend_ambien"><i class="fa fa-circle-o"></i> Emisi Ambien</a></li>
                <li><a href="#" id="trend_cerobong"><i class="fa fa-circle-o"></i> Emisi Cerobong</a></li>
              </ul>
            </li>

          </ul>
          
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper" id="konten">
        <section class="content">
          <div class="jumbotron well">
            <h1>Selamat Datang</h1>
            <p>Anda berada di halaman ragam data.</br>
            1. Halaman ini berisi data berbentuk tabel dan informasi yang ada pada BPLH Kota Bogor.</p>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

    </div><!-- ./wrapper -->


    <div id="loading">
      <img src="<?php echo base_url('assets/dist/img/load.gif')?>">
    </div>

    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url()?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <!--<script src="<?php echo base_url()?>assets/dist/js/ragamdata.js" type="text/javascript"></script>-->

    <script type="text/javascript">
      $('#dp2').datepicker({ format: 'yyyy-mm-dd' });
    </script>

    <script>
    $("#trend_sungai").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('trend/sungai')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#trend_situ").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('trend/situ')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#trend_sumur").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('trend/sumur')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#trend_ambien").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('trend/ambien')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#trend_cerobong").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('trend/cerobong')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });


    // Menu awal
    $("#sungai").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/sungai')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#situ").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/situ')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#sumur").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/sumur')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#ambien").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/ambien')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#mata_air").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/mata_air')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#sumur_pantau").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/sumur_pantau')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#perusahaan_pengguna_air_tanah").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/pemanfaatan_air')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#sumur_imbuhan").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/sumur_imbuhan')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#hutan_kota").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/hutan_kota')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#sehati").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/sehati')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#kehati").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/kehati')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#pemerhati").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/pemerhati')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#sumur_resapan").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/sumur_resapan')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#sekolah_adiwiyata").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/sekolah_adiwiyata')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#adipura").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/adipura')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#pembangunan_biogas").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/biogas')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    $("#tanah").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/tanah')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });

    $("#pembangun_limbah_cair").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/limbah_cair')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
     $("#cerobong").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/cerobong')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });

     $("#ambien").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/ambien')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });

     $("#pengawasan_b3").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/pengawasan_b3')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });

      $("#sppl").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/sppl')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });

      $("#amdal").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/amdal')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });

      $("#ukl-upl").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/ukl_upl')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });

      $("#izin_lc").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/izin_lc')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });
    
    $("#kendaraan").click(function() {
        $("#loading").show();
        $.ajax({
          url: "<?php echo site_url('ragam_data/kendaraan')?>",
          data: "",
          success: function(data) {
            $("#loading").hide();
            $("#konten").html(data);
          }
        });
      });

   
    </script>

    <style type="text/css">
    #loading {
      position: absolute;
      z-index: 9999;
      top: 300px;
      left: 750px;
      display: none;
    }
    </style>
  </body>
</html>