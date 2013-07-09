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
            function hideText(){
                document.getElementById('attendText').style.visibility = 'hidden';
            }
            function attendEvent(value) {
                if(value==="I am Attending"){
                    document.getElementById('attendText').style.visibility = 'visible';
                    document.getElementById('attendBtn').value = "Attend";
                }
            }
        </script>
<!--    <script language="javascript">
var xmlHttp
function selectedtime(t)
{
var url="book_ticket_process.php";
document.getElementById("show_id").value = t;
var sh_id = document.getElementById("sho_time").value;
url=url+"?sh_id="+sh_id;

}
function selectshow(str)
{
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
{
alert ("Your browser does not support AJAX!");
return;
}


var url="select_sh_time.php";
var numPeople = document.getElementById("numPeople").value;
url=url+"?date="+str+"&numPeople="+numPeople;
url=url+"&date="+str;
alert(url);
xmlHttp.onreadystatechange=screenChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function screenChanged()
{
if (xmlHttp.readyState==4)
{
document.getElementById("show_time").innerHTML=xmlHttp.responseText;
}
}


//function selectshow(str)
//{
//xmlHttp=GetXmlHttpObject();
//if (xmlHttp==null)
//  {
//  alert ("Your browser does not support AJAX!");
//  return;
//  }
//  
//var url="select_sh_time.php";
//var numPeople = document.getElementById("numPeople").value;
//url=url+"?date="+str+"&numPeople="+numPeople;
//
//xmlHttp.onreadystatechange=dateChanged;
//xmlHttp.open("GET",url,true);
//xmlHttp.send(null);
//}
//
//function dateChanged()
//{
//if (xmlHttp.readyState==4)
//{
//document.getElementById("show_time").innerHTML=xmlHttp.responseText;
//}
//}


function GetXmlHttpObject()
{
var xmlHttp=null;
try
{
// Firefox, Opera 8.0+, Safari
xmlHttp=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
}
}
return xmlHttp;
}

</script> -->

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
        }


        echo "<form action=\"$address/module/booking/book_ticket_process.php\" method=\"post\">";
        ?>
        <div>
            <div id="menu" class="leftdiv">
                <?php echo "<img src=\"$eventImage\" />" ?> 
            </div>

           
            <div align="center" class="centerdiv" >
                <h1 style="display: inline;">Event Name</h1>
                <div  style="float:right; font-size: 20px; padding-top: 8px; height: 100px; margin-top: 20px; width:90px;; border-radius: 5px; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.35);">
                    September
                    <div style="margin-top: 6px; padding: 6px; padding-bottom: 8px; font-weight: bold; font-size: 25px; height: 30px; background-color: red; color: white;">
                        30
                    </div>
                    08:00:00

                </div><br/>
                <br/>
                <div align="left" style="margin-left: 0px; width: 380px; ">
                    NGO Name: Alochana <br/>
                    Event Category : FALA DHEKNA <br/>
                    Volunteer Criteria : timepas 
                </div>

                <div><p>
                        morgan stanley aaya, bina hame liye chala gyaa, dil ko bada dard hua, aisa laga jaise barish me mu sukha ho. dil is kadar jhanjhor chuka tha k ab jine ki koi aashsa
                        nai thi. mann to kiya is beraham duniya se naata tod lu lekin fir khayal aaya k 12 lakh nahi to kya 6 ki to aasha hai. isi thought k sath hum fir duniya jine chal diye
                    </p>
                </div>
                <br/>

                <div>
                    <input type="email" class="input" id="attendText" placeholder="Enter Your Email ID" />
                    <input type="button" class="button" id="attendBtn" onclick="attendEvent(this.value);" value="I am Attending"/>
                </div>
            </div>

            <div class="rightdiv" >Contact Details : 
                <div style="float:right" align="left">Krupal Solanki <br/>Phone no : +91 9833216207 <br/>Email ID : krupalsolanki@live.com
                </div>
                <br/>
            </div> 
       
        </form>
    </div>
</body>
</html>
