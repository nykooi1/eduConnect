<?php
//create the account in the database
$formData = json_decode(file_get_contents("php://input"), true);

//do some checks here TBD

//sets the settings to connect to the database
//we need to know our server name (defining host)
//All of these are subject to change depending on where you are trying to connect
$servername = "localhost";
$username = "root";
$password = "Oc-n-s-d!";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  echo "connection failed";
  error_log('Connection error: ' . $mysqli->connect_error);
}

//insert the row
$sql = "SELECT * FROM educUsers.users WHERE email='" . $formData . "'" ;
$result = $conn->query($sql);

if ($result) {
  echo json_encode($result->fetch_object());
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}