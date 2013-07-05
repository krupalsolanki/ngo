<html>
    <head>
        <title>
            Add Event
        </title>

        <?php
        require_once '../../config.php';
        include BASE_PATH . '/includes/css.php';
        include BASE_PATH . '/includes/connection.php';
        include BASE_PATH . '/includes/header.php';
        ?>
        <script type="text/javascript">
            function CheckCategory(val) {
                var element = document.getElementById('event_category');
                if (val == 'Choose' || val == 'other')
                    element.style.display = 'block';
                else
                    element.style.display = 'none';
            }
            function validateMobNo(mobno) {
                var mobno2;
                var flag = false;
                var mlen = mobno.length;
                //alert(mobno.substr(3,mobno.length-3));  
                if (mobno.charAt(0) != '+' && mlen == 10) {
                    mobno2 = "+91-" + mobno;
                    flag = true;
                }
                else if (mobno.charAt(0) == '+') {
                    if (mobno.substr(0, 3) == '+91' && mobno.length == 13) {
                        mobno2 = mobno.substr(0, 3) + "-" + mobno.substr(3, mobno.length - 3);
                        flag = true;
                    }
                }
                else if (mobno.indexOf("-") < 0 && mobno.length == 12 && mobno.substr(0, 2) == '91') {
                    mobno2 = mobno.substr(0, 2) + "-" + mobno.substr(3, mobno.length - 2);
                    flag = true;
                }
                else
                    alert("Please correct your mobile No");
                if (flag == true)
                    document.addEvent.phone_no.value = mobno2;
                else
                    document.addEvent.phone_no.focus()
                return flag;
            }</script> 
    </head>

    <body>
        <div align="center" class="centerdiv" style="height: auto;">

            <h3 align="center">Add new Event</h3>
            <form method="post" name="addEvent" enctype="multipart/form-data" action="eventAdd_db.php">
                <table align="center" >
                    <tr>
                        <td>NGO Name</td>
                        <td><select name="ngo_id" class="input" style="width: 160px;">
                                <?php
                                $query = "SELECT distinct ngo_name,ngo_id FROM ngo_info";
                                $result = mysql_query($query) or die(mysql_error());
                                while ($row = mysql_fetch_array($result)) {
                                    echo "<option value='{$row['ngo_id']}'>{$row['ngo_name']}</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Event Name</td>
                        <td><input type="text" name="event_name" class="input" /></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td><input type="textarea" class="input" name="event_desc" rows="100" cols="50" /></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><label for="file">Add Photo:</label></td>
                        <td><input type="file" name="file" id="file"></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <td>Area</td>
                        <td><input type="text" name="event_area" class="input"  /></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>City</td>
                        <td><input type="text" class="input" name="event_city" /></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Date</td>
                        <td><input type="date" class="input" name="event_date"/></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Time</td>
                        <td><input type="time" class="input" name="event_time"/></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Volunteer Criteria</td>
                        <td><input type="textarea" class="input" name="event_v_criteria" rows="100" cols="50" /></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="event_category" class="input" style="width: 160px;" onchange='CheckCategory(this.value);'>
                                <?php
                                $query = "SELECT distinct event_category FROM event_info";
                                $result = mysql_query($query) or die(mysql_error());
                                while ($row = mysql_fetch_array($result)) {
                                    echo "<option value='{$row['event_category']}'>{$row['event_category']}</option>";
                                }
                                ?>
                                <option value='other'>Other</option>
                            </select><input type="text" name="event_category_tb" id="event_category" style='display:none;'/><br/>

                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Contact Name</td>
                        <td><input type="text" name="event_contact_name" class="input" /></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Email ID</td>
                        <td><input type="email" class="input" style="text-transform: none;" name="event_contact_emailId" /></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Mobile No</td>
                        <td><input type="text" class="input" name="event_contact_phone" id="phone_no" onblur="validateMobNo(phone_no.value);" /></td>
                        <td></td>
                    </tr>


                    <tr>
                        <td align="center" ><input type="reset" name="ok" id="okbtn" value="Reset" class="button"/></td>
                        <td align="center" ><input type="submit" name="ok" id="okbtn" value="Create" class="button"/></td>
                        <td></td>
                    </tr>



                </table>

            </form>
        </div>
    </div>
</body>
</html>
