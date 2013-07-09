<?php
require 'class.phpmailer.php';
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
$mail->AddAddress("satyam.mgs@gmail.com");
$mail->Body = "Hello<br>
    You've successfully opted for the event which is at {insertcodehere}. We expect you to be there on time.
    For your convenience, here is the contact details of the event manager.<br>
    <strong>Name:</strong>{person's name}<br>
    <strong>Contact Number:</strong>{Person's Number}<br><br><br><br><br>
    --<br>
    Team NGO Connect<br>
    teamngoconnect@gmail.com<br>
    
    ";


    if(!$mail->Send())
    {
    echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
    echo "Message has been sent";
    }
    
 ?>