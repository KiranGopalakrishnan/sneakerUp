<?php

//One way to call this file is:
// http://peterboroughtransit.comuv.com/ProvideLocationFinal.php?RouteNo=7&RouteDirection=Towards%20Fleming&Latitude=44.29455552&Longitude=-78.34966600

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
	$RouteDirection = $_GET["RouteDirection"];
	$Longitude = $_GET["Longitude"];
	$Latitude = $_GET["Latitude"];
	
	//$RouteNo = '6';
	//$RouteDirection = 'Towards Fleming';
	//$Latitude = 44.29455552;
	//$Longitude = -78.34966600;
	//$Latitude = 34.052235;		//Los Angeles
	//$Longitude = -118.243683;		//Los Angeles
	
	
	//Check if the Lat and Long is in Peterborough or not
	//Google Geocoding is used to validate this
	$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$Latitude.",".$Longitude."&sensor=true";
	$data = @file_get_contents($url);
	
	//Following statement converts the data retrieved into JSON format
    $jsondata = json_decode($data,true);	
	foreach ($jsondata["results"] as $result) {
    foreach ($result["address_components"] as $address) {
        if (in_array("locality", $address["types"])) {
			//Reading only the Locality component as it contains the city name
			$city = $address["long_name"];
        }
    }
}
	//echo "I found that the coordinate is in $city <br>";
	
	if($city !="Peterborough")
	{	
		//If  city name returned is not "Peterborough", the user's coordinates are outside Peterborough
		$response = array();
		//Following statement creates a JSON response with a message of type Error annd a message text
		array_push($response,array("MessageType"=>"Error","MessageText"=>"User's Coordinate is outside Peterborough"));
		echo json_encode(array("server_response"=>$response));
		exit;
		//Exited the code after returning error message as further processing is not required
	}
	//Lat Long check ends here
	
	
	//Set the timezone to local timezone
	date_default_timezone_set("America/Toronto");
	
	//Finding the current time at server
	$timeNow = date("Y-m-d H:i:s",round(time()/60)*60);
	
	//Check if the dynamic table contains the entry for the rout number and direction
	$SelectQuery = "Select * from CurrentLocation where RouteNo = '$RouteNo' AND RouteDirection = '$RouteDirection';";		//creates the query
	$SelectResult = mysqli_query($con,$SelectQuery) or die (mysqli_error($con));		//executes the query and takes the result into a variable

	
	//Now insert the new dynamic location
	$InsertQuery = "Insert into CurrentLocation (RouteNo, RouteDirection, Longitude, Latitude, TimeUpdated) values ('$RouteNo','$RouteDirection','$Longitude','$Latitude','$timeNow')";
	$InsertResult = mysqli_query($con,$InsertQuery);
	if($InsertResult){
		//This code is executed when the entry is successfully inserted
		$response = array();
		//Following statement creates a JSON response with a message of type Success annd a message text
		array_push($response,array("MessageType"=>"Success","MessageText"=>"User's Current Location Successfully Updated"));
		echo json_encode(array("server_response"=>$response));
	}else{
		//This code is executed when the entry could not be inserted
		$response = array();
		//Following statement creates a JSON response with a message of type Error annd a message text
		array_push($response,array("MessageType"=>"Error","MessageText"=>"Error while updating User's Current Location"));
		echo json_encode(array("server_response"=>$response));
	}
	
	//Closing the database connection before ending the code 
	mysqli_close($con);
}
?>