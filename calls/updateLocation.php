<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$formData = json_decode(file_get_contents("php://input"), true);

echo $formData["latitude"] . ", " . $formData["latitude"] . ", " . $formData["email"];

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

$updateQuery = "UPDATE educUsers.users SET latitude = " . $formData["latitude"] . ", longitude = " . $formData["longitude"] . " WHERE email = '" . $formData["email"] . "'";

$result = $conn->query($updateQuery);
