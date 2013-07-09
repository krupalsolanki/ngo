<?php
require_once '../../config.php';
include BASE_PATH . '/includes/css.php';
include BASE_PATH . '/includes/connection.php';
include BASE_PATH . '/includes/header.php';
?>

<div id="menu" class="leftdiv">
    <div><strong> Search By : </strong></div>
    <div><strong>Location</strong></div>
    <div><select name="event_city" class="input"><?php
        $query = "SELECT distinct event_city FROM event_info";
        $result = mysql_query($query) or die(mysql_error());
        while ($row = mysql_fetch_array($result)) {
            echo "<option value='{$row['event_city']}'>{$row['event_city']}</option>";
        }
        ?></select></div>
    <br/>
    <div><strong>Categories</strong></div>
        <div style="height:100px;overflow:auto;"><?php
        $query1="SELECT distinct event_category FROM event_info";
        $result1=mysql_query($query1) or die(mysql_error());
        while($row1 = mysql_fetch_array($result1))
        {
            echo "<input type='checkbox' value='{$row1['event_category']}'>{$row1['event_category']}<br>";
        }
        ?></div>
        
        <div><strong>Date</strong></div>
        <div><input type="date"/></div>
        <br>
        <div><strong>NGO</strong></div>
        <div style="height:100px;overflow:auto;"><?php
        $query2="SELECT distinct ngo_name FROM ngo_info";
        $result2=mysql_query($query2) or die(mysql_error());
        while($row2 = mysql_fetch_array($result2))
        {
            echo "<input type='checkbox' value='{$row2['ngo_name']}'>{$row2['ngo_name']}<br>";
        }
        ?></div>
        
        <input type="submit" class="button" value="Filter Search"/><br/>
        <input type="submit" class="button" value="Search Near By"/>
        
       
</div>
