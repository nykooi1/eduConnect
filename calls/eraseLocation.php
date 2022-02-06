<?php

$formData = json_decode(file_get_contents("php://input"), true);

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

$updateQuery = "UPDATE educUsers.users SET latitude = NULL, longitude = NULL WHERE email = '" . $formData . "'";
echo $updateQuery;

$result = $conn->query($updateQuery);
