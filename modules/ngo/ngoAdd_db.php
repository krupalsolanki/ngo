<?php
 require_once '../../config.php'; 
 include BASE_PATH.'/includes/css.php';
include BASE_PATH.'/includes/connection.php';
                
$city=$_POST['ngo_city'];
	if($city=="other")
	{
	$city=$_POST['ngo_city_tb'];
	}

$query="INSERT INTO 
		ngo_info
		(`ngo_id`, `ngo_name`, `ngo_description`, `ngo_country`, `ngo_city`, `ngo_address`, `ngo_contact_no`, `ngo_website`, `ngo_email`, `ngo_latitude`, `ngo_longitude`) VALUES (NULL, '".$_POST['ngo_name']."', '".$_POST['ngo_description']."', 'India', '".$city."', '".$_POST['ngo_address']."', '".$_POST['ngo_contact']."', '".$_POST['ngo_website']."', '".$_POST['ngo_email']."', '".$_POST['ngo_latitude']."', '".$_POST['ngo_longitude']."');";

$result=mysql_query($query);
	if($result)
		{
		echo "NGO Information Entered Successfully";
		}	
	else
		{
		echo "Please Try Again";
		}

$category=$_POST['ngo_category_name'];	
	if($category=="other")
	{
			$category=$_POST['ngo_category_name_tb'];
	}
	
		

?>
