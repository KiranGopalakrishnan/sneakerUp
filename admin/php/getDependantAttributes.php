<?php
include 'database.php';
$db=new database();
$bundledData = array();
$id = $_POST["raffleID"];
$reply = $db->getShoeSizes($id);
$colors = $db->getShoeColors($id);
$bundledData["sizes"] = $reply;
$bundledData["colors"] = $colors;
echo json_encode($bundledData);
