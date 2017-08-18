<?php
include 'database.php';
$db=new database();
$reply = $db->getPreviousWinners();
echo json_encode($reply);