<html>
    <head>
        <title>
            Event Added
        </title>
        <?php
        require_once '../../config.php';
        include BASE_PATH . '/includes/css.php';
        ?> 

    </head>
    <body>
        <?php
        require_once BASE_PATH . '/includes/connection.php';
        include BASE_PATH . '/includes/header.php';

        $event_location = $_POST['event_area'] . " " . $_POST['event_city'];

        $event_category = $_POST['event_category'];
        if ($event_category == "other") {
            $event_category = $_POST['event_category_tb'];
        }
        
//        for maps
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . str_replace(' ', '+', trim($event_location)) . '&sensor=false');

        $output = json_decode($geocode);

        $lat = $output->results[0]->geometry->location->lat;
        $long = $output->results[0]->geometry->location->lng;

        $query = "INSERT INTO `event_info` (`event_id`, `event_name`, `event_description`, `event_city`, `event_location`, `event_latitude`, `event_longitude`, `event_date`, `event_time`, `event_volunteer_criteria`, `event_category`, `event_contact_person`, `event_contact_phone`, `event_contact_email`, `ngo_id`) VALUES 
            (NULL,'" . $_POST['event_name'] . "','" . $_POST['event_desc'] . "','" . $_POST['event_city'] . "','" . $event_location . "',
                '".$lat."','".$long."','" . $_POST['event_date'] . "','" . $_POST['event_time'] . ":00','" . $_POST['event_v_criteria'] . "','" . $event_category . "','" . $_POST['event_contact_name'] . "','" . $_POST['event_contact_phone'] . "','" . $_POST['event_contact_emailId'] . "','" . $_POST['ngo_id'] . "')";

        $date = date('Ymd_Hi');

        $allowedExts = array("jpg", "jpeg", "gif", "png");
        $fileName = $date."_".$_FILES["file"]["name"];
        $extension = end(explode(".", $fileName));
        $target = BASE_PATH . '/images/';
        $target = $target . basename($_FILES['file']['name']);

        if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/pjpeg")) && ($_FILES["file"]["size"] < 2000000) && in_array($extension, $allowedExts)) {
            if ($_FILES["file"]["error"] > 0) {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
            } else {
                if (file_exists($target)) {

                    echo "<div align=\"center\" class=\"centerdiv\" style=\"width: 550px; \">";
                    echo $fileName. " already exists. </br>Please rename the file and try again. ";
                    echo "</div>";
                } else {
                    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
                        $result = mysql_query($query);
                        if ($result) {

                            $query1 = "SELECT MAX( event_id ) FROM event_info";
                            $result1 = mysql_query($query1);
                            $row1 = mysql_fetch_row($result1);
                            $event_id = $row1[0];

                            $result2 = mysql_query("INSERT INTO images(`image_path`,`ngo_id`,`event_id`) values ('/images/" . $fileName . "','" . $_POST['ngo_id'] . "','" . $event_id . "')");
                            mysql_query($result2);
                            if ($result2) {
                                echo "<div align=\"center\" class=\"centerdiv\" style=\"width: 550px; \">";
                                echo "<h1>Event Added Successfully</h1>";
                                echo "</div>";
                            } else {
                                echo "<div align=\"center\" class=\"centerdiv\" style=\"width: 550px; \">";
                                echo "<h1>Image was not added</h1>";
                                echo "</div>";
                            }
                        } else {
                            echo "<div align=\"center\" class=\"centerdiv\" style=\"width: 550px; \">";
                            echo "<h1>Please try again, data not inserted into database</h1>";
                            echo "</div>";
                        }
                    } else {
                        echo "<div align=\"center\" class=\"centerdiv\" style=\"width: 550px; \">";
                        echo "<h1>Please try again</h1>";
                        echo "</div>";
                    }
                }
            }
        } else {
            echo "<div align=\"center\" class=\"centerdiv\" style=\"width: 550px; \">";
            echo "<h1>Invalid File</h1>";
            echo "</div>";
        }
        ?>

    </body>
</html>
