<?php

header("Content-Type: application/json");

$servername = "localhost";
$username = $_POST["username"];
$password = $_POST["password"];

//Create Connection
$con = new mysqli($servername, "Ahlquist", "Amy102!!", 'writeeverydatabase');

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
