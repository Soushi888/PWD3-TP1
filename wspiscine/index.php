<?php

require_once('includes/Autoloader.class.php');
Autoloader::register();

header("Access-Control-Allow-Origin: *");

$_SERVER['PHP_AUTH_USER'] = '';
$_SERVER['PHP_AUTH_PW']   = '';
if (isset($_SERVER['HTTP_AUTHORIZATION']) && $_SERVER['HTTP_AUTHORIZATION'] != '' ) {
    list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}

echo "HTTP_AUTHORIZATION : ".$_SERVER['HTTP_AUTHORIZATION']."</br>";
echo "SERVER_PROTOCOL : "   .$_SERVER["SERVER_PROTOCOL"]."<br>";
echo "REQUEST_METHOD : "    .$_SERVER["REQUEST_METHOD"]."<br>";
echo "REQUEST_URI : "       .$_SERVER["REQUEST_URI"]."<br>";
echo "QUERY_STRING : "      .$_SERVER["QUERY_STRING"]."<br>";

new Controleur;