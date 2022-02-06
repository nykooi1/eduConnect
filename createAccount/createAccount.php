<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

//create the account in the database
$formData = json_decode(file_get_contents("php://input"), true);

//do some checks here TBD

//sets the settings to connect to the database
//we need to know our server name (defining host)
//All of these are subject to change depending on where you are trying to connect
$servername = "localhost";
$username = "root";
$password = "*******";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  echo "connection failed";
  error_log('Connection error: ' . $mysqli->connect_error);
}

//insert the row
$sql = "INSERT INTO educUsers.users (email, password, name, bio, major, classes, phone_number, instagram_username, linkedin_url) VALUES ('" . $formData["email"] . "', '" . $formData["password"] . "', '" . $formData["name"] . "', '" . $formData["bio"] . "', '" . $formData["major"] . "', '" . $formData["classes"] . "', '" . $formData["phone"] . "', '" . $formData["instagram"] . "', '" . $formData["linkedIn"] . "')";

//echo $sql;

if ($conn->query($sql) === TRUE) {
  echo "success";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
