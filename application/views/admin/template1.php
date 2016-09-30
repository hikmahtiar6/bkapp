<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  
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
  <body>
    <!-- Site wrapper -->
    <div class="wrapper">
 
        <?php $this->load->view($konten)?>
  

     
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

    

    
      
    </script>


  </body>
</html>