<?php

$formData = json_decode(file_get_contents("php://input"), true);

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

//loop through all the users in the database and check if they have a longitude and latitude
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
$sql = "SELECT * FROM educUsers.users WHERE latitude IS NOT NULL AND longitude IS NOT NULL";

$result = $conn->query($sql);

$getLocSQL = "SELECT email,latitude,longitude FROM educUsers.users WHERE email = '" . $formData["email"] . "'";
$resultLoc = $conn->query($getLocSQL);

//get the users longitude and latitude
$userData = $resultLoc->fetch_object();

$userLat = $userData->latitude;
$userLong = $userData->longitude;

if ($result) {
    
    //if there are users with their location enabled
    if (mysqli_num_rows($result) > 0) {
        
        $nearbyUsers = [];
        
        $users = $result->fetch_all();
        
        //check if the users are nearby
        for($i = 0; $i < sizeof($users); $i++){
            $latitude2 = $users[$i][3];
            $longitude2 = $users[$i][4];
            $distance = distance($userLat, $userLong, $latitude2, $longitude2, "Miles");
            //similar distance to the village
            //if they are within this range, add them to the list
            if($distance <= 0.05){
                array_push($nearbyUsers, $users[$i]);
            }
        }
        
        echo json_encode($nearbyUsers);
        
    } else {
        echo "No nearby users";
    }
} else {
    echo 'Error: '. mysqli_error();
}
