<!--
  FileName: Major.php
  Author: Eswar Dhinakaran
  Date of Last Modification: 7 April 2014
  Languages: PHP5, Javascript, HTML5, CSS3
  APIs: Google Maps API v3
  Description: This file is called when the user changes the class
                and/or major that they wish to view in the heatmap.
                It repopulates the alumdata array in javascript via
                a POST request to PHP. PHP script pulls relevant
                alumni from a MySQL Table and writes into the 
                javascript array. 
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
// Adding 500 Data Points
var map, pointarray, heatmap, new_alumdata;
/*populates the array with the alumni and their latitudes and longitudes with the correct alumni and latitudes*/
var alumdata = [
<?php
	require 'connectDB.php';
  $class = $_POST['classyear']; //POST request for grad year
  $major = $_POST['choices']; //POST request for the major
  /*If all majors and all classes are chosen to be viewed*/
  if ($major == 'All' && $class == 'All'){
    if(!$entry=$db->query("SELECT * FROM trial"))
      die('There was an error connecting: queryError [' . $db->error . ']');
  }

  /*If a specific class is chosen but all majors are requested*/
  else if ($major == 'All'){
    if(!$entry=$db->query("SELECT * FROM trial WHERE Class = '$class'"))
      die('There was an error connecting: queryError [' . $db->error . ']');
  }

  /*If all classes are requested but a specific major is chosen*/
  else if ($class == 'All'){
      if(!$entry=$db->query("SELECT * FROM trial WHERE Major ='$major'"))
        die('There was an error connecting: queryError [' . $db->error . ']');
  }

  /*If the distribution of specific majors from a specific year is
    requested*/
  else{
    if(!$entry=$db->query("SELECT * FROM trial WHERE Major = '$major' AND Class = '$class'"))
      die('There was an error connecting: queryError [' . $db->error . ']');
  }
  
  /*parses through the assosciative array and assigns variables to 
    data in those objects*/

  while($foobar=$entry->fetch_assoc()){
    $longitude = $foobar['Longitude'];
    $latitude = $foobar['Latitude'];

    /*prints a single element into the javascript array*/
  print <<<HTML2
      new google.maps.LatLng($latitude, $longitude),
HTML2;
  }
?>
];

/*Initialize Function*/
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
        <option value = <?php print "\"$major\"";?>>--choose one--</option>
        <option value = "All">All</option>
        <option value = "Computer Science">Computer Science</option>
        <option value = "Economics">Economics</option>
      </select>
     
      <select name = "classyear">
        <option value = <?php print "\"$class\"";?>>--choose one--</option>
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
      Currently viewing <strong>$major</strong> majors from <strong>$class</strong>
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
		/*alumdata = [ 
			$.ajax({
				url: 'Major.php',
				type: 'POST'
				data: { major : major },
				success: function (data) {	
					$.each( data, function( index, point){
					new google.maps.LatLng(point.latitude, point.longitude);
					});
				}
			})
		];
		
		initialize();*/
	
		
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
      window.location.href="index.php";
  }

	</script>
		