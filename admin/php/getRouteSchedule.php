<?php
/**
 * Created by IntelliJ IDEA.
 * Date: 22-02-2017
 * Time: 12:51 PM
 */
header('Access-Control-Allow-Origin: http://*');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 604800');
header("Content-type: application/json");
include 'database.php';
date_default_timezone_set('America/Toronto');
$db = new database();
/*$_GET["Longitude"],$_GET["Latitude"]*/
$nearestStop = $db->getNearestStops($_GET["Latitude"],$_GET["Longitude"],$_GET["RouteNo"],$_GET["RouteDirection"]);
$nearestBusDetails = $db->getBusSchedule($nearestStop[0]["StopNo"],$_GET["RouteNo"],$_GET["RouteDirection"]);
echo $nearestBusDetails;