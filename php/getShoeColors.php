<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 20-03-2017
 * Time: 09:04 AM
 */

include '../admin/php/database.php';
$db=new database();
$reply = $db->getShoeColors($_POST["raffleID"]);
echo json_encode($reply);