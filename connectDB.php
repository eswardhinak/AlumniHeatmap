

<?php
	/*Commented line below should substitute line below that when on 000webhost service.*/
	//$db=new mysqli("mysql1.000webhost.com","a2573314_alumni","UCSDucsd1","a2573314_alumni");
	$db=new mysqli("localhost","root","triton","heatmaptrial");
	if (mysqli_connect_errno($db))
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
?>