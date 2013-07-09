<?php
require_once '../../config.php';
include BASE_PATH . '/includes/css.php';
include BASE_PATH . '/includes/connection.php';
include BASE_PATH . '/includes/header.php';

?>

<div id="menu" class="leftdiv">

    <div>Location</div>
    <div><select name="event_city" class="input"><?php
        $query = "SELECT distinct event_city FROM event_info";
        $result = mysql_query($query) or die(mysql_error());
        while ($row = mysql_fetch_array($result)) {
            echo "<option value='{$row['event_city']}'>{$row['event_city']}</option>";
        }
        ?></select></div>
</div>
