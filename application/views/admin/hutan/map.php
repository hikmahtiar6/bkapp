<!DOCTYPE html>
<html>
<head>
	<title>Tampilkan Map</title>
	<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry"></script>
<script>

    var map;
    var infoWindow;
    var decodedPolygon = [];

    function initialize() {
  var mapOptions = {
      center: new google.maps.LatLng(-6.598619,106.799977),
        zoom: 13,
        mapTypeId: 'roadmap'
  };
  infoWindow = new google.maps.InfoWindow();

  map = new google.maps.Map(document.getElementById('peta'),
      mapOptions);

  downloadUrl("<?php echo site_url('adm_hutan/xmlmap/'.$id)?>", function(data) {
    var xml = data.responseXML;
    var markers = xml.documentElement.getElementsByTagName("marker");
    var bounds = new google.maps.LatLngBounds();
      for (var i = 0; i < markers.length; i++) {
        var encodedPath = markers[i].getAttribute("coords");
        var warna = markers[i].getAttribute("warna");
        var name = markers[i].getAttribute("nama");

        var decodedPolygon = google.maps.geometry.encoding.decodePath(encodedPath);
        for (var j = 0; j < decodedPolygon.length; j++) {
          bounds.extend(decodedPolygon[j]);
        }
        var html = "<div style='height:auto;font-weight:500;text-align:center'>" + name + "</div>";
        // Construct the polygon.
        var bermudaTriangle = new google.maps.Polygon({
            paths: decodedPolygon,
            strokeColor: warna,
            strokeOpacity: 0.8,
            strokeWeight: 3,
            fillColor: warna,
            fillOpacity: 0.35
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
        infoWindow.setContent(html);
        infoWindow.open(map);
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

	<style type="text/css">
  #peta {
    height: 420px;
    width: 500px;
    margin-left: auto;
    margin-right: auto;
  }
  </style>
</head>
<body>
	<div id="peta"></div>
</body>
</html>