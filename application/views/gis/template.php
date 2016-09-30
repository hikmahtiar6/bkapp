<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BPLH Kota Bogor | Web GIS</title>
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
            <h2 class="title-top"><a href="<?php echo site_url() ?>">Sistem informasi lingkungan hidup</a></h2>
            <p>bplh kota bogor</p>
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
            <li class="treeview">
              <a href="#">
                <i class="fa fa-angle-double-right"></i> <span>Pengendalian PLH</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-angle-right"></i> Hasil Pengujian</a>
                  <ul class="treeview-menu">
                    <li><a href="#" id="sungai"><i class="fa fa-circle-o"></i> Air Sungai</a></li>
                    <li><a href="#" id="sumur"><i class="fa fa-circle-o"></i> Air Sumur</a></li>
                    <li><a href="#" id="situ"><i class="fa fa-circle-o"></i> Air Situ</a></li>
                    <li><a href="#" id="emisi_cerobong"><i class="fa fa-circle-o"></i> Emisi Cerobong</a></li>
                    <li><a href="#" id="emisi_ambien"><i class="fa fa-circle-o"></i> Emisi Ambien</a></li>
                    <li><a href="#" id="tanah"><i class="fa fa-circle-o"></i> Tanah</a></li>
                  </ul>
                </li>
                <li><a href="#"><i class="fa fa-angle-right"></i> Upaya Pengendalian</a>
                  <ul class="treeview-menu">
                    <li><a href="#" id="pengawasan_b3"><i class="fa fa-circle-o"></i> Pengawasan B3</a></li>
                    <li><a href="#" id="limbah_cair"><i class="fa fa-circle-o"></i> Pengawasan Limbah Cair</a></li>
                    <li><a href="#" id="pembangunan_biogas"><i class="fa fa-circle-o"></i> Pembangunan Biogas</a></li>
                  </ul>
                </li>
              </ul>
            </li>

            <li class="treeview active">
              <a href="#">
                <i class="fa fa-angle-double-right"></i> <span>Konservasi Sumber Daya Alam </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" id="mata_air"><i class="fa fa-circle-o"></i> Mata Air</a></li>
                <li><a href="#" id="perusahaan_pengguna_air_tanah"><i class="fa fa-circle-o"></i> Perusahaan Penggunaan Air Tanah</a></li>
                <li><a href="#" id="sumur_pantau"><i class="fa fa-circle-o"></i> Sumur Pantau</a></li>
                <li><a href="#" id="sumur_resapan"><i class="fa fa-circle-o"></i> Sumur Resapan</a></li>
                <li><a href="#" id="sumur_imbuhan"><i class="fa fa-circle-o"></i> Sumur Imbuhan</a></li>
                <li><a href="#" id="hutan_kota"><i class="fa fa-circle-o"></i> Hutan Kota (Arboretrum)</a></li>
                <li><a href="#" id="sehati"><i class="fa fa-circle-o"></i> SEHATI</a></li>
                <li><a href="#" id="kehati"><i class="fa fa-circle-o"></i> KEHATI</a></li>
                <li><a href="#" id="pemerhati"><i class="fa fa-circle-o"></i> PEMERHATI</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-angle-double-right"></i> <span>Pengawasan Dampak Lingkungan</span>
              </a>
              <ul class="treeview-menu">
                <li><a href="http://bplh.dreamcube.co.id/peta" target="_blank"><i class="fa fa-circle-o"></i> Peta Kegiatan Usaha</a></li>
                <li><a href="http://bplh.dreamcube.co.id/peta" target="_blank"><i class="fa fa-circle-o"></i> Peta UKM</a></li>
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

          </ul>
          
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <section class="content-header">
          <h1 id="title">
            Ragam Data
          </h1>
          <ol class="breadcrumb">
            <form>
              <input type="hidden" id="url" name="url">
              <label>Filter berdasarkan : </label>
              <select id="kecamatan" name="kecamatan">
                <option value="">- Pilih Kecamatan -</option>
                <?php
                if($kecamatan->num_rows()>0) {
                  foreach ($kecamatan->result() as $rows) {
                    ?>
                    <option value="<?php echo $rows->kecamatan_id ?>"><?php echo $rows->kecamatan_nama ?></option>
                    <?php
                  }
                }
                ?>
              </select>
              <select id="kelurahan" name="kelurahan">
                <option value="">-Pilih Kelurahan-</option>
              </select>
              <select id="tahun" name="tahun">
                <option value="">-Pilih Tahun-</option>
                <?php
                for ($i=date('Y'); $i >= 2000 ; $i--) { 
                ?>
                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php
                }
                ?>
              </select>
            </form>
          </ol>
        </section>
        <div id="konten">
        <section class="content">
          <div class="jumbotron well">
            <h1>Selamat Datang</h1>
            <p>Anda berada di halaman Sistem Informasi Geografis.</br>
            1. Halaman ini berisi data berbentuk titik dan informasinya.</br>
            2. Halaman ini berisi data berbentuk Area dan informasinya.</br></p>
          </div>
        </section>
        </div>
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <strong>Copyright &copy; 2015 BPLH. All Right Received.</strong>
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url()?>assets/dist/js/app.min.js" type="text/javascript"></script>

    <script type="text/javascript">
      $('#dp2').datepicker({ format: 'yyyy-mm-dd' });
    </script>
    <script>
      $("#mata_air").click(function() {
        $("#title").text("Data Mata Air");
        document.getElementById('url').value = "mata_air";
        $("#konten").load("<?php echo site_url('gis/mata_air') ?>");
      });
      $("#sumur_pantau").click(function() {
        $("#title").text("Data Sumur Pantau");
        document.getElementById('url').value = "sumur_pantau";
        $("#konten").load("<?php echo site_url('gis/sumur_pantau') ?>");
      });
      $("#sumur_imbuhan").click(function() {
        $("#title").text("Data Sumur Imbuhan");
        document.getElementById('url').value = "sumur_imbuhan";
        $("#konten").load("<?php echo site_url('gis/sumur_imbuhan') ?>");
      });
      $("#sumur_resapan").click(function() {
        $("#title").text("Data Sumur Resapan");
        document.getElementById('url').value = "sumur_resapan";
        $("#konten").load("<?php echo site_url('gis/sumur_resapan') ?>");
      });
      $("#perusahaan_pengguna_air_tanah").click(function() {
        $("#title").text("Data Perusahaan Pengguna Air Tanah");
        document.getElementById('url').value = "perusahaan_pengguna_air_tanah";
        $("#konten").load("<?php echo site_url('gis/perusahaan_pengguna_air_tanah') ?>");
      });
      $("#sehati").click(function() {
        $("#title").text("Data SEHATI");
        document.getElementById('url').value = "sehati";
        $("#konten").load("<?php echo site_url('gis/sehati') ?>");
      });
      $("#kehati").click(function() {
        $("#title").text("Data KEHATI");
        document.getElementById('url').value = "kehati";
        $("#konten").load("<?php echo site_url('gis/kehati') ?>");
      });
      $("#pemerhati").click(function() {
        $("#title").text("Data PEMERHATI");
        document.getElementById('url').value = "pemerhati";
        $("#konten").load("<?php echo site_url('gis/pemerhati') ?>");
      });
      $("#pembangunan_biogas").click(function() {
        $("#title").text("Data Pembangunan Biogas");
        document.getElementById('url').value = "pembangunan_biogas";
        $("#konten").load("<?php echo site_url('gis/pembangunan_biogas') ?>");
      });
      $("#pengawasan_b3").click(function() {
        $("#title").text("Data Pengawasan Limbah B3");
        document.getElementById('url').value = "pengawasan_b3";
        $("#konten").load("<?php echo site_url('gis/pengawasan_b3') ?>");
      });
      $("#adipura").click(function() {
        $("#title").text("Data Titik Pantau Adipura");
        document.getElementById('url').value = "adipura";
        $("#konten").load("<?php echo site_url('gis/adipura') ?>");
      });
      $("#sekolah_adiwiyata").click(function() {
        $("#title").text("Data Sekolah Adiwiyata");
        document.getElementById('url').value = "sekolah_adiwiyata";
        $("#konten").load("<?php echo site_url('gis/sekolah_adiwiyata') ?>");
      });
      $("#hutan_kota").click(function() {
        $("#title").text("Data Hutan Kota");
        document.getElementById('url').value = "hutan_kota";
        $("#konten").load("<?php echo site_url('gis/hutan_kota') ?>");
      });
      $("#emisi_cerobong").click(function() {
        $("#title").text("Data Emisi Cerobong");
        document.getElementById('url').value = "cerobong";
        $("#konten").load("<?php echo site_url('gis/cerobong') ?>");
      });
      $("#emisi_ambien").click(function() {
        $("#title").text("Data Emisi Ambien");
        document.getElementById('url').value = "ambien";
        $("#konten").load("<?php echo site_url('gis/ambien') ?>");
      });
      $("#sungai").click(function() {
        $("#title").text("Data Titik Pengujian Air Sungai");
        document.getElementById('url').value = "sungai";
        $("#konten").load("<?php echo site_url('gis/sungai') ?>");
      });
      $("#situ").click(function() {
        $("#title").text("Data Titik Pengujian Air Situ");
        document.getElementById('url').value = "situ";
        $("#konten").load("<?php echo site_url('gis/situ') ?>");
      });
      $("#sumur").click(function() {
        $("#title").text("Data Titik Pengujian Air Sumur");
        document.getElementById('url').value = "sumur";
        $("#konten").load("<?php echo site_url('gis/sumur') ?>");
      });
      $("#tanah").click(function() {
        $("#title").text("Data Titik Pengujian Tanah");
        document.getElementById('url').value = "tanah";
        $("#konten").load("<?php echo site_url('gis/tanah') ?>");
      });
      $("#limbah_cair").click(function() {
        $("#title").text("Data Titik Pengujian Limbah Cair");
        document.getElementById('url').value = "limbah_cair";
        $("#konten").load("<?php echo site_url('gis/limbah_cair') ?>");
      });


      // Select Filter

      $("#kecamatan").change(function() {
        var kec = $("#kecamatan").val();
        var kode = $("#url").val();
        var tahun = $("#tahun").val();
        $.ajax({
          url: "<?php echo site_url('gis/load_kelurahan')?>",
          data: "id_kec="+kec,
          success: function(data) {
            $("#kelurahan").html(data);
          }
        });
        $.ajax({
          url: "<?php echo site_url('gis')?>/"+kode,
          data: "kec="+kec+"&tahun="+tahun,
          success: function(data) {
            $("#konten").html(data);
          }
        });
      });

      $("#kelurahan").change(function() {
        var kec = $("#kecamatan").val();
        var kode = $("#url").val();
        var tahun = $("#tahun").val();
        var kel = $("#kelurahan").val();
        $.ajax({
          url: "<?php echo site_url('gis')?>/"+kode,
          data: "kec="+kec+"&kel="+kel+"&tahun="+tahun,
          success: function(data) {
            $("#konten").html(data);
          }
        });
      });

      $("#tahun").change(function() {
        var kec = $("#kecamatan").val();
        var kode = $("#url").val();
        var tahun = $("#tahun").val();
        var kel = $("#kelurahan").val();
        $.ajax({
          url: "<?php echo site_url('gis')?>/"+kode,
          data: "kec="+kec+"&kel="+kel+"&tahun="+tahun,
          success: function(data) {
            $("#konten").html(data);
          }
        });
      });
    </script>

  </body>
</html>