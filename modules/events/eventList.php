<html>

    <body>

        <form action="selectEvent.php" method="post" enctype="multipart/form-data">
            <div >

                <?php
                require_once '../../config.php';
                require_once BASE_PATH . '/includes/connection.php';

                session_start();
//                    $mu_id = $_SESSION["user_mu_id"] = $_REQUEST['mu_id'];
//                    $sh_date = date("Y-m-d");

                $query = "select * from event_info, images where event_info.event_id = images.event_id ";
                $result = mysql_query($query);
                $num_rows = mysql_num_rows($result);
                $count = 0;
                while ($row = mysql_fetch_array($result)) {
                    //$resultrow=$row;
                    
                    $eventImage = $address.$row['image_path'];
                    echo "<div style=\"height:100px; width:400px; text-decoration:none\">";

                    echo "<a href=\"selectEvent.php?event_id=" . $row['event_id'] . "\">
                        <img src=\"$eventImage\" style=\"height:95px; float:left;\"/><div><h3>" . $row['event_name'] . "</h3></a>
                            Event Date :" . $row['event_date'] . "</br>Event Location :" . $row['event_location'] . "</div></div><div><hr></div>";

                    //echo $row['mo_name'];
                }
                ?>



            </div>

        </form>
    </body>
</html>