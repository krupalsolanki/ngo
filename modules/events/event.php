<?php
require_once '../../config.php';
include BASE_PATH . '/includes/css.php';
include BASE_PATH . '/includes/connection.php';
include BASE_PATH . '/includes/header.php';
?>


<script src="filterEvents.js" ></script>
<script>
var values = new Array();
var category = new Array();
    $(document).ready(function() {
        $(".filterEventChbx").click(function() {
            var category = $('input:checkbox:checked.filterEventChbx').map(function() {
                return this.value;
            }).get();
            var values = $('input:checkbox:checked.filterNgoChbx').map(function() {
                return this.value;
            }).get();
            var v = $("#filterCity").val();
            $.ajax({
                type: "GET",
                url: 'eventList.php',
                data: {
                    selectedCategory: category,
                    selectedNgo: values,
                    filterCity: v
                }, // appears as $_GET['id'] @ ur backend side
                success: function(data) {
                    // data is ur summary
                    $('#filterList').html(data);
                }

            });
        });
        
  
        $(".filterNgoChbx").click(function() {
            var category = $('input:checkbox:checked.filterEventChbx').map(function() {
                return this.value;
            }).get();
            var values = $('input:checkbox:checked.filterNgoChbx').map(function() {
                return this.value;
            }).get();
            var v = $("#filterCity").val();
            $.ajax({
                type: "GET",
                url: 'eventList.php',
                data: {
                    selectedCategory: category,
                    selectedNgo: values,
                    filterCity: v
                }, // appears as $_GET['id'] @ ur backend side
                success: function(data) {
                    // data is ur summary
                    $('#filterList').html(data);
                }

            });
        });
        
        
    });</script>
<div>
    <div id="menu" class="leftdiv">
        <!--<form>-->
        <div><strong> Search By : </strong></div>
        <div><strong>Location</strong></div>
        <div><select name="filter_city" id="filterCity" class="input" onchange="selectCity(this.value);"><?php
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

        <input type="submit" class="button" value="Filter Search"/><br/>
        <input type="button" class="button" value="Search Near By"/>
        
        <!--</form>-->

    </div>
    <div id="filterList" >
        <?php include 'eventList.php'; ?>
    </div>
</div>