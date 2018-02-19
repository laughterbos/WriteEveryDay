<?php

header("Content-Type: application/json");

$servername = $_POST['servername'];
$DBusername = $_POST['DBusername'];
$DBpassword = $_POST['DBpassword'];
$database = $_POST['database'];
$username = $_POST['username'];
$password = $_POST['password'];

$array = array();
$array = $servername." ".$DBusername." ".$DBpassword." "$database;

echo json_encode($array);

//Create Connection
$con = new mysqli($servername, $DBusername, $DBpassword, $database);

// Check connection
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
} 

//Sql query
$stmt = $con->prepare("SELECT UserID FROM user WHERE Username = ? and Password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

//Process results
$myArray = array();
$result = $stmt->get_result();
while($row = $result->fetch_assoc(MYSQL_ASSOC)) {
	$myArray[] = $row;
}
echo json_encode($myArray);

// Close connections
mysqli_close($con);

?>
