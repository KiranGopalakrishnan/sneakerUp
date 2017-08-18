<?php
include'./database.php';
$db=new database();
$raffleID=$_GET["raffleID"];
$data=$db->decideWinner($raffleID);
var_dump($data);
?>