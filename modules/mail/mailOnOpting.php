<?php
require 'class.phpmailer.php';
require_once '../../config.php';
require_once BASE_PATH . '/includes/connection.php';


function sendMailForAttending($email_id,$event_id)
{
    $query="SELECT * FROM event_info where event_id=".$event_id;
    $result = mysql_query($query);
            while ($row = mysql_fetch_array($result))
                {
                    $event_id=$row['event_id'];
                    $event_description=$row['event_description'];
                 }
    $mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->SetFrom("compassitessolution@gmail.com");
$mail->FromName="Team NGO Connect";
$mail->Subject = "You've successfully opted for the event";
$mail->AddAddress($email_id);
$mail->Body = "";

    $mail->Body="Hello ".$email_id."<br>"."Event id :".$event_id."<br>"."Event Description".$event_description."";
    if(!$mail->Send())
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
    echo "Message has been sent";
    }

}   
    
 ?>