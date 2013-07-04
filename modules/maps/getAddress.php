<html>
    <head>
        <title>
            Get Latitude & Longitude
        </title>
		<?php require_once '../../config.php'; 
               include BASE_PATH.'/includes/css.php';
                
                ?>
        
       
    </head>

    <body>
        
        <div align="center" class="centerdiv" style="height: 300px;">
            <h3 align="center">Get Latitude and Longitude</h3>
            <form method="post" action="lastTry.php">
                <table align="center" >
                    <tr>
                        <td>Address</td>
                        <td><input type="text" name="address" class="input" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>City</td>
                        <td><input type="text" class="input" name="city" /></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input type="text" class="input" name="state" /></td>
                        <td></td>
                    </tr>
                    
                    <tr>
                        <td align="center" ><input type="reset" name="ok" id="okbtn" value="Reset" class="button"/></td>
                        <td align="center" ><input type="submit" name="ok" id="okbtn" value="Find" class="button"/></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>
</html>

