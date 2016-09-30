<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<body>
  <div id="map" style="height:500px; width:100%; background:#ccc; margin-top:10px;">
  </div>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url()?>assets/plugins/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
  <script src="<?php echo base_url()?>assets/plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
  <script type="text/javascript">
 
    function load_map() {
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(-6.598619,106.799977),
        zoom: 14,
        mapTypeId: 'roadmap',
        panControl: false,
        scaleControl: false,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL
        }

      });
      var infoWindow = new google.maps.InfoWindow;
 
      // Bagian ini digunakan untuk mendapatkan data format XML yang dibentuk dalam dataLokasi.php
      downloadUrl("<?php echo site_url('mapsxml/'.$linked); ?>", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var id = markers[i].getAttribute("id");
          var icon_map = '<?php echo base_url("assets/gmaps/images/icon.png")?>';
 
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<?php echo site_url('ragamdata/adipura') ?>/"+id;
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon_map
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }
    
    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        //infoWindow.setContent(html);
        //infoWindow.open(map, marker);
        $.fancybox({
          'href' : html,
          'overlayShow' : false,
          'transitionIn'  : 'elastic',
          'transitionOut' : 'elastic',
          'type' : 'iframe',
          'padding':  0,
          'width':    400
        });
      });
    }
 
    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;
 
      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };
 
      request.open('GET', url, true);
      request.send(null);
    }
 
    function doNothing() {}

    google.maps.event.addDomListener(window, 'load', load_map);
  </script>
</body>
</html>