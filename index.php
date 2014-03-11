<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Heatmaps</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=visualization"></script>
    <script>
// Adding 500 Data Points
var map, pointarray, heatmap, new_alumdata;
var alumdata = [
<?php
	require 'connectDB.php';
	if (!$majorchange=$db->query("UPDATE currmajor SET Major = 'All' WHERE ID='0'"))
		die('There was an error connecting: queryError [' .$db->error . ']');

	if(!$entry=$db->query("SELECT * FROM trial"))
		die('There was an error connecting: queryError [' . $db->error . ']');
		
	while($onealum=$entry->fetch_assoc()){
		$name = $onealum['Name'];
		$major = $onealum['Major'];
		$class = $onealum['Class'];
		$longitude = $onealum['Longitude'];
		$latitude = $onealum['Latitude'];
		print <<<HTMLBlock
		  new google.maps.LatLng($latitude, $longitude),
HTMLBlock;
	}
?>
];
function initialize() {
  var mapOptions = {
    zoom: 2,
    center: new google.maps.LatLng(32.8807, -117.2359),
    mapTypeId: google.maps.MapTypeId.SATELLITE
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var pointArray = new google.maps.MVCArray(alumdata);

  heatmap = new google.maps.visualization.HeatmapLayer({
    data: pointArray
  });

  heatmap.setMap(map);
}

function toggleHeatmap() {
  heatmap.setMap(heatmap.getMap() ? null : map);
}

function changeGradient() {
  var gradient = [
    'rgba(0, 255, 255, 0)',
    'rgba(0, 255, 255, 1)',
    'rgba(0, 191, 255, 1)',
    'rgba(0, 127, 255, 1)',
    'rgba(0, 63, 255, 1)',
    'rgba(0, 0, 255, 1)',
    'rgba(0, 0, 223, 1)',
    'rgba(0, 0, 191, 1)',
    'rgba(0, 0, 159, 1)',
    'rgba(0, 0, 127, 1)',
    'rgba(63, 0, 91, 1)',
    'rgba(127, 0, 63, 1)',
    'rgba(191, 0, 31, 1)',
    'rgba(255, 0, 0, 1)'
  ]
  heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
}

function changeRadius() {
  heatmap.set('radius', heatmap.get('radius') ? null : 20);
}

function changeOpacity() {
  heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>

  <body>
    <div id="panel">
      <button onclick="toggleHeatmap()">Toggle Heatmap</button>
      <button onclick="changeGradient()">Change gradient</button>
      <button onclick="changeRadius()">Change radius</button>
      <button onclick="changeOpacity()">Change opacity</button>
	  <select id = "major" onchange = "jsfunction()">
			<option value = "All">All</option>
			<option value = "compsci">Computer Science</option>
			<option value = "econ">Economics</option>
	  </select>
	</div>
    <div id="map-canvas"></div>
  </body>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script>
	function jsfunction(){
		var major = $('#major').find(":selected").text();
		alert(major);
		new_alumdata = [ 
			$.ajax({
				url: 'Major.php',
				type: 'POST'
				data: { major : major },
				success: function (data) {	
					alert("Successfulfulfulf");
				}
			})
		];
		
		//initialize_again();
	
		
	}
	function initialize_again() {
  var mapOptions = {
    zoom: 2,
    center: new google.maps.LatLng(32.8807, -117.2359),
    mapTypeId: google.maps.MapTypeId.SATELLITE
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var pointArray = new google.maps.MVCArray(new_alumdata);

  heatmap = new google.maps.visualization.HeatmapLayer({
    data: pointArray
  });

  heatmap.setMap(map);
}

	</script>
		