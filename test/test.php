<?php


//require_once './vendor/autoload.php';


//$response = \tinywan\Weather::liveWeather("重庆");
use sunsgne\Weather;

$response = Weather::liveWeather("重庆");

var_dump($response);