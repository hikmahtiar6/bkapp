<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/plugins/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<body>
  <div id="map" style="height:500px; width:100%; background:#ccc; margin-top:10px;">
  </div>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url()?>assets/plugins/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
  <script src="<?php echo base_url()?>assets/plugins/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=geometry"></script>
  <script type="text/javascript">

    var map;
    var infoWindow;
    var decodedPolygon = [];

    function initialize() {
  var mapOptions = {
      center: new google.maps.LatLng(-6.598619,106.799977),
        zoom: 14,
        mapTypeId: 'roadmap',
        panControl: false,
        scaleControl: false,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL
        }
  };
  infoWindow = new google.maps.InfoWindow();

  map = new google.maps.Map(document.getElementById('map'),
      mapOptions);

  downloadUrl("<?php echo site_url('mapsxml/'.$linked); ?>", function(data) {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName("marker");
    var bounds = new google.maps.LatLngBounds();
      for (var i = 0; i < markers.length; i++) {
        var id = markers[i].getAttribute("id");
        var encodedPath = markers[i].getAttribute("coords");
        var warna = markers[i].getAttribute("warna");

        var decodedPolygon = google.maps.geometry.encoding.decodePath(encodedPath);
        for (var j = 0; j < decodedPolygon.length; j++) {
          bounds.extend(decodedPolygon[j]);
        }
        var html = "<?php echo site_url('ragamdata/hutan_kota') ?>/"+id;
        // Construct the polygon.
        var bermudaTriangle = new google.maps.Polygon({
            paths: decodedPolygon,
            strokeColor: warna,
            strokeOpacity: 0.8,
            strokeWeight: 1,
            fillColor: warna,
            fillOpacity: 0.22
        });

        bermudaTriangle.setMap(map);

        bindInfoWindow(bermudaTriangle, html);
        // Add a listener for the click event.
        //google.maps.event.addListener(bermudaTriangle, 'click', showArrays);

      }
      //map.fitBounds(bounds);
    })

    
}
  
  function bindInfoWindow(bermudaTriangle, html) {
      google.maps.event.addListener(bermudaTriangle, 'click', function(event) {
        infoWindow.setPosition(event.latLng);
        //infoWindow.setContent(html);
        //infoWindow.open(map);
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

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
</body>
</html>