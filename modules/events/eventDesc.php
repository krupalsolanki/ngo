<html>
    <head>
        <title>
            Event Description
        </title>

        <?php
        require_once '../../config.php';
        include BASE_PATH . '/includes/css.php';
        include BASE_PATH . '/includes/header.php';
        require_once BASE_PATH . '/includes/connection.php';
        ?>
        <script type="text/javascript">
            function hideText() {
                document.getElementById('attendDialog').style.display = 'none';
            }
            function spliceString(str, start, count, stringToInsert) {
                return str.substring(0, start) + stringToInsert + str.substr(start + count);
            }
            function attendEvent(value) {
                if (value === "I want to Attend") {
                    document.getElementById('attendDialog').style.display = 'block';
                    document.getElementById('attendBtn').value = "Attend";
                }
                if (value === "Attend") {
                    var url = "registerEventAttend.php";
                    var emailID = document.getElementById("attendText").value;
                    var event_id = document.getElementById("event_id").value;
                    if (document.getElementById("attendReminder").checked) {
                        var reminder = "y";
                    }
                    else
                    {
                        var reminder = "n";
                    }

                    url = url + "?emailID=" + emailID + "&event_id=" + event_id + "&reminder=" + reminder;
                    urlAddress = location.href;
                    var n = urlAddress.indexOf("eventDesc");
                    urlAddress = spliceString(urlAddress, n, 40, url);
                    if(emailID == ''){
                        alert("Add Email ID ");
                    }
                    else{
                    window.location.assign(urlAddress);
                    }
                }
            }
        </script>


    </head>

    <body onload="hideText();">

        <?php
        $event_id = $_GET['event_id'];
        $query = "select * from event_info, images where event_info.event_id = images.event_id and event_info.event_id='" . $event_id . "'";

        $result = mysql_query($query);

        if (!$result) {
            die("Invalid query: " . mysql_error());
        }

        while ($row = mysql_fetch_array($result)) {
            $eventImage = $address . $row['image_path'];
            $eventDate = (explode("-", $row['event_date']));
            $eventDesc = $row['event_description'];
            $eventName = $row['event_name'];
            $eventTime = $row['event_time'];
            $eventCriteria = $row['event_volunteer_criteria'];
            $eventContact = $row['event_contact_person'];
            $eventEmail = $row['event_contact_email'];
            $eventPhone = $row['event_contact_phone'];
            $eventNGO = $row['ngo_id'];
            $eventLocation = $row['event_location'];
            $eventCategory = $row['event_category'];
            $originalDate = $row['event_date'];
            $month = date("F", strtotime($originalDate));
            $time = date("g:i a", strtotime($eventTime));
        }
        $query = "select ngo_name from ngo_info where ngo_id=" . $eventNGO;
        $result = mysql_query($query);
        if ($result) {
            while ($row = mysql_fetch_array($result)) {
                $ngo_name = $row['ngo_name'];
            }
        }
        ?>
        <div>
            <div id="menu" class="leftdiv" >
                <?php echo "<img src=\"$eventImage\" style=\"height: 200px; width: 200\"/>" ?> 
                <input type="text" value="<?php echo $event_id ?>" id="event_id" hidden="true" />

            </div>
            <div class="rightdiv" >Contact Details : 
                <div style="float:right" align="left"><?php echo $eventContact; ?><br/>Phone No: <?php echo $eventPhone ?><br/>Email ID : <?php echo $eventEmail ?>
                </div>
                <br/>
            </div> 

            <div align="center" class="centerdiv" >
                <h1 style="display: inline;"><?php echo $eventName; ?></h1>
                <div  style="float:right; font-size: 20px; padding-top: 8px; height: 100px; margin-top: 20px; width:90px;; border-radius: 5px; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.35);">
                        <?php echo $month ?>
                    <div style="margin-top: 6px; padding: 6px; padding-bottom: 8px; font-weight: bold; font-size: 25px; height: 30px; background-color: red; color: white;">
                        <?php echo $eventDate[2] ?>
                    </div>
                    <?php echo $time; ?>

                </div><br/>
                <br/>
                <div align="left" style="margin-left: 0px; width: 380px; ">
                    NGO Name: <?php echo $ngo_name; ?> <br/>
                    Event Category : <?php echo $eventCategory ?> <br/>
                    Volunteer Criteria : <?php echo $eventCriteria; ?> <br/>
                    Event Venue : <?php echo $eventLocation ?>
                </div>

                <div><p><?php echo $eventDesc; ?>    
                    </p>
                </div>
                <br/>
                <div>
                <?php 
                if(isset($_SESSION['emailID'])){
                    
                $todays_date = date("Y-m-d");
                $today = strtotime($todays_date); 
                $originalDate = strtotime($originalDate);
                    if($originalDate < $today){
                    echo "<button class=\"button\">Post Success Stories</button> ";
                        
                    }  else {
                        echo '<button class="button">Do not Want to Attend</button>';    
                    }
                }
                else{
                ?>
                    
                </div>
                <div>
                    <div id="attendDialog">
                        <input type="email" class="input" style="text-transform: none;" id="attendText" name="emailID" placeholder="Enter Your Email ID" />
                        <input type="checkbox" id="attendReminder" name="reminder" />I want a Reminder?<br/><br/>

                    </div>
                    <input type="button" class="button" id="attendBtn" onclick="attendEvent(this.value);" value="I want to Attend"/><br/>
                <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>
