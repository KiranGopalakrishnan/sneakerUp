<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 22-03-2017
 * Time: 11:18 AM
 */
include'./database.php';
$ticketID = $_POST["ticketID"];
$db=new database();
$reply = $db->getWinnerData($ticketID);
echo json_encode($reply);