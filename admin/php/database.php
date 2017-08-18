<?php

/**
 * Created by IntelliJ IDEA.
 * User: Kiran
 * Date: 16-02-2017
 * Time: 01:12 AM
 */
class database
{
    public function connect()
    {
        include 'db.php';
        $this->dataConn = new PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8', '' . $user . '', '' . $pass . '');
    }

    public function newRaffle($name, $description, $price, $start, $end)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `raffles`(`shoeName`, `shoeDescription`, `price`, `startTime`, `endTime`, `status`) VALUES (:name,:description,:price,:start,:end,:status)");
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":price", $price, PDO::PARAM_STR);
        $stmt->bindValue(":start", $start, PDO::PARAM_STR);
        $stmt->bindValue(":end", $end, PDO::PARAM_STR);
        $stmt->bindValue(":status", "0", PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->dataConn->lastInsertId();
        return $id;
    }
    public function editRaffle($id,$name, $description, $price, $start, $end)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("UPDATE `raffles` SET `shoeName`=:nameT,`shoeDescription`=:description,`price`=:price,`startTime`=:start,`endTime`=:endT WHERE `raffleID` = :id");
        $stmt->bindValue(":nameT", $name, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":price", $price, PDO::PARAM_STR);
        $stmt->bindValue(":start", $start, PDO::PARAM_STR);
        $stmt->bindValue(":endT", $end, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
    public function deleteRaffle($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("DELETE FROM `raffles` WHERE `raffleID` = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
    public function deleteWinner($id){
        $this->connect();
        $stmt = $this->dataConn->prepare("DELETE FROM `snkrup`.`soldtickets` WHERE `soldtickets`.`ticketID` = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
    public function uploadImage($image, $fileId,$dir)
    {
        $target_dir = $dir;
        $target_file = $target_dir . $fileId . ".png";
        if(file_exists( $target_file)) {
            chmod($target_file,0755);
            unlink($target_file); //remove the file
        }
        if (move_uploaded_file($image["tmp_name"], $target_file)) {
            echo "The file " . basename($image["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    public function deleteImage($fileId,$dir)
    {
        $target_dir = $dir;
        $target_file = $target_dir . $fileId . ".png";
        if(file_exists( $target_file)) {
            chmod($target_file,0755);
            unlink($target_file); //remove the file
        }

    }
    public function deleteFile($fileId,$dir)
    {
        $target_dir = $dir;
        $target_file = $target_dir . $fileId . ".png";
            chmod($target_file,0755);
            unlink($target_file); //remove the file
    }

    public function changeStatus($id, $status)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("UPDATE `raffles` SET `status`=:status WHERE `raffleID`= :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->bindValue(":status", $status, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }

    public function removeAllStatuses($id)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("UPDATE `raffles` SET `status`= :status WHERE `raffleID`= :id`");
        $stmt->bindValue(":status", "0", PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        return true;
    }
    public function removeAllWinners($id)
{
    $this->connect();
    $stmt = $this->dataConn->prepare("UPDATE `soldtickets` SET `status`= :status WHERE `raffleID`= :id");
    $stmt->bindValue(":status", "0", PDO::PARAM_STR);
    $stmt->bindValue(":id", $id, PDO::PARAM_STR);
    $stmt->execute();
    return true;
}


    public function getCurrentRaffle()
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `raffles` WHERE `status` = :status");
        $stmt->bindValue(":status", "1", PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function getRaffle($id)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `raffles` WHERE `raffleID` = :id");
        $stmt->bindValue(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function getShoeSizes($raffleID)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `shoesizes` WHERE `raffleID` = :raffleID");
        $stmt->bindValue(":raffleID", $raffleID, PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
public function deleteShoeSizes($raffleID){

    $this->connect();
        $stmt = $this->dataConn->prepare("DELETE FROM `shoesizes` WHERE `raffleID` = :raffleID");
        $stmt->bindValue(":raffleID", $raffleID, PDO::PARAM_STR);
        $stmt->execute();
}
    public function getUpcomingRaffles()
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `raffles` WHERE `startTime` > :start AND `status` = :status ORDER BY `startTime` ASC");
        $stmt->bindValue(":status", "0", PDO::PARAM_STR);
        $stmt->bindValue(":start", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function getPreviousRaffles()
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `raffles` WHERE `endTime` < :currentTime AND `status` = :status");
        $stmt->bindValue(":status", "2", PDO::PARAM_STR);
        $stmt->bindValue(":currentTime", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function getUpcomingAndCurrentRaffles()
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `raffles` WHERE `status` <> :status AND `endTime` > :endTime  ORDER BY `startTime` ASC");
        $stmt->bindValue(":status", "2", PDO::PARAM_STR);
        $stmt->bindValue(":endTime", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }

    public function setNextRaffle()
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `raffles` WHERE `startTime` < :start AND `status` = :status ORDER BY `startTime` ASC");
        $stmt->bindValue(":status", "0", PDO::PARAM_STR);
        $stmt->bindValue(":start", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
        $upcoming = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($upcoming); $i++) {
            $this->changeStatus($upcoming[$i]["raffleID"], "1");
        }
    }

    public function getTickets($id)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `soldtickets` WHERE `raffleID` = :raffleID");
        //$stmt->bindValue(":status", "0", PDO::PARAM_STR);
        $stmt->bindValue(":raffleID", $id, PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function getTicketsLessInfo($id)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT `firstname`,`lastname`,`buyerEmail`  FROM `soldtickets` WHERE `raffleID` = :raffleID");
        //$stmt->bindValue(":status", "0", PDO::PARAM_STR);
        $stmt->bindValue(":raffleID", $id, PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }

    public function checkWinner($raffleID)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `soldtickets` WHERE `raffleID` = :raffleID AND `status` = :status");
        $stmt->bindValue(":status", "1", PDO::PARAM_STR);
        $stmt->bindValue(":raffleID", $raffleID, PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($resultData) > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    public function setWinner($ticketID)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("UPDATE `soldtickets` SET `status` = :status WHERE `ticketID` = :ticketID");
        $stmt->bindValue(":status", "1", PDO::PARAM_STR);
        $stmt->bindValue(":ticketID", $ticketID, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function enterTicket($id, $shoeSize, $fname, $lname, $email)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `soldtickets`(`raffleID`,  `shoeSize`,`firstname`,`lastname`, `buyerEmail`,`purchaseTime`, `status`) VALUES(:raffleId,:shoeSize,:fname,:lname,:email,:time,:status)");
        $stmt->bindValue(":status", "0", PDO::PARAM_STR);
        $stmt->bindValue(":raffleId", $id, PDO::PARAM_STR);
        $stmt->bindValue(":shoeSize", $shoeSize, PDO::PARAM_STR);
        $stmt->bindValue(":fname", $fname, PDO::PARAM_STR);
        $stmt->bindValue(":lname", $lname, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":time", Date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
    }

    public function enterShoeSizes($id, $shoeSize)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `shoesizes`(`raffleID`, `sizeValue`) VALUES (:raffleId,:shoeSize)");
        $stmt->bindValue(":raffleId", $id, PDO::PARAM_STR);
        $stmt->bindValue(":shoeSize", $shoeSize, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getPreviousWinners()
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `raffles` WHERE `endTime` < :currentTime AND `status` = :status");
        $stmt->bindValue(":status", "2", PDO::PARAM_STR);
        $stmt->bindValue(":currentTime", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($resultData); $i++) {
            $stmt = $this->dataConn->prepare("SELECT `soldtickets`.`ticketID`,`raffles`.`raffleID`,`soldtickets`.`Firstname`,`soldtickets`.`Lastname`,`raffles`.`endTime`,`raffles`.`shoeName`,`winnerdata`.`instagramLink`,`winnerdata`.`isImagePresent`,`soldtickets`.`ticketID`,`winnerdata`.`Location` FROM `soldtickets` LEFT JOIN raffles ON `raffles`.`raffleID` = `soldtickets`.`raffleID` LEFT JOIN `winnerdata` ON `soldtickets`.`ticketID` = `winnerdata`.`ticketID`   WHERE `soldtickets`.`raffleID` = :raffleID AND `soldtickets`.`status` = :status");
            $stmt->bindValue(":status", "1", PDO::PARAM_STR);
            $stmt->bindValue(":raffleID", $resultData[$i]["raffleID"], PDO::PARAM_STR);
            $stmt->execute();
            $resultData2[$i] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
        return $resultData2;
    }
    public function enterColors($raffleID,$name){
        $this->connect();
        $stmt = $this->dataConn->prepare("INSERT INTO `shoecolors`(`raffleID`, `Name`) VALUES (:raffleID,:name)");
        $stmt->bindValue(":raffleID", $raffleID, PDO::PARAM_STR);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        $id = $this->dataConn->lastInsertId();
        return $id;

    }
    public function getShoeColors($raffleID)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `shoecolors` WHERE `raffleID` = :raffleID");
        $stmt->bindValue(":raffleID", $raffleID, PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function updateShoeColors($raffleID,$name)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("UPDATE `shoecolors` SET `Name` WHERE `raffleID` = :raffleID");
        $stmt->bindValue(":raffleID", $raffleID, PDO::PARAM_STR);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function deleteShoeColor($colorID){

        $this->connect();
        $stmt = $this->dataConn->prepare("DELETE FROM `shoecolors` WHERE `colorID` = :colorID");
        $stmt->bindValue(":colorID", $colorID, PDO::PARAM_STR);
        $stmt->execute();
    }
public function enterWinner($ticketID,$imagePresent,$instagram,$location){
    $this->connect();
    $stmt = $this->dataConn->prepare("INSERT INTO `winnerdata`(`ticketID`, `isImagePresent`, `status`, `instagramLink`, `Location`) VALUES (:ticketID,:imagePresent,:status,:instagram,:location)");
    $stmt->bindValue(":ticketID", $ticketID, PDO::PARAM_STR);
    $stmt->bindValue(":imagePresent", $imagePresent, PDO::PARAM_STR);
    $stmt->bindValue(":instagram", $instagram, PDO::PARAM_STR);
    $stmt->bindValue(":location", $location, PDO::PARAM_STR);
    $stmt->bindValue(":status", "1", PDO::PARAM_STR);
    $stmt->execute();
    $this->setWinner($ticketID);

}
    public function getWinnerData($ticketID)
    {
        $this->connect();
        $stmt = $this->dataConn->prepare("SELECT * FROM `winnerdata` WHERE `ticketID` = :ticketID");
        $stmt->bindValue(":ticketID", $ticketID, PDO::PARAM_STR);
        $stmt->execute();
        $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultData;
    }
    public function updateWinner($ticketID,$imagePresent,$instagram,$location){
        $this->connect();
        $stmt = $this->dataConn->prepare("UPDATE `winnerdata` SET `isImagePresent`=:imagePresent, `status`=:status, `instagramLink`=:instagram, `Location`=:location WHERE `ticketID` = :ticketID");
        $stmt->bindValue(":ticketID", $ticketID, PDO::PARAM_STR);
        $stmt->bindValue(":imagePresent", $imagePresent, PDO::PARAM_STR);
        $stmt->bindValue(":instagram", $instagram, PDO::PARAM_STR);
        $stmt->bindValue(":location", $location, PDO::PARAM_STR);
        $stmt->bindValue(":status", "1", PDO::PARAM_STR);
        $stmt->execute();

    }

}