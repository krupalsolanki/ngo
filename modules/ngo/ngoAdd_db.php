<?php
 require_once '../../config.php'; 
 include BASE_PATH.'/includes/css.php';
include BASE_PATH.'/includes/connection.php';
                
$city=$_POST['ngo_city'];
	if($city=="other")
	{
	$city=$_POST['ngo_city_tb'];
	}

 $ngo_location = $_POST['ngo_address'] . " " . $city;       
 $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . str_replace(' ', '+', trim($ngo_location)) . '&sensor=false');
 $output = json_decode($geocode);
 $lat = $output->results[0]->geometry->location->lat;
 $long = $output->results[0]->geometry->location->lng;
       
        
$query="INSERT INTO 
		ngo_info
		(`ngo_id`, `ngo_name`, `ngo_description`, `ngo_country`, `ngo_city`, `ngo_address`, `ngo_contact_no`, `ngo_website`, `ngo_email`, `ngo_latitude`, `ngo_longitude`) VALUES (NULL, '".$_POST['ngo_name']."', '".$_POST['ngo_description']."', 'India', '".$city."', '".$_POST['ngo_address']."', '".$_POST['ngo_contact']."', '".$_POST['ngo_website']."', '".$_POST['ngo_email']."', '".$lat."', '".$long."')";

        
$addimage=1;
$date=date('Ymd_Hi');
$filename=$date."_".$_FILES["file"]["name"];
$allowedExts = array("jpg", "jpeg", "gif", "png");
$extension = end(explode(".", $filename));
$target=BASE_PATH.'/images/';
$target=$target.basename($filename);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/jpeg"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
{
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    $addimage=0;
    }
    else
    {
    if (file_exists($target))
	{

	
        echo $filename . " already exists. </br>Please rename the file and try again. ";
        $addimage=0;
	}
    else
      {
	 if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) 
	{
	
	
        echo "Image Uploaded successfully";
        
	}
	else 
        {
            echo "Please Try Again";
            $addimage=0;
        }
        
      }
    }
  }
else
  {
  echo "Invalid file";
  $addimage=0;
  }	
  
  if($addimage)
  {
      $result=mysql_query($query);
	if($result)
		{
		echo "NGO Information Entered Successfully<br>";
                $query1="SELECT MAX( ngo_id ) FROM ngo_info";
                $result1=mysql_query($query1);
                $row1 = mysql_fetch_row($result1);
                $ngo_id_fetched=$row1[0];
                
                $result2=  mysql_query("INSERT INTO images(`image_path`,`ngo_id`) values ('/images/".$filename."','".$ngo_id_fetched."')");
                mysql_query($result2);
                    if($result2)
                    {
                        echo "Image Table me bhi gaya";
                    }
                    else
                        echo "Image Table me nahi gaya";
                }	
	else
		{
		echo "Please Try Again";
                }
      
      
  }
?>
