<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$formData = json_decode(file_get_contents("php://input"), true);

// check if user exists

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

$queryEmail = "SELECT * FROM educUsers.users WHERE email = '" . $formData["email"] . "'";
$queryPassword = "SELECT password FROM educUsers.users WHERE email = '" . $formData["email"] . "'";
$resultEmail = $conn->query($queryEmail);


if ($resultEmail) {
    // if the user exists
    if (mysqli_num_rows($resultEmail) > 0) {
        $resultPassword = $conn->query($queryPassword);
        if($resultPassword->fetch_object()->password == $formData["password"]){
            echo "login"; 
        }else{
            echo "incorrect password";
        }
    } 
    // if user does not exists
    else {
        echo 'not found';
    }
} else {
    echo 'Error: '. mysqli_error();
}
