<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 13-03-2017
 * Time: 09:26 PM
 */
include 'database.php';
$db=new database();
$id = $_POST["id"];
$reply = $db->getRaffle($id);
echo json_encode($reply);