<?php
	$db=new mysqli("localhost","root","triton","heatmaptrial");
	if (mysqli_connect_errno($db))
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
?>