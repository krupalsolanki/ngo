<html>
<head>
    <title>
        Event Added
    </title>
    <?php
	require_once '../../config.php';
	include BASE_PATH.'/includes/css.php';
    ?> 
 
</head>
<body>
<?php   
        
        require_once BASE_PATH.'/includes/connection.php';
        include BASE_PATH .'/includes/header.php';
        include BASE_PATH.'/includes/admin_options.php';
       $event_loaction;

$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $_FILES["file"]["name"]));
$target=BASE_PATH.'/images/';
$target=$target.basename($_FILES['file']['name']);
$query = "INSERT INTO `event_info`(`event_id`, `event_name`, `event_description`, `event_city`, `event_location`, `event_latitude`, `event_longitude`, `event_date`,
    `event_time`, `event_volunteer_criteria`, `event_category`, `event_contact_person`, 
    `event_contact_phone`, `event_contact_email`, `ngo_id`) VALUES (NULL,'".$_POST['event_name']."','".$_POST['event_desc']."',
        '".$_POST['event_city']."','".$_POST['event_location']."',[value-6],[value-7],[value-8],[value-9],[value-10],
    [value-11],[value-12],[value-13],[value-14],[value-15])";

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/pjpeg"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
{
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
    else
    {
    if (file_exists($target))
	{
	    
	echo "<div align=\"center\" class=\"centerdiv\" style=\"width: 550px; \">";
        echo $_FILES["file"]["name"] . " already exists. </br>Please rename the file and try again. ";
        echo "</div>";
	}
    else
      {
	 if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) 
	{
	$result = mysql_query($query);
	echo "<div align=\"center\" class=\"centerdiv\" style=\"width: 550px; \">";
        echo "<h1>Movie Added Successfully</h1>";
        echo "</div>";
	}
	else "please try again";
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>

</body>
</html>
