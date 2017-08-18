<?php
session_start();
if ($_SESSION["loggedIn"] == false || !isset($_SESSION["loggedIn"])) {
    header("location:login.php?error=1");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home-Admin Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="./js/jscolor.js"></script>
    <script src="./js/moment.js"></script>
    <script src="./js/main.js"></script>
</head>
<body>
<div class="mainWrapper">
    <div class="header">
        <img src="images/logo.png"/>
    </div>
    <div class="adminOptions">
        <input type="button" class="manageButton addNewButton" value="Add New Raffle +"/>
         </div>
    <div class="contentContainer">
        <div class="homePreview">
            <h1>Current & Upcoming Raffles</h1>

            <div class="upcomingRaffles">
                <div class="upcomingItems">
                </div>
            </div>
            <h1>Recently Ended Raffles</h1>
            <div class="previousRaffles">
                <div class="previousItems">
                </div>
            </div>
            <!--<div class="viewCurrentRaffle">
                <div class="lastWinnerItem">
                    <span class="raffleName"><h3>Yeezy 350</h3></span>
                    <span class="lastRaffleEndTime"><h5>08.05.2017</h5></span>
                    <span class="endRaffleImage"><img src="../images/test-raffle.png" class="winnerRaffleImage" /></span>
                    <span class="winnerName"><h3>SIMOND</h3></span>
                    <span class="emailName"><h4>kirangplkrishnan@gmail.com</h4></span>
                </div>
            </div>-->

            <h1>Previous Raffle Winners</h1>
            <div class="previousWinners">
                <div class="previousWinnerItems">
                </div>
            </div>

        </div>
    </div>

    <div class="overlay">
        <div class="enterColorName">
            <h3>Color Name</h3>
            <form class="colorNameForm adminForm">
                <input type="text" required placeholder="Enter a name For this color" class="textbox colorName"/>
                <input type="submit" class="addButton " value="Submit" />
            </form>
        </div>
        <div class="addNew">
        <form class="addNewRaffle" enctype="multipart/form-data">
            <h3>Add New Raffle</h3>
            <input type="text" class="shoeName" name="shoeName" placeholder="Name of the shoe" required/>
            <textarea class="shoeDescription" name="description" placeholder="Description" required></textarea>
            <input type="text" class="rafflePrice" name="price" placeholder="Price" required/>
            <input type="datetime-local" class="startTime halfBox" name="start" placeholder="Start Time" required/>
            <input type="datetime-local" class="endTime halfBox" name="end" placeholder="End Time" required/>
            <select class="shoeSizeSelecter">
                <option value="US 6">US 6</option>
                <option value="US 6.5">US 6.5</option>
                <option value="US 7">US 7</option>
                <option value="US 7.5">US 7.5</option>
                <option value="US 8">US 8</option>
                <option value="US 8.5">US 8.5</option>
                <option value="US 9">US 9</option>
                <option value="US 9.5">US 9.5</option>
                <option value="US 10">US 10</option>
                <option value="US 10.5">US 10.5</option>
                <option value="US 11">US 11</option>
                <option value="US 11.5">US 11.5</option>
                <option value="US 12">US 12</option>
                <option value="US 12.5">US 12.5</option>
                <option value="US 13">US 13</option>
            </select>
            <div class="shoeSizeSelected">
            </div>
            <input type="button" value="Add Color" class="colorSelecter"/>
            <div class="colorsSelected">
            </div>
           <input type="submit" class="addButton" value="Add Raffle"/>
        </form>
    </div>

    <div class="actionsPopup currentAndUpcomingRaffles">
        <h1>Select an action</h1>
        <form class="rafflesActionForm actionForm">
        <select class="actionSelect raffleActions">
            <option value="01">Edit Raffle</option>
            <option value="02">Delete Raffle</option>
            <option value="03">Export Tickets Data</option>
        </select>
        <input type="submit" class="actionButton" value="Go" />
        </form>
    </div>
        <div class="actionsPopup endedRaffles">
            <h1>Select an action</h1>
            <form class="winnerActionForm actionForm">
            <select class="actionSelect winnerActions">
                <option value="04">Add/Change Winner</option>
                <option value="02">Delete Raffle</option>
                <option value="03">Export Tickets Data</option>
                <option value="07">Export Firstname,Lastname,Email Data</option>
            </select>
            <input type="submit" class="actionButton" value="Go" />
            </form>
        </div>
        <div class="actionsPopup winners">
            <h1>Select an action</h1>
            <form class="endedRafflesActionForm actionForm">
            <select class="actionSelect endedRaffles">
                <option value="06">Change Winner Data</option>
            </select>
            <input type="submit" class="actionButton" value="Go" />
            </form>
        </div>
        <div class="enterWinner enterWinnerCommon">
            <h3>Enter A Winner</h3>
            <form class="winnerForm adminForm">
                <input type="text" placeholder="Enter the Ticket No" class="textbox" name="ticketID" />
                <input type="text" placeholder="Winner's Instagram" class="textbox" name="instagram" />
                <input type="text" placeholder="Winner's Location" class="textbox" name="location" />
                <input type="file" class="winnerImage" name ="winnerImage" />
                <input type="submit" class="addButton" value="Submit" />
            </form>
        </div>
        <div class="changeWinner enterWinnerCommon">
            <h3>Edit Winner Data</h3>
            <form class="winnerChangeForm adminForm">
                <input type="text" disabled placeholder="Enter the Ticket No" class="textbox ticketid" name="ticketID" />
                <input type="text" placeholder="Winner's Instagram" class="textbox instagram"  name="instagram" />
                <input type="text" placeholder="Winner's Location" class="textbox location" name="location" />
                <input type="file" class="winnerImage" name ="winnerImage" />
                <input type="submit" class="addButton" value="Submit" />
            </form>
        </div>

</div>
    </div>
    <!-- <div class="viewWinners">
         <span class="closePopup"><img src="images/close.png" height="30" /></span>
         <div class="winnerItems  ">
         </div>
     </div>-->
</div>
</body>
</html>