<?php
include 'database.php';
$db=new database();
$currentRaffle = $db->getCurrentRaffle();
$now = date("Y-m-d H:i:s");
//var_dump($currentRaffle);
$raffleDate = new DateTime($currentRaffle[0]["endTime"]);
$currentTime = new DateTime($now);
if($raffleDate<$currentTime){
//echo "1";
   $abcd =  $db->decideWinner($currentRaffle[0]["raffleID"]);
    $db->changeStatus($currentRaffle[0]["raffleID"],"2");
    var_dump($abcd);
    $upcoming  = $db->setNextRaffle();
}
?>