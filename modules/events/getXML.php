<?php 
require_once '../../config.php';
require_once BASE_PATH.'/includes/connection.php';
// Get parameters from URL
$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = 10;
//$radius = $_GET["radius"];

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("event_info");
$parnode = $dom->appendChild($node);

// Search the rows in the markers table
$query = sprintf("SELECT event_name, event_location, event_latitude, event_longitude, ( 3959 * acos( cos( radians('%s') ) * cos( radians( event_latitude ) ) * cos( radians( event_longitude ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( event_latitude ) ) ) ) AS distance FROM event_info HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($center_lng),
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($radius));
$result = mysql_query($query);

if (!$result) {
  die("Invalid query: " . mysql_error());
}

header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  $node = $dom->createElement("event_info");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name", $row['event_name']);
  
  $newnode->setAttribute("lat", $row['event_latitude']);
  $newnode->setAttribute("lng", $row['event_longitude']);
  $newnode->setAttribute("distance", $row['distance']);

  
}

echo $dom->saveXML();
?>
