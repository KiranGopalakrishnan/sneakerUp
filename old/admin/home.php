<?php
session_start();
if($_SESSION["loggedIn"]==false||!isset($_SESSION["loggedIn"])){
    header("location:login.php?error=1");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home-Admin Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="./js/main.js"></script>
</head>
<body>
    <div class="mainWrapper">
        <div class="header">
            <img src="images/logo.png"  />
        </div>
        <div class="adminOptions">
            <input type="button" class="manageButton addNewButton" value="Add New Raffle +" />
            <input type="button" class="manageButton" value="Manage Upcoming Raffles" />
            <input type="button" class="manageButton" value="View Winners" />
        </div>
        <div class="contentContainer">
            <div class="homePreview">
<h1>Current Raffle</h1>
                <div class="viewCurrentRaffle">
                    <div class="lastWinnerItem">
                        <span class="raffleName"><h3>Yeezy 350</h3></span>
                        <span class="lastRaffleEndTime"><h5>08.05.2017</h5></span>
                        <span class="endRaffleImage"><img src="../images/test-raffle.png" class="winnerRaffleImage" /></span>
                        <span class="winnerName"><h3>SIMOND</h3></span>
                        <span class="emailName"><h4>kirangplkrishnan@gmail.com</h4></span>
                    </div>
                </div>

<h1>Last Raffle Winner</h1>
                <div class="viewLastWinner">
                    <div class="lastWinnerItem">
                        <span class="raffleName"><h3>Yeezy 350</h3></span>
                        <span class="lastRaffleEndTime"><h5>08.05.2017</h5></span>
                        <span class="endRaffleImage"><img src="../images/test-raffle.png" class="winnerRaffleImage" /></span>
                        <span class="winnerName"><h3>SIMOND</h3></span>
                       <span class="emailName"><h4>kirangplkrishnan@gmail.com</h4></span>
                    </div>
                </div>

<h1>Upcoming Raffles</h1>

                <div class="upcomingRaffles">
                    <div class="upcomingItems">
                    </div>
                </div>
            </div>
        </div>
        <div class="addNew">
            <span class="closePopup"><img src="images/close.png" height="30" /></span>
            <form class="addNewRaffle" enctype="multipart/form-data">
                <h3>Add New Raffle</h3>
                <input type="text" class="shoeName" name="shoeName" placeholder="Name of the shoe" required />
                <textarea class="shoeDescription" name="description" placeholder="Description" required></textarea>
                <input type="text" class="rafflePrice" name="price" placeholder="Price" required/>
                <input type="datetime-local" class="startTime halfBox" name="start" placeholder="Start Time" required />
                <input type="datetime-local" class="endTime halfBox" name="end" placeholder="End Time" required />
                <select class="shoeSizeSelecter">
                    <option value="US M 6">US M 6</option>
                    <option value="US M 7">US M 7</option>
                    <option value="US M 8">US M 8</option>
                    <option value="US M 9">US M 9</option>
                    <option value="USM10">US M 10</option>
                    <option value="USM11">US M 11</option>
                    <option value="USM12">US M 12</option>
                    <option value="USM13">US M 13</option>
                </select>
                <div class="shoeSizeSelected">
                </div>
                <input type="file" class="selectFile" name="shoeImage" value="Select image" required />
                <input type="submit" class="addButton" value="Add Raffle" />
            </form>
        </div>
       <!-- <div class="viewWinners">
            <span class="closePopup"><img src="images/close.png" height="30" /></span>
            <div class="winnerItems">
            </div>
        </div>-->
    </div>
</body>
</html>