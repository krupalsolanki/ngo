<?php


$addr = str_replace(' ','+',trim($_POST['address']));
$city = $_POST['city'];
$state = $_POST['state'];


$address = "$addr+$city+$state";
 
$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$address.'&sensor=false');
 
$output= json_decode($geocode);
 
$lat = $output->results[0]->geometry->location->lat;
$long = $output->results[0]->geometry->location->lng;
 
echo $address.'<br>Lat: '.$lat.'<br>Long: '.$long;
 

?>