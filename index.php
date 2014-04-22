<!--
  FileName: index.php
  Author: Eswar Dhinakaran
  Date of Last Modification: 7 April 2014
  Languages: PHP5, Javascript, HTML5, CSS3, MySQL
  APIs: Google Maps API v3
  Description: This is the index file for this directory. It is the
                first file called in this heatmap site. It uses the
                Google Maps API to display a heatmap that is 
                populated off information in a MySQL table. It pulls
                Alumni longitude and latitude.
-->
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
var map, pointarray, heatmap, new_alumdata;
//populates the array with all the alumni information
var alumdata = [
<?php
	require 'connectDB.php'; //file to connect to database
	if(!$entry=$db->query("SELECT * FROM trial"))
		die('There was an error connecting: queryError [' . $db->error . ']');
	
  //pareses t
  while($onealum=$entry->fetch_assoc()){
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
    zoom: 3,
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
      <button onclick="viewEveryone()">View Everyone</button>
    
    <form id = "major" action = "Major.php" method = "POST">
      <select name = "choices">
        <option value = "All">--choose one--</option>
        <option value = "All">All</option>
        <option value = "Computer Science">Computer Science</option>
        <option value = "Economics">Economics</option>
      </select>
      
      <select name = "classyear">
        <option value = "All">--choose one--</option>
        <option value = "All">All</option>
        <?php 
          for ($i=1960; $i<=2014; $i++){
            print <<<HTMLBLOCK
              <option value = "$i">$i</option>
HTMLBLOCK;
          }
        ?>
      </select>
      <?php print <<<HTMLBLOCK
      Currently viewing <strong>all</strong> majors from <strong>all</strong> years
HTMLBLOCK;
      ?>
      <input type = 'submit' />
    </form>
      
	</div>
    <div id="map-canvas"></div>
  </body>
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script>
	function specifyMajor(){
		var major = $('#major').find(":selected").text();
		alert(major);
	
		
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

  function viewEveryone(){
    window.location.href = "index.php";
  }


	</script>
		