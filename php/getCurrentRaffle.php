<?php
include '../admin/php/database.php';
$db=new database();
$reply = $db->getCurrentRaffle();
for ($i=0;$i<count($reply);$i++){
    $colors = $db->getShoeColors($reply[$i]["raffleID"]);
    $reply[$i]["colors"] = $colors;
    $sizes = $db->getShoeSizes($reply[$i]["raffleID"]);
    $reply[$i]["sizes"] = $sizes;
}
echo json_encode($reply);