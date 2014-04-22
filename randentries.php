<?php
	require 'connectDB.php';
	
	for ($x = 0; $x<5000; $x++){
		$weight = rand(0,1);
		$offset = mt_rand()/mt_getrandmax();
		if($weight == 1)
			$genloc = rand(0,50);
		else{ 
			$genloc = rand(51,179);
			if($genloc > 90)
				$genloc = 90-$genloc;
		}
		$latitude = $genloc + $offset;
		$offset  = mt_rand()/mt_getrandmax();
		$weight = rand(0,1);
		if ($weight == 1)
			$genloc = rand(0,50);
		else
			$genloc = rand(51,179);
		$weight = rand(0,1);
		if ($weight == 0)
			$genloc = -1*$genloc;
		$longitude = $genloc+$offset;
		$testname = "Eswar";
		$major_rand = rand(0,1);
		if($major_rand == 1)
			$testmajor = "Computer Science";
		else
			$testmajor = "Economics";
		$class_offset = rand(0, 54);
		$testclass = 1960 + $class_offset;
		$testemail = "eswardhinak@gmail.com";
		if(!$entry=$db->query("INSERT INTO trial(Name, Major, Class, Latitude, Longitude) VALUES ('$testname', '$testmajor', '$testclass', '$latitude', '$longitude');"))
			die('There was an error connecting: queryError [' . $db->error . ']');
	}
?>