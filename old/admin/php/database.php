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

    public function newRaffle($name,$description,$price,$start,$end)
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
   public function uploadImage($image,$fileId){
   $target_dir = "../../uploads/";
   $target_file = $target_dir .$fileId.".png";

   if (move_uploaded_file($image["tmp_name"], $target_file)) {
           echo "The file ". basename( $image["name"]). " has been uploaded.";
       } else {
           echo "Sorry, there was an error uploading your file.";
       }
   }
    public function changeStatus($id,$status)
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
     public function getCurrentRaffle()
               {
                   $this->connect();
                   $stmt = $this->dataConn->prepare("SELECT * FROM `raffles` WHERE `status` = :status");
                   $stmt->bindValue(":status", "1", PDO::PARAM_STR);
                   $stmt->execute();
                   $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                   return $resultData;
                }
      public function getUpcomingRaffles()
          {
              $this->connect();
              $stmt = $this->dataConn->prepare("SELECT * FROM `raffles` WHERE `startTime` < :start AND `status` = :status ORDER BY `startTime` ASC");
              $stmt->bindValue(":status", "0", PDO::PARAM_STR);
              $stmt->bindValue(":start", date("Y-m-d H:i:s"), PDO::PARAM_STR);
              $stmt->execute();
              $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
              return $resultData;
           }
public function setNextRaffle()
          {
              $this->connect();
              $upcoming = $this->getUpcomingRaffles();
              var_dump($upcoming);
              if(count($upcoming)>0){
              $this->changeStatus($upcoming[0]["raffleID"],"1");
              }else{
              return false;
              }
           }

      public function decideWinner($id){
      if(!$this->checkWinner($id)){
            $this->connect();
                      $stmt = $this->dataConn->prepare("SELECT * FROM `soldtickets` WHERE `raffleID` = :raffleID ORDER BY RAND() LIMIT 1");
                      //$stmt->bindValue(":status", "0", PDO::PARAM_STR);
                      $stmt->bindValue(":raffleID", $id, PDO::PARAM_STR);
                      $stmt->execute();
                      $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      if(count($resultData)>0){
                      $stmt = $this->dataConn->prepare("UPDATE `soldtickets` SET`status`=:status WHERE `ticketID`=:ticketID");
                                            $stmt->bindValue(":status", "1", PDO::PARAM_STR);
                                            $stmt->bindValue(":ticketID", $resultData[0]["ticketID"], PDO::PARAM_STR);
                                            $stmt->execute();
                                            }
                      return $resultData;
       }else{
            return false;
       }
      }
      public function checkWinner($raffleID){
         $this->connect();
         $stmt = $this->dataConn->prepare("SELECT * FROM `soldtickets` WHERE `raffleID` = :raffleID AND `status` = :status");
                            $stmt->bindValue(":status", "1", PDO::PARAM_STR);
                            $stmt->bindValue(":raffleID", $raffleID, PDO::PARAM_STR);
                            $stmt->execute();
                            $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $result;
                            if(count($resultData)>0){
                                $result = true;
                            }else{
                                $result=false;
                            }
                            return $result;
      }
      public function enterTicket($id,$shoeSize,$name,$email){
                  $this->connect();
                   $stmt = $this->dataConn->prepare("INSERT INTO `soldtickets`(`raffleID`,  `shoeSize`,`buyerName`, `buyerEmail`, `status`) VALUES(:raffleId,:shoeSize,:name,:email,:status)");
                   $stmt->bindValue(":status", "0", PDO::PARAM_STR);
                    $stmt->bindValue(":raffleId", $id, PDO::PARAM_STR);
                    $stmt->bindValue(":shoeSize", $shoeSize, PDO::PARAM_STR);
                    $stmt->bindValue(":name", $name, PDO::PARAM_STR);
                    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
                    $stmt->execute();
            }
                public function enterShoeSizes($id,$shoeSize){
                              $this->connect();
                               $stmt = $this->dataConn->prepare("INSERT INTO `shoesizes`(`raffleID`, `sizeValue`) VALUES (:raffleId,:shoeSize)");
                                $stmt->bindValue(":raffleId", $id, PDO::PARAM_STR);
                                $stmt->bindValue(":shoeSize", $shoeSize, PDO::PARAM_STR);
                                $stmt->execute();
                        }
            public function getPreviousWinners(){
                  $this->connect();
                  $stmt = $this->dataConn->prepare("SELECT * FROM `raffles` WHERE `endTime` < :currentTime");
                                                       $stmt->bindValue(":currentTime", date("Y-m-d H:i:s"), PDO::PARAM_STR);
                                                       $stmt->execute();
                                                       $resultData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    for($i=0;$i<count($resultData);$i++){
                                        $stmt = $this->dataConn->prepare("SELECT * FROM `soldtickets` INNER JOIN raffles ON `raffles`.`raffleID` = `soldtickets`.`raffleID`  WHERE `soldtickets`.`raffleID` = :raffleID AND `soldtickets`.`status` = :status");
                                      $stmt->bindValue(":status", "1", PDO::PARAM_STR);
                                      $stmt->bindValue(":raffleID", $resultData[$i]["raffleID"], PDO::PARAM_STR);
                                      $stmt->execute();
                                      $resultData2[$i] = $stmt->fetchAll(PDO::FETCH_ASSOC);

                     }
                     return $resultData2;
            }


}