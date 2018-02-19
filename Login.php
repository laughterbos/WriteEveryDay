<?php

header("Content-Type: application/json");

$servername = $_POST['servername'];
$DBusername = $_POST['DBusername'];
$DBpassword = $_POST['DBpassword'];
$database = $_POST['database'];
$username = $_POST['username'];
$password = $_POST['password'];

//$Array[] = "Servername: ".$servername." DBusername: ".$DBusername." DBpassword: ".$DBpassword." database: ".$database." username: ".$username." password: ".$password;
//" DBusername: ".$DBusername." DBpassword: ".$DBpassword." database: ".$database." username: ".$username." password: ".$password

//Create Connection
$con = new mysqli($servername, $DBusername, $DBpassword, $database);

// Check connection
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
	$NewArray[] = "Connection failed"
	echo json_encode($NewArray);
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
