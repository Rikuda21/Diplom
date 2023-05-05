<?php
$servername = "localhost";
$username = "root";
$password = "k5411894";
$dbname = "users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get image data from a file and encode it into base64 format
$image_data = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

// Insert image data into the database
$sql = "INSERT INTO images (image) VALUES ('$image_data')";
if ($conn->query($sql) === TRUE) {
  echo "Image uploaded successfully.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>