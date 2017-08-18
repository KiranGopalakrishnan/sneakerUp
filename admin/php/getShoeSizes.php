<?php
include 'database.php';
$db=new database();
$reply = $db->getShoeSizes($_POST["raffleID"]);
echo json_encode($reply);
