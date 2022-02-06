<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$formData = json_decode(file_get_contents("php://input"), true);

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

$updateQuery = "UPDATE educUsers.users SET 
name = " . $formData["name"] . ", 
bio = " . $formData["bio"] . ",
major = " . $formData["major"] . ",
classes = " . $formData["classes"] . ",
phone_number = " . $formData["phone"] . ",
instagram_username = " . $formData["instagram"] . ",
linkedin_url = " . $formData["linkedIn"] . ",
WHERE email = '" . $formData["email"] . "'";

$result = $conn->query($updateQuery);