<?php

header("Content-Type: application/json");

$servername = $_POST['servername'];
$DBusername = $_POST['DBusername'];
$DBpassword = $_POST['DBpassword'];
$database = $_POST['database'];
$userID = $_POST['userID'];

//Create Connection
$con = new mysqli($servername, $DBusername, $DBpassword, $database);

// Check connection
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
	$NewArray[] = "Connection failed";
	echo json_encode($NewArray);
} 

//Sql query
if (!($stmt = $con->prepare("SELECT NoteID, TimeStamp, Title, Note, WordCount FROM note WHERE userID = ?"))) {
	$prepareArray[] = "Prepare failed";	
	echo json_encode($prepareArray);
}

if (!$stmt->bind_param("s", $userID)) {
	$bindArray[] = "Bind failed";
	echo json_encode($bindArray);
}

if (!$stmt->execute()) {
	$executeArray[] = "Execute array";
	echo json_encode($executeArray);
}

//Process results
$myArray = array();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()) {
	$myArray[] = $row;
}

echo json_encode($myArray);

// Close connections
$stmt->close();
mysqli_close($con);
?>
