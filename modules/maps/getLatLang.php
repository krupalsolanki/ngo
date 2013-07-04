<?php

$addr = $_POST['address'];
urlencode($addr);
echo $addr;
$key = "AIzaSyBH3u6k4SDqwejVMskneZZJl_s-xSzbvMg";
$city = $_POST['city'];
$state = $_POST['state'];
//$url = "http://maps.google.com/maps/geo?q=" . $addr . "+" . $city . "+" . $state . "&output=xml&key=" . $key;
$url = "http://maps.google.com/maps/geo?q=washington+DC&output=xml&key=AIzaSyDZLNp8CTYr03zRNC29SNg5_P0vHo7FqEo";
//$url = "http://maps.google.com/maps/geo?q=washington+DC&output=xml&key=AIzaSyDZLNp8CTYr03zRNC29SNg5_P0vHo7FqEo";
echo $url;
    $xml = new SimpleXMLElement();
    echo $xml->Response->Status->code;
    ?>
https://maps.googleapis.com/maps/api/js?key=AIzaSyDZLNp8CTYr03zRNC29SNg5_P0vHo7FqEo&sensor=true