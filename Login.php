<?php

$servername = "localhost";
$username = $_POST["username"];
$password = $_POST["password"];

//Create Connection
$con = new mysqli($servername, $username, $password, "writeeverydatabase");

// Check connection
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
} 

//Sql query
SQL = "Select UserID from User where username = $username and password = $password;"

// Check if there are results
if ($result = mysqli_query($con, $sql))
{
	// If so, then create a results array and a temporary one
	// to hold the data
	$resultArray = array();
	$tempArray = array();
 
	// Loop through each row in the result set
	while($row = $result->fetch_object())
	{
		// Add each row into our results array
		$tempArray = $row;
	    	array_push($resultArray, $tempArray);
	}
 
	// Encode the array to JSON and output the results
	echo json_encode($resultArray);
}

// Close connections
mysqli_close($con);

?>
