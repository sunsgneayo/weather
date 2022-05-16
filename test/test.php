<?php
require_once '../vendor/autoload.php';


$response = \Sunsgne\Weather::liveWeather('杭州');

var_dump($response);