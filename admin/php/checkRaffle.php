<?php
include 'database.php';
$db=new database();
$currentRaffle = $db->getCurrentRaffle();
$now = date("Y-m-d H:i:s");
if(count($currentRaffle)>0) {
    for ($i = 0; $i < count($currentRaffle); $i++) {
        $raffleDate = new DateTime($currentRaffle[$i]["endTime"]);
        $currentTime = new DateTime($now);
        if ($raffleDate < $currentTime) {
            //$abcd = $db->decideWinner($currentRaffle[$i]["raffleID"]);
            $db->changeStatus($currentRaffle[$i]["raffleID"], "2");
            $upcoming = $db->setNextRaffle();
        }
    }
}
$upcoming = $db->setNextRaffle();