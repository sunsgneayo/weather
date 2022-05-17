<?php

use sunsgne\Weather;

require_once './vendor/autoload.php';


$response = Weather::liveWeather();

var_dump($response);