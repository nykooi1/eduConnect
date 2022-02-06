<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

/* Crop Function */
function jpegImgCrop($target_url) {



  $image = imagecreatefromjpeg($target_url);
  $filename = $target_url;
  $width = imagesx($image);
  $height = imagesy($image);
  $image_type = imagetypes($image); //IMG_GIF | IMG_JPG | IMG_PNG | IMG_WBMP | IMG_XPM

  if($width==$height) {

   $thumb_width = $width;
   $thumb_height = $height;

  } elseif($width<$height) {

   $thumb_width = $width;
   $thumb_height = $width;

  } elseif($width>$height) {

   $thumb_width = $height;
   $thumb_height = $height;

  } else {
   $thumb_width = 150;
   $thumb_height = 150;
  }

  $original_aspect = $width / $height;
  $thumb_aspect = $thumb_width / $thumb_height;

  if ( $original_aspect >= $thumb_aspect ) {

     // If image is wider than thumbnail (in aspect ratio sense)
     $new_height = $thumb_height;
     $new_width = $width / ($height / $thumb_height);

  }
  else {
     // If the thumbnail is wider than the image
     $new_width = $thumb_width;
     $new_height = $height / ($width / $thumb_width);
  }

  $thumb = imagecreatetruecolor( $thumb_width, $thumb_height );

  // Resize and crop
  imagecopyresampled($thumb,
         $image,
         0 - ($new_width - $thumb_width) / 2, // Center the image horizontally
         0 - ($new_height - $thumb_height) / 2, // Center the image vertically
         0, 0,
         $new_width, $new_height,
         $width, $height);
  imagejpeg($thumb, $filename, 80);

 }

$formData = json_decode($_POST["user"], true);

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

// only process image if user uploads file
if($_POST["image"] != "undefined"){
    $target_dir = "../content/images/profiles/";
    $image_dir = "http://c9.noah.kim/educonnect/content/images/profiles/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $image_file = $image_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    jpegImgCrop($target_file, basename($_FILES["image"]["name"]));
    $updateImgQuery = "UPDATE educUsers.users SET img_url = " . "'" . $image_file . "'" . "WHERE email = " . "'". $formData["email"] . "'";
    $result = $conn->query($updateImgQuery);
}

$updateQuery = "UPDATE educUsers.users SET 
name = " . "'" . $formData["name"] . "'" . ", 
bio = " . "'" . $formData["bio"] . "'". ",
major = " . "'" . $formData["major"] . "'" . ",
classes = " ."'" .  $formData["classes"] . "'" . ",
phone_number = " . "'" . $formData["phone"] . "'" .",
instagram_username = " . "'" . $formData["instagram"] . "'" . ",
linkedin_url = " . "'" . $formData["linkedIn"] . "'" . "WHERE email = " . "'". $formData["email"] . "'";

$result = $conn->query($updateQuery);
