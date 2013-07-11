<html>

    <body>

        <form action="eventDesc.php" method="post" enctype="multipart/form-data">
            <div id="eventList" class="centerdiv" style="height: auto;">

                <?php
                require_once '../../config.php';
                require_once BASE_PATH . '/includes/connection.php';
                if (isset($_GET['filterCity']) && !empty($_GET['filterCity'])) {
                    $filterCity = $_GET['filterCity'];
                    $query = "select * from event_info, images where event_info.event_id = images.event_id and event_city='" . $filterCity . "'";
                    if (isset($_GET['selectedNgo']) && !empty($_GET['selectedNgo'])) {
                        $selectedNgo = join(',', $_GET['selectedNgo']);
                        $query = "select * from event_info, images where event_info.event_id = images.event_id and event_city='" . $filterCity . "' and event_info.ngo_id IN ($selectedNgo)";
                    }
                    if (isset($_GET['selectedCategory']) && !empty($_GET['selectedCategory'])) {
                        $selectedCategory = join(',', $_GET['selectedCategory']);
                        $query = "select * from event_info, images where event_info.event_id = images.event_id and event_city='" . $filterCity . "' and event_info.event_category IN ($selectedCategory)";
                    }
                    if ((isset($_GET['selectedNgo']) && !empty($_GET['selectedNgo'])) && (isset($_GET['selectedCategory']) && !empty($_GET['selectedCategory']))) {
                        $selectedNgo = join(',', $_GET['selectedNgo']);
                        $selectedCategory = join(',', $_GET['selectedCategory']);
                        $query = "select * from event_info, images where event_info.event_id = images.event_id and event_city='" . $filterCity . "' and event_info.ngo_id IN ($selectedNgo) and event_info.event_category IN ($selectedCategory)";
                    }
                } else {

                    $query = "select * from event_info, images where event_info.event_id = images.event_id ";
                }
                $result = mysql_query($query);
                if ($result) {

                    $num_rows = mysql_num_rows($result);
                    echo $num_rows;
                    if ($num_rows != 0) {
                        while ($row = mysql_fetch_array($result)) {
                            //$resultrow=$row;

                            $eventImage = $address . $row['image_path'];
                            echo "<div style=\"height:100px; width:400px; text-decoration:none;\">";

                            echo "<a href=\"eventDesc.php?event_id=" . $row['event_id'] . "\">
                        <img src=\"$eventImage\" style=\"height:95px; float:left;\"/><div><h3>" . $row['event_name'] . "</h3></a>
                            Event Date :" . $row['event_date'] . "</br>Event Location :" . $row['event_location'] . "</div></div><div><hr></div>";
                        }
                    }
                } else {
                    echo"Zero results found";
                }
                ?>



            </div>

        </form>
    </body>
</html>