var xmlHttp
var url="eventList.php"

function selectCity(str)
{
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  }

var url="eventList.php";
url=url+"?filterCity="+str;
xmlHttp.onreadystatechange=cityChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function cityChanged()
{
if (xmlHttp.readyState==4)
{
document.getElementById("filterList").innerHTML=xmlHttp.responseText;
}
}
//
//function selectedscreen(scr)
//{
//    //var url="prev_show_status.php";
//    url=url+"?sc_id="+scr;
//    //document.getElementById("url").style.display = 'block';
//    document.getElementById("sc_id").value = scr;
//}
//
//function selectdate(str)
//{
//xmlHttp=GetXmlHttpObject();
//if (xmlHttp==null)
//  {
//  alert ("Your browser does not support AJAX!");
//  return;
//  }
//  
////var url="prev_show_status.php";
//url=url+"&date="+str;
//xmlHttp.onreadystatechange=screenChanged;
//xmlHttp.open("GET",url,true);
//xmlHttp.send(null);
//}
//
//function screenChanged()
//{
//if (xmlHttp.readyState==4)
//{
//document.getElementById("status").innerHTML=xmlHttp.responseText;
//}
//}
//

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
