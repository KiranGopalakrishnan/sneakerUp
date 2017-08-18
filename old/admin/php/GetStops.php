<?php
/**
 * Created by IntelliJ IDEA.
 * Date: 21-02-2017
 * Time: 12:31 AM
 */
header('Access-Control-Allow-Origin: http://localhost');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 604800');
header("Content-type: application/json");
include 'db.php';
$gs = new database();
$stopData = $gs->getStops($_GET["RouteNo"],$_GET["RouteDirection"]);
echo $stopData;