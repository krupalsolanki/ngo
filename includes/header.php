<div style="background: -moz-linear-gradient(270deg, #d1f7f7, rgb(254, 254, 254)) repeat scroll 0% 0% transparent; height:600px;">
<?php
require_once BASE_PATH .'/config.php';

echo "<img src=\"$address/images/ngo_logo.jpg\" class=\"img\"/>";
?>
<div style="background-color:#d3d3d3; height:auto "><h1 align="center" style="padding-top:20px; margin: 0px; padding-bottom:20px; margin-top:0px">NGO</h1></div>

<div id="tabs" class="tabs">

<?php

session_start();
echo "<a class=\"ex2\" href=\"$address/index.php\" >Home</a>";
echo "<a class=\"ex2\" href=\"$address/modules/events/eventAdd.php\">Events</a>";
echo "<a class=\"ex2\" href=\"$address/modules/ngo/ngoAdd.php\">Ngo</a>";
echo "<a class=\"ex2\" >Success Stories</a>";

echo "<a class=\"ex2\" href=#>About Us</a>";
//
//if($_SESSION['user_type']=='admin')
//   {
//    echo "<a class=\"ex2\" href=\"$address/admin.php\">Admin</a>";
//   }
//
//
//
//if(isset($_SESSION['valid_id']))
//{
//    
//   if($_SESSION['valid_id']=='authorized')
//   {
//    
//    echo "<a class=\"ex2\" style=\"margin-right:10px; margin-left: 700px; \">Hi ".$_SESSION["valid_user"]."</a>";
//    echo "|";
//    echo "<a class=\"ex2\" style=\" margin-left: 10px; \" href=\"$address/module/login/logout.php\">Logout</a>";
//   }
//   
//}
//if($_SESSION['valid_id']!='authorized')
//   {
//    echo "<a class=\"ex2\" style=\"margin-right:10px; margin-left: 700px; \" href=\"$address/registeration.php\">Register</a>";
//    echo "|";
//    echo "<a class=\"ex2\" style=\" margin-left: 10px; \" href=\"$address/login.php\">Login</a>";
//    
//}




?>
</div>
