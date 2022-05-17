<?php


require_once './vendor/autoload.php';


//$response = \tinywan\Weather::liveWeather("重庆");
$response = sunsgne\Weather::liveWeather("重庆");

var_dump($response);