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
	$NewArray[] = "Connection failed";
	echo json_encode($NewArray);
} 

//Sql query
if (!($stmt = $con->prepare("INSERT INTO `user` (`UserID`, `Username`, `Password`) VALUES (NULL, ?, ?)"))) {
	$prepareArray[] = "Prepare failed";	
	echo json_encode($prepareArray);
}

if (!$stmt->bind_param("ss", $username, $password)) {
	$bindArray[] = "Bind failed";
	echo json_encode($bindArray);
}

if (!$stmt->execute()) {
	$executeArray[] = "Sign Up failed";
	echo json_encode($executeArray);
}

$stmt->close();

//Sql query
if (!($login = $con->prepare("SELECT UserID FROM user WHERE Username = ? and Password = ?"))) {
	$prepareArray[] = "Prepare failed";	
	echo json_encode($prepareArray);
}

if (!$login->bind_param("ss", $username, $password)) {
	$bindArray[] = "Bind failed";
	echo json_encode($bindArray);
}

if (!$login->execute()) {
	$executeArray[] = "Login failed";
	echo json_encode($executeArray);
}

//Process results
$myArray = array();
$result = $login->get_result();
while($row = $result->fetch_assoc()) {
	$myArray[] = $row;
}

echo json_encode($myArray);

$login->close();

// Close connections
mysqli_close($con);

?>
