<?php
include '../admin/php/database.php';
$db=new database();
$reply = $db->getCurrentRaffle();
echo json_encode($reply);
?>