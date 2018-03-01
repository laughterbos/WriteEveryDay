<?php

header("Content-Type: application/json");

$servername = $_POST['servername'];
$DBusername = $_POST['DBusername'];
$DBpassword = $_POST['DBpassword'];
$database = $_POST['database'];
$userID = intval($_POST['userID']);
$noteTitle = $_POST['noteTitle'];
$noteBody = $_POST['noteBody'];
$wordCount = intval($_POST['wordCount']);

//Create Connection
$con = new mysqli($servername, $DBusername, $DBpassword, $database);

// Check connection
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
	$NewArray[] = "Connection failed";
	echo json_encode($NewArray);
} 

//Sql query
if (!($stmt = $con->prepare("INSERT INTO note ('NoteID','UserID', 'Timestamp', 'Title', 'Note', 'Word Count') values ('',?, CURRENT_TIMESTAMP, ?, ?, ?);"))) {
	$prepareArray[] = "Prepare failed";	
	echo json_encode($prepareArray);
}

if (!$stmt->bind_param("issi", $userID, $noteTitle, $noteBody, $wordCount)) {
	$bindArray[] = "Bind failed";
	echo json_encode($bindArray);
}

if (!$stmt->execute()) {
	$executeArray[] = "Execute Failed";
	echo json_encode($executeArray);
}

//Process results
$myArray = array();
$myArray[] = "Note inserted successfully"

echo json_encode($myArray);

// Close connections
$stmt->close();
mysqli_close($con);
?>
