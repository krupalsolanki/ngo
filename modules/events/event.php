<?php
require_once '../../config.php';
include BASE_PATH . '/includes/css.php';
include BASE_PATH . '/includes/connection.php';
include BASE_PATH . '/includes/header.php';
?>


<script src="filterEvents.js" ></script>

<div>
    <div id="menu" class="leftdiv">
        <!--<form>-->
        <div><strong> Search By : </strong></div>
        <div><strong>Location</strong></div>
        <div><select name="filter_city" id="filterCity" class="input" onchange="selectCity();"><?php
                $query = "SELECT distinct event_city FROM event_info";
                $result = mysql_query($query) or die(mysql_error());
                while ($row = mysql_fetch_array($result)) {
                    echo "<option value='{$row['event_city']}'>{$row['event_city']}</option>";
                }
                ?></select></div>
        <br/>
        <div><strong>Categories</strong></div>
        <div style="height:100px;overflow:auto;"><?php
            $query1 = "SELECT distinct event_category FROM event_info";
            $result1 = mysql_query($query1) or die(mysql_error());
            while ($row1 = mysql_fetch_array($result1)) {
                echo "<input type='checkbox' class=\"filterEventChbx\"  value='{$row1['event_category']}'>{$row1['event_category']}<br>";
            }
            ?></div>

        <div><strong>Date</strong></div>
        <div><input type="date" name="filter_date"/></div>
        <br>
        <div><strong>NGO</strong></div>
        <div style="height:100px;overflow:auto;"><?php
            $query2 = "SELECT distinct ngo_name FROM ngo_info";
            $result2 = mysql_query($query2) or die(mysql_error());
            while ($row2 = mysql_fetch_array($result2)) {
                $query3 = "select ngo_id,ngo_name from ngo_info where ngo_name = '" . $row2['ngo_name'] . "'";
                $result3 = mysql_query($query3) or die(mysql_error());
                while ($row3 = mysql_fetch_array($result3)) {
                    echo "<input type='checkbox' class=\"filterNgoChbx\" name='filter_ngo' value='{$row3['ngo_id']}'>{$row3['ngo_name']}<br>";
                }
            }
            ?></div>

        
        <input type="button" id="searchNearBy" class="button"  value="Search Near By"/><br/>
        
        <div id="previousEvents"><button class="button">Previous Events</button></div>
        <div id="regEmail" style="margin-bottom: 15px; margin-top: 15px; display: none">
            <input type="email" id="prevEmailTxt" style="text-transform: none" required="required" class="input" placeholder="Enter your Email ID" /><br/>
            <button id="prevEventsBtn" class="button" style="margin-left: 25px;">Show</button> 
        </div>
        
        <!--</form>-->

    </div>
    <div class="rightdiv" id="mapDisplay" style="display: none;">
        <div id="map" style="width: 100%; height: 80%"></div><br/>
        <div style="margin:15px; margin-left: 60px; " >
            <select id="radiusSelect">
                <option value="1.24" selected>2km</option>
                <option value="6.21">10km</option>
                <option value="12.42">20km</option>
            </select>
        <input type="button" class="button" onclick="searchLocationsNear();" value="Search"/>
            
        </div>
    </div>
    <div id="filterList" >
        <?php include 'eventList.php'; ?>
    </div>
</div>