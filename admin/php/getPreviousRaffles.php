<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 11-03-2017
 * Time: 11:34 PM
 */
 include 'database.php';
date_default_timezone_set('America/Toronto');
$db = new database();
$previous = $db->getPreviousRaffles();
$previousFinal = array();
foreach ($previous as $singleItem){
    $singleItem["winnerDecided"] = $db->checkWinner($singleItem["raffleID"]);
    $previousFinal[count($previousFinal)] = $singleItem;
}

echo json_encode($previousFinal);