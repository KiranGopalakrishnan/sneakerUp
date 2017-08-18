<?php
/**
 * Created by IntelliJ IDEA.
 * Date: 20-02-2017
 * Time: 10:53 PM
 */
include 'database.php';
$db = new database();
$routeDetails = $db->getRoutes();
echo $routeDetails;