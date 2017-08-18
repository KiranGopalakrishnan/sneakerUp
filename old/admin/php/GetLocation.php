<?php

//One way to call this file is:
// http://peterboroughtransit.comuv.com/GetLocationFinal.php?RouteNo=6

//Following are the database connection properties
$host = "localhost";
$user = "id720997_transitdbuser";
$password = "transitdbpassword";
$db = "id720997_transitdb";

//The following statement creates a database connection
$con = mysqli_connect($host,$user,$password,$db);

//Retrieving the various components from the request
if($_SERVER["REQUEST_METHOD"]=="GET"){
	$RouteNo = $_GET["RouteNo"];
	//$RouteDirection = $_GET["RouteDirection"];
	//$Longitude = $_GET["Longitude"];
	//$Latitude = $_GET["Latitude"];

//$RouteNo = '6';				//Replace with Incoming JSON
//$LatitudeOrig = -78.372143;
//$LongitudeOrig = 44.276614;
//$LatitudeOrig = 44.29426817;
//$LongitudeOrig = -78.34892014;

//Set the timezone to local timezone
date_default_timezone_set("America/Toronto");

//Below Query selects the data from CurrentLocation based on Route No
$SelectQuery = "Select * from CurrentLocation WHERE RouteNo = '$RouteNo';";
$SelectResult = mysqli_query($con,$SelectQuery) or die (mysqli_error($con));


if (mysqli_num_rows($SelectResult)!=0){
	//This code is executed when an entry is available in CurrentLocation
	$response = array();
	while($row = mysqli_fetch_array($SelectResult))
	{
	//The following statement creates a JSON response to be sent back
	array_push($response,array("RouteNo"=>$row[0],"RouteDirection"=>$row[1],"Latitude"=>$row[2],"Longitude"=>$row[3]));	
	}
	echo json_encode(array("server_response"=>$response));
}
else{
	//This code is executed when no entry is available in CurrentLocation
	$response = array();
	//Following statement creates a JSON response with a message of type Error annd a message text
	array_push($response,array("MessageType"=>"Error","MessageText"=>"No entry found for Current Location of bus"));
	echo json_encode(array("server_response"=>$response));
}	
}

?>