<?php
	require 'connectDB.php';
	if(!$entry=$db->query("SELECT * from alumni"))
		die('There was an error connecting: queryError [' . $db->error . ']');
		
	while($onealum=$entry->fetch_assoc()){
		$name = $onealum['Name'];
		$major = $onealum['Major'];
		$class = $onealum['Class'];
		$longitude = $onealum['Longitude'];
		$latitude = $onealum['Latitude'];
		print <<<HTMLBlock
	$name - $major - c/o $class - $longitude, $latitude<br>
HTMLBlock;
	}
	
?>