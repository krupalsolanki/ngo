<?php    
       
        require_once '../../config.php';
        require_once BASE_PATH.'/includes/connection.php';
        
        $query = "INSERT INTO `event_attendee`(`event_attendee_id`, `event_id`, `event_attendee_email`, `reminder`) VALUES 
            (null,'".$_GET['event_id']."','".$_GET['emailID']."','".$_GET['reminder']."')";
         $result = mysql_query($query);
        
                    
        if($result)
        Header("Location: $address/index.php");
?>