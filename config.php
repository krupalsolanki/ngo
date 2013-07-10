<?php

$host = "192.168.2.8";
define('BASE_PATH', dirname(realpath(__FILE__)));

$user = "krupal";
$public_replace_string = "/home/$user/public_html/";
$localhost_replace_string_windows = "C:/wamp/www/";
$localhost_replace_string_linux = "/var/www/";

$string = BASE_PATH;


if (strpos($string, "public_html") == true) {
    $address = trim(substr_replace("$string", "http://localhost/~$user/", 0, strlen($public_replace_string)));
    define('main', $address . '/');
} elseif (strpos($string, "wamp") == true) {
    $address = trim(substr_replace("$string", "http://" . $host . "/", 0, strlen($localhost_replace_string_windows)));
    define('main', $address . '/');
} else {
    $address = substr_replace("$string", "http://" . $host . "/", 0, strlen($localhost_replace_string_linux));
    define('main', $address . '/');
}

function ImgAddress($imgLocation) {
    global $host, $user, $public_replace_string, $localhost_replace_string_linux, $localhost_replace_string_windows;
    if (strpos($imgLocation, "public_html") == true) {
        $address = trim(substr_replace("$imgLocation", "http://localhost/~$user/", 0, strlen($public_replace_string)));
        define('imgMain', $address . '/');
    } elseif (strpos($imgLocation, "wamp") == true) {
        $address = trim(substr_replace("$imgLocation", "http://" . $host . "/", 0, strlen($localhost_replace_string_windows)));
        define('imgMain', $address . '/');
    } else {
        $address = substr_replace("$imgLocation", "http://" . $host . "/", 0, strlen($localhost_replace_string_linux));
        define('imgMain', $address . '/');
    }
}

?>
