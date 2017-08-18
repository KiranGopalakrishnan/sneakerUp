<?php
/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 13-03-2017
 * Time: 01:56 PM
 */
include 'database.php';
$action = $_POST["action"];
$db=new database();
var_dump($_POST);
switch ($action){
    case "01":
        $id = $_POST["id"];
        $name = $_POST["shoeName"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $shoeColors = json_decode($_POST["shoeColors"],true);
        $start = date("Y-m-d H:i:s",strtotime($_POST["start"]));
        $end = date("Y-m-d H:i:s",strtotime($_POST["end"]));
        for($i=0;$i<count($shoeColors);$i++){
            if($shoeColors[$i]["active"]==false){
                $deleteID = $shoeColors[$i]["colorID"];
                $db->deleteShoeColor($deleteID);
                $db->deleteImage($deleteID, "../../uploads/");
            }
            if($shoeColors[$i]["imageIncluded"]==true) {
                $colorID = $db->enterColors($id, $shoeColors[$i]["name"]);
                $image = $_FILES["color".$i];
                $upImage = $db->uploadImage($image, $colorID, "../../uploads/");
            }
        }
        $shoeSizes = json_decode($_POST["shoeSizes"]);
        $db->editRaffle($id,$name,$description,$price,$start,$end);

        $db->deleteShoeSizes($id);
        for($i=0;$i<count($shoeSizes);$i++){
            $db->enterShoeSizes($id,$shoeSizes[$i]);;
        }
        echo "Done !";
        break;
    case "02":
        $id = $_POST["id"];
        $db->deleteRaffle($id);
        echo "Done";
        break;
    case "03":
        require_once 'class.exporter.php';
        $tickets = $db->getTickets($_POST["id"]);
        $exporter = new exporter();
        $exportToexcel = $exporter->toExcel($tickets);
        break;
    case "04":
        $raffleID = $_POST["id"];
        //$db->removeAllWinners($raffleID);
        $ticketID = $_POST["ticketID"];
        $location = $_POST["location"];
        $instagram = $_POST["instagram"];
        $image = $_FILES["winnerImage"];
        $imagePresent = false;
        $isEdit = $_POST["isEdit"];
        if($image["size"]>0){
            $db->uploadImage($image,$ticketID,"../../uploads/winnersImages/");
            $imagePresent = true;
        }
        $db->enterWinner($ticketID, $imagePresent, $instagram, $location);

        echo "02";
        break;
    case "05":
        $db->deleteWinner($_POST["id"]);
        break;
    case "06":

        $raffleID = $_POST["id"];
        //$db->removeAllWinners($raffleID);
        $ticketID = $_POST["ticketID"];
        $location = $_POST["location"];
        $instagram = $_POST["instagram"];
        $image = $_FILES["winnerImage"];
        $imagePresent = false;
        if($_POST["imageExists"]=='true') {
            $imagePresent = true;
        }
        var_dump($_POST);
        if($image["size"]>0){
            $db->uploadImage($image,$ticketID,"../../uploads/winnersImages/");
            $imagePresent = true;
        }
        $db->updateWinner($ticketID, $imagePresent, $instagram, $location);
        echo "06";
        break;
}