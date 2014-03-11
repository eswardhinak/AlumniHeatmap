<?php	
	require 'connectDB.php';
	$major = $_POST['major'];
	
	
	if ($major == 'All'){
		if(!$entry=$db->query("SELECT * FROM trial"))
			die('There was an error connecting: queryError [' . $db->error . ']');
	
	}
	else{
		if(!$entry=$db->query("SELECT * FROM trial WHERE Major = '$major'"))
			die('There was an error connecting: queryError [' . $db->error . ']');
		
	}
	
	while($foobar=$entry->fetch_assoc()){
		$longitude = $foobar['Longitude'];
		$latitude = $foobar['Latitude'];
	print <<<HTML2
		  new google.maps.LatLng($latitude, $longitude),
HTML2;
	}
	
	
?>