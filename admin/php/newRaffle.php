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
$shoeSizes = json_decode($_POST["shoeSizes"]);
$shoeColors = json_decode($_POST["shoeColors"],true);
 //var_dump($shoeSizes);
 var_dump($_FILES);

$createdID = $db->newRaffle($name,$description,$price,$start,$end);
for($i=0;$i<count($shoeColors);$i++){
    if($shoeColors[$i]["imageIncluded"]==true&&$shoeColors[$i]["active"]==false){
        $image = $_FILES["color".$i];
        $colorID = $db->enterColors($createdID,$shoeColors[$i]["name"]);
        $upImage = $db->uploadImage($image, $colorID, "../../uploads/");
    }
}
for($i=0;$i<count($shoeSizes);$i++){
    $db->enterShoeSizes($createdID,$shoeSizes[$i],"../../uploads/");;
 }
echo true;
