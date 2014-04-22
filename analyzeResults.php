<?php    
  require 'connectDB.php';
  

  if(!$entry=$db->query("SELECT * FROM trial"))
    die('There was an error connecting: queryError [' . $db->error . ']');
  echo "reached it";
  $sum_of_distances;
  $numrows = mysqli_num_rows($entry);
  $total_paths = (($numrows-1)*($numrows))/2;
  $earth_radius = 6371;//earths mean radius of 6371 km
 
  while($foobar=$entry->fetch_assoc()){
        $latitude = $foobar['latitude'];echo $latitude;
        $longitude = $foobar['longitude'];echo $longitude;
        $id = $foobar['ID'];
        for ($idx=$i+1; $idx<=$numrows; $idx++){
          if(!$compare=$db->query("SELECT * FROM trial WHERE ID='$idx'"))
            die('There was an error connecting: queryError [' . $db->error. ']');
          while($poop = $compare->fetch_assoc()){
            $lat2=$poop['latitude'];
            $lng2=$poop['longitude'];
            //actual Haversine algorithm for distance between two points on a circle
            $dLat = deg2Rad(($lat2-$latitude));
            $dLon = deg2Rad(($lng2-$longitude));
            $lat1=deg2Rad($latitude);
            $lat2=deg2Rad($lat2);

            $a = sin($dlat/2)*sin($dlat/2)+sin($dLon/2)*sin($dLon/2)*cos($lat1)*cos($lat2);
            $c=atan2(sqrt($a), sqrt(1-$a));
            $d= $earth_radius*$c;
            $sum_of_distances+=$d;

          }
        }
  }
  echo ($sum_of_distances/$total_paths);

?>
