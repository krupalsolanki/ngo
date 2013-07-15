<?php

require_once '../../config.php';
//require_once BASE_PATH . '/includes/connection.php';
session_start();
$type = $_GET['type'];
if ($type == "opt_out") {
    $_GET['event_id'];
    $_SESSION['event_id'] = $_GET['event_id'];
    Header("Location: $address/modules/events/optOut.php");
}
?>
