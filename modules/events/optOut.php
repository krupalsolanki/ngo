<?php    
       
        require_once '../../config.php';
        require_once BASE_PATH.'/includes/connection.php';
        session_start();
        echo $_SESSION['emailID'];
        echo $_SESSION['event_id'];
        $query = "delete from event_attendee where event_attendee_email = '".$_SESSION['emailID']."' and event_id = '".$_SESSION['event_id']."'";
            
         $result = mysql_query($query);
        
                    
        if($result)
        Header("Location: $address/modules/events/event.php");
?>