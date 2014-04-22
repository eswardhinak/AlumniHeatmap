<?php	
	require 'connectDB.php';
	$major = $_POST['major'];
	
Eswar;
	if ($major == 'All'){
		if(!$entry=$db->query("SELECT * FROM trial"))
			die('There was an error connecting: queryError [' . $db->error . ']');
		/*print <<<Eswar
			y = $major;
Eswar;*/
	}
	else{
		if(!$entry=$db->query("SELECT * FROM trial WHERE Major = '$major'"))
			die('There was an error connecting: queryError [' . $db->error . ']');
		/*print <<<Cindy
			x = $major;
Cindy;*/
	}
	
	while($foobar=$entry->fetch_assoc()){
		$longitude = $foobar['Longitude'];
		$latitude = $foobar['Latitude'];
	print <<<HTML2
		  new google.maps.LatLng($latitude, $longitude),
HTML2;
	}
	/*print <<<HTML3
			];
HTML3;*/
	
	

	
?>