<?php
define ('BASE_PATH',dirname(realpath(__FILE__)));
$host="localhost";
$user="krupal";
$public_replace_string="/home/$user/public_html/";
$localhost_replace_string_windows="C:/wamp/www/";
$localhost_replace_string_linux="/var/www/";

$string= BASE_PATH;


    if (strpos($string,"public_html")==true)
    {
        $address=trim(substr_replace("$string","http://localhost/~$user/",0,strlen($public_replace_string)));
        define ('main',$address . '/');
           
    }
    elseif (strpos($string,"wamp")==true){
        $address=trim(substr_replace("$string","http://localhost/",0,strlen($localhost_replace_string_windows)));
        define ('main',$address . '/');
    }
    else
    {
        $address=substr_replace("$string","http://192.168.1.201/",0,strlen($localhost_replace_string_linux));
        define ('main',$address . '/');
        
    }
  
    function ImgAddress($imgLocation)
    {
        global $user, $public_replace_string, $localhost_replace_string;
        if (strpos($imgLocation,"public_html")==true)
        {
            return trim(substr_replace("$imgLocation","http://localhost/~$user/",0,strlen($public_replace_string)));
               
        }
        else
        {
            $imghref=substr_replace("$imgLocation","http://192.168.0.105/",0,strlen($localhost_replace_string));
            return $imghref;
            
        }
    }
?>
