<?php require_once BASE_PATH . '/config.php'; ?>
<head>
    <script src="//ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.1.min.js"></script>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<!--    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"
    type="text/javascript"></script>-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    
        <script type="text/javascript"
                src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBH3u6k4SDqwejVMskneZZJl_s-xSzbvMg&sensor=true">
        </script>

</head>
<div style="background: -moz-linear-gradient(270deg, #d1f7f7, rgb(254, 254, 254)) repeat scroll 0% 0% transparent; height:600px;">
    <?php
    echo "<img src=\"$address/images/ngo_logo.gif\" class=\"img\"/>";
    ?>
    <div style="background-color:#d3d3d3; height:auto "><h1 align="center" style="padding-top:20px; margin: 0px; padding-bottom:20px; margin-top:0px">NGO</h1></div>

    <div id="tabs" class="tabs">

<?php
session_start();
echo "<a class=\"ex2\" href=\"$address/index.php\" >Home</a>";
echo "<a class=\"ex2\" href=\"$address/modules/events/eventAdd.php\">Events</a>";
echo "<a class=\"ex2\" href=\"$address/modules/ngo/ngoAdd.php\">Ngo</a>";
echo "<a class=\"ex2\" href=\"$address/modules/events/event.php\">Search Events</a>";
echo "<a class=\"ex2\" >Success Stories</a>";

echo "<a class=\"ex2\" href=#>About Us</a>";
?>
    </div>

