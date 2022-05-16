<?php
require_once './vendor/autoload.php';


$response = \Sunsgne\Weather\Weather::liveWeather();

var_dump($response);