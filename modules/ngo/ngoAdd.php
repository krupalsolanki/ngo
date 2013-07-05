<html>
<title>Enter Details for NGO</title>
<head>
<script type="text/javascript">
function CheckCity(val){
 var element=document.getElementById('ngo_city');
 if(val=='Choose'||val=='other')
   element.style.display='block';
 else  
   element.style.display='none';
}

</script> 
<?php  
require_once '../../config.php'; 
 include BASE_PATH.'/includes/css.php';
include BASE_PATH.'/includes/connection.php';?>
</head>
<body>
	<h1>Enter Information for NGO</h1>
	<form method="POST" action="ngoAdd_db.php">
		Name : <input type="text" name="ngo_name"/><br/>
		Description : <input type="textarea" name="ngo_description" rows="100" cols="50"/><br/>
		Country: <input type="text" name="ngo_country" value="India" disabled="true"/><br/>
		City: <select name="ngo_city" onchange='CheckCity(this.value);'>
                    <?php
				
				$query = "SELECT distinct ngo_city FROM ngo_info";
				$result = mysql_query($query) or die(mysql_error());
				while($row = mysql_fetch_array($result))
				{
					echo "<option value='{$row['ngo_city']}'>{$row['ngo_city']}</option>";
				} 
				?>
				<option value='other'>Other</option>
				</select><input type="text" name="ngo_city_tb" id="ngo_city" style='display:none;'/><br/>
		Address: <input type="text" name="ngo_address"/><br/>
		Contact Number: <input type="text" name="ngo_contact"/><br/>
		Website: <input type="url" name="ngo_website"/><br/>
		Email: <input type="email" name="ngo_email"/><br/>
		Latitude: <input type="text" name="ngo_latitude"/><br/>
		Longitude: <input type="text" name="ngo_longitude"/><br/>
		<input type="submit"/>
	</form>
</body>


