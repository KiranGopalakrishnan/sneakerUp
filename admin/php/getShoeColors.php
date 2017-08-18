<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 20-03-2017
 * Time: 06:05 PM
 */
include 'database.php';
$id = $_POST["id"];
$db = new database();
$colors = $db->getShoeColors($id);
echo json_encode($colors);