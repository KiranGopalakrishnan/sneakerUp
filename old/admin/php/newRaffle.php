<?php
/**
 * Created by IntelliJ IDEA.
 * Date: 25-02-2017
 * Time: 12:51 PM
 */
 include 'database.php';
date_default_timezone_set('America/Toronto');
$db = new database();
$name = $_POST["shoeName"];
$description = $_POST["description"];
$price = $_POST["price"];
$start = date("Y-m-d H:i:s",strtotime($_POST["start"]));
$end = date("Y-m-d H:i:s",strtotime($_POST["end"]));
$image = $_FILES["shoeImage"];
$shoeSizes = json_decode($_POST["shoeSizes"]);
 //var_dump($shoeSizes);
 var_dump($shoeSizes);

$createdID = $db->newRaffle($name,$description,$price,$start,$end);
$upImage= $db->uploadImage($image,$createdID);
for($i=0;$i<count($shoeSizes);$i++){
    $db->enterShoeSizes($createdID,$shoeSizes[$i]);;
 }
echo true;
?>