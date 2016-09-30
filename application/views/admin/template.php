<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo $title ?> | Administrator</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="<?php echo base_url()?>assets/bootstrap/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url()?>assets/css/admin.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url()?>assets/plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?libraries=drawing, geometry"></script>
  <script type="text/javascript">
  var infoWindows;
  var map;
  
  function load() {
    var mapOptions = {
      center: new google.maps.LatLng(-6.598619,106.799977),
        zoom: 14,
        mapTypeId: 'roadmap',
        disableDefaultUI:true,
        zoomControl:true
    };

    infoWindows = new google.maps.InfoWindow();

    map = new google.maps.Map(document.getElementById("petak"), mapOptions);

    var drawing = new google.maps.drawing.DrawingManager({
      drawingControl : true,
      drawingControlOption : {
        drawingModes : [
          google.maps.drawing.OverlayType.POLYGON,
          google.maps.drawing.OverlayType.POLYLINE
        ]
      }
    });

    google.maps.event.addListener(drawing, 'polygoncomplete', function (polygon) {
      var corodinates = polygon.getPath().getArray();
      alert(corodinates);
      simpan(corodinates);
      window.poly = polygon;
    });

    drawing.setMap(map);

  }

  google.maps.event.addDomListener(window, 'load', load);

  function simpan(corodinates) {
    var text = document.getElementById('kordinat');
    text.value = google.maps.geometry.encoding.encodePath(corodinates);
  }


  </script>
  </head>
  <body class="skin-green">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <header class="main-header">
        <a href="#" class="logo"><i><b>Web Admin</b>istrator</i></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user"></i>
              <?php echo $this->session->userdata('name') ?>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('adminweb/edit_profile')?>"><i class="fa fa-gear"></i> Pengaturan Profil</a></li>
              <li><a href="<?php echo site_url('adminweb/logout')?>"><i class="fa fa-lock"></i> Keluar</a></li>
            </ul>
            </li>
          </ul>
        </div>

        </nav>

      </header>


      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url('assets/dist/img/avatar.png')?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?php echo $this->session->userdata('name') ?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> <?php level($this->session->userdata('userlvl')) ?></a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->

          <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            <li><a href="<?php echo site_url('adminweb/')?>"><i class="fa fa-dashboard "></i> Dashboard</a></li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i> <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('category') ?>"><i class="fa fa-file"></i> Kategori</a></li>
                <li><a href="<?php echo site_url('user') ?>"><i class="fa fa-group"></i> User</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i> <span>Konten </span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('post/category/0')?>"><i class="fa fa-table"></i> Data Statis</a></li>
                <li><a href="<?php echo site_url('post/category/1')?>"><i class="fa fa-table"></i> Data Dinamis</a></li>
                <li><a href="<?php echo site_url('post/category/2')?>"><i class="fa fa-table"></i> Data Media</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-globe"></i> <span>Ragam Data</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Data Hasil Pengujian <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> AIR <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo site_url('adm_sungai')?>"><i class="fa fa-circle-o"></i> Sungai</a></li>
                        <li><a href="<?php echo site_url('adm_sumur')?>"><i class="fa fa-circle-o"></i> Sumur</a></li>
                        <li><a href="<?php echo site_url('adm_situ')?>"><i class="fa fa-circle-o"></i> Situ</a></li>
                      </ul>
                    </li>
                    <li>
                      <a href="#"><i class="fa fa-circle-o"></i> UDARA <i class="fa fa-angle-left pull-right"></i></a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo site_url('adm_cerobong')?>"><i class="fa fa-circle-o"></i> Emisi Cerobong</a></li>
                        <li><a href="<?php echo site_url('adm_kendaraan')?>"><i class="fa fa-circle-o"></i> Emisi Kendaraan</a></li>
                        <li><a href="<?php echo site_url('adm_ambien')?>"><i class="fa fa-circle-o"></i> Ambien</a></li>
                      </ul>
                    </li>
                    <li><a href="<?php echo site_url('adm_tanah')?>"><i class="fa fa-circle-o"></i> TANAH</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Data Upaya Pengendalian <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('adm_b3')?>"><i class="fa fa-circle-o"></i> Pengawasan B3</a></li>
                    <li><a href="<?php echo site_url('adm_limbah_cair')?>"><i class="fa fa-circle-o"></i> Pengawasan Limbah Cair</a></li>
                    <li><a href="<?php echo site_url('adm_biogas')?>"><i class="fa fa-circle-o"></i> Pembagunan Biogas</a></li>
                  </ul>
                </li>
                <li>
                  <a href="#"><i class="fa fa-circle-o"></i> Konservasi <i class="fa fa-angle-left pull-right"></i></a>
	                  <ul class="treeview-menu">
	                    <li><a href="<?php echo site_url('adm_mata_air')?>"><i class="fa fa-circle-o"></i> Data Mata Air</a></li>
	                    <li><a href="<?php echo site_url('adm_perusahaan_pengguna_air')?>"><i class="fa fa-circle-o"></i> Data Sebaran Perusahaan yang Memanfaatkan Air Tanah</a></li>
	                    <li><a href="<?php echo site_url('adm_sumur_pantau')?>"><i class="fa fa-circle-o"></i> Data Sumur Pantau</a></li>
	                    <li><a href="<?php echo site_url('adm_sumur_resapan')?>"><i class="fa fa-circle-o"></i> Data Sumur Resapan</a></li>
	                    <li><a href="<?php echo site_url('adm_sumur_imbuhan')?>"><i class="fa fa-circle-o"></i> Data Sumur Imbuhan</a></li>
	                    <li><a href="<?php echo site_url('adm_sehati')?>"><i class="fa fa-circle-o"></i> Data Sehati</a></li>
	                    <li><a href="<?php echo site_url('adm_kehati')?>"><i class="fa fa-circle-o"></i> Data Kehati</a></li>
	                    <li><a href="<?php echo site_url('adm_pemerhati')?>"><i class="fa fa-circle-o"></i> Data Pemerhati</a></li>
	                    <li><a href="<?php echo site_url('adm_hutan')?>"><i class="fa fa-circle-o"></i> Data Hutan Kota</a></li>
	                  </ul>
                </li>
                <li>
                	<a href="#"><i class="fa fa-circle-o"></i> Kemitraan <i class="fa fa-angle-left pull-right"></i></a>
                	<ul class="treeview-menu">
                		<li><a href="<?php echo site_url('adm_adipura')?>"><i class="fa fa-circle-o"></i> Titik Pantau Adipura</a></li>
	                    <li><a href="<?php echo site_url('adm_adiwiyata')?>"><i class="fa fa-circle-o"></i> Sekolah Adiwiyata</a></li>
                	</ul>
                </li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart-o"></i> <span> Chart</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Pengujian Air Sungai <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo site_url('adm_sungai/chart')?>"><i class="fa fa-circle-o"></i> Chart Perlokasi</a></li>
                      <li><a href="<?php echo site_url('adm_sungai/chart_tahun')?>"><i class="fa fa-circle-o"></i> Chart Pertahun</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Pengujian Air Situ <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                      <li><a href="<?php echo site_url('adm_situ/chart')?>"><i class="fa fa-circle-o"></i> Chart Perlokasi</a></li>
                      <li><a href="<?php echo site_url('adm_situ/chart_tahun')?>"><i class="fa fa-circle-o"></i> Chart Pertahun</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Pengujian Air Sumur <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                      <li><a href="<?php echo site_url('adm_sumur/chart')?>"><i class="fa fa-circle-o"></i> Chart Perlokasi</a></li>
                      <li><a href="<?php echo site_url('adm_sumur/chart_tahun')?>"><i class="fa fa-circle-o"></i> Chart Pertahun</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Pengujian Emisi Cerobong <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                      <li><a href="<?php echo site_url('adm_cerobong/chart')?>"><i class="fa fa-circle-o"></i> Chart Perlokasi</a></li>
                      <li><a href="<?php echo site_url('adm_cerobong/chart_tahun')?>"><i class="fa fa-circle-o"></i> Chart Pertahun</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-circle-o"></i> Pengujian Emisi Ambien <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                      <li><a href="<?php echo site_url('adm_ambien/chart')?>"><i class="fa fa-circle-o"></i> Chart Perlokasi</a></li>
                      <li><a href="<?php echo site_url('adm_ambien/chart_tahun')?>"><i class="fa fa-circle-o"></i> Chart Pertahun</a></li>
                    </ul>
                </li>
              </ul>
            </li>


          <!--  <li class="treeview">
              <a href="#">
                <i class="fa fa-archive"></i> <span> Perizinan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('adm_sppl_baru')?>"><i class="fa fa-circle-o"></i> SPPL</a></li>
                <li><a href="<?php echo site_url('adm_sppl')?>"><i class="fa fa-circle-o"></i> Pendaftaran SPPL Baru</a></li>
                <li><a href="<?php echo site_url('adm_amdal')?>"><i class="fa fa-circle-o"></i> AMDAL</a></li>
                <li><a href="<?php echo site_url('adm_uklupl')?>"><i class="fa fa-circle-o"></i> UKL-UPL</a></li>
                <li><a href="<?php echo site_url('adm_izin_lc')?>"><i class="fa fa-circle-o"></i> Izin Limbah Cair</a></li>
              </ul>
            </li>-->
            <li class="treeview">
              <a href="#">
                <i class="fa fa-list"></i> <span>Import Data Pengujian</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('adm_csv') ?>"><i class="fa fa-file"></i> Pengujian Sungai</a></li>
                <li><a href="<?php echo site_url('adm_csv') ?>"><i class="fa fa-group"></i> Pengujian Tanah</a></li>
                <li><a href="<?php echo site_url('adm_csv') ?>"><i class="fa fa-group"></i> Pengujian Situ</a></li>
                <li><a href="<?php echo site_url('adm_csv') ?>"><i class="fa fa-group"></i> Pengujian Limbah</a></li>
               
              </ul>
            </li>
           
			

            <li><a href="<?php echo site_url('album_galeri')?>"><i class="fa fa-file"></i> Album</a></li>
            <li><a href="<?php echo site_url('adm_galeri')?>"><i class="fa fa-star"></i> Galeri</a></li>
            <li><a href="<?php echo site_url('banner')?>"><i class="fa fa-picture-o"></i> Banner</a></li>
            <li><a href="<?php echo site_url('slide')?>"><i class="fa fa-arrows-alt"></i> Slide Show</a></li>
            <li><a href="<?php echo site_url('konfig') ?>"><i class="fa fa-cogs"></i> Pengaturan</a></li>
            
          </ul>
          
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <?php $this->load->view($konten)?>
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2015. All rights reserved.</strong>
      </footer>
    </div><!-- ./wrapper -->

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

      $('#dp2').datepicker({ format: 'yyyy-mm-dd' });
    </script>

    <script>
    var id_kec = $("#kec").val();
    var id_kel = $("#kel").val();
    if(id_kel!='') {
      $("#kelurahan").load("<?php echo site_url('adminweb/load_kelurahan?id_kec=') ?>"+id_kec+"&id_kel="+id_kel);
    }

      $("#kecamatan").change(function() {
        var kec = $("#kecamatan").val();
        $("#kelurahan").load("<?php echo site_url('adminweb/load_kelurahan?id_kec=') ?>"+kec);
      });

      var tipeGaleri = $("#tipeGaleri").val();
      if(tipeGaleri=="Foto") {
        $("#foto").show();
        $("#video").hide();
      } else if(tipeGaleri=="Video") {
        $("#video").show();
        $("#foto").hide();
      } else if(tipeGaleri=="pilih"){
        $("#video").show();
        $("#foto").show();
      }
      
      $("#tipeGaleri").change(function(){
      	var tipeGaleri = $("#tipeGaleri").val();
    	if(tipeGaleri=="Foto") {
    		$("#foto").show();
    		$("#video").hide();
    	} else if(tipeGaleri=="Video") {
    		$("#video").show();
    		$("#foto").hide();
    	} else if(tipeGaleri=="pilih"){
    		$("#video").show();
    		$("#foto").show();
    	}

      });

    
      
    </script>


  </body>
</html>